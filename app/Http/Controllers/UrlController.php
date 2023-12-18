<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Services\UrlService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;

class UrlController extends Controller
{
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
        $Url = UrlService::store($request);

        return response()->json($Url);
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
    public function update(Request $request, Url $url)
    {
        // $request->validated();

        // $url->url = $request->url;
        // $url->alias = $request->alias;
        // $url->password = $request->password;
        // $url->expires_at = $request->expires_at;
        // $url->save();

        return $request->all();
        // $url->url = $request->url;

        // return response()->json($url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Url $url)
    {
        $url = $url->delete();

        return response()->json($url);
    }
}
