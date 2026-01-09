<x-main center>
    <section class="bg-white p-8 rounded-2xl shadow-md max-w-1/4">
        <h1 class="text-2xl font-bold">Hello there!</h1>
        <p>Nunc felis eros, facilisis at nulla in, feugiat posuere felis. Praesent congue magna nec aliquet euismod. Integer aliquam elit sed pulvinar suscipit. Praesent molestie aliquam sollicitudin. Morbi facilisis vulputate maximus. Cras eleifend nulla ut iaculis elementum. Quisque tincidunt maximus arcu convallis condimentum. Mauris viverra consectetur turpis, vitae faucibus turpis luctus sed. Aliquam a sem ut odio tincidunt bibendum in at ante. </p>
        <div class="flex flex-row justify-center">
            <a href="{{ route('page.login') }}"><x-button>Login now!</x-button></a>
            <a href="{{ route('page.register') }}"><x-button>Register now!</x-button></a>
        </div>
    </section>
</x-main>