@isset($name)
    <x-jet-label for="{{ $name }}" value="{{ __(ucfirst(mb_strtolower($name))) }}"></x-jet-label>
    <x-jet-input
        id="{{ mb_strtolower($name) }}"
        type="text"
        class="mt-1 block w-full"
        wire:model.defer="state.{{ mb_strtolower($name) }}"
        placeholder="{{ __($placeholder) ?? '' }}"
    ></x-jet-input>
    <x-jet-input-error for="{{ mb_strtolower($name) }}" class="mt-2"></x-jet-input-error>
@endisset
