<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'image';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'path', 'album_id', 'alt'];

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


    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_images', 'image_id','service_id')->with('service'.currentLang());
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_images', 'image_id','project_id');
    }

    public function billboards()
    {
        return $this->belongsToMany(Billboard::class, 'billboard_images', 'image_id','billboard_id');
    }

}
