<form class="flex col gap--2" method="POST" action="{{ route($location->exists ? 'location.update' : 'location.store', $location) }}">
    @csrf
    @method($location->exists ? 'put' : 'post')

    <h5>Informations</h5>
    <div>
        <div class="flex col gap--2">
            <!-- Name -->
            <div class="w--100">
                <x-input-label for="name" :value="__('Nom')"/>
                <x-text-input id="name" type="text" name="name" :value="old('name', $location->name)" autofocus
                              autocomplete="name"/>
                <x-input-error :messages="$errors->get('name')"/>
            </div>
            <!-- Address -->
            <div class="w--100">
                <x-input-label for="address" :value="__('Adresse')"/>
                <x-text-input id="address" type="text" name="address" :value="old('address', $location->address)" autofocus
                              autocomplete="address"/>
                <x-input-error :messages="$errors->get('address')"/>
            </div>
        </div>
    </div>
    <div class="flex col gap--4 mt--4">
        <x-primary-button>
            {{ __('Enregistrer') }}
        </x-primary-button>
    </div>
</form>
