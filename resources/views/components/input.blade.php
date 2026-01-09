@props([
    'type',
    'name',
    'value' => "",
    'required' => false,
    'autofocus' => false,
    'disabled' => false,
    'readonly' => false,
    'placeholder' => "",
    'label'
])

<div class="flex flex-col m-2">
    <label for="{{ $name }}" class="text-xl">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}" 
    {{ $attributes->merge([ 
        'required' => $required ? 'required' : null, 
        'autofocus' => $autofocus ? 'autofocus' : null, 
        'disabled' => $disabled ? 'disabled' : null, 
        'readonly' => $readonly ? 'readonly' : null
        ])->class(["border border-gray-300 p-2 w-full rounded"])
        }}>
</div>