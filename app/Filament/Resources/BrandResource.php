<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers\ProductRelationManager;
use App\Models\Brand;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;
use Tapp\FilamentAuditing\RelationManagers\AuditsRelationManager;

class BrandResource extends Resource
{
    use Translatable;
    protected static ?string $navigationGroup = 'Shop';
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';


    public static function getTranslatableLocales(): array
    {
        return ['en', 'es'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(2)->schema([
                    TextInput::make('name')->label('Brand Name')->required()->unique(Brand::class, 'slug', ignoreRecord: true)->reactive()->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                    TextInput::make('slug')->unique(Brand::class, 'slug', ignoreRecord: true)->required()->disabled(),
                ]),
                Grid::make(1)->schema([
                    TextInput::make('website')->activeUrl()->required(),
                    RichEditor::make('description')->required()
                ])
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('slug')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('website')->sortable()->searchable(),
            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProductRelationManager::class,
            AuditsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
