<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'billboard';
    protected $connection = 'mysql';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['image_id', 'service_id', 'display', 'created_by'];

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

    public function project_ar()
    {
        return $this->hasOne(\App\Models\Arabic\Project::class, 'project_id', 'id');
    }

    public function project_en()
    {
        return $this->hasOne(\App\Models\English\Project::class, 'project_id', 'id');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'project_images', 'project_id','image_id')->withTimestamps();
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }

    public function relatedService()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
