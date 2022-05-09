<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //
    public function index(){

        $posts = Post::paginate(5);

        return view('admin.posts.index', ['posts'=>$posts]);
    }
    
    public function show(Post $post){
        return view('blog-post', ['post'=>$post]);
    }

    public function create(){
        return view('admin.posts.create');
    }

    public function store(Request $request){
        $this->authorize('create', Post::class);
        $input = request()->validate([
          'title' => 'required|min:8|max:255',
           'post_image'=>'file',
            'body' => 'required'
       ]);
 
      if($file = request('post_image')){
 
           $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $input['post_image'] = $name;
        }
        auth()->user()->posts()->create($input);
        $request->session()->flash('post-create-message', 'Post was created ' . $input['title']);
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post, Request $request){

        

         $post->delete();
         $request->session()->flash('message', 'Post was deleted');
         return back();
    }

    public function edit(Post $post){
        $this->authorize('view', $post);
        if(auth()->user()->can('view', $post)){


       }
        return view('admin.posts.edit', ['post'=>$post]);
    }

    public function update(Post $post, Request $request){
        $input = request()->validate([
            'title' => 'required|min:8|max:255',
             'post_image'=>'file',
              'body' => 'required'
         ]);

         if($file = request('post_image')){
 
            $name = $file->getClientOriginalName();
             $file->move('images', $name);
             $input['post_image'] = $name;
         }

         
         $post->title = $input['title'];
         $post->body = $input['body'];

         $this->authorize('update', $post);
         
         auth()->user()->posts()->save($post);

         $request->session()->flash('post-update-message', 'Post was updated');
         return redirect()->route('posts.index');
    }
        
}
