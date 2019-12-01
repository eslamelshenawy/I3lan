<?php

namespace App\Models;

use App\Models\Arabic\TestimonialArabic;
use App\Models\English\TestimonialEnglish;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'testimonial';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_by'];

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

    public function testimonial_ar()
    {
        return $this->hasOne(TestimonialArabic::class, 'testimonial_id', 'id');
    }

    public function testimonial_en()
    {
        return $this->hasOne(TestimonialEnglish::class, 'testimonial_id', 'id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }


}
