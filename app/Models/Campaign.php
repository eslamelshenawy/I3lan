<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'campaign';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'status'];

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


    public function campaignDetails()
    {
        return $this->hasOne(Campaign_detail::class, 'campaign_id', 'id')->withDefault();
    }

    public function billboard()
    {
        return $this->belongsToMany(Billboard::class, 'campaign_items', 'campaign_id', 'billboard_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function campaignItems()
    {
        return $this->hasMany(Campaign_item::class, 'campaign_id', 'id');
    }

}
