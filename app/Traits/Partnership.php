<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\SponsorBroadcast;
use App\Models\UserSponsorApp;
use App\Models\HelpOffered;



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
    

  

    public function list_partners_page()
    {
        // Retrieve all partners, consider using pagination
        $partners = UserSponsorApp::paginate(10); // Adjust the number per page as needed

        // Pass the partners to the view
        return view('partners.list_partners', compact('partners'));
    }

    public function view_partner_page($id)
    {
        $partner = UserSponsorApp::findOrFail($id);
        $helpsOffered = HelpOffered::where('uuid', $partner->uuid)->get(); // Retrieve all helps offered by this partner

        return response()->json([
            'name' => $partner->fullname,
            'image' => $partner->profile_photo,
            'other_details' => 'Other details here...', // Add more details as required
            'help_offered' => $helpsOffered // This will be a collection of HelpOffered objects
        ]);
    }
}