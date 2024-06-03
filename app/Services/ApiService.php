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

    public function getData(Request $request, $id = null)
    {
        $response = $this->httpClient->get($this->url . 'character/' . $id);

        $responseData = json_decode($response->getBody(), true);

        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);
        $results = array_slice($responseData, ($page - 1) * $perPage, $perPage);

        return $results;
    }
}
