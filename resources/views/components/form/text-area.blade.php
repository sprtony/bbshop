<div class="flex flex-col">
    @if ($attributes->has('label'))
        <label
            class="text-[#226f4c] font-poppins font-medium">{{ $attributes->get('label') }}{{ $attributes->has('required') ? '*' : '' }}</label>
        <div class="h-1"></div>
    @endif
    <textarea
        {{ $attributes->except(['label', 'required', 'error'])->merge([
            'class' => 'focus:ring-transparent border-[##e0e0e0]',
        ]) }}>
    </textarea>

    @if ($attributes->has('error'))
        @error($attributes->get('error'))
            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    @endif

    <div class="h-3"></div>
</div>
