<?php
namespace App\Http\Models\Stock;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Models\Sys\AureoleLookup;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PriceMapping extends Model
{   
    protected $table ="ut_stock_price_mapping_m";

    protected $guarded = [];
    use SoftDeletes;

    public static function getLOV() {
        $lov = [];
        // $lov['BF'] = AureoleLookup::getLov('BF');
        // $lov['GSM'] = AureoleLookup::getLov('GSM');
        return $lov;
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

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
