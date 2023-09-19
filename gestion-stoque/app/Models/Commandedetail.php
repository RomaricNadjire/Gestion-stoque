<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commandedetails extends Model
{
    use HasFactory;
    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class);
    }
    
}
