<?php

namespace App\Services;
use Illuminate\Http\Request;

class ApiService 
{
    protected $url;

    protected $httpClient;

    public function __construct()
    {
       $this->url = env('API_URL');
       $this->httpClient = new \GuzzleHttp\Client();
    }

    public function getData($request)
    {
        $page = $request->input('page', 1);
        $response = $this->httpClient->get($this->url . 'character?page=' . $page);
        $responseData = json_decode($response->getBody(), true);
    
        return $responseData;
    }

    public function getCharacterData($id) 
    {
        $response = $this->httpClient->get($this->url . 'character/' . $id);

        $character = json_decode($response->getBody(), true);
        $episodes = [];

        foreach ($character['episode'] as $episodeUrl) {
            $episodes[] = $this->getEpisodeData($episodeUrl);
        }

        return [$character, $episodes];
    }

    public function getEpisodeData($episodeUrl) {
        $response = $this->httpClient->get($episodeUrl);
        $episode = json_decode($response->getBody(), true);
        return $episode['name'];
    }
}
