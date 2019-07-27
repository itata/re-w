<?php

namespace App\Http\Controllers\Api\V1;

use App\Post;
use App\Join;
use App\Support;
use App\Meta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index()
    {
        $posts = Post::selectRaw('posts.id, posts.post_title, posts.post_image, posts.post_status, categories.category_name, users.name ')
        ->join('users' , 'posts.post_author' ,'=' , 'users.id')
        ->join('categories' , 'posts.categoryID' , '=' , 'categories.id')
        ->where('post_type', 'project')
        ->get() ;
		return response()->json($posts);
    }
    public function indexFront() {
        $posts = Post::where('post_type', 'project')->paginate(2);
		return response()->json($posts);
    }
    public function detailFront($id) {
        $posts = Post::selectRaw('posts.id, posts.post_title, posts.post_image, posts.post_status, categories.category_name, users.name, posts.post_content, posts.created_at ')
        ->join('users' , 'posts.post_author' ,'=' , 'users.id')
        ->join('categories' , 'posts.categoryID' , '=' , 'categories.id')
        ->where('post_type', 'project')
        ->where('post_status', 'Active')
        ->where('posts.id', $id)
        ->get();
		return response()->json($posts);
    }
    public function projectsOnMV() {
        $posts = Post::selectRaw('posts.id, posts.post_title, posts.post_image, posts.post_status, categories.category_name, users.name, posts.post_content, posts.created_at ')
        ->join('users' , 'posts.post_author' ,'=' , 'users.id')
        ->join('categories' , 'posts.categoryID' , '=' , 'categories.id')
        ->join('metas' , 'posts.id' , '=' , 'metas.IDS')

        ->where('meta_key', '_onmv')
        ->where('meta_value', 'true')
        ->where('post_type', 'project')
        ->where('post_status', 'Active')
        ->get();
		return response()->json($posts);
    }
    public function projectsOnTop() {
        $posts = Post::selectRaw('posts.id, posts.post_title, posts.post_image, posts.post_status, categories.category_name, users.name, posts.post_content, posts.created_at ')
        ->join('users' , 'posts.post_author' ,'=' , 'users.id')
        ->join('categories' , 'posts.categoryID' , '=' , 'categories.id')
        ->join('metas' , 'posts.id' , '=' , 'metas.IDS')

        ->where('meta_key', '_ontop')
        ->where('meta_value', 'true')
        ->where('post_type', 'project')
        ->where('post_status', 'Active')
        ->get();
		return response()->json($posts);
    }

    public function joinedProject($id) {
        $posts = Join::selectRaw('posts.id, posts.post_title, posts.post_image, posts.post_status')
        ->join('posts' , 'posts.id' ,'=' , 'joins.postID')
        ->where('posts.post_type', 'project')
        ->where('joins.userID', $id)
        ->get() ;
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
        $input['post_type'] = 'project';
        $post->update($input);
        return $post;
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $input['post_type'] = 'project';
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
    public function joinProject(Request $request) {
        $input = $request->all();
        $join = Join::create($input);
        return response()->json([
            'data' => $join
        ], 200);
    }
    public function joinProjectCk($projectID, $userID) {
        $join = Join::selectRaw('*')
        ->where('postID', $projectID)
        ->where('userID', $userID)
        ->get();
		return response()->json($join);
    }
    public function countuserProject($projectID) {
        $join = Join::where('postID','=', $projectID)->count();
        return response()->json($join);
    }
    public function countdamgeProject($projectID) {
        $countDmg = DB::table('joins')->where('postID','=', $projectID)->sum('enjoy_damge');
		return response()->json($countDmg);
    }
    public function supportProject(Request $request) {
        $input = $request->all();
        $support = Support::create($input);
        return response()->json([
            'data' => $support
        ], 200);
    }
    public function supportProjectCk($projectID, $userID) {
        $join = Support::selectRaw('*')
        ->where('postID', $projectID)
        ->where('userID', $userID)
        ->get();
		return response()->json($join);
    }
    public function countSupportProject($projectID) {
        $join = Support::where('postID','=', $projectID)->count();
        return response()->json($join);
    }
    public function getUserJoin($projectID) {
        $join = Join::selectRaw('users.id, users.name')
        ->join('users' , 'joins.userID' ,'=' , 'users.id')
        ->where('postID', $projectID)
        ->get();
		return response()->json($join);
    }
    public function getUserSupport($projectID) {
        $join = Support::selectRaw('users.id, users.name')
        ->join('users' , 'supports.userID' ,'=' , 'users.id')
        ->where('postID', $projectID)
        ->get();
		return response()->json($join);
    }

    public function addMeta(Request $request)
    {
        $input = $request->all();
        $meta = Meta::create($input);
        return $meta;
    }
    public function addMeta1(Request $request)
    {
        $input = $request->all();
        $meta1 = Meta::create($input);
        return $meta1;
    }
    public function addMeta2(Request $request)
    {
        $input = $request->all();
        $meta1 = Meta::create($input);
        return $meta1;
    }

    public function getMeta($id, $key) {
        $posts = Meta::selectRaw('*')
        ->where('IDs', $id)
        ->where('meta_key', $key)
        ->get();
		return response()->json($posts);
    }

    public function updateMeta(Request $request, $id, $key)
    {
        $post = Meta::findOrFail($id);
        $input = $request->all();
        $input['post_type'] = $key;
        $post->update($input);
        return $post;
    }

}
