<?php

namespace App\Http\Controllers;

use App\Models\URL;
use Illuminate\Http\Request;

class URLController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $shortCode = $this->generateShortCode();

        $url = new URL();
        $url->original_url = $request->original_url;
        $url->short_code = $shortCode;
        $url->clicks = 0;
        $url->save();

        return response()->json(['short_code' => $shortCode]);
    }

    public function show($shortCode)
    {
        $url = URL::where('short_code', $shortCode)->firstOrFail();

        $url->clicks++;
        $url->save();

        return redirect($url->original_url);
    }

    public function trackClick(Request $request)
    {
        $url = URL::where('short_code', $request->shortCode)->firstOrFail();

        return response()->json([
            'clicks' => $url,
        ]);

        // return view('track', compact('url'));
    }

    private function generateShortCode()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codeLength = 6;
        $shortCode = '';

        for ($i = 0; $i < $codeLength; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $shortCode .= $characters[$randomIndex];
        }

        $existingUrl = URL::where('short_code', $shortCode)->first();
        if ($existingUrl) {
            return $this->generateShortCode();
        }

        return $shortCode;
    }
}
