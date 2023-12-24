<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\FreeShop;
use App\Models\UserMainApp;


class WishList extends Model
{
    use HasFactory;
    protected $table = 'wishlists';

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function item():BelongsTo
    {
        return $this->belongsTo(FreeShop::class, 'item_id');
    }

}
