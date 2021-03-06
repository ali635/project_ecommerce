<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table    = 'products';
    protected $fillable = [
        'title_ar'  	,
        'title_en'  	,
        'photo'  		,
        'code'          ,
        'content_ar'  	,
        'content_en'  	,
        'code'          ,
        'department_id' ,
        'trade_id'  	,
        'manu_id'  		,
        'color_id'  	,
        'size_id'  		,
        'currency_id'  	,
        'price'  		,
        'stock'  		,
        'start_at'  	,
        'end_at'  		,
        'start_offer_at',
        'end_offer_at'  ,
        'price_offer'  	,
        'other_date'  	,
        'weight'  		,
        'weight_id'  	,
        'status'  		,
        'reason'  		,
    ];

    public static function getRandProducts()
    {
        return self::inRandomOrder()->where('status', '=', 'active')->take(12)->get();
    }

    public static function recommendProducts()
    {
        return self::inRandomOrder()->where('status', '=', 'active')->take(3)->get();
    }

    public function departmends()
    {
        return $this->hasOne("App\Model\Department");
    }

    public function tradeMark()
    {
        return $this->hasOne(\App\Model\TradeMark::class, 'id', 'trade_id');
    }

    public static function inStock($id)
    {
        $product_stock_count = self::find($id);

        if ($product_stock_count->stock > 0) {
            return "In Stock";
        } else {
            return "Out Stock";
        }
    }

    public function related() {
        return $this->hasMany(\App\Model\RelatedProduct::class,'product_id','id');
    }

    public function mall_product() {
        return $this->hasMany(\App\Model\MallProducts::class,'product_id','id');
    }

    public function other_data() {
        return $this->hasMany(\App\Model\OtherData::class,'product_id','id');
    }
    public function malls() {
        return $this->hasMany(\App\Model\MallProducts::class,'product_id','id');
    }

    public function files()
    {
        return $this->hasMany('App\File','relation_id','id')->where('file_type','product');
    }
}
