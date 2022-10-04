@foreach ($records as $record)
    <div class="p-4">
        {{-- <div>{{ $record }}</div>
        <div class="text-xs italic">-{{ $record->user }}</div> --}}
        <div class="flex gap-2">
            <img class="h-12 w-12 rounded-full object-cover" src="{{ $record->user->profile_photo_url }}"
                alt="{{ $record->user->name }}" />
            <div>
                <p>{{ $record->user->name }}</p>
                <p class="text-xs">{{ date('d-M-Y', strtotime($record->published_at)) }}</p>
                <a href="{{ route('post.get', ['slug' => $record->slug]) }}">
                    <h1 class="py-4 text-3xl font-bold tracking-wide">{{ $record->title }}</h1>
                </a>
                <a href="" class="hover:text-indigo-500"> # {{ $record->category->name }}</a>
            </div>
        </div>
    </div>
    <hr>
@endforeach
