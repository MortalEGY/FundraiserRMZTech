<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'campaign_id',
        'anonymous',
        'amount',
        'fee',
        'message',
        'paid',
        'expired_at',
        'paid_at',
    ];

    protected $casts = [
        'anonymous' => 'boolean',
        'paid' => 'boolean',
        'amount' => 'integer',
        'fee' => 'integer',
        'expired_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function campaign() {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}
