<form class="flex col gap--2" method="POST" action="{{ route($repair->exists ? 'repair.update' : 'repair.store', $repair) }}">
    @csrf
    @method($repair->exists ? 'put' : 'post')

    <h5>Informations</h5>
    <div>
        <div class="flex col gap--2">
            <!-- Type -->
            <div class="w--100">
                <x-input-label for="type" :value="__('Type de réparation')"/>
                <x-text-input id="type" type="text" name="type" :value="old('type', $repair->type)" autofocus
                              autocomplete="type"/>
                <x-input-error :messages="$errors->get('type')"/>
            </div>
        </div>
    </div>
    <div class="flex col gap--4 mt--4">
        <x-primary-button>
            {{ __('Enregistrer') }}
        </x-primary-button>
    </div>
</form>
