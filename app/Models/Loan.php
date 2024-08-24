<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'user_id', 'return_date', 'loan_duration', 'status', 'quantity', 'no_hp'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'item_room')->withPivot('quantity');
    }
}
