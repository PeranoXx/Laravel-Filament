<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use FilamentEditorJs\Forms\Components\EditorJs;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PostForm extends Component implements HasForms
{
    use InteractsWithForms;

    public $title = '';
    public $slug = '';
    public $content = '';
    public $category_id = '';
    public $image = '';

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    TextInput::make('title')->required()->unique()->reactive()->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                    TextInput::make('slug')->unique()->disabled(),
                ]),
            TinyEditor::make('content')->required(),
            // EditorJs::make('content'),
            Grid::make(2)
                ->schema([
                    Select::make('category_id')->required()
                        ->label('Category')
                        ->options(Category::all()->pluck('name', 'id'))
                        ->searchable(),
                    // DateTimePicker::make('published_at')->required(),
                ]),
            FileUpload::make('image')->directory('blog-post')
        ];
    }

    public function submit()
    {   
        $post = $this->form->getState();
        $post['user_id'] =Auth::user()->id;
        $post['published_at'] = Carbon::now();
        // dd($post);
        $post = Post::create($post);
        if($post){
            Notification::make() 
            ->title('Post created successfully!')
            ->success()
            ->send(); 

            return redirect()->route('dashboard');
        }
    }
    
    public function render()
    {
        return view('livewire.post-form');
    }
}
