<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'assigned_to'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with user who created the ticket
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with assigned agent/admin
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
