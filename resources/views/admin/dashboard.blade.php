<x-app-layout>
    @section('title', 'Tableau de bord')
    <x-slot name="header">
        @yield('title')
        <p class="tag tag--primary-dark mt--1">{{ Auth::user()->email }}</p>
    </x-slot>
    <section class="container">
            <div class="grid grid--5 hide-mobile w--100 p--2 text--s border--rounded border--bottom border--stroke-light bg--stroke-light">
                <p>Lieu</p>
                <p>En cours</p>
                <p>Réparés</p>
                <p>Livrés</p>
                <p>Total</p>
            </div>
            <div id="search-results">
                @foreach($locations as $key => $location)
                    <div class="grid grid--5 grid--1-mobile grid-gap--2 w--100 p--2 border--rounded  text--s {{ ($key % 2 != 0) ? 'bg--secondary-light' : '' }}">
                        <p >{{ $location->name }}</p>
                        <p>@foreach($progress as $key => $value){{ $location->id === $value->id ? $value->location_count : '' }}@endforeach</p>
                        <p>@foreach($repaired as $key => $value){{ $location->id === $value->id ? $value->location_count : '' }}@endforeach</p>
                        <p>@foreach($delivered as $key => $value){{ $location->id === $value->id ? $value->location_count : '' }}@endforeach</p>
                        <p>{{ $location->location_count }}</p>
                    </div>
                @endforeach
            </div>
    </section>
</x-app-layout>
