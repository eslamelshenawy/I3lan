<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign_item extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'campaign_items';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['campaign_id', 'billboard_id'];

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
    protected $dates = ['starts', 'end'];

    public function requestedCampaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id')->withDefault();
    }

    public function requestedBillboard()
    {
        return $this->belongsTo(Billboard::class, 'billboard_id', 'id')->withDefault();
    }

}
