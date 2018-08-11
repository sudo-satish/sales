<?php
namespace App\Http\Models\Stock;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use App\Http\Models\Sys\AureoleLookup;

class Tumbrow extends Model
{
    //
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
    //     $lov = [];
    //     $lov['GENDER'] = AureoleLookup::getLov('GENDER');

    //     return $lov;
    // }
    
    /**
     * Get LOv for dropdown in ordered manner of active code only.
     * 
     * @param  String  $translationType
     * @return Collection list of values.
     */
    public static function getLOV() {
        $lov = [];
        $lov['GENDER'] = AureoleLookup::getLov('GENDER');
        $lov['GENDER2'] = AureoleLookup::getLov('GENDER');
        // $lov['field2'] = AureoleLookup::getLov('field2');
        // $lov['field3'] = AureoleLookup::getLov('field3');

        return $lov;
    }
}
