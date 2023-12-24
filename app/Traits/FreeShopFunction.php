<?php

namespace App\Traits;

use App\Models\FreeShop;
use App\Models\WishList;

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
        $wishlists = Wishlist::with(['user', 'item']) // Assuming 'user' and 'item' are the relationship methods in Wishlist model
                       ->where('wish_status', 'pending') // Or any other condition you want to apply
                       ->get();
        // dd($wishlists);
    
        return view("free_shop.users_wishlist", compact('wishlists'));
    }

    public function fetchWishlistDetails($wishlistId)
    {
        $wishlist = Wishlist::with(['user', 'item'])->find($wishlistId);
        if ($wishlist) {
            return response()->json([
                'user' => $wishlist->user, // Assuming a 'user' relationship is defined
                'item' => $wishlist->item  // Assuming an 'item' relationship is defined
            ]);
        } else {
            return response()->json(['error' => 'Wishlist not found'], 404);
        }
    }


    public function approveWishlist(Request $request)
    {
        $wishlistId = $request->input('wishlistId');
        $wishlist = Wishlist::find($wishlistId);
        $wishlist->wish_status = 'approved';
        $wishlist->save();

        return response()->json(['message' => 'Wishlist approved successfully']);
    }

    public function rejectWishlist(Request $request)
    {
        $wishlistId = $request->input('wishlistId');
        $wishlist = Wishlist::find($wishlistId);
        $wishlist->wish_status = 'rejected';
        $wishlist->save();

        return response()->json(['message' => 'Wishlist rejected successfully']);
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