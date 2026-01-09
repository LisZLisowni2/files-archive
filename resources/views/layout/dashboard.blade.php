<x-main>
    <section class="flex flex-col w-screen h-full items-center">
        {{-- Header --}}
        <nav class="bg-white p-4 mb-2 w-full flex flex-row justify-between items-center">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <div class="flex">
                @can('access-admin')
                    <a href="{{ route('dashboard.admin.upload') }}"><x-button>Upload a new image</x-button></a>
                @endcan
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <x-button>Logout</x-button>
                </form>
            </div>
        </nav>
    
        {{-- Content --}}
        <main class="flex flex-col">
            {{ $slot }}
        </main>
    </section>
</x-main>