@extends('layouts.main')

@section('content')
    <section class="flex flex-col gap-y-4 w-2/4">
        <h1 class="text-center text-2xl md:text-3xl text-blue font-bold w-full">Atarim URL Shortener</h1>
        <form class="w-full max-w-lg" action="{{ route('url.storeUrl') }}" method="POST">
            @csrf
            <div class="flex flex-wrap mb-2">
                <label for="original_url">Enter URL:</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="url" name="original_url" class="" required>
            </div>
            <button type="submit" class="bg-atarim hover:bg-atarim-darken text-white font-bold py-2 px-4 rounded cursor-pointer">Shorten URL</button>
        </form>
    </section>
    <section class="flex flex-col gap-y-4 w-2/4">
        <h2 class="text-1xl md:text-2xl text-blue font-bold w-full">List of shortened URLs</h2>
        @foreach ($urls as $url)
            <a target="_BLANK" href="{{ route('url.redirectOriginal', $url->short_url) }}">
                <div class="hover:bg-atarim-darken flex gap-x-4 bg-atarim p-4 rounded text-white">
                    {{ route('url.redirectOriginal', $url->short_url) }}
                    <p class="">({{ $url->original_url }})</p>
                </div>
            </a>
        @endforeach
    </section>
@endsection
