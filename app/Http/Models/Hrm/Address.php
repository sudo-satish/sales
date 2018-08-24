<?php

namespace App\Http\Models\Hrm;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

//aureole-lookups
class Address extends Model
{
    //
    protected $table ="address";
    protected $guarded = [];

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get LOv for dropdown in ordered manner of active code only.
     * 
     * @param  String  $translationType
     * @return Collection list of values.
     */
    // public function getLOV($translationType) {
    //     return Self::find(['translation_type' => $translationType, 'active'=>'Y'])->orderBy('order', 'asc');
    // }
    
    /**
     * Get LOv for dropdown in ordered manner of active code only.
     * 
     * @param  String  $translationType
     * @return Collection list of values.
     */
    public static function getLOV() {
        
        $addressTypeTrans = 'ADDRESS_TYPE';

        $citys = DB::table('citys')
                ->select('id as code', 'name as meaning')
                ->where('active', '=', 'Y')->get();
        $states = DB::table('states')
                ->select('id as code', 'name as meaning')
                ->where('active', '=', 'Y')->get();

        $addressType =  DB::table('aureole_lookups')
            ->select('code', 'meaning', 'tip')
            ->where([['translation_type', '=', $addressTypeTrans], ['active', '=', 'Y']])
            ->orderBy('order', 'asc')
            ->get();

        return ['citys' => $citys, 'states' => $states, 'address_type' => $addressType];
        
    }
}
