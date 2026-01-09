<x-start-form header="Register Form">
    <form action="/register" method="POST" class="grid grid-cols-2 gap-4">
        @csrf
        
        <x-input type="text" name="name" required autofocus label="Username"/>
        <x-input type="email" name="email" required label="Email"/>
        <x-input type="password" name="password" required label="Password"/>        
        <x-input type="password" name="password_confirmation" required label="Password Confirm"/>        

        <x-button class="col-span-full">Register</x-button>
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 col-span-full">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
    Do you have an account? Login <x-hyperlink href="{{ route('page.login'); }}">here</x-hyperlink>
</x-start-form>