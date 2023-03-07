<div x-transition>
    @foreach([
    'smtp_host', 'smtp_port', 'smtp_encryption', 'smtp_username', 'smtp_password', 'email_form', 'email_form_name'
    ] as $emailKey)
        <div class="row align-items-center mb-3">
            <div class="col-lg-2">
                <label for="site_title" class="form-label">{{ __("admin.settings.email.{$emailKey}") }}</label>
            </div>
            <div class="col-lg-10">
                <div class="input-group">
                    <x-form.input name="{{$emailKey}}"></x-form.input>
                </div>
            </div>
        </div>
    @endforeach
</div>

