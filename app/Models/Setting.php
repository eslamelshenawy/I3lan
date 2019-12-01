<?php

namespace App\Models;

use App\Models\Arabic\SettingArabic;
use App\Models\English\SettingEnglish;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'setting';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['logo', 'status', 'default_lang', 'created_by'];

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


    public function image()
    {
        return $this->belongsTo(Image::class, 'logo', 'id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }


    public function setting_ar()
    {
        return $this->hasOne(SettingArabic::class, 'setting_id', 'id');
    }

    public function setting_en()
    {
        return $this->hasOne(SettingEnglish::class, 'setting_id', 'id');
    }

}
