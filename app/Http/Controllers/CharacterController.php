<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Models\Character;

class CharacterController extends Controller
{
    public function __construct(ApiService $service)
    {
        $this->service = $service;
    }
    
    public function index()
    {
        $request = Request::create('/', 'GET'); // Create a new request
        $characterData = json_decode($this->getInitialData($request)->getContent());

        return view('character-list', ['characters' => json_encode($characterData)]);
    }

    public function show(string $id)
    {
        $character = $this->service->getApiCharacterData($id);
        return view('character-profile', ['character' => $character]);
    }
    
    public function getInitialData(Request $request)
    {
        $data = $this->service->getData($request);
    
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);
        $results = array_slice($data['results'], ($page - 1) * $perPage, $perPage);
    
        return response()->json([
            'characters' => $results
        ]);
    }

    public function getApiCharacterData($id = null)
    {
        return $this->service->getData($id);
    }
}
