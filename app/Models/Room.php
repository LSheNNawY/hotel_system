<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'capacity',
        'price',
        'available',
        'created_by',
        'floor_id'
    ];

    public function floor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Floor::class, 'floor_id');
    }

    public function manager() {
        return $this->belongsTo(User::class, 'created_by');
    }

}
