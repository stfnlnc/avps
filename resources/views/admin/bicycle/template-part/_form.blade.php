<form class="flex col gap--2" method="POST" action="{{ route($bicycle->exists ? 'bicycle.update' : 'bicycle.store', $bicycle) }}">
    @csrf
    @method($bicycle->exists ? 'put' : 'post')

    <h5>Informations</h5>
    <div class="grid grid--2 grid--1-mobile grid-gap--4">
        <div class="flex col gap--2">
            <!-- Image -->
            <div>
                <x-input-label for="picture" :value="__('Image')"/>
                <x-file-input id="picture" type="text" name="picture" autofocus
                />
                <x-input-error :messages="$errors->get('picture')"/>
            </div>

            <!-- QR Code -->
            <div>
                <x-input-label for="qr_code" :value="__('QR Code')"/>
                <x-file-input id="qr_code" type="text" name="qr_code" autofocus
                />
                <x-input-error :messages="$errors->get('qr_code')"/>
            </div>
        </div>
        <div class="flex col gap--2">
            <!-- Model -->
            <div>
                <x-input-label for="name" :value="__('Nom / Modèle')"/>
                <x-text-input id="name" type="text" name="name" :value="old('name', $bicycle->name)" autofocus
                              autocomplete="name"/>
                <x-input-error :messages="$errors->get('name')"/>
            </div>

            <!-- Serial Number -->
            <div>
                <x-input-label for="serial_number" :value="__('Numéro de série')"/>
                <x-text-input id="serial_number" type="text" name="serial_number" :value="old('serial_number', $bicycle->serial_number)" autofocus
                              autocomplete="serial_number"/>
                <x-input-error :messages="$errors->get('serial_number')"/>
            </div>
        </div>
        <div class="flex col gap--2">
            <h5>Réparations</h5>
            <!-- Start Date -->
            <div>
                <x-input-label for="start_date" :value="__('Début')"/>
                <x-text-input id="start_date" type="date" name="start_date" :value="old('start_date', $bicycle->start_date)" autofocus
                              autocomplete="start_date"/>
                <x-input-error :messages="$errors->get('start_date')"/>
            </div>

            <!-- End Date -->
            <div>
                <x-input-label for="end_date" :value="__('Fin estimée')"/>
                <x-text-input id="end_date" type="date" name="end_date" :value="old('end_date', $bicycle->end_date)" autofocus
                              autocomplete="end_date"/>
                <x-input-error :messages="$errors->get('end_date')"/>
            </div>
        </div>
        <div class="flex col gap--2">
            <h5>Livraison</h5>
            <!-- Delivery Date -->
            <div>
                <x-input-label for="delivery_date" :value="__('Date de livraison')"/>
                <x-text-input id="delivery_date" type="date" name="delivery_date" :value="old('delivery_date', $bicycle->delivery_date)" autofocus
                              autocomplete="delivery_date"/>
                <x-input-error :messages="$errors->get('delivery_date')"/>
            </div>

            <!-- Delivery Location -->
            <div>
                <x-input-label for="delivery_location" :value="__('Adresse de livraison')"/>
                <x-text-input id="delivery_location" type="text" name="delivery_location" :value="old('delivery_location', $bicycle->delivery_location)" autofocus
                              autocomplete="delivery_location"/>
                <x-input-error :messages="$errors->get('delivery_location')"/>
            </div>

            <!-- Delivery Status -->
            <div class="form-toggle">
                <input type="hidden" value="0" name="delivery_status">
                <input @checked(old('delivery_status', $bicycle->delivery_status ?? false)) value="1" name="delivery_status" type="checkbox" role="switch" id="delivery_status">
                <label for="delivery_status" class="form-label">Livré</label>
            </div>
        </div>
    </div>

    <div class="flex col gap--4 mt--4">
        <p class="text--s">* La référence du vélo est générée automatiquement lors de la validation</p>
        <x-primary-button>
            {{ __('Enregistrer') }}
        </x-primary-button>
    </div>
</form>
