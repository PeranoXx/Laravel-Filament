<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PostList extends Component implements HasTable
{
    use InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Post::query()->orderBy('published_at','DESC');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('title')->searchable(),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            // SelectFilter::make('author')->relationship('category', 'name')
        ];
    }

    protected function getTableActions(): array
    {
        return [];
    }

    protected function getTableBulkActions(): array
    {
        return [];
    }

    public function getTableContent(): ?View
    {
        return view('tables.post-table');
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
