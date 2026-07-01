<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Order;
use App\Models\ProjectTemplate;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
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
                TextInput::make('whatsapp_number')
                    ->tel()
                    ->maxLength(20),
                Select::make('project_type')
                    ->options(Order::projectTypes())
                    ->required(),
                DatePicker::make('deadline'),
                DatePicker::make('viva_date'),
                Select::make('budget_range')
                    ->options(Order::budgetRanges()),
                Select::make('package')
                    ->options(Order::packages()),
                Toggle::make('portfolio_permission'),
                TextInput::make('referred_by')
                    ->maxLength(255),
                Textarea::make('additional_notes')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(Order::statuses())
                    ->required()
                    ->default('pending'),
                Select::make('payment_status')
                    ->options(Order::paymentStatuses())
                    ->required()
                    ->default('unpaid'),
                TextInput::make('deposit_amount')
                    ->numeric()
                    ->prefix('৳'),
                TextInput::make('total_amount')
                    ->numeric()
                    ->prefix('৳'),
                Textarea::make('admin_notes')
                    ->columnSpanFull(),
                DateTimePicker::make('delivered_at'),
            ]);
    }
}
