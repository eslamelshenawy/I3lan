<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign_detail extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'campaign_details';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['campaign_id', 'company', 'phone', 'position', 'name', 'start_at', 'end_at', 'availability', 'price', 'printing_cost', 'status'];

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
    protected $dates = ['start_at', 'end_at'];


    public function parentCampaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id')->withDefault();
    }

}
