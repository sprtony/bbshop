<div x-data="swal" x-on:swal.window="show" @keydown.escape.window="open = false">
    {{-- layout del modal --}}
    <div x-show="open" class="flex fixed top-0 left-0 justify-center items-center w-screen h-screen z-[99]" x-cloak>

        {{-- fondo gris --}}
        <div class="absolute inset-0 w-full h-full bg-black bg-opacity-40" @click="open=false"></div>


        <div class="relative py-14 px-16 bg-gray-50 rounded-lg">
            <div class="flex justify-center">

                {{-- icono --}}
                <div class="p-6 rounded-full"
                    :class="type == 'success' ? 'bg-green-200' :
                        type == 'info' ? 'bg-blue-200' :
                        type == 'warning' ? 'bg-yellow-200' :
                        'bg-red-200'">

                    <div class="flex justify-center items-center p-4 w-16 h-16 rounded-full"
                        :class="type == 'success' ? 'bg-green-500' :
                            type == 'info' ? 'bg-blue-500' :
                            type == 'warning' ? 'bg-yellow-500' :
                            'bg-red-500'">

                        <x-heroicon-o-check-circle class="w-8 h-8 text-white" x-show="type == 'success'" />
                        <x-heroicon-o-information-circle class="w-8 h-8 text-white" x-show="type == 'info'" />
                        <x-heroicon-o-exclamation-triangle class="w-8 h-8 text-white" x-show="type == 'warning'" />
                        <x-heroicon-o-x-circle class="w-8 h-8 text-white" x-show="type == 'danger'" />

                    </div>
                </div>

            </div>

            {{-- boton de cerrar --}}
            <button @click="open=false"
                class="flex absolute top-0 right-0 justify-center items-center mt-5 mr-5 w-8 h-8 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>

            <h3 class="my-4 text-3xl font-semibold text-center text-gray-700" x-text="title"></h3>

            <p class="font-normal text-center text-gray-600 w-[230px]" x-text="message"></p>
        </div>

    </div>

</div>

@push('scripts')
    <script>
        window.addEventListener("alpine:init", (event) => {
            Alpine.data('swal', () => ({
                open: false,
                title: '',
                message: '',
                type: '',

                show() {
                    this.title = this.$event.detail.title;
                    this.message = this.$event.detail.message;
                    this.type = this.$event.detail.type;
                    {{-- type: success, error, warning, info --}}
                    this.open = true;
                }
            }))
        });

        //permite despachar eventos desde una variable de session
        window.addEventListener("load", (event) => {
            @if ($swal = session('swal'))
                window.dispatchEvent(new CustomEvent('swal', {
                    detail: {
                        title: "{{ $swal['title'] ?? '' }}",
                        message: "{{ $swal['message'] ?? '' }}",
                        type: "{{ $swal['type'] ?? '' }}"
                    }
                }));
            @endif
        });
    </script>
@endpush
