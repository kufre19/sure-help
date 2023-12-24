<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\SponsorBroadcast;

trait Partnership {



    public function broadcastmessage_page()
    {
        return view("partners.broadcast_message");
        
    }

    public function sendBroadcast(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'broadcast_type' => 'required|string|max:50',
            'message' => 'required|string|max:500',
            'broadcast_by' => 'required|string|max:50',
        ]);
    
        // Update or create a new broadcast message
        $broadcast = SponsorBroadcast::first(); // Attempt to get the first record
        if (!$broadcast) {
            $broadcast = new SponsorBroadcast(); // If no record exists, create a new instance
        }
    
        // Update the properties
        $broadcast->title = $request->title;
        $broadcast->broadcast_type = $request->broadcast_type;
        $broadcast->message = $request->message;
        $broadcast->broadcast_by = $request->broadcast_by;
        
        $broadcast->save(); // Save the record, which will either update or insert
    
        return redirect()->back()->with('success', 'Broadcast message updated successfully!');
    }
    

    public function broadcastmessage_send(Request $request)
    {
        session()->flash('success', 'Message Sent!');
        return redirect()->back();
    } 

    public function list_partners_page()
    {
        // $partners = 
        return view("partners.list_partners");
    }

    public function view_partner_page($id)
    {
        return response()->json(['name'=>"Partner name","image"=>"image url","other_details"=>"other details"]);

    }
}