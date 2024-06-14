<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showPost(Post $post){
        if(auth()->check()){
            return view('edit',  ['post' => $post] );
        }
    }
    public function editPost(Request $request){
        if(auth()->check()){
            $inputForm = $request->validate([
                'title'=> 'required',
                'body'=>['required','max:1000'],
            ]);
            $inputForm['title'] = $request->title;
            $inputForm['body'] = $request->body;
            $inputForm->save();
            return redirect('/home');
        }
    }

    // function that will handle the post 
    public function createPostBlog(Request $request){
        $inputForm = $request->validate([
            'title'=> 'required',
            'body'=>['required','max:1000'],
        ]);
        // protected from  input with html tags
        $inputForm['title'] = strip_tags($inputForm['title']);
        $inputForm['body'] = strip_tags($inputForm['body']);
        $inputForm['user_id'] = auth()->id();

        Post::create($inputForm); // creating a post
        return redirect('/home');
    }
}
