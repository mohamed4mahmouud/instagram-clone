<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Events\AddLike;
use App\Events\PostAdd;
use App\Events\TagPost;
use App\Models\Comment;
use App\Models\PostsTag;
use App\Models\SavedPost;
use App\Events\PostComment;
use Illuminate\Http\Request;
use App\Events\RemovePostLike;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NotificationLikeAdded;
use App\Notifications\NotificationCommentAdded;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public $user;

    public function index()
    {
        // $posts=User::find(1)->posts();
        $user = User::find(Auth::id());
        $followedUsersIds = $user->following()->pluck('followee_id');
        $latestPosts = Post::whereIn('user_id', $followedUsersIds)->latest()->take(9)->get();
        foreach ($latestPosts as $post) {
            $post->images = json_decode($post->images, true);
            $created_at = Carbon::parse($post->created_at);
            foreach ($post->comments as $comment) {
                $commentCreateTime = Carbon::parse($comment->created_at);
                $comment->timeDifference = $commentCreateTime->shortRelativeDiffForHumans();
            }
            $post->timeDifference = $created_at->diffForHumans();
        }
        // dd($post->likes);
        return view('posts.index', ['posts' => $latestPosts, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();
        $request->validate([
            'tags.*' => 'regex:/^#[^\s]+$/'
        ]);
        // post cption and images store
        $post->caption = $request->input('caption');
        $post->user_id = Auth::user()->id;
        $images = [];
        for ($i = 0; $i < count($request->file('files')); $i++) {
            if ($request->hasFile('files') && $request->file('files')[$i]->isValid()) {
                $imagepath = $request->file('files')[$i]->store('images', 'public');
                $images[$i] = $imagepath;
            }
        }
        $post->images = json_encode($images);
        event(new PostAdd($post));
        $post->save();

        // tag store
        preg_match_all('/#(\w+)/', $post->caption, $matches);
        $hashtags = $matches[1];

        for ($i = 0; $i < count($hashtags); $i++) {
            $tag = new Tag();
            $tag->name = $hashtags[$i];
            $tagName = $tag->name;
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            event(new TagPost($tag));
            $tag->save();

            //save tags and post_id in post_tag table
            if ($hashtags) {
                $postTag = new PostsTag();
                $postTag->post_id = $post->id;
                $postTag->tag_id = $tag->id;
                $postTag->save();
            }
        }

        return redirect()->route('posts.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        $post->images = json_decode($post->images, true);
        // check if the post has comments or not
        if (!$post->comments->isEmpty()) {
            $created_at = Carbon::parse($post->comments[0]->created_at);
            $post->timeDifference = $created_at->diffForHumans();
        }

        preg_match_all('/#(\w+)/', $post->caption, $matches);
        $tags = $matches[1];
        // $caption_with_tags = preg_replace('/#(\w+)/', '<span class="tag">#$1</span>', $post->caption);

        $user=Auth::user();
        return view('posts.show' , ['post' => $post, 'user'=>$user]);

    }
    
    public function likePost(Request $request)
    {
        $user = User::find($request->user);

        $like = Like::where([
            'user_id' => $request->user,
            'post_id' => $request->post
        ])->first();

        if ($like) {
            event(new RemovePostLike($like));
            $like->delete();
            return ['msg' => 'like removed' . $like];
        } else {
            $like = new Like();
            $like->user_id = $request->user;
            $like->post_id = $request->post;
            $like->save();
            event(new AddLike($like));
            $user->notify(new NotificationLikeAdded($like));
            return ['msg' => 'Liked by you'];
        }
    }

    public function commentPost(Request $request)
    {
        $user = User::find($request->user);
        $comment = new Comment();
        $comment->post_id = $request->post;
        $comment->user_id = $request->user;
        $comment->body = $request->commentbody;
        $comment->saveOrFail();
        event(new PostComment($comment));
        $user->notify(new NotificationCommentAdded($comment));
        return response()->json(['message' => 'Commented on post ' . $comment]);
    }

    public function test()
    {
        dd(Auth::user());
    }

    public function tagsView(string $id)
    {
        // $posts = Post::find(35);
        // $posts->images = json_decode($posts->images, true);

        // $tag = Tag::find($id);
        $postTag = PostsTag::where('tag_id', $id)->get();


        // dd($postTag[0]->posts);
        $tag = Tag::find($id);
        // dd($tag->id);
        // $tag->posts[0]->images = json_decode($tag->posts[0]->images, true);
        foreach ($tag->posts as $post) {
            $post->images = json_decode($post->images, true);
            // dd( $tag->name );
        }
        $user = Auth::user();
        return view('posts.tags', ["posts" => $postTag, "tag" => $tag, "user" => $user]);
    }
    public function savePost(Request $request)
    {
        //save post to a random user

        $user = User::find(Auth::id());
        $savedPost = SavedPost::where([
            'user_id' => $user->id,
            'post_id' => $request->postId
        ])->first();
        if ($savedPost) {
            $savedPost->delete();
        } else {
            $savedPost = new SavedPost();
            $savedPost->user_id = $user->id;
            $savedPost->post_id = $request->postId;
            $savedPost->save();
        }
        return ['MSG' => 'Post saved successfully'];
    }


}
