@extends('layouts.app')

@section('title', 'Write a story')

@section('content')
    <section class="editor-page">
        <a class="back-link" href="{{ route('home') }}">← Back to posts</a>
        <div class="editor-heading">
            <h1>New post</h1>
        </div>

        <form class="editor-card" action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="form-field">
                <label for="title">Title</label>
                <input id="title" type="text" name="title" value="{{ old('title') }}" required maxlength="255" autofocus>
                @error('title') <p class="field-error">{{ $message }}</p> @enderror
            </div>
            <div class="form-field">
                <label for="body">Body</label>
                <textarea id="body" name="body" rows="12" required>{{ old('body') }}</textarea>
                @error('body') <p class="field-error">{{ $message }}</p> @enderror
            </div>
            <div class="editor-actions">
                <a class="text-link" href="{{ route('home') }}">Cancel</a>
                <button class="button button-primary" type="submit">Save post</button>
            </div>
        </form>
    </section>
@endsection
