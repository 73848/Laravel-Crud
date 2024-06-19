<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function deletePost(Post $post) {
           $post->delete();
           return redirect('/home');
        
    }
    public function showPost(Post $post){
        if(auth()->user()->id !== $post['user_id']){ // verifica  se o usuário cadastrado é o mesmo que é o dono do post a ser editado
            return view('/home');
        }
        return view('edit',  ['post' => $post] );
    }
    public function editPost(Post $post, Request $request){
        if(auth()->user()->id !== $post['user_id']){ 
            // verifica  se o usuário cadastrado é o mesmo que é o dono do post a ser editado
            return redirect('/home');
        } 
        $inputForm = $request->validate([
            'title'=> 'required',
            'body'=>['required','max:1000'],
        ]);

        $post['title'] = $inputForm['title'];
        $post['body'] = $inputForm['body'];

        $post->update($inputForm);
        return redirect('/home');
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
