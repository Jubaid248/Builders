<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderFeedback extends Model
{
    protected $fillable = [
        'order_id',
        'did_well',
        'improve',
        'would_refer',
        'rating',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public static function wouldReferOptions(): array
    {
        return [
            'yes' => 'Yes',
            'maybe' => 'Maybe',
            'no' => 'No',
        ];
    }
}
