<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show($post)
    {
        $post = Post::find($post);
        // $post = Post::where('title', 'Javascript')->first(); //this makes limit 1 and returns first result  select * from posts where title = 'Javascript' limit 1;
        // $postsWithTitle = Post::where('title', 'Javascript')->get(); //this gets all results select * from posts where title = 'Javascript';

        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('posts.create',[
            'users' => User::all()
        ]);
    }

    public function store(StorePostRequest $myRequestObject)
    {

        
        $data = $myRequestObject->all();
        //$data = request()->all();
        // request()->title == $data['title']

        // $myRequestObject->validate([
        //     'title' => ['required', 'min:3'],
        //     'description' => ['required']
        // ],[
        //     'title.required' => 'watch out the title is required dadasd',
        //     'title.min' => 'override the min',
        // ]);

        Post::create($data);

        // Post::create($myRequestObject->all());

        // Post::create([
        //     'title' => $data['title'],
        //     'description' => $data['description'],
        //     'id' => 1, //those will be ignore cause they aren't in fillable
        //     'ajsnhdoiqwjsd' => 'aikoshdiahsdui' //those will be ignore cause they aren't in fillable
        // ]);

        //with this syntax you don't need fillable
        // $post = new Post;
        // $post->title = $data['title'];
        // $post->description = $data['description'];
        // $post->save();

        return redirect()->route('posts.index');
    }

    // public function delete ($id){
    //     $post =Post::find($id);

    //     if($post){
    //         $post->delete();
    //         return response()->json("Deleted Successfully");
    //     }
    //     return response()->json("Not Found To Be Deleted");
        
    // }

   
    // public function updateform($id)
    // {
    //     # code...
    //     $posts = Post::all();
    //     $post = Post::find($id);
    //     return response()->json([$id,$post,$posts]);
    // }

  


    // public function update( StorePostRequest $request ,$id)
    // {
    //     # code...
    //     $validated = $request->validated();
    //     $post = Post::find($id);
    //     $post->name=$validated['name'];
    //     $post->update();
    //     $posts = Post::all();
    //     return response()->json(["updated successfully",$posts]);
    // }
}
