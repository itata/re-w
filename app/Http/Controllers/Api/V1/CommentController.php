<?php

namespace App\Http\Controllers\Api\V1;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index()
    {
        $commets = Comment::selectRaw('comments.id, posts.post_title, users.name, comment_content')
        ->join('users' , 'comments.userID' ,'=' , 'users.id')
        ->join('posts' , 'comments.postID' , '=' , 'posts.id')
        ->orderBy('created_at', 'desc')
        ->get();
		return response()->json($commets);
    }

    public function getCommentOfPost($postID)
    {
        $commets = Comment::selectRaw('comments.id, posts.post_title, users.name, comment_content, comments.created_at')
        ->join('users' , 'comments.userID' , '=' , 'users.id')
        ->join('posts' , 'comments.postID' , '=' , 'posts.id')
        ->where('postID', $postID)
        ->orderBy('created_at', 'asc')
        ->get();
		return response()->json($commets);
    }
    public function destroy($id)
    {
        $post = Comment::findOrFail($id);
        $post->delete();
        return '';
    }
    public function addComment(Request $request) {
        $input = $request->all();
        $comment = Comment::create($input);
        return $comment;
    }
}
