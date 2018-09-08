<?php

namespace App\Http\Controllers\Api\Pla;

use App\Http\Models\Hrm\Client;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // client/{Client_id}/user/{user_id}_{user_name}/{module_name}/{resource_name}/{file_name}
        
        // $filePath = 'user/Screenshot.png';
        // return Storage::download($filePath);
        $users = (new User())->with('client')->get();
        // $clients = (new Client())->with('users')->get();
        // $clients = (new Client())->with('billTo')->get();
        // return $clients;
        return $users;
        // return User::all()->with('client');

    }
    
}
