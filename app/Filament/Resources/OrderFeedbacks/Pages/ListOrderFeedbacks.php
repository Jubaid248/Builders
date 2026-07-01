<?php

namespace App\Filament\Resources\OrderFeedbacks\Pages;

use App\Filament\Resources\OrderFeedbacks\OrderFeedbackResource;
use Filament\Resources\Pages\ListRecords;

class ListOrderFeedbacks extends ListRecords
{
    protected static string $resource = OrderFeedbackResource::class;
}
