<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pricing';
    protected $connection = 'mysql';


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['image_id', 'icon_code', 'price'];

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

    public function pricing_ar()
    {
        return $this->hasOne(\App\Models\Arabic\Pricing::class, 'pricing_id', 'id');
    }

    public function pricing_en()
    {
        return $this->hasOne(\App\Models\English\Pricing::class, 'pricing_id', 'id');
    }

}
