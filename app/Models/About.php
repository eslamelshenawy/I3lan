<?php

namespace App\Models;

use App\Models\Arabic\AboutArabic;
use App\Models\English\AboutEnglish;
use Illuminate\Database\Eloquent\Model;

class About extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'about';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['image_id', 'mission_image_id', 'vision_image_id', 'values_image_id', 'approach_image_id'];

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


    public function about_en()
    {
        return $this->hasOne(AboutEnglish::class, 'about_id', 'id');
    }

    public function about_ar()
    {
        return $this->hasOne(AboutArabic::class, 'about_id', 'id');
    }

    public function aboutImage()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }

    public function missionImage()
    {
        return $this->belongsTo(Image::class, 'mission_image_id', 'id');
    }

    public function visionImage()
    {
        return $this->belongsTo(Image::class, 'vision_image_id', 'id');
    }

    public function valuesImage()
    {
        return $this->belongsTo(Image::class, 'values_image_id', 'id');
    }

    public function approachImage()
    {
        return $this->belongsTo(Image::class, 'approach_image_id', 'id');
    }


}
