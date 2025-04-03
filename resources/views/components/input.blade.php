{{-- resources/views/components/form/input.blade.php --}}
<!-- @props([
    'id', 
    'type' => 'text', 
    'name', 
    'value' => '', 
    'placeholder' => '', 
    'required' => false, 
    'autocomplete' => '', 
    'autofocus' => false  //  Add this line
]) -->


<!-- <div> -->
    <!-- <label for="{{ $id }}" class="block text-base text-brandGrayLight mb-1">{{ ucfirst(str_replace('_', ' ', $name)) }}</label> -->
    <!-- <label for="{{ $id ?? $name }}" class="block text-base text-brandGrayLight mb-1">
        {{ $label ?? ucfirst($name) }}
    </label>

    <input id="{{ $id ?? $name }}"
        name="{{ $name }}"
        type="{{ $type ?? 'text' }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value ?? '') }}"
        {{ $attributes->merge(['class' => 
          'w-full px-4 py-2 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none']) }}
        {{ $required ? 'required' : '' }}
        {{ $autocomplete ? "autocomplete=$autocomplete" : '' }}
        {{ $autofocus ? 'autofocus' : '' }}
    >
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror

</div> -->

@props([
    'id'=> $name ?? null, 
    'type' => 'text', 
    'name', 
    'value' => '', 
    'placeholder' => '', 
    'required' => false, 
    'readonly' => false,
    'disabled' => false,
    'autocomplete' => '', 
    'autofocus' => false,
    'label' => null,
    'showEyeIcon' => false // Only use for password fields
])

@php
    $fieldId = $id ?? $name;
@endphp

<div class="mb-4">
    @if ($label !== false)
        <label for="{{ $id ?? $name }}" class="block text-base text-brandGrayLight mb-1">
            {{ $label ?? ucfirst(str_replace('_', ' ', $name)) }}
        </label>
    @endif

    <div class="relative">
        <input
            id="{{ $id ?? $name }}"
            type="{{ $type }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $readonly ? 'readonly' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $autocomplete ? "autocomplete=$autocomplete" : '' }}
            {{ $autofocus ? 'autofocus' : '' }}

            {!! $attributes->merge(['class' =>
                'w-full px-4 py-2 ' .
                ($readonly ? 'bg-gray-700 opacity-70 cursor-not-allowed' : 'bg-brandGrayDark') .
                ' border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none pr-10'
            ]) !!}
        />
           

        @if($showEyeIcon && $type === 'password')
            <!--  Eye Icon -->
            <button type="button" class="absolute inset-y-0 right-3 flex items-center" onclick="togglePasswordVisibility('{{ $id ?? $name }}')">
                <i class="fa fa-eye-slash text-brandGrayLight hover:text-white transition duration-200" id="{{ $id ?? $name }}-eye-icon"></i>
            </button>
        @endif
    </div>

    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!--  Eye Icon Script -->
@once
<script>
function togglePasswordVisibility(id) {
    const input = document.getElementById(id);
    const icon = document.getElementById(id + '-eye-icon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}
</script>
@endonce
