<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('search') }}" method="post">
                {{csrf_field()}}
                <input id="search" class="form-control mr-sm-2" type="search" name="search" placeholder="Search..." />
                <button type="submit" class="btn btn-primary search">Search</button>
            </form>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(!$products->isEmpty())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg card-columns">
                    @include('layouts.products')
            </div>
            @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg card-columns">
                <p>There is no such product.</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>