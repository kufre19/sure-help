<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Partnership {



    public function broadcastmessage_page()
    {
        return view("partners.broadcast_message");
        
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