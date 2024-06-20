@php
    $route = request()->route()->getName()
@endphp

@section('menu')
    <div class="flex row col-mobile align--center gap--8">
        <!-- Navigation Links -->
        <div class="flex row align--center col-mobile align-mobile--start gap--4" hx-boost="true" hx-trigger="delay:1000ms">
            <x-nav-link :href="route('dashboard')" :active="str_contains($route, 'dashboard')">
                {{ __('Tableau de bord') }}
            </x-nav-link>
            @if(Auth::user()->role->name === 'admin')
            <div class="nav--dropdown">
                <x-nav-link :href="route('users.index')" :active="str_contains($route, 'users.')">
                    {{ __('Utilisateurs') }}
                </x-nav-link>
                <div class="nav--dropdown-item">
                    <x-nav-link :href="route('users.index')">
                        {{ __('Gestion des utilisateurs') }}
                    </x-nav-link>
                    <x-nav-link :href="route('users.create')">
                        {{ __('Ajouter un utilisateur') }}
                    </x-nav-link>
                </div>
            </div>
            @endif
            <div class="nav--dropdown">
                <x-nav-link :href="route('bicycle.index')" :active="str_contains($route, 'bicycle.')">
                    {{ __('Vélos') }}
                </x-nav-link>
                <div class="nav--dropdown-item">
                    <x-nav-link :href="route('bicycle.index')">
                        {{ __('Gestion des vélo') }}
                    </x-nav-link>
                    <x-nav-link :href="route('bicycle.create')">
                        {{ __('Ajouter un vélo') }}
                    </x-nav-link>
                </div>
            </div>
            <div class="nav--dropdown">
                <x-nav-link :href="route('location.index')" :active="str_contains($route, 'location.')">
                    {{ __('Lieux') }}
                </x-nav-link>
                <div class="nav--dropdown-item">
                    <x-nav-link :href="route('location.index')">
                        {{ __('Gestion des lieux') }}
                    </x-nav-link>
                    <x-nav-link :href="route('location.create')">
                        {{ __('Ajouter un lieu') }}
                    </x-nav-link>
                </div>
            </div>
            <div class="nav--dropdown">
                <x-nav-link :href="route('repair.index')" :active="str_contains($route, 'repair.')">
                    {{ __('Types de réparations') }}
                </x-nav-link>
                <div class="nav--dropdown-item">
                    <x-nav-link :href="route('repair.index')">
                        {{ __('Gestion des types de réparations') }}
                    </x-nav-link>
                    <x-nav-link :href="route('repair.create')">
                        {{ __('Ajouter un type de réparation') }}
                    </x-nav-link>
                </div>
            </div>
        </div>
    </div>

@endsection

<nav x-data="{ open: false }" class="flex row justify--center border--bottom border--stroke-light">
    <!-- Primary Navigation Menu -->
    <div class="container pt--4 pb--4">
        <div class="flex row align--center justify--space-between w--100">
            <div class="flex row gap--8 hide-mobile w--100">
                <x-application-logo></x-application-logo>
                @yield('menu')
            </div>
            <div class="display-mobile">
                <span class="mobile-menu">
                    <span class="line-1"></span>
                    <span class="line-2"></span>
                    <span class="line-3"></span>
                </span>
                <div class="mobile-dropdown p--5 flex col align--start gap--8 c--primary-light">
                    <span class="mobile-close align--self-end">
                        <span class="line-1"></span>
                        <span class="line-2"></span>
                        <span class="line-3"></span>
                    </span>
                    @yield('menu')
                </div>
            </div>
            <div class="flex row align--center gap--4" hx-boost="true">
                <x-profile href="{{ route('profile') }}"></x-profile>
                @if(Auth::user()->role->name === 'admin')
                <x-parameters href=""></x-parameters>
                @endif
                <x-logout></x-logout>
            </div>
        </div>
    </div>
</nav>
