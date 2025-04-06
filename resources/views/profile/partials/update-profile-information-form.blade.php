<section class="bg-white p-6 rounded-lg shadow-sm">
    <header>
        <h2 class="text-xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-user-edit text-blue-500 mr-2"></i>
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="font-medium text-gray-700" />
            <div class="relative mt-2">
                <x-text-input 
                    id="name" 
                    name="name" 
                    type="text" 
                    class="block w-full pl-10" 
                    :value="old('name', $user->name)" 
                    required 
                    autofocus 
                    autocomplete="name" 
                    placeholder="{{ __('Your full name') }}"
                />
                <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="font-medium text-gray-700" />
            <div class="relative mt-2">
                <x-text-input 
                    id="email" 
                    name="email" 
                    type="email" 
                    class="block w-full pl-10" 
                    :value="old('email', $user->email)" 
                    required 
                    autocomplete="username" 
                    placeholder="{{ __('Your email address') }}"
                />
                <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-yellow-500 mt-0.5"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                {{ __('Your email address is unverified.') }}
                                <button form="send-verification" class="underline text-sm font-medium text-yellow-700 hover:text-yellow-600 ml-1">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>
                        </div>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <div class="mt-3 flex items-center text-sm text-green-600">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ __('A new verification link has been sent to your email address.') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <x-primary-button class="flex items-center">
                <i class="fas fa-save mr-2"></i> {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                     class="flex items-center text-sm text-green-600">
                    <i class="fas fa-check-circle mr-2"></i> {{ __('Saved.') }}
                </div>
            @endif
        </div>
    </form>
</section>