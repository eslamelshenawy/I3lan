<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parent_location extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'parent_location';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [];

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

    public function parentLocation_en()
    {
        return $this->hasOne(\App\Models\English\Parent_location::class, 'parent_location_id', 'id')->withDefault();
    }

}
