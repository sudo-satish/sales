<?php

namespace App\Http\Controllers\Api\Hrm;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Get Users Profile information
     */
    public function getUserProfile(Request $request) {
        return Auth::user();
    }

    public function updateUserProfile(Request $request)
    {   
        $userId = $request->input('id');
        if(empty($userId)) {
            $response = ['message'=>'id is mendatory field', 'error'=>'id is mendatory field'];
            return response($response, 403); // ->withStatus(403)->send();
        }

        $user = User::find($userId);
        $updateData = $request->except(['id', 'email', 'password', 'created_at', 'updated_at', 'profile_image']);

        $profileImage = $request->file('profile_image');
        $profilePath = $this->getS3ProfileImagePath($user);
        $newFilePath = $profilePath.'.'.$profileImage->getClientOriginalExtension();
        
        $pfile = Storage::put($profileImage, $newFilePath);
        $user->profile_image = $pfile;
        $user->fill($updateData);
        $user->save();

        return $user;
    }

    public function getProfileLov(Request $request)
    {
        return User::getProfileLov();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|max:255',
            'client_id' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'email_official' => 'required|email',
            'designation_id' => 'required|max:255',
            'location_id' => 'required',
            'department_id' => 'required',
            'roles_id' => 'required',
            'employee_code' => 'required',
        ]);

        $user = new User();

        $user->fill($request->except('id')); // <=Error resolved on postgre:  Not null violation: 7 ERROR: null value in column "id" violates not-null constraint 
        $user->password = Hash::make($request->input('email'));
        $user->save();
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $user->fill($request->all());
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GlobalValue  $globalValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(AureoleLookup $aureoleLookup)
    {
        //
        $aureoleLookup->delete();
        // return Response::
        return response()->json(['response' => 'Deleted Successfully']);
    }

    // S3 : client/{Client_id}/user/{user_id}_{user_name}/{module_name}/{resource_name}/{file_name}
    public function getS3ProfileImagePath(User $user) {
        return "client/".$user->client_id."/user/$user->id"."_".snake_case($user->name)."/Hrm/user/profile_".snake_case($user->name);
    }
}
