<?php

namespace App\Http\Controllers;

use App\Events\PostComment;
use App\Models\Comment;
use Carbon\Carbon;
use App\Models\Tag;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PostsTag;

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
        // check if the post has comments or not
        if(!$post->comments->isEmpty()){
        $created_at = Carbon::parse($post->comments[0]->created_at);
        $post->timeDifference = $created_at->diffForHumans();
        }
        
      
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
        $like = new Like();
        $like->user_id = $user->id;
        $like->post_id = $request->post;
        $like->save();
        return ['msg' => 'liked successfully'];
    }

    public function commentPost(Request $request)
    {
        $comment = new Comment();
        $comment->post_id = $request->post;
        $comment->user_id = User::find(1)->id;
        $comment->body=$request->json()->get('comment');
        $comment->saveOrFail();
        event(new PostComment($comment));

        return response()->json(['message' => 'Commented on post '.$comment]);
    }
    
    public function test(){
        $posts=Post::with('comments')->get();
        dd($posts[5]->comments_count);
    }

    public function tagsView(string $id){
        $posts = Post::find(35);
        $posts->images = json_decode($posts->images, true);

        $tag = Tag::find($id);
        $postTag = PostsTag::where('tag_id', $id)->get();
        // dd($postTag->post->caption);
        return view('posts.tags',["posts"=>$postTag , "tag"=>$tag]);
    }
}