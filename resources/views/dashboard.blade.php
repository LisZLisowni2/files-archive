@auth
    <x-dashboard>
        <section class="flex flex-col bg-white p-8 rounded-2xl shadow-md">
            <div class="flex flex-col justify-center items-center">
                @foreach ($public as $file)
                    <img src="{{ asset("storage/$file") }}" width="300"/>
                    <div class="flex items-center justify-center">
                        <p class="wrap-break-word w-1/2">{{ $file }}</p>
                        <form action="{{ route('dashboard.file.download.public') }}" method="POST">
                            @csrf
                            <input type="hidden" name="path" value="{{ $file }}">
                            <x-button>Download</x-button>
                        </form>
                    </div>
                @endforeach
                <hr class="border w-full my-4"/>
                @foreach ($private as $name)
                    @if(strlen($name) > 0)
                        <div class="flex items-center justify-center">
                            <p class="wrap-break-word w-1/2">{{ $name }}</p>
                            <form action="{{ route('dashboard.file.download.private') }}" method="POST">
                                @csrf
                                <input type="hidden" name="path" value="{{ $name }}">
                                <x-button>Download</x-button>
                            </form>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    </x-dashboard>
@endauth