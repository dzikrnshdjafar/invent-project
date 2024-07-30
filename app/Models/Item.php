<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'quantity', 'room_id'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
