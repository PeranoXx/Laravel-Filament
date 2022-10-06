<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\Widgets\ProductOverview;
use App\Models\Product;
use Closure;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;
use Konnco\FilamentSafelyDelete\Tables\Actions\RevertableDeleteAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Webbingbrasil\FilamentAdvancedFilter\Filters\BooleanFilter;
use Webbingbrasil\FilamentAdvancedFilter\Filters\DateFilter;
use Webbingbrasil\FilamentAdvancedFilter\Filters\NumberFilter;
use Webbingbrasil\FilamentAdvancedFilter\Filters\TextFilter;
use Tapp\FilamentAuditing\RelationManagers\AuditsRelationManager;
use FilamentEditorJs\Forms\Components\EditorJs;

class ProductResource extends Resource
{
    use Translatable;
    protected static ?string $navigationGroup = 'Shop';
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-lightning-bolt';

    public static function getTranslatableLocales(): array
    {
        return ['en', 'es'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(3)->schema([
                Grid::make(3)->schema([
                    Card::make()->schema([
                        Grid::make()->schema([
                            TextInput::make('name')->label('Product Name')->required()->unique(Product::class, 'slug', ignoreRecord: true)->reactive()->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                            TextInput::make('slug')->unique(Product::class, 'slug', ignoreRecord: true)->required()->disabled(),
                        ]),
                        RichEditor::make('description')->required(),
                        // EditorJs::make('description')
                    ]),
                    Section::make('Image')->schema([
                        FileUpload::make('image')->multiple()->required()
                    ])->columns(1),

                    Section::make('Pricing')->schema([
                        Grid::make()->schema([
                            TextInput::make('amount')->numeric()->label('Product Amount')->required()->default(0)->reactive()->afterStateUpdated(
                                function ($state, Closure $get, callable $set) {
                                    $discount = $get('discount');
                                    if ($state && $discount) {
                                        $discount_amount = $state - ($state * ($discount / 100));
                                        $set('discount_amount', $discount_amount);
                                    } else {
                                        $set('discount_amount', 0);
                                    }
                                }
                            ),
                            TextInput::make('discount_amount')->numeric()->label('Discounted Amount')->default(0)->disabled(),
                            TextInput::make('discount')->numeric()->label('Discounted')->default(0)->reactive()->afterStateUpdated(
                                function ($state, Closure $get, callable $set) {
                                    $amount = $get('amount');
                                    if ($state && $amount) {
                                        $discount_amount = $amount - ($amount * ($state / 100));
                                        $set('discount_amount', $discount_amount);
                                    } else {
                                        $set('discount_amount', 0);
                                    }
                                }
                            ),
                        ]),
                    ]),
                ])->columnSpan(2),
                Grid::make(3)->schema([
                    Section::make('Association')->schema([
                        Select::make('brand_id')->relationship('brand', 'name'),
                        Select::make('category')->multiple()->relationship('category', 'name')
                    ])->columns(1),
                    Section::make('Status')->schema([
                        Toggle::make('is_visible')->helperText('This product will be hidden from all sales channels'),

                        Placeholder::make('created_at')->content(fn (Product $record): string => $record->created_at->diffForHumans())->hidden(fn (?Product $record) => $record === null),
                        Placeholder::make('updated_at')->content(fn (Product $record): string => $record->updated_at->diffForHumans())->hidden(fn (?Product $record) => $record === null),
                    ])->columns(1),
                ])->columnSpan(1),

            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('image'),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('amount')->prefix('₹')->sortable(),
                TextColumn::make('discount_amount')->prefix('₹')->sortable()->toggleable(),
                TextColumn::make('discount')->suffix('%')->sortable()->toggleable(),
                TextColumn::make('brand.name')->searchable()->sortable()->toggleable(),
                TextColumn::make('created_at')->toggleable(),
            ])->defaultSort('created_at', 'desc')
            ->filters([
                // SelectFilter::make('brand')->relationship('brand', 'name'),
                BooleanFilter::make('is_visible'),
                DateFilter::make('created_at'),
                NumberFilter::make('amount'),
                TextFilter::make('name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // DeleteAction::make()->usingField('slug'),
                RevertableDeleteAction::make('slug')
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make('export')
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AuditsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ProductOverview::class,
        ];
    }
}
