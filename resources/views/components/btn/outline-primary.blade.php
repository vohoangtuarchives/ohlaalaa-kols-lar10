<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-primary waves-effect waves-light']) }}>
    {{ $slot }}
</button>