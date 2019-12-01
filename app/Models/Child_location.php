<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child_location extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'child_location';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_location_id'];

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

    public function childLocation_en()
    {
        return $this->hasOne(\App\Models\English\Child_location::class, 'child_location_id', 'id');
    }

    public function parentLocation()
    {
        return $this->belongsTo(Parent_location::class, 'parent_location_id', 'id')->with('parentLocation_en');
    }

}
