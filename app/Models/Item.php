<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description'];

    public function rooms()
    {
        return $this->belongsToMany(Room::class)->withPivot('quantity');
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
