<?php

namespace App\Filament\Resources\OrderFeedbacks;

use App\Filament\Resources\OrderFeedbacks\Pages\ListOrderFeedbacks;
use App\Filament\Resources\OrderFeedbacks\Pages\ViewOrderFeedback;
use App\Filament\Resources\OrderFeedbacks\Schemas\OrderFeedbackForm;
use App\Filament\Resources\OrderFeedbacks\Tables\OrderFeedbacksTable;
use App\Models\OrderFeedback;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrderFeedbackResource extends Resource
{
    protected static ?string $model = OrderFeedback::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static ?string $navigationLabel = 'Order Feedback';

    protected static ?string $modelLabel = 'Order Feedback';

    public static function form(Schema $schema): Schema
    {
        return OrderFeedbackForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrderFeedbacksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrderFeedbacks::route('/'),
            'view' => ViewOrderFeedback::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
