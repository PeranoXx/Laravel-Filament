<x-app-layout>
    <div class="grid grid-cols-4 gap-4">
        <div class="col-span-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <img src="{{ url('storage/' . $post->image) }}" alt="Image" />
                <div class="p-4">
                    <div class="flex gap-2">
                        <img class="h-12 w-12 rounded-full object-cover" src="{{ $post->user->profile_photo_url }}"
                            alt="{{ $post->user->name }}" />
                        <div>
                            <p>{{ $post->user->name }}</p>
                            <p class="text-xs">{{ date('d-M-Y', strtotime($post->published_at)) }}</p>
                            <div>
                                {!! $post->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
