<?php

namespace App\Services;

use GuzzleHttp\Client;

class GooglePlacesService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('GOOGLE_PLACES_API_KEY');
    }

    public function getPhotoUrl($photoReference, $maxWidth = 400)
    {
        $url = "https://maps.googleapis.com/maps/api/place/photo";
        $response = $this->client->get($url, [
            'query' => [
                'maxwidth' => $maxWidth,
                'photoreference' => $photoReference,
                'key' => $this->apiKey,
            ],
            'stream' => true, // ストリームを使用して大きなファイルを扱う
        ]);

        // GuzzleのgetResponse()メソッドを使用してリダイレクト先のURLを取得
        // return $response->getEffectiveUrl();
    }
}
