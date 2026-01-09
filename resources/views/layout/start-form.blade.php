@props(['header' => 'Login Form'])

<x-main center>
    <div class="p-8 bg-white shadow-md rounded-2xl">
        <h1 class="text-2xl font-bold">{{ $header }}</h1>
        {{ $slot }}
    </div>
</x-main>