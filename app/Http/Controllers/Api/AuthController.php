<?php

namespace App\Http\Controllers\Api;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // public function register(Request $request) {
    //     $request->validate([
    //         'email' => 'required',
    //         'name' => 'required',
    //         'password' => 'required',
    //     ]);
        
    //     $user = User::firstOrNew(['email' => $request->email]);
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = bcrypt($request->password);
    //     $user->save();

    //     $http = new Client();

    //     $response = $http->post(url('/oauth/token'), [
    //         'form_params' => [
    //             'grant_type' => 'password',
    //             'client_id' => '2',
    //             'client_secret' => 'YKnMqTT9rm0Py4Py8VU5Qku9DuGoGKMfytgdPeaP',
    //             'username' => $request->email,
    //             'password' => $request->password,
    //             'scope' => '',
    //         ]
    //     ]);
    //             dd($response->getBody());
    //     // return response('sdffddsf', 200);
    //     return response(json_decode((string) $response->getBody(), true));
    // }

    public $successStatus = 200;

    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            return response()->json(['success' => $success], $this->successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    /**
     * 
     */
    public function forgetPassword() {
        
    }

    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $request->validate([ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);

        // $input = $request->all(); 
        // $input['password'] = bcrypt($input['password']); 
        // $user = User::create($input); 
        
        $user = User::firstOrNew(['email' => $request->email]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $success['token'] =  $user->createToken('MyApp')->accessToken; 
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], $this->successStatus); 
    }

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user();
        if(!$user->profile_image) {
            $user->profile_image = asset('images/default-profile.png');
        }

        // dd($user);
        return response()->json(['success' => $user], $this->successStatus); 
    } 

}
