<?php

namespace App\Traits;

use App\Models\FreeShop;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait FreeShopFunction 
{

    public function freeshop_page()
    {
        $free_shop_model = new FreeShop();
        $items = $free_shop_model->paginate(20);
        return view("free_shop.list_items",compact("items"));

    }

    public function freeshop_wishlist_page()
    {
        return view("free_shop.users_wishlist");
    }


    public function add_item_page()
    {
        return view("free_shop.create_item");
    }

    public function add_item(Request $request)
    {
        $item_name = $request->input("item_name");
        $item_category = $request->input("item_category");


        if (!empty($request->item_image)) {
            $file =$request->file('item_image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.' . $extension;
            $file->move(public_path('uploads/'), $filename);
            $image_path = env("APP_URL"). "/uploads/".$filename ;
        }
        

        $free_shop_model = new FreeShop();
        $free_shop_model->item_name = $item_name;
        $free_shop_model->item_category = $item_category;
        $free_shop_model->item_image = $image_path;
        $free_shop_model->item_status = "active";
        $free_shop_model->save();

        return redirect()->back()->with("success","Item Added Successfully");


    }

    public function manage_item(Request $request)
    {
        $status = $request->input("status");
        $id = $request->input("id");

        $free_shop_model = new FreeShop();
        $free_shop_model->where('id',$id)->update([
            "item_status"=>$status
        ]);

        return redirect()->to(route("shop_items"));

    }


}