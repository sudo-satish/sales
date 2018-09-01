<?php

namespace App\Http\Controllers\Api\Hrm;

use App\User;
use Illuminate\Http\Request;
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
        $user = Auth::user();
        $user->fill($request->except(['id', 'email', 'password', 'created_at', 'updated_at']));
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
}
