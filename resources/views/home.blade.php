@extends('layouts.app')

@section('content')
<div class="columns-1 gap-2 space-y-4 p-4 sm:columns-2 md:columns-3 lg:columns-4">
    @foreach ($posts as $value) 
    <div class="relative mb-1 before:content-[''] before:rounded-md before:absolute before:inset-0 before:bg-black before:bg-opacity-20">
    <img class="w-full rounded-4" src="images/post/{{$value->path}}">
        <div class="test__body absolute inset-0 p-3 text-white flex flex-col">
            <div class="relative">
                <a class="test__link absolute inset-0" href="{{route('pin.show', ['id' => $value->id])}}"></a>
                <h1 class="test__title text-md font-bold mb-2">{{$value->judulfoto}}</h1>
            </div>
            
        </div>

    </div>
    @endforeach
</div>
@endsection
