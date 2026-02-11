<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Order;
use App\Models\ProjectTemplate;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable(),
                Select::make('project_template_id')
                    ->relationship('projectTemplate', 'title')
                    ->searchable(),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->columnSpanFull(),
                Select::make('project_type')
                    ->options(ProjectTemplate::projectTypes())
                    ->required(),
                TextInput::make('tech_stack_preference')
                    ->placeholder('e.g. Laravel, Vue, MySQL'),
                DatePicker::make('deadline'),
                Select::make('complexity')
                    ->options(ProjectTemplate::complexityLevels())
                    ->default('medium'),
                Select::make('status')
                    ->options(Order::statuses())
                    ->required()
                    ->default('pending'),
                Textarea::make('admin_notes')
                    ->columnSpanFull(),
                DateTimePicker::make('delivered_at'),
            ]);
    }
}
