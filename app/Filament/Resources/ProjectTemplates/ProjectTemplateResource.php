<?php

namespace App\Filament\Resources\ProjectTemplates;

use App\Filament\Resources\ProjectTemplates\Pages\CreateProjectTemplate;
use App\Filament\Resources\ProjectTemplates\Pages\EditProjectTemplate;
use App\Filament\Resources\ProjectTemplates\Pages\ListProjectTemplates;
use App\Filament\Resources\ProjectTemplates\Schemas\ProjectTemplateForm;
use App\Filament\Resources\ProjectTemplates\Tables\ProjectTemplatesTable;
use App\Models\ProjectTemplate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProjectTemplateResource extends Resource
{
    protected static ?string $model = ProjectTemplate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ProjectTemplateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectTemplatesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjectTemplates::route('/'),
            'create' => CreateProjectTemplate::route('/create'),
            'edit' => EditProjectTemplate::route('/{record}/edit'),
        ];
    }
}
