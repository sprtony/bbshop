@php
    $data = $this->form->getRawState();
@endphp

<div class="flex flex-col gap-1 mb-8">
    <p class="text-[#161B9D] dark:text-white" v-text="metaTitle">{{ $data['meta_title'] }}</p>

    <!-- SEO Meta Title -->
    <p class="text-[#135F29]">
        {{ URL::to('/') }}/{{ $data['slug'] ? $data['slug'] . '/' : '' }}
    </p>

    <!-- SEP Meta Description -->
    <p class="text-gray-600 dark:text-gray-300">{{ $data['meta_description'] }}</p>

</div>
