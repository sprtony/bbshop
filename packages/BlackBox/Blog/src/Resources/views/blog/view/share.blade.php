<div
    class="flex justify-center items-center md:flex-col gap-2 md:sticky top-[150px]
        [&>a]:border-2 [&>a]:border-solid [&>a]:border-[#acacac] [&>a]:text-[#acacac]
        [&>a]:h-10 [&>a]:aspect-square [&>a]:flex [&>a]:justify-center [&>a]:items-center">

    <a href="http://twitter.com/share?text={{ $post->title }}&amp;url={{ url()->current() }}&amp;hashtags={{ implode(',', $post->tags) }}"
        target="_blank" class="hover:text-primario hover:border-primario hvr-pulse-grow">
        <x-fab-twitter class="h-6" />
    </a>

    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
        target="_blank"class="hover:text-primario hover:border-primario hvr-pulse-grow">
        <x-fab-facebook-f class="h-6" />
    </a>

    <a href="https://wa.me/?text={{ url()->current() }}" target="_blank"
        class="hover:text-primario hover:border-primario hvr-pulse-grow">
        <x-fab-whatsapp class="h-6" />
    </a>
    <a href="fb-messenger://share/?link={{ url()->current() }}" target="_blank"
        class="hover:text-primario hover:border-primario hvr-pulse-grow">
        <x-fab-facebook-messenger class="h-6" />
    </a>
</div>
<div class="h-4"></div>
