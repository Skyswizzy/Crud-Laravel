@extends('layouts.app')

@section('title', 'Blog post reports')

@section('content')
    <section class="report-page" aria-labelledby="report-heading">
        <a class="back-link" href="{{ route('posts.index') }}">&larr; Back to journal</a>

        <header class="report-heading">
            <p class="report-eyebrow">Journal / Reports</p>
            <h1 id="report-heading">Blog post reports</h1>
            <p>Choose a date range to review your posts or download a copy of the report.</p>
        </header>

        @if ($errors->any())
            <div class="report-errors" role="alert">
                <strong>Please correct the following:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="report-summary" aria-label="Report summary">
            <div>
                <p class="report-label">Selected period</p>
                <p class="report-period">
                    {{ $startDate ?: 'Beginning' }}
                    <span aria-hidden="true">&rarr;</span>
                    {{ $endDate ?: 'Present' }}
                </p>
            </div>
            <div class="report-total">
                <span class="report-label">Posts in report</span>
                <strong>{{ $totalPosts }}</strong>
            </div>
        </section>

        <form action="{{ route('posts.reports.index') }}" method="GET" class="report-filter-card">
            <div class="report-filter-heading">
                <h2>Filter by date</h2>
                <p>Leave either date blank to keep that end of the range open.</p>
            </div>

            <div class="report-filter-fields">
                <div class="report-field">
                    <label for="start_date">Start date</label>
                    <input
                        type="date"
                        id="start_date"
                        name="start_date"
                        value="{{ old('start_date', $startDate) }}"
                    >
                </div>
                <div class="report-field">
                    <label for="end_date">End date</label>
                    <input
                        type="date"
                        id="end_date"
                        name="end_date"
                        value="{{ old('end_date', $endDate) }}"
                    >
                </div>
            </div>

            <div class="report-filter-actions">
                <button class="button button-primary" type="submit">Generate report</button>
                <a class="button button-secondary" href="{{ route('posts.reports.index') }}">Clear dates</a>
            </div>
        </form>

        <section class="report-results" aria-labelledby="results-heading">
            <div class="report-results-heading">
                <div>
                    <p class="report-eyebrow">Your journal at a glance</p>
                    <h2 id="results-heading">Included posts</h2>
                </div>
                <div class="report-exports" aria-label="Download report">
                    <a
                        class="button button-secondary"
                        href="{{ route('posts.reports.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                    >Export PDF</a>
                    <a
                        class="button button-primary"
                        href="{{ route('posts.reports.csv', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                    >Export CSV</a>
                </div>
            </div>

            <div class="report-table-wrap">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Body preview</th>
                            <th scope="col">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td class="report-id">{{ $post->id }}</td>
                                <td class="report-title">{{ $post->title }}</td>
                                <td>{{ \Illuminate\Support\Str::limit(strip_tags($post->body), 100) }}</td>
                                <td>
                                    <time datetime="{{ $post->created_at->toDateString() }}">
                                        {{ $post->created_at->format('M d, Y') }}
                                    </time>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="report-empty" colspan="4">
                                    <strong>No posts in this date range</strong>
                                    <span>Try adjusting the dates to see more of your journal.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </section>
@endsection
