<x-layout.main>
    <x-slot:header>
        @include('admin.header')
    </x-slot:header>

    @include('layouts.sideBar')
 
    <main>
        <h1>content</h1>
    </main>
 
    <x-slot:footer>
        @include('layouts.footer')
    </x-slot:footer>
</x-layout.main>