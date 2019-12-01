<?php

namespace App\Models;

use App\Models\Arabic\AlbumArabic;
use App\Models\English\AlbumEnglish;
use Illuminate\Database\Eloquent\Model;

class Album extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'album';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['image_id', 'created_by', 'type'];

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

    public function videos()
    {
        return $this->hasMany(Video::class, 'album_id', 'id');
    }


    public function images()
    {
        return $this->hasMany(Image::class, 'album_id', 'id');
    }


    public function album_ar()
    {
        return $this->hasOne(AlbumArabic::class, 'album_id','id');
    }

    public function album_en()
    {
        return $this->hasOne(AlbumEnglish::class, 'album_id','id');
    }

}
