<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $post = Post::find(1);
        $category = Category::find(1);
        $tag = Tag::find(1);
        dd($post->tags);
        //dd($tag->posts);
        //dd($category->posts);
        //dd($post->category);
    }


    public function restore()
    {
        $post = Post::withTrashed()->find(2);
        $post->restore();
        dd('restored');
    }

    public function firstOrCreate()
    {
        $anotherPost = [
            'title' => 'some post',
            'content' => 'some content',
            'image' => 'some_imageblabla.jpg',
            'likes' => 50,
            'is_published' => 1,
        ];

        $post = Post::firstOrCreate([
            'title' => 'some title phpStorm',
        ],
            [
                'title' => 'some title phpStorm',
                'content' => 'some content',
                'image' => 'some_imageblabla.jpg',
                'likes' => 50,
                'is_published' => 1,
            ]);
        dump($post->content);
        dd('finished');
    }

    public function updateOrCreate()
    {
        $anotherPost = [
            'title' => 'updateOrCreatesome post',
            'content' => 'updateOrCreate some content',
            'image' => 'updateOrCreate_imageblabla.jpg',
            'likes' => 500,
            'is_published' => 0,
        ];

        $post = Post::updateOrCreate([
            'title' => 'some title not phpStorm',
        ],
            [
                'title' => 'some title not phpStorm',
                'content' => ' not update content',
                'image' => ' not_update_imageblabla.jpg',
                'likes' => 50,
                'is_published' => 0,
            ]);

        dump($post->content);
        dd('finished');
    }


    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));
    }

    public function store()
    {
        $data = request()->validate([
            //'title' => 'string',
            'title' => 'required|string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);
        //dd($tags, $data);
        //dd($tags);
        $post = Post::create($data);
        //$post = Post::firstOrCreate($data);
        foreach ($tags as $tag) {
            PostTag::firstOrCreate([
                'tag_id' => $tag,
                'post_id' => $post->id,
            ]);
        }
        //$post->tags()->attach($tags);
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);
        $post->update($data);
        $post->tags()->sync($tags);
        return redirect()->route('post.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

}
