<!-- resources/views/post/search-results.blade.php -->

@extends('layouts.app')

@section('content')
    <!-- <h1>Search Results for '{{ $keyword }}'</h1> -->

    @if($post->isEmpty())
    <main class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
  <div class="text-center">
    <p class="text-base font-semibold text-indigo-600">404</p>
    <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Page not found</h1>
    <p class="mt-6 text-base leading-7 text-gray-600">Sorry, we couldn’t find the page you’re looking for.</p>
    <div class="mt-10 flex items-center justify-center gap-x-6">
      <a href="#" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Go back home</a>
      <a href="#" class="text-sm font-semibold text-gray-900">Contact support <span aria-hidden="true">&rarr;</span></a>
    </div>
  </div>
</main>
    @else
    <div class="columns-1 gap-2 space-y-4 p-4 sm:columns-2 md:columns-3 lg:columns-4">
    @foreach($post as $post)
    <div class="relative mb-1 before:content-[''] before:rounded-md before:absolute before:inset-0 before:bg-black before:bg-opacity-20">
    <img class="w-full rounded-4" src="{{ asset('images/post/' . $post->path) }}">
        <div class="test__body absolute inset-0 p-3 text-white flex flex-col">
            <div class="relative">
                <a class="test__link absolute inset-0" href="{{route('pin.show', ['id' => $post->id])}}"></a>
                <h1 class="test__title text-md font-bold mb-2">{{ $post->judulfoto }}</h1>
            </div>
            
        </div>

    </div>
    @endforeach
</div>
        
    @endif
@endsection
