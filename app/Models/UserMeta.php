<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'accout_type', 'accout_number',
        'transaction_limit', 'surplus'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
