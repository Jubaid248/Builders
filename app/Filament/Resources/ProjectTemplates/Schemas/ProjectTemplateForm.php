<?php

namespace App\Filament\Resources\ProjectTemplates\Schemas;

use App\Models\ProjectTemplate;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectTemplateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Textarea::make('description')
                    ->columnSpanFull(),
                Select::make('project_type')
                    ->options(ProjectTemplate::projectTypes())
                    ->required(),
                Textarea::make('tech_stack')
                    ->columnSpanFull()
                    ->helperText('JSON array e.g. ["Laravel","Vue","MySQL"] or comma-separated'),
                Select::make('complexity')
                    ->options(ProjectTemplate::complexityLevels())
                    ->default('medium'),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
