<x-dashboard>
    <div class="bg-white m-8 p-4 rounded-2xl shadowm-md">
        <form method="POST" action="{{ route('dashboard.admin.upload.action') }}" enctype="multipart/form-data">
            @csrf
            <x-input type="file" name="file" label="File"/>
            <div class="flex flex-col m-2">
                <label for="scope" class="text-xl">Scope</label>
                <select name="scope">
                    <option value="private">Private</option>
                    <option value="public">Public</option>
                </select>
            </div>
            
            <x-button>Submit</x-button>
        </form>
    </div>
</x-dashboard>