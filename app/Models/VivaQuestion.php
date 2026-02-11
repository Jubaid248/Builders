<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VivaQuestion extends Model
{
    protected $fillable = [
        'order_id',
        'category',
        'question',
        'answer',
        'sort_order',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public static function categories(): array
    {
        return [
            'basic_concept' => 'Basic Concept',
            'architecture_design' => 'Architecture & Design',
            'implementation' => 'Implementation',
            'follow_up' => 'Follow-up Questions',
        ];
    }
}
