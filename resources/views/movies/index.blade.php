@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h2>Movies</h2>
                <a href="{{ route('movies.create') }}" class="action-link">
                    Create New Movie
                </a>
            </div>
            @if (count($movies) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Country</th>
                            <th scope="col">Year</th>
                            <th scope="col">Genres</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movies as $movie)
                            <tr>
                                <th scope="row">{{ $movie->id }}</th>
                                <td>{{ $movie->title }}</td>
                                <td>{{ $movie->country->title }}</td>
                                <td>{{ $movie->year }}</td>
                                <td>{{ $movie->genres->implode('title', ', ') }}</td>
                                <td class="table-instance-actions">
                                    <a href="{{ route('movies.edit', $movie) }}" class="link-primary">Edit</a>
                                </td>
                                <td class="table-instance-actions">
                                    <form style="display:inline-block;" action="{{ route('movies.destroy', $movie) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button style="all: unset; cursor: pointer; text-decoration: underline" class="link-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                No movies yet...
            @endif
        </div>
    </div>
</div>
@endsection
