<?php

namespace App\Http\Models\Hrm;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $table ="ut_hrm_client_m";
    protected $guarded = [];

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function users() {
        return $this->hasMany('App\User', 'client_id');
    }
    
    public function billtoClientId() {
        // Work as thistable join App\Http\Models\Hrm\Client c on c.id = thistbl.billto_client_id 
        return $this->hasOne('App\Http\Models\Hrm\Client', 'id', 'billto_client_id');
    }

    public static function searchClient($searchTxt) {
        return DB::table('ut_hrm_client_m')
                ->where("client_name", "like", "%".$searchTxt."%")
                ->get();
    }
}
