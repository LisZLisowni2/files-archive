@props(['class' => ''])

<button @class(["bg-violet-500 text-white p-4 m-2 rounded-2xl hover:bg-violet-800 transition-all", $class])>{{ $slot }}</button>