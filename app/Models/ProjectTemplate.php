<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectTemplate extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'project_type',
        'tech_stack',
        'complexity',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'tech_stack' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'project_template_id');
    }

    public static function projectTypes(): array
    {
        return [
            'web' => 'Web Application',
            'ml' => 'Machine Learning',
            'iot' => 'IoT',
            'desktop' => 'Desktop Application',
        ];
    }

    public static function complexityLevels(): array
    {
        return [
            'low' => 'Low',
            'medium' => 'Medium',
            'high' => 'High',
        ];
    }
}
