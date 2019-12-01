<?php

namespace App\Models\English;

use Illuminate\Database\Eloquent\Model;

class Parent_location extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'parent_location';
    protected $connection = 'mysql3';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_location_id', 'location', 'description'];

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

}
