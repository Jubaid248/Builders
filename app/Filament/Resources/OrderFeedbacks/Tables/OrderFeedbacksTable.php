<?php

namespace App\Filament\Resources\OrderFeedbacks\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderFeedbacksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order.title')
                    ->label('Order')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('order.user.name')
                    ->label('Customer')
                    ->searchable(),
                TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn (int $state): string => str_repeat('★', $state) . str_repeat('☆', 5 - $state))
                    ->sortable(),
                TextColumn::make('would_refer')
                    ->label('Would refer')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'yes' => 'success',
                        'maybe' => 'warning',
                        'no' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('did_well')
                    ->limit(50)
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make(),
            ]);
    }
}
