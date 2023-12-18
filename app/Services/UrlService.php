<?php
namespace App\Services;

use App\Models\Url;
use Illuminate\Support\Str;

class UrlService
{
    public static function getAll()
    {
        return Url::all();
    }

    public static function store($request){
        return Url::create([
            'user_id' => 1,
            'ulid' => Str::random(8),
            'url' => $request->url,
            'alias' => $request->alias,
            'password' => $request->password,
            'expires_at' => $request->expires_at
        ]);
    }

    public static function update($request, $url){
        $url->url = $request->url;
        $url->alias = $request->alias;
        $url->password = $request->password;
        $url->expires_at = $request->expires_at;
        $url->save();

        return $url;
    }
}
