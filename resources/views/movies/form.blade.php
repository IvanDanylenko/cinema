@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h2>{{ $movie ? 'Update' : 'Create New'}} Movie</h2>
                    <a href="{{ route('movies.index') }}" class="action-link">
                        Back to index
                    </a>
                </div>
                <form
                    method="post"
                    action="{{ $movie ? route('movies.update', $movie) : route('movies.store') }}"
                >
                    {{ csrf_field() }}
                    @if ($movie)
                        {{ method_field('PUT') }}
                    @endif
                    <div class="form-group">
                        <label for="movieTitle">Movie title</label>
                        <input
                            name="title"
                            class="form-control"
                            id="movieTitle"
                            placeholder="Enter movie title"
                            value="{{ old('title', $movie) }}"
                        >
                        @if ($errors->has('title'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group mt-3">
                        <label for="movieYear">Movie year</label>
                        <input
                            name="year"
                            class="form-control"
                            id="movieYear"
                            placeholder="Enter movie year"
                            value="{{ old('year', $movie) }}"
                        >
                        @if ($errors->has('year'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('year') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group mt-3">
                        <label for="movieCountry">Movie country</label>                       
                        <select name="country_id" class="form-select" id="movieCountry">
                            @foreach ($countries as $country)
                                <option
                                    value="{{ $country->id }}"
                                    {{ old('country_id', $movie) == $country->id ? 'selected' : '' }}
                                >
                                    {{ $country->title }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('country_id'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('country_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group mt-3">
                        <label for="movieGenres">Movie genres</label>
                        <select name="genre_ids[]" class="form-select" id="movieGenres" multiple style="height: 200px">
                            @foreach ($genres as $genre)
                                <option
                                    value="{{ $genre->id }}"
                                    {{ in_array($genre->id, old('genre_ids') ?? ($movie ? $movie->genres->pluck('id')->toArray() : [])) ? 'selected' : '' }}
                                >
                                    {{ $genre->title }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('genre_ids'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('genre_ids') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group mt-4">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                            <a class="btn btn-default" href="{{ url()->previous() }}">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
