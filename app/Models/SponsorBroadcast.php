<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsorBroadcast extends Model
{
    use HasFactory;
    protected $table = 'users_sponsors_broadcast';
    protected $fillable = ['title', 'broadcast_type', 'message', 'broadcast_by'];

    // The $dates property allows you to work with date_created and date_updated as Carbon instances
    public $timestamps = false;
    protected $dates = ['date_created', 'date_updated'];
}
