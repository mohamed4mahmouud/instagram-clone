<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;

use App\Models\User;
use Illuminate\Http\Request;
use function Termwind\render;
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
        $posts=User::find(1)->posts;
        return view('posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('posts.create');
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
        for ($i=0; $i<count($request->file('files')) ; $i++) { 
            if ($request ->hasFile('files')&& $request->file('files')[$i]->isValid()) {
                $imagepath=$request->file('files')[$i]->store('images','public');
                $images[$i]=$imagepath;
            }
            
        }
 
        $post->images=json_encode($images);
        $post->save();

        $postTag = new PostsTag();
        $postTag->post_id = $post->id;
        $postTag->tag_id = $tag->id;
        $postTag->save();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
