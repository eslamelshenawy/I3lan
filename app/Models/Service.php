<?php

namespace App\Models;

use App\Models\Arabic\ServiceArabic;
use App\Models\English\ServiceEnglish;
use App\Models\Video;
use Illuminate\Database\Eloquent\Model;

class Service extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'service';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['image_id', 'video_id', 'created_by', 'icon_code'];

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

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function service_ar()
    {
        return $this->hasOne(ServiceArabic::class, 'service_id', 'id');
    }

    public function service_en()
    {
        return $this->hasOne(ServiceEnglish::class, 'service_id', 'id');
    }

    public function parentService()
    {
        return $this->belongsTo(Service::class, 'parent_service_id', 'id');
    }

    public function childService()
    {
        return $this->hasMany(Service::class, 'parent_service_id', 'id');
    }

    public function team()
    {
        return $this->hasMany(Team::class, 'service_id', 'id');
    }


}
