<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }
    public function create() {
        return view('post.create');
    }

    public function store(Request $request){
        $validation  = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg'
        ]);

        try{
            $post = new Post();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->user_id = Auth::user()->id;

            if($request->has('image')){
                $file = $request->file('image');
                $destination = 'uploads';
                $file_name = rand(1, 100).$file->getClientOriginalName();
                $path = $destination."/".$file_name;
                $file->move($destination, $path);
                $post->image = $path;
            }
            $post->save();

            return redirect('posts')->with("message", 'insert success');
        }catch(Exception $e){
            return redirect()->back()->with('message', $e);
        }
    }

    public function edit($id){
        $post = Post::where('id', $id)->first();
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $id){
        $validation  = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        try{
            $post = Post::where('id', $id)->first();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->user_id = Auth::user()->id;

            if($request->has('image')){
                $file = $request->file('image');
                $destination = 'uploads';
                $file_name = rand(1, 100).$file->getClientOriginalName();
                $path = $destination."/".$file_name;
                $file->move($destination, $path);
                $post->image = $path;
                if(File::exists($post->image)){
                    File::delete($post->image);
                }
            }
            $post->save();

            return redirect('posts')->with("message", 'insert success');
        }catch(Exception $e){
            return redirect()->back()->with('message', $e);
        }
    }

    public function delete($id){
        $post = Post::where('id', $id)->first();
        if(File::exists($post->image)){
            File::delete($post->image);
        } 
        $post->delete();
        return redirect('posts')->with("message", 'delete  success');
    }
}
