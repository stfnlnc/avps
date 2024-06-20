<x-app-layout>
    @section('title', 'Ajouter un lieu')
    <x-slot name="header">
        @yield('title')
    </x-slot>

    <section class="container flex col w--100">
        <card>
            @include('admin.location.template-part._form')
        </card>
    </section>

</x-app-layout>
