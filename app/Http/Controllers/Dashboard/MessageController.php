<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('dashboard.message.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::find($id);
        return view('dashboard.message.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();
        Session::flash('delete', 'Message ' . $message->id . ' Has Been Deleted Successfully');
        return redirect(adminUrl('message'));
    }
}
