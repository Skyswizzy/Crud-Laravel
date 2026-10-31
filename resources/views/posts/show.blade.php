@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article class="reading-page">
        <a class="back-link" href="{{ route('home') }}">← Back to posts</a>
        <header class="story-header">
            <h1>{{ $post->title }}</h1>
            <div class="story-meta">Published {{ $post->created_at->format('F j, Y') }}</div>
        </header>
        <div class="story-body">{{ $post->body }}</div>
        <footer class="story-footer">
            <div class="story-actions">
                <a class="button button-secondary" href="{{ route('posts.edit', $post) }}">Edit post</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this story?')">
                    @csrf
                    @method('DELETE')
                    <button class="button button-quiet" type="submit">Delete</button>
                </form>
            </div>
        </footer>
    </article>
@endsection
