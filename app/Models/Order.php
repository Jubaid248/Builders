<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'project_template_id',
        'title',
        'description',
        'whatsapp_number',
        'project_type',
        'tech_stack_preference',
        'deadline',
        'viva_date',
        'budget_range',
        'package',
        'portfolio_permission',
        'referred_by',
        'additional_notes',
        'complexity',
        'status',
        'payment_status',
        'deposit_amount',
        'total_amount',
        'admin_notes',
        'delivered_at',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'viva_date' => 'date',
            'delivered_at' => 'datetime',
            'portfolio_permission' => 'boolean',
            'deposit_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
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

    public function learningMaterial(): HasOne
    {
        return $this->hasOne(ProjectLearningMaterial::class, 'order_id');
    }

    public function vivaQuestions(): HasMany
    {
        return $this->hasMany(VivaQuestion::class, 'order_id')->orderBy('sort_order');
    }

    public function feedback(): HasOne
    {
        return $this->hasOne(OrderFeedback::class);
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

    public static function projectTypes(): array
    {
        return [
            'web' => 'Web Application',
            'research' => 'Research',
            'english_writing' => 'English Writing',
        ];
    }

    public static function budgetRanges(): array
    {
        return [
            'under_1000' => 'Under ৳1000',
            '1000_2500' => '৳1000–৳2500',
            '2500_5000' => '৳2500–৳5000',
            'above_5000' => 'Above ৳5000',
        ];
    }

    public static function packages(): array
    {
        return [
            'basic' => 'Basic',
            'standard' => 'Standard',
            'premium' => 'Premium',
        ];
    }

    public static function paymentStatuses(): array
    {
        return [
            'unpaid' => 'Unpaid',
            'deposit_paid' => 'Deposit Paid',
            'fully_paid' => 'Fully Paid',
        ];
    }

    public function isDelivered(): bool
    {
        return $this->status === 'delivered';
    }
}
