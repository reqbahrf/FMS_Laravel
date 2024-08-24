<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProxyController extends Controller
{
    public function proxy(Request $request)
    {
        $url = $request->query('url');

        if (!$url) {
            return response()->json(['error' => 'URL parameter is required'], 400);
        }

        try {
            // Make the request to the external URL
            $response = Http::head($url);

            // Return the status code and headers from the external request
            return response()->json([
                'status' => $response->status(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch the URL', 'message' => $e->getMessage()], 500);
        }
    }
}
