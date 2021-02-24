<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class SessionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'session' => 'required|string|unique:App\Models\Session,name|max:255',
            'starts' => 'nullable | date',
            'ends' => 'nullable | date | after:starts',
        ]);

        if ($request->has('active')) {
            $current_active = Session::where('is_active', true)->first();
            $check = is_null($current_active) ?: $this->deactivate($current_active, 'is_active');
        }


        $session = new Session();
        $session->name = $request->session;
        $session->start = $request->starts;
        $session->end = $request->ends;
        $session->is_active = $request->has('active') ? true : false;
        $session->is_bookable = $request->has('bookable') ? true : false;
        $session->save();

        $notification = ['message' => 'Session created successfully', 'alert-type' => 'success'];
        return back()->with($notification);
    }

    public function update(Request $request, $id)
    {
        $session = Session::find($id);
        
        if ($session->name == $request->session) {
            $validated = $request->validate([
                'session' => 'required|string',
                'starts' => 'nullable | date',
                'ends' => 'nullable | date | after:starts',
            ]);
        } else {
            $validated = $request->validate([
                'session' => 'required|string|unique:App\Models\Session,name|max:255',
                'starts' => 'nullable | date',
                'ends' => 'nullable | date | after:starts',
            ]);
        }

        if ($request->has('active')) {
            $current_active = Session::where('is_active', true)->first();
            $check = is_null($current_active) ?: $this->deactivate($current_active, 'is_active');
        }


        $session->name = $request->session;
        $session->start = $request->starts;
        $session->end = $request->ends;
        $session->is_active = $request->has('active') ? true : false;
        $session->is_bookable = $request->has('bookable') ? true : false;
        $session->save();

        $notification = ['message' => 'Session updated successfully', 'alert-type' => 'success'];
        return back()->with($notification);
    }

    //deactive session active and bookable features    
    public function deactivate($id, $column)
    {
        $sessions = Session::find($id);
        foreach (collect($sessions) as $session) {
            $session->{$column} = false;
            $session->save();
        }
    }
}
