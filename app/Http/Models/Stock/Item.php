<?php
namespace App\Http\Models\Stock;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Models\Sys\AureoleLookup;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{   
    protected $table ="ut_stock_item_m";

    protected $guarded = [];
    use SoftDeletes;

    public static function getLOV() {
        $lov = [];
        $lov['BF'] = AureoleLookup::getLov('BF'); // BF,GSM
        $lov['GSM'] = AureoleLookup::getLov('GSM');
        return $lov;
    }

    public static function getLookup($codes, $translation) {
        // return AureoleLookup::where([['transalation', $translation], ['code','in', $codes]])->get();
        // dd(explode(',', $codes));
        // dd(DB::table('aureole_lookups')
        // ->where('translation_type', $translation)
        // ->whereIn('code', explode(',', $codes))->toSql()
        // );

        // dd($translation);

        // SELECT * FROM `aureole_lookups` WHERE `translation_type` = 'BF' AND CODE IN ('BF50');
        // $query = "SELECT * FROM `aureole_lookups` WHERE `translation_type` = '$translation' AND FIND_IN_SET(CODE,  '$codes')";

        // dd($query);
        // $data = DB::select($query);

        // dd($data);
        return DB::table('aureole_lookups')
            ->where([['translation_type','=' ,$translation]])
            ->whereIn('code', explode(',', $codes))
            ->get();
    }

    public static function getItemCode($codePrefix) {
        $codePrefix .= '-';
        $itemCodeArr = DB::table('ut_stock_item_m')
                ->select('item_code')
                ->where('item_code', 'like', $codePrefix.'%')
                ->orderBy('id', 'desc')
                ->get()->toArray();

        if(count($itemCodeArr) == 0) {
            $codePrefix .= 1;
        } else {
             $codePrefix .= explode('-', $itemCodeArr[0]->item_code)[1] + 1;
        }
        return $codePrefix;
    }

    public static function isUnique($item) {
        $item['item_name'];
        $item['bf'];
        $item['gsm'];

        $item = Self::where("item_name", $item['item_name'])
            ->where('bf', $item['bf'])
            ->where('gsm', $item['gsm'])
            ->get()->toArray();

        return count($item) == 0;
    }
}
