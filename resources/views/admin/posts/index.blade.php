@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('deleted'))
            <div class="alert alert-success"><strong>{{ session('deleted') }}</strong> eliminato correttamente!</div>
        @endif

        <h1 class="mt-4">Elenco Articoli</h1>
        <a class="btn btn-primary mb-4" href="{{ route('admin.posts.create') }}">Nuovo articolo</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titolo</th>
                    <th>Slug</th>
                    <th>Categoria</th>
                    <th>Tags</th>
                    <th colspan="3">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>
                            @if ($item->category)
                                {{ $item->category->name }}
                            @endif
                        </td>
                        <td>
                            @foreach ($item->tags as $tag)
                                <span class="badge badge-pill badge-dark">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a class="btn btn-success" href="{{ route('admin.posts.show', $item->id) }}">SHOW</a>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.posts.edit', $item->id) }}">EDIT</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.posts.destroy', $item->id) }}" method="POST" onSubmit="return confirm('Sei sicuro di voler eliminare questo articolo?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection