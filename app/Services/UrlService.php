<?php
namespace App\Services;

use App\Models\Url;
use Illuminate\Support\Str;

class UrlService
{
    public static function getAll()
    {
        $baseUrl = env('APP_URL');
        $urls = Url::all();

        foreach($urls as $url)
        {
            $short_url = $baseUrl . '/' . $url->ulid;
            $url->short_url = $short_url;
        }

        return $urls;

    }

    public static function store($request){
        try {
            $url = Url::create([
                'user_id' => 1,
                'ulid' => Str::random(5),
                'url' => $request->url,
                'alias' => $request->alias,
                'password' => $request->password,
                'expires_at' => $request->expires_at
            ]);
            $response = [
                'status' => true,
                'message' => 'Url created successfully',
                'url' => $url
            ];
            return $response;
        } catch (\Throwable $th) {
            $response = [
                'status' => false,
                'message' => $th->getMessage()
            ];
            return $response;
        }
    }

    public static function update($request, $url){

        try {
            $url->url = $request->url;
            $url->save();

            $response = [
                'status' => true,
                'message' => 'Url updated successfully',
                'url' => $url
            ];

            return $response;
        } catch (\Throwable $th) {
            $response = [
                'status' => false,
                'message' => $th->getMessage()
            ];
            return $response;
        }



        return $url;
    }
}
