<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_type', 'creator_id', 'status', 'receiver_account',
        'fund', 'bank', 'money', 'fee', 'approve_level', 'total_money',
        'receiver_id', 'content', 'form', 'approver_id'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
