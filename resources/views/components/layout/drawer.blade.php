@props([
    'position' => 'left',
    'width' => '500px',
])

<div x-data="{ open: false }">

    @isset($toggle)
        <div @click="open = true">
            {{ $toggle }}
        </div>
    @endisset


    {{-- Overlay --}}
    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-100"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity z-[1]">
    </div>

    {{-- Content --}}
    <div x-show="open" {{-- @click.away="open = false" --}}
        x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
        x-transition:enter-start="{{ $position == 'left' ? '-translate-x-full' : 'translate-x-full' }}"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="{{ $position == 'left' ? '-translate-x-full' : 'translate-x-full' }}"
        class="fixed inset-y-0 z-[1000] bg-white overflow-hidden max-sm:!w-full
            {{ $position == 'left' ? 'left-0' : 'right-0' }}"
        style="width:{{ $width }};">


        <div class="overflow-auto w-full h-full bg-white pointer-events-auto">
            <div class="flex flex-col w-full h-full">
                <div class="overflow-auto flex-1 min-w-0 min-h-0">
                    <div class="flex flex-col h-full">

                        @isset($header)
                            <div {{ $header->attributes->merge(['class' => 'grid gap-y-2.5 p-6 pb-5 max-sm:px-4']) }}>
                                {{ $header }}

                                <div class="absolute top-5 cursor-pointer {{ $position == 'left' ? 'right-5' : 'left-5' }}"
                                    @click="open=false">
                                    <x-heroicon-o-x-mark class="w-5 h-5" />
                                </div>
                            </div>
                        @endisset

                        @isset($slot)
                            <div class="overflow-auto flex-1 px-6 max-sm:px-4">
                                {{ $slot }}
                            </div>
                        @endisset

                        @isset($footer)
                            <div class="pb-8">
                                {{ $footer }}
                            </div>
                        @endisset

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
