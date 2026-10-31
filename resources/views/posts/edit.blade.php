@extends('layouts.app')

@section('title', 'Edit story')

@section('content')
    <section class="editor-page">
        <a class="back-link" href="{{ route('posts.show', $post) }}">← Back to post</a>
        <div class="editor-heading">
            <h1>Edit post</h1>
        </div>

        <form class="editor-card" action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-field">
                <label for="title">Title</label>
                <input id="title" type="text" name="title" value="{{ old('title', $post->title) }}" required maxlength="255" autofocus>
                @error('title') <p class="field-error">{{ $message }}</p> @enderror
            </div>
            <div class="form-field">
                <label for="body">Body</label>
                <textarea id="body" name="body" rows="12" required>{{ old('body', $post->body) }}</textarea>
                @error('body') <p class="field-error">{{ $message }}</p> @enderror
            </div>
            <div class="editor-actions">
                <a class="text-link" href="{{ route('posts.show', $post) }}">Cancel</a>
                <button class="button button-primary" type="submit">Save changes</button>
            </div>
        </form>
    </section>
@endsection
