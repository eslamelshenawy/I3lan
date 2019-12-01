<?php

namespace App\Models;

use App\Models\Arabic\FeatureArabic;
use App\Models\Arabic\ProductArabic;
use App\Models\English\ProductEnglish;
use App\Models\English\FeatureEnglish;

use App\Models\Video;
use Illuminate\Database\Eloquent\Model;

class Product extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'product';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['image_id', 'created_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }

    public function product_ar()
    {
        return $this->hasOne(ProductArabic::class, 'product_id', 'id');
    }

    public function product_en()
    {
        return $this->hasOne(ProductEnglish::class, 'product_id', 'id');
    }


}
