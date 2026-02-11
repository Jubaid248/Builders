<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectLearningMaterial extends Model
{
    protected $fillable = [
        'order_id',
        'problem_statement',
        'tech_stack_used',
        'system_architecture',
        'workflow_breakdown',
        'feature_breakdown',
        'architecture_diagram',
        'data_flow_diagram',
        'module_interaction_diagram',
        'deployment_guide',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
