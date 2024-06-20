<x-app-layout>
    @section('title', 'Modifier un type de réparation')
    <x-slot name="header">
        @yield('title')
    </x-slot>

    <section class="container flex col w--100">
        <card>
            @include('admin.repair.template-part._form')
        </card>
    </section>

</x-app-layout>
