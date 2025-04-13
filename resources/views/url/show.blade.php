@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">URL Shortener</h1>
        <p class="text-center">
            Your shortened URL is:
            <a target="_BLANK" href="{{ $url->original_url }}">
                {{ route('url.show', $url->short_url) }}
            </a>
        </p>
    </div>
@endsection
