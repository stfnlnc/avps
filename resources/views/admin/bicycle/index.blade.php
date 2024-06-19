<x-app-layout>
    @section('title', 'Les vélos')
    <x-slot name="header">
        @yield('title')
        <a hx-boost="true" href="{{ route('bicycle.create') }}" class="btn btn--small btn--primary-dark mt--1">+ Ajouter un vélo</a>
    </x-slot>

    <section class="container flex col gap--12-mobile">
        <div class="flex row col-mobile gap--4 align--center align-mobile--start justify--space-between mb--2">
            <div class="flex row col-mobile align--center align-mobile--start gap--2">
{{--                <form hx-trigger="change" hx-boost="true" class="flex row align--center gap--2" method="get" action="{{ route('users.index') }}">
                    <x-select-input name="role">
                        @foreach($roles as $role)
                            <option @if(app('request')->input('role') === strval($role->id)) selected @endif value="{{ $role->id }}">{{ $role->title }}</option>
                        @endforeach
                    </x-select-input>
                </form>--}}
                <form hx-boost="true" class="flex row align--center gap--2" method="get" action="{{ route('bicycle.index') }}">
                    <input type="text" class="form-input" name="search" placeholder="Rechercher...">
                    <button class="btn--unset" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon--primary-dark" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0-14 0m18 11l-6-6"/></svg>
                    </button>
                </form>
                <a hx-boost="true" href="{{ route('bicycle.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon--primary-dark" viewBox="0 0 15 15"><path fill="currentColor" fill-rule="evenodd" d="M4.854 2.146a.5.5 0 0 1 0 .708L3.707 4H9a4.5 4.5 0 1 1 0 9H5a.5.5 0 0 1 0-1h4a3.5 3.5 0 1 0 0-7H3.707l1.147 1.146a.5.5 0 1 1-.708.708l-2-2a.5.5 0 0 1 0-.708l2-2a.5.5 0 0 1 .708 0" clip-rule="evenodd"/></svg>
                </a>
            </div>
            <p class="tag tag--info">{{ $bicycles->count() }} vélo{{ $bicycles->count() <= 1 ? '' : 's' }} sur {{ $bicycles->total() }}</p>
        </div>
        <div class="grid grid--7 hide-mobile w--100 p--2 text--s border--rounded border--bottom border--stroke-light bg--stroke-light">
            <p>Nom / Modèle</p>
            <p>Localisation</p>
            <p>Date de début</p>
            <p>Date de fin</p>
            <p>Date de livraison</p>
            <p>Statut</p>
            <p class="flex row justify--end">Actions</p>
        </div>
        <div id="search-results">
            <!-- Show all users order by role -->
            @foreach($bicycles as $key => $bicycle)
                <div class="grid grid--7 grid--1-mobile grid-gap--2 w--100 p--2 border--rounded {{ ($key % 2 != 0) ? 'bg--secondary-light' : '' }}">
                    <p class="flex row align--center text--s">{{ $bicycle->name }}</p>
                    <p class="flex row align--center gap--1 text--s hide-mobile">

                    </p>
                    <p class="flex row align--center gap--1 text--s hide-mobile">
                        {{ !empty($bicycle->start_date) ? date_format(new DateTimeImmutable($bicycle->start_date), 'd/m/Y') : 'N/A' }}
                    </p>
                    <p class="flex row align--center gap--1 text--s hide-mobile">
                        {{ !empty($bicycle->end_date) ? date_format(new DateTimeImmutable($bicycle->end_date), 'd/m/Y') : 'N/A' }}
                    </p>
                    <p class="flex row align--center gap--1 text--s hide-mobile">
                        {{ !empty($bicycle->delivery_date) ? date_format(new DateTimeImmutable($bicycle->delivery_date), 'd/m/Y') : 'N/A' }}
                    </p>
                    <p class="flex row align--center gap--1 text--s hide-mobile">
                        <x-check :check="$bicycle->delivery_status"></x-check>
                    </p>
                    <div class="flex row align--center gap--2 justify--end">
                        <x-edit href="{{ route('bicycle.edit', [$bicycle]) }}"></x-edit>
                        @if(Auth::user()->role->name === 'admin')
                            <x-delete action="{{ route('bicycle.destroy', [$bicycle]) }}"></x-delete>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <x-paginate :data="$bicycles"></x-paginate>


    </section>
</x-app-layout>
