<?php

namespace App\Models\Arabic;

use Illuminate\Database\Eloquent\Model;

class AboutArabic extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql2';
    protected $table = 'about';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['about_id', 'mission', 'vision', 'value', 'approach', 'description'];

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
