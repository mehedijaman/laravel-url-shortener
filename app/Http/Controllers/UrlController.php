<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Services\UrlService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;

class UrlController extends Controller
{
    public $baseUrl;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Urls = UrlService::getAll();

        return response()->json($Urls);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUrlRequest $request)
    {
        $request->validated();
        $response = UrlService::store($request);

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Url $url)
    {
        return response()->json($url);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Url $url)
    {
        return response()->json($url);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, url $url)
    {
        // return $request;
        // $request->validated();
        $response = UrlService::update($request, $url);

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Url $url)
    {
        $url = $url->delete();

        $response = [
            'status' => true,
            'message' => 'Url deleted successfully',
            'url' => $url
        ];

        return response()->json($response);
    }

    /**
     * Parmanently remove the specified resource from storage
     */
    public function forceDelete($url)
    {
        $url = Url::withTrashed()->find($url)->forceDelete();

        $response = [
            'status' => true,
            'message' => 'Url Deleted Parmanently !',
            'url' => $url
        ];

        return response()->json($response);
    }

    /**
     * Restore the specified resource from storage
     */
    public function restore($url)
    {
        $url = Url::withTrashed()->find($url)->restore();

        $response = [
            'status' => true,
            'message' => 'Url Restored !',
            'url' => $url
        ];

        return response()->json($response);
    }

    /* Redirect Url */
    public function redirectUrl($ulid)
    {
        $url = Url::where('ulid', $ulid)->first();
        $url->total_clicks = $url->total_clicks + 1;
        $url->save();
        return redirect($url->url);
    }
}
