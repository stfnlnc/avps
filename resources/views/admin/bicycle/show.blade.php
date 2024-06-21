<x-app-layout>
    @section('title', $bicycle->name)

    <section class="container flex col gap--12-mobile">
        <card>
            <h3>@yield('title')</h3>
            <div class="flex row align--start gap--1 mt--4">
                <x-edit href="{{ route('bicycle.edit', [$bicycle]) }}"></x-edit>
                <a href="{{ route('bicycle.edit', [$bicycle]) }}">Éditer</a>
            </div>
            <div class="flex col mt--4 gap--8">
                <div class="flex row col-mobile gap--4 justify--space-between align-mobile--center">
                    @if($bicycle->picture)
                        <a target="_blank" href="{{ asset('storage/' . $bicycle->picture) }}">
                            <img class="thumbnail" src="{{ asset('storage/' . $bicycle->picture) }}" alt="">
                        </a>
                    @else
                        <div class="thumbnail bg--stroke-light"></div>
                    @endif
                    @if($bicycle->qr_code)
                        <a target="_blank" href="{{ asset('storage/' . $bicycle->qr_code) }}">
                            <img class="thumbnail" src="{{ asset('storage/' . $bicycle->qr_code) }}" alt="">
                        </a>
                    @else
                        <div class="thumbnail bg--stroke-light"></div>
                    @endif
                </div>
                <div class="flex row col-mobile gap--16 align--start">
                    <div class="flex col gap--4">
                        <div class="flex col gap--2 align--start">
                        <h5>Références</h5>
                        <p class="form-label">
                            Numéro de série
                        </p>
                        @if($bicycle->serial_number)
                            <tag class="tag tag--info">{{ $bicycle->serial_number }}</tag>
                        @else
                            <tag class="tag tag--info">N/A</tag>
                        @endif
                        <p class="form-label">
                            Référence
                        </p>
                        @if($bicycle->ref_number)
                            <tag class="tag tag--info">{{ $bicycle->ref_number }}</tag>
                        @else
                            <tag class="tag tag--info">N/A</tag>
                        @endif
                        </div>
                    </div>
                    <div class="flex col gap--2">
                        <h5>Dates des réparations</h5>
                        <div class="flex row gap--4">
                            <div class="flex col gap--2 align--start">
                                <p class="form-label">
                                    Date de début
                                </p>
                                <tag class="tag tag--info">{{ !empty($bicycle->start_date) ? date_format(new DateTimeImmutable($bicycle->start_date), 'd/m/Y') : 'N/A' }}</tag>
                            </div>
                            <div class="flex col gap--2 align--start">
                                <p class="form-label">
                                    Date de fin estimée
                                </p>
                                <tag class="tag tag--info">{{ !empty($bicycle->end_date) ? date_format(new DateTimeImmutable($bicycle->end_date), 'd/m/Y') : 'N/A' }}</tag>
                            </div>
                        </div>
                        <p class="form-label">
                            Types de réparation
                        </p>
                        <div class="flex row col-mobile gap--2">
                            @forelse($bicycle->repairs as $repair)
                                <tag class="tag tag--info">{{ $repair->type }}</tag>
                            @empty
                                <tag class="tag tag--info">N/A</tag>
                            @endforelse
                        </div>
                    </div>
                    <div class="flex col gap--2">
                        <div class="flex row gap--2 align--center">
                            <h5>Livraison</h5>
                            <x-check :check="$bicycle->delivery_status"></x-check>
                        </div>
                        <div class="flex row col-mobile gap--4">
                            <div class="flex col gap--2 align--start">
                                <p class="form-label">
                                    Date de livraison
                                </p>
                                <tag class="tag tag--info">{{ !empty($bicycle->delivery_date) ? date_format(new DateTimeImmutable($bicycle->delivery_date), 'd/m/Y') : 'N/A' }}</tag>
                            </div>
                            <div class="flex col gap--2 align--start">
                                <p class="form-label">
                                    Bénéficiaire
                                </p>
                                <tag class="tag tag--info">
                                    @if($bicycle->recipient)
                                        <tag class="tag tag--info">{{ $bicycle->recipient }}</tag>
                                    @else
                                        <tag class="tag tag--info">N/A</tag>
                                    @endif
                                </tag>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </card>
    </section>

</x-app-layout>
