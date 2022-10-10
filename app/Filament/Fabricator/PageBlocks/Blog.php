<?php

namespace App\Filament\Fabricator\PageBlocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;
use Illuminate\Support\Str;

class Blog extends PageBlock
{
    public static function getBlockSchema(): Block
    {
        return Block::make('blog')
            ->schema([
                Group::make()
                    ->schema([
                        Card::make()
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->reactive()->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                                TextInput::make('slug')
                                    ->disabled()
                                    ->required(),

                                TinyEditor::make('content')->height(400)
                                    ->required()
                                    ->columnSpan('full'),

                                // Forms\Components\Select::make('blog_author_id')
                                //     ->relationship('author', 'name')
                                //     ->searchable()
                                //     ->required(),

                                DatePicker::make('published_at')
                                    ->label('Published Date'),

                                // SpatieTagsInput::make('tags'),
                            ])
                            ->columns(2),

                            Section::make('Image')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Image')
                                    ->image()
                                    ->disableLabel(),
                            ])
                            ->collapsible(),
                    ])

            ]);
    }

    public static function mutateData(array $data): array
    {
        return $data;
    }
}