<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class OrderDeliverable extends Model
{
    protected $fillable = [
        'order_id',
        'version',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'notes',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getDownloadUrl(): string
    {
        if (str_starts_with($this->file_path, 'http')) {
            return $this->file_path;
        }
        return route('orders.deliverables.download', ['order' => $this->order_id, 'deliverable' => $this->id]);
    }

    public function isLocalFile(): bool
    {
        return ! str_starts_with($this->file_path, 'http');
    }
}
