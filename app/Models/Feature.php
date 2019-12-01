<?php

namespace App\Models;

use App\Models\Arabic\FeatureArabic;
use App\Models\English\FeatureEnglish;

use App\Models\Video;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'feature';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['image_id'];

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

    public function feature_ar()
    {
        return $this->hasOne(FeatureArabic::class, 'feature_id', 'id');
    }

    public function feature_en()
    {
        return $this->hasOne(FeatureEnglish::class, 'feature_id', 'id');
    }


}
