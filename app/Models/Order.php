<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'project_template_id',
        'title',
        'description',
        'project_type',
        'tech_stack_preference',
        'deadline',
        'complexity',
        'status',
        'admin_notes',
        'delivered_at',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'delivered_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function projectTemplate(): BelongsTo
    {
        return $this->belongsTo(ProjectTemplate::class, 'project_template_id');
    }

    public function deliverables(): HasMany
    {
        return $this->hasMany(OrderDeliverable::class, 'order_id')->orderByDesc('version');
    }

    public function learningMaterial(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProjectLearningMaterial::class, 'order_id');
    }

    public function vivaQuestions(): HasMany
    {
        return $this->hasMany(VivaQuestion::class, 'order_id')->orderBy('sort_order');
    }

    public static function statuses(): array
    {
        return [
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'in_progress' => 'In Progress',
            'delivered' => 'Delivered',
        ];
    }

    public function isDelivered(): bool
    {
        return $this->status === 'delivered';
    }
}
