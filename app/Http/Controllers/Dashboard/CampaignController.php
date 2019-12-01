<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Campaign_item;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $requests = Campaign::with('campaignDetails')->get();
        return view('dashboard.campaign.index', compact('requests'));
    }

    public function show($id)
    {
        $request = Campaign::with('campaignDetails')->find($id);
        $campaignItems = Campaign_item::with('requestedBillboard')->where('campaign_id', $id)->get();
        return view('dashboard.campaign.show', compact('request', 'campaignItems'));
    }
}
