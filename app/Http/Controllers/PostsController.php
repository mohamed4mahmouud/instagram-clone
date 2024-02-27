<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Events\AddLike;

use App\Events\PostAdd;
use App\Models\Comment;
use App\Models\PostsTag;
use App\Events\PostComment;
use Illuminate\Http\Request;
use App\Events\RemovePostLike;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts=User::find(1)->posts();
        $posts = User::find(1)->posts;
        foreach ($posts as $post) {
            $post->images = json_decode($post->images, true);
            $created_at = Carbon::parse($post->created_at);
            foreach ($post->comments as $comment) {
                $commentCreateTime = Carbon::parse($comment->created_at);
                $comment->timeDifference = $commentCreateTime->shortRelativeDiffForHumans();
            }
            $post->timeDifference = $created_at->diffForHumans();
        }

        $user = User::find(1);
        return view('posts.index', ['posts' => $posts, 'user' => $user]);
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

        $post->caption= $request->input('caption');

        preg_match_all('/#(\w+)/', $post->caption, $matches);
        $hashtags = $matches[1];
        
        for ($i=0; $i < count($hashtags); $i++) { 
            $tag=new Tag();       
            $tag->name=$hashtags[$i];
            $tagName= $tag->name;
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tag->save();
           
        }
    

        
        $post->user_id= User::all()->random()->id;
        $images=[];
        // dd($request->all());
        // dd($request->input('caption'));
        for ($i=0; $i<count($request->file('files')) ; $i++) { 
            if ($request ->hasFile('files')&& $request->file('files')[$i]->isValid()) {
                $imagepath=$request->file('files')[$i]->store('images','public');
                $images[$i]=$imagepath;
            }
        }
 
        $post->images=json_encode($images);
        $post->save();
        event(new PostAdd($post));
        if($hashtags){
        $postTag = new PostsTag();
        $postTag->post_id = $post->id;
        $postTag->tag_id = $tag->id;
        $postTag->save();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post ::find($id);
        $post->images = json_decode($post->images, true);
        $created_at = Carbon::parse($post->comments[0]->created_at);
        // dd( $created_at ->diffForHumans());
        $post->timeDifference = $created_at->diffForHumans();
        // dd($post->images[0]);
        return view('posts.show' , ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function likePost(Request $request)
    {

        // TODO : 
        // User that is logged in will be used instead to put his like 
        // for the sake of the test right now 
        //iam using user with id for testing right now

        $user = User::find(1);
        $like = Like::where([
            'user_id' => $user->id,
            'post_id' => $request->post
        ])->first();
        // return ['msg'=>$like];

        if ($like) {
            event(new RemovePostLike($like));
            $like->delete();
            return ['msg' => 'like removed' . $like];
        } else {
            $like = new Like();
            $like->user_id = $user->id;
            $like->post_id = $request->post;
            $like->save();
            event(new AddLike($like));
            return ['msg' => 'liked successfully'];
        }
    }

    public function commentPost(Request $request)
    {
        $comment = new Comment();
        $comment->post_id = $request->post;
        $comment->user_id = User::find(1)->id;
        $comment->body = $request->json()->get('comment');
        $comment->saveOrFail();
        event(new PostComment($comment));

        return response()->json(['message' => 'Commented on post ' . $comment]);
    }

    public function test()
    {
        $posts = Post::with('likes')->get();
        foreach ($posts as $post) {
            foreach ($post->likes as $like) {
                dd($like->user);
            }
        }
    }
}
