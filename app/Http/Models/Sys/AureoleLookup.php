<?php

namespace App\Http\Models\Sys;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

//aureole-lookups
class AureoleLookup extends Model
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
    //     return Self::find(['translation_type' => $translationType, 'active'=>'Y'])->orderBy('order', 'asc');
    // }
    
    /**
     * Get LOv for dropdown in ordered manner of active code only.
     * 
     * @param  String  $translationType
     * @return Collection list of values.
     */
    public static function getLOV($translationType) {
        return DB::table('aureole_lookups')
            ->select('code', 'meaning', 'tip')
            ->where([['translation_type', '=', $translationType], ['active', '=', 'Y'], ['deleted_at', '=', null]])
            ->orderBy('order', 'asc')
            ->get();
            // ->toSql();

        // return Self::find(['translation_type' => $translationType, 'active'=>'Y'])->orderBy('order', 'asc');
    }

    public static function getTranslations() {
        return DB::table('aureole_lookups')
                ->select('translation_type')
                ->groupBy('translation_type')
                ->get();
    }
    
    public static function getTranslationDetail($translationType) {
        return DB::table('aureole_lookups')
        ->where('translation_type', '=', $translationType)
        ->get();
    }
}
