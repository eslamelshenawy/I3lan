<?php

namespace App\Models;

use App\Models\Arabic\SliderArabic;
use App\Models\English\SliderEnglish;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'slider';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['image_id', 'video_id', 'url', 'created_by'];

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


    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }

    public function slider_ar()
    {
        return $this->hasOne(SliderArabic::class, 'slide_id', 'id');
    }

    public function slider_en()
    {
        return $this->hasOne(SliderEnglish::class, 'slide_id', 'id');
    }

}
