<?php

namespace App\Models;

use App\Models\Album;
use Illuminate\Database\Eloquent\Model;

class Video extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'video';
    protected $connection = 'mysql';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['url', 'album_id', 'created_by'];

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
    protected $dates = ['birth_date'];


    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }


    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

}
