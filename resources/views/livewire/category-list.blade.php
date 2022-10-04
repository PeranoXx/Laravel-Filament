<div>
    
</div><h1 class="px-2 font-bold">Categories</h1>
<ul class="py-2">
    @foreach ($categories as $item)
    <a href="" ><li class="py-2 hover:bg-indigo-100 hover:text-indigo-600 rounded-md px-2">{{$item->name}}</li></a>
    @endforeach
</ul>
