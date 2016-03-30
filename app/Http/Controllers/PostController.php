<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Category;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getBlogIndex', 'getSinglePost']]);
    }
 	public function getBlogIndex()
    {
        $posts = Post::paginate(5);
        foreach ($posts as $post) {
            $post->body = $this->shortenText($post->body, 20);
        }
    	return view('blog.index', compact('posts'));
    }

    public function getPostIndex()
    {
        $posts = Post::paginate(5);
        return view('admin.index', compact('posts'));
    }

    public function getSinglePost($post_id, $end = 'blog')
    {
        $post = Post::find($post_id);
        if(!$post){
            return redirect()->route('blog.index')->with(['fail' => 'Post not find']);
        }
    	return view($end . '.single', compact('post'));
    }

    public function getCreatePost()
    {
        $categories = Category::all();
    	return view('blog.create_post', compact('categories'));
    }

    public function postCreatePost(CreatePostRequest $request)
    {
    	$blog = new Post();
    	$blog->title = $request->title;
    	$blog->body = $request->body;
    	auth()->user()->posts()->save($blog);
        if(strlen($request->categories) > 0){
            $categoriesIDs = explode(',', $request->categories);
            foreach ($categoriesIDs as $categoryID) {
                $blog->categories()->attach($categoryID);
            }
        }

        return redirect()->route('blog.index')->with(['success' => 'Post succsessfully created!']);
    }

    public function getUpdatePost($post_id)
    {   
        $post = Post::find($post_id);
        $categories = Category::all();
        $post_categories = $post->categories;
        $post_categories_ids = [];
        $i = 0;
        foreach ($post_categories as $post_category) {
            $post_categories_ids[$i] = $post_category->id;
            $i++;
        }
        if(!$post){
            return redirect()->route('admin.blog.index')->with(['fail' => 'Post not found']);
        }
        //find categories
        return view('blog.edit_post', compact('post', 'categories', 'post_categories', 'post_categories_ids'));
    }

    public function postUpdatePost(UpdatePostRequest $request)
    {       
        $post = Post::find($request->post_id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->update();
        $post->categories()->detach();
        if(strlen($request->categories) > 0){
            $categoriesIDs = explode(',', $request->categories);
            foreach ($categoriesIDs as $categoryID) {
                $post->categories()->attach($categoryID);
            }
        }
        return redirect()->route('admin.blog.index')->with(['success' => 'Post succsessfully updated']);
    }

    public function getDeletePost($post_id)
    {
        $post = Post::find($post_id);
        $post->categories()->detach();
        if(!$post){
            return redirect()->route('admin.blog.index')->with(['fail' => 'Post not found']);
        }
        $post->delete();
        return redirect()->back()->with(['success' => 'Post succsessfully deleted']);
    }

    private function shortenText($text, $words_count)
    {
        if(str_word_count($text, 0) > $words_count){
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$words_count]).'...';
        }
        return $text;
    }
}
