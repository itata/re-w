<?php

namespace App\Http\Controllers\Api\V1;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        $posts = Post::selectRaw('posts.id, posts.post_title, posts.post_image, posts.post_status, users.name ')
        ->join('users' , 'posts.post_author' ,'=' , 'users.id')
        ->where('post_type', 'page')
        ->orderBy('posts.created_at', 'desc')
        ->get() ;
		return response()->json($posts);
    }
    public function indexFront()
    {
        $posts = Post::selectRaw('posts.id, posts.post_title, posts.post_image, posts.post_status, categories.category_name, users.name, posts.created_at ')
        ->join('users' , 'posts.post_author' ,'=' , 'users.id')
        ->join('categories' , 'posts.categoryID' , '=' , 'categories.id')
        ->where('post_type', 'page')
        ->where('post_status', 'Active')
        ->orderBy('posts.created_at', 'desc')
        ->get();
		return response()->json($posts);
    }
    public function detailFront($id) {
        $posts = Post::selectRaw('posts.id, posts.post_title, posts.post_image, posts.post_status, users.name, posts.post_content, posts.created_at ')
        ->join('users' , 'posts.post_author' ,'=' , 'users.id')
        ->where('post_type', 'page')
        ->where('post_status', 'Active')
        ->where('posts.id', $id)
        ->get();
		return response()->json($posts);
    }
    public function show($id)
    {
        return Post::findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $input = $request->all();
        $input['post_type'] = 'page';
        $post->update($input);
        return $post;
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $input['post_type'] = 'page';
        $input['post_author'] = 1;
        $post = Post::create($input);
        return $post;
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return '';
    }
}
