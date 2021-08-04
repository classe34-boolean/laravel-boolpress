{{-- var teacher = {
    name: "Gianluca",
    surname: "Pesce",
    coordinator: {
        name: "Sofia",
        surname: "Perlari"
    }
}

console.log(teacher.coordinator.surname); --}}

@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <h1>
            {{ $post->title }} 
            @if ($post->category)        
                <a href="{{ route('admin.categories.show', $post->category->id) }}" class="badge badge-info">{{ $post->category->name }}</a>
            @else
                <span class="badge badge-secondary">Nessuna categoria associata</span>     
            @endif
        </h1>

        {{-- @dump($post->category) --}}
        {{-- @dump($post->category) --}}

        <small>{{ $post->slug }}</small>

        @if (count($post->tags) > 0)
            <div class="mt-3 h4">
                @foreach ($post->tags as $tag)
                    <span class="badge badge-pill badge-dark">{{ $tag->name }}</span>    
                @endforeach
            </div>
        @else
            <h5 class="mt-3">Nessun tag collegato</h5>    
        @endif
            

        <div class="mt-3">
            <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a>
            <a class="btn btn-secondary ml-2" href="{{ route('admin.posts.index') }}">Elenco post</a>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                @if ($post->cover)
                    <img class="img-fluid" src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
                @else 
                    <img class="img-fluid" src="{{ asset('images/placeholder.png') }}" alt="{{ $post->title }}">    
                @endif
                
            </div>
            <div class="col-md-6">
                {{ $post->content }}
            </div>
        </div>
    </div>
@endsection