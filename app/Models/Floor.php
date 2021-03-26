<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by'
    ];

    public function rooms() {
        $this->hasMany(Room::class);
    }


    public function manager() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
