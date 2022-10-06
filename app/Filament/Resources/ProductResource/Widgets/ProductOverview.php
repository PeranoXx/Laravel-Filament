<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class ProductOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Products', Product::count()),
            Card::make('Average Price', number_format(Product::avg('amount'),2)),
        ];
    }
}
