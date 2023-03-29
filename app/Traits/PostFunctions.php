<?php

namespace App\Traits;

use App\Models\UsersMainApp;
use App\Models\UsersMainPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait PostFunctions {


    public function fetch_all_post()
    {
        return UsersMainPost::fetch_pending_post();
    }

    public function post_action(Request $request)
    {
        $admin_comment = $request->input("admin_comment");
        $post_id = $request->input("post_id");
        $post_status = $request->input("button_type");
        $admin_detail = Auth::user()->name;
        $timestamp = time();
        $date = date('Y-m-d H:i:s', $timestamp);
        $date_updated = $date;

        $post_model = new UsersMainPost();
        $post_model->where("id", $post_id)->update([
            "admin_comment"=>$admin_comment,
            "post_status" => $post_status,
            "admin_detail"=> $admin_detail,
            "date_updated" =>$date_updated

        ]);

        return redirect()->back()->with("success","Post Updated Successfully!");
    }

    public function view_approved_post()
    {

        $posts = UsersMainPost::fetch_approved_post();
        return view("post_request.approved",compact("posts"));
    }
    public function view_rejected_post()
    {

        $posts = UsersMainPost::fetch_rejected_post();
        return view("post_request.rejected",compact("posts"));
    }

    public function fetch_user_by_post( $uuid)
    {
        $user = UsersMainApp::fetch_user_by_uuid($uuid);
        $data = [
        "imageSrc"=>$user->profile_photo,"name"=>$user->fullname,
        "email"=>$user->email,"phone"=>$user->phone,"address"=>$user->address,
        "country"=>$user->country
    ];
        return response()->json($data,200);
    }

}