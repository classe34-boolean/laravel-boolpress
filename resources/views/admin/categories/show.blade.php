@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $category->name }}</h1>
        <small>{{ $category->slug }}</small>

        {{-- @dump($category->posts) --}}
        <ul class="mt-4">
            @forelse ($category->posts as $post)
                <li>
                    <a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a>
                </li>
            @empty
                <li>
                    <h2>Non ci sono articoli all'interno di questa categoria.</h2>    
                </li>
            @endforelse
        </ul>
    </div>
@endsection