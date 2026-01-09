<x-start-form header="Login Form">
    <form action="/login" method="POST" class="flex flex-col">
        @csrf
        
        <x-input type="email" name="email" required="true" autofocus="true" label="Email"/>
        <x-input type="password" name="password" required="true" label="Password"/>      
        
        <div class="flex items-center m-4">
            <input type="checkbox" name="remember" id="remember" class="mr-2">
            <label for="remember" class="text-sm text-gray-600">Remember Me</label>
        </div>

        <x-button>Login</x-button>
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
    Do you have no account? Register <x-hyperlink href="{{ route('page.register') }}">here</x-hyperlink>
</x-start-form>