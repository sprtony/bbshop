@php
    $data = (object) $this->form->getRawState();
    $data->url = $data->slug ? route('productOrCategory.index', ['fallbackPlaceholder' => $data->slug]) : '';
    $data->thumnail = '';
@endphp

<div class="">
    <x-catalog::cards.product :product="$data" />
</div>
