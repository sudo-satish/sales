<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getProfileLov()
    {
        $departments =  DB::table('ut_hrm_department_m')
                ->select('id as code', 'name as meaning')
                ->where('active', '=', 'Y')
                ->orderBy('order', 'asc')
                ->get();
        
        $designations =  DB::table('ut_hrm_designation_m')
                ->select('id as code', 'name as meaning')
                ->where('active', '=', 'Y')
                ->orderBy('order', 'asc')
                ->get();
        
        $locations =  DB::table('ut_hrm_location_m')
                ->select('id as code', 'name as meaning')
                ->where('active', '=', 'Y')
                ->orderBy('order', 'asc')
                ->get();

        $rolesTrans = 'ROLES';
        $roles =  DB::table('aureole_lookups')
            ->select('code', 'meaning', 'tip')
            ->where([['translation_type', '=', $rolesTrans], ['active', '=', 'Y']])
            ->orderBy('order', 'asc')
            ->get();

        return [ 'departments' => $departments, 'designations' => $designations, 'locations' => $locations,  'roles' => $roles];
    }

}
