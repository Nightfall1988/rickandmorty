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

    public function getData($request, $id = null)
    {
        $page = $request->input('page', 1);
        $response = $this->httpClient->get($this->url . 'character?page=' . $page);
        $responseData = json_decode($response->getBody(), true);
    
        return $responseData;
    }
}
