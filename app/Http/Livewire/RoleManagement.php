<?php

namespace App\Http\Livewire;

use App\Models\ApplyForAuthor;
use App\Models\User;
use App\Tables\Columns\status;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class RoleManagement extends Component implements HasTable
{
    use InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return ApplyForAuthor::query()->orderBy('created_at', 'DESC');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('user.name')->description(fn (ApplyForAuthor $record) => $record->user->email)->searchable(),
            status::make('status'),
            // SelectColumn::make('status')
            //     ->options([
            //         'accepted' => 'Accepted',
            //         'rejected' => 'Rejected',
            //     ])->disablePlaceholderSelection()
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('updateAuthor')
                ->action(function (Collection $records, array $data): void {
                    foreach ($records as $record) {
                        $record->author()->associate($data['authorId']);
                        $record->save();
                    }
                })
                ->form([
                    Select::make('authorId')
                        ->label('Author')
                        ->options(User::query()->pluck('name', 'id'))
                        ->required(),
                ])
        ];
    }

    public function render()
    {
        return view('livewire.role-management');
    }
}
