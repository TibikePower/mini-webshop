<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
            <h1>{{$message}}<br>
            See at e-mail: {{Auth::user()->email}}
            </h1>
        </div>
    </div>
</x-app-layout>