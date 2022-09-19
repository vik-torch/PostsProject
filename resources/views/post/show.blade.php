@extends('layouts.main')
@section('content')
    <div>
        <div>{{$post->id}}. {{ $post->title }}</div>
        <div>{{$post->content}}</div>
    </div>
    <div class="mb-2">
        <a href="{{ route('post.edit', $post->id) }}">Edit</a>
    </div>
    <div class="mb-2">
        <form action="{{ route('post.delete', $post->id) }}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    </div>
    <div class="mb-2">
        <a href="{{ route('post.index') }}">Back</a>
    </div>
@endsection
