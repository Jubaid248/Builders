<?php

namespace App\Filament\Resources\OrderFeedbacks\Schemas;

use App\Models\OrderFeedback;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderFeedbackForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('order_id')
                    ->label('Order')
                    ->relationship('order', 'title')
                    ->disabled(),
                Textarea::make('did_well')
                    ->label('What did we do well?')
                    ->disabled()
                    ->columnSpanFull(),
                Textarea::make('improve')
                    ->label('What could we improve?')
                    ->disabled()
                    ->columnSpanFull(),
                Select::make('would_refer')
                    ->options(OrderFeedback::wouldReferOptions())
                    ->disabled(),
                TextInput::make('rating')
                    ->label('Rating (1–5)')
                    ->disabled(),
            ]);
    }
}
