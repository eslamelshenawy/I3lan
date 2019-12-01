<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Client;
use App\Models\Message;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $clients = Client::all()->count();
        $messages = Message::all()->count();
        $projects = Project::all()->count();
        //$members = Team::all()->count();
        return view('dashboard.welcome', compact('clients', 'messages', 'projects'));
    }
}
