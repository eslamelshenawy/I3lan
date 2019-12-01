<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'client';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['image_id', 'created_by'];

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


    public function client_ar()
    {
        return $this->hasOne(ClientArabic::class, 'client_id','id');
    }

    public function client_en()
    {
        return $this->hasOne(ClientEnglish::class, 'client_id','id');
    }

}
