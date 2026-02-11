<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_learning_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->text('problem_statement')->nullable();
            $table->text('tech_stack_used')->nullable();
            $table->longText('system_architecture')->nullable(); // Mermaid/description
            $table->longText('workflow_breakdown')->nullable();
            $table->longText('feature_breakdown')->nullable();
            $table->longText('architecture_diagram')->nullable(); // Mermaid code
            $table->longText('data_flow_diagram')->nullable();
            $table->longText('module_interaction_diagram')->nullable();
            $table->longText('deployment_guide')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_learning_materials');
    }
};
