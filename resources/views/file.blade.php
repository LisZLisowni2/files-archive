<x-main center>
    <section class="text-center">
        <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 shadow-2xl">
            @csrf
            @method('POST')
            <div class="mb-4">
                <label for="file" class="block text-gray-700 font-medium mb-2">Choose a file to upload:</label>
                <input type="file" name="file" id="file" class="border border-gray-300 p-2 w-full">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Upload</button>
        </form>
        @if(session('path'))
            @php
                $path = session('path');
            @endphp
            <div>
                <img src="{{ Storage::url($path) }}" alt="My file" />
            </div>
        @endif
        
        <a href="{{ route('file.download.public') }}"><x-button>Click to get secret from logged!</x-button></a>
        <a href="{{ route('file.download') }}"><x-button>Click to get secret from admin!</x-button></a>
    </section>
</x-main>