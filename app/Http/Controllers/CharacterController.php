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
        $request = Request::create('/', 'GET');
        $initialData = $this->getInitialData($request)->getData(true);
        $characters = $initialData['characters'];
        $nextPage = $initialData['next'];
        
        return view('character-list', ['characters' => $characters, 'nextPage' => $nextPage]);
    }

    public function show(string $id)
    {
        $character = $this->service->getCharacterData($id);
        return view('character-profile', ['character' => $character]);
    }
    
    public function getInitialData(Request $request)
    {
        $data = $this->service->getData($request);
    
        return response()->json([
            'characters' => $data['results'],
            'next' => $data['info']['next'],
        ]);
    }

}
