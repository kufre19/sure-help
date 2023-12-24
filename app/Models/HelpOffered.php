<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpOffered extends Model
{
    use HasFactory;

    protected $table = 'help_offered';

    // Define the relationship with Sponsor
    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class, 'uuid', 'uuid');
    }
}
