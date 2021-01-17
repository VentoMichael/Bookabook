<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasesStudent extends Model
{
    use HasFactory;
    public function scopeDraft($query)
    {
        return $query->where('is_draft', '=', '1');
    }
    public function scopeNoDraft($query)
    {
        return $query->where('is_draft', '=', '0');
    }
}
