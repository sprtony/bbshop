<x-layout.drawer position="left" width="80%">

    <x-slot:toggle>
        <x-fas-bars class="pl-3 h-7" />
    </x-slot:toggle>


    <x-slot:header>
        <div class="flex justify-between items-center">
            <a href="{{ route('home') }}">
                <img src="{{ Storage::url(setting('seo.logo')) }}" alt="{{ setting('seo.title') }}"
                    class="max-h-10 xl:max-h-max">
            </a>
        </div>
    </x-slot:header>

    <div class="grid grid-cols-[auto_1fr] gap-4 items-center mb-4 p-2.5 border border-[#E9E9E9] rounded-xl">
        <div class="">
            <img src="" class="rounded-full w-[60px] h-[60px]">
        </div>

        @guest('customer')
            <a href="" class="flex text-base font-medium">
                Sign up or Login
                <i class="ml-2.5 text-2xl icon-double-arrow"></i>
            </a>
        @endguest

        @auth('customer')
            <div class="flex flex-col gap-2.5 justify-between">
                <p class="text-2xl font-mediums">Hello! {{ auth()->user()?->first_name }}</p>

                <p class="text-[#6E6E6E] ">{{ auth()->user()?->email }}</p>
            </div>
        @endauth
    </div>

    <div
        class="[&>*]:pb-5 [&>*]:mt-5
        [&>*]:border [&>*]:border-b [&>*]:border-l-0
        [&>*]:border-r-0 [&>*]:border-t-0 [&>*]:border-[#f3f3f5]">

        @include('layout.header.sections.menu-links')

    </div>

    <x-slot:footer>

    </x-slot:footer>


</x-layout.drawer>
