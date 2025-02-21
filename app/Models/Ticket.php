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
        'category_id',
        'agent_id'
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

    public function agent(){
        return $this->belongsTo(User::class, 'agent_id');
    }

    // Relationship with assigned agent/admin
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
