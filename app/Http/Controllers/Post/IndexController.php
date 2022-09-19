<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Models\Post;

class IndexController extends BaseController
{
//    public function __invoke()
//    {
//        //$posts = Post::all();
//        $posts = Post::paginate(10);
//
//        return view('post.index', compact('posts'));
//    }

    public function __invoke(FilterRequest $request)
    {
        //$this->authorize('view', auth()->user());

        $data = $request->validated();

//        $query = Post::query();
//
//        if (isset($data['category_id'])) {
//            $query->where('category_id', $data['category_id']);
//        }
//
//        if (isset($data['title'])) {
//            $query->where('title','like', "%{$data['title']}%");
//        }
//
//        $posts = $query->get();
//        dd($posts);

        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
        $posts = Post::filter($filter)->paginate(10);
        //dd($posts);

        return view('post.index', compact('posts'));
    }
}
