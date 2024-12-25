<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class products extends Model
{
    /** @use HasFactory<\Database\Factories\ProductsFactory> */
    use HasFactory;
    protected $fillable = ["name", "price", "quantity", "description"];

    // TODO: Add forieng-key relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
