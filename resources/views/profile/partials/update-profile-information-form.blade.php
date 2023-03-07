<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('dashboard.verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('dashboard.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-3">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />


        </div>

        <div class="d-flex align-items-center justify-content-between mt-4">
            <div>
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-success">
                            {{ __('dashboard.email.verification-sent') }}
                        </p>
                        @else
                        <div class="text-sm mt-2 text-gray-800">
                            {{ __('dashboard.email.unverified') }}

                            <button form="send-verification" class="btn btn-outline-primary">
                                {{ __('dashboard.email.click-to-send') }}
                            </button>
                        </div>
                    @endif
            @endif
                </div>
                <x-primary-button>{{ __('Save') }}</x-primary-button>

{{--            @if (session('status') === 'profile-updated')--}}
{{--                <p--}}
{{--                    x-data="{ show: true }"--}}
{{--                    x-show="show"--}}
{{--                    x-transition--}}
{{--                    x-init="setTimeout(() => show = false, 2000)"--}}
{{--                    class="text-sm text-gray-600"--}}
{{--                >{{ __('Saved.') }}</p>--}}
{{--            @endif--}}
        </div>
    </form>
</section>
