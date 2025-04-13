<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function index()
    {
        $urls = Url::all();

        return view('url.index', [
            'urls' => $urls
        ]);
    }

    public function encodeUrl(UrlRequest $request)
    {
        try {
            $url = new Url();
            $url->original_url = $request->original_url;
            $url->short_url = Str::random(6);
            $url->save();

            return new UrlResource($url);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'message' => 'An unexpected error occurred, please try again.'
            ], 500);
        }
    }

    public function decodeUrl(String $short_url)
    {
        try {
            $url = Url::where('short_url', $short_url)->firstOrFail();

            // Typically I'd want to return resource classes to maintain API responses in one place,
            // but for the purpose of this assignment I've done it like so:
            return response()->json([
                'decoded_url' => $url->original_url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'message' => 'An unexpected error occurred, please try again.'
            ], 500);
        }
    }

    public function storeUrl(UrlRequest $request)
    {
        $url = new Url();
        $url->original_url = $request->original_url;
        $url->short_url = Str::random(6);
        $url->save();

        return redirect()->route('url.index');
    }

    // Redirect to the original URL
    public function redirectOriginal(String $short_url)
    {
        $url = Url::where('short_url', $short_url)->firstOrFail();

        return redirect($url->original_url);
    }
}
