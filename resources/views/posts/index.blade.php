@extends('layouts.app')

@section('title', 'The journal')

@section('content')
    @if (session('success'))
        <div class="notice" role="status">{{ session('success') }}</div>
    @endif

    <section class="journal-section" aria-labelledby="latest-heading">
        <div class="section-heading">
            <h1 id="latest-heading">Journal</h1>
            <span class="post-count">{{ $posts->count() }} {{ \Illuminate\Support\Str::plural('post', $posts->count()) }}</span>
        </div>

        @forelse ($posts as $post)
            <article class="post-card">
                <div class="card-topline">
                    <time datetime="{{ $post->created_at->toDateString() }}">{{ $post->created_at->format('M j, Y') }}</time>
                </div>
                <h3><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h3>
                <p class="post-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($post->body), 180) }}</p>
                <div class="card-bottom">
                    <a class="text-link" href="{{ route('posts.show', $post) }}">Read post</a>
                    <a class="text-link" href="{{ route('posts.edit', $post) }}">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-link" type="submit">Delete</button>
                    </form>
                </div>
            </article>
        @empty
            <div class="empty-state">
                <h2>No posts yet</h2>
                <p>Start your journal with a new post.</p>
                <a class="button button-secondary" href="{{ route('posts.create') }}">Create a post</a>
            </div>
        @endforelse
    </section>
@endsection
