<section class="bg-white p-6 rounded-lg shadow-sm">
    <header>
        <h2 class="text-xl font-bold text-sky-500 flex items-center">
            🔧
            <span class="ml-2">{{ __('Update Password') }}</span>
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="font-medium text-gray-700" />
            <div class="relative mt-2">
                <x-text-input 
                    id="update_password_current_password" 
                    name="current_password" 
                    type="password" 
                    class="block w-full pl-10" 
                    autocomplete="current-password" 
                    placeholder="{{ __('Enter current password') }}"
                />
                <i class="fas fa-key absolute left-3 top-3 text-gray-400"></i>
                <button type="button" onclick="togglePassword('update_password_current_password')" class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="font-medium text-gray-700" />
            <div class="relative mt-2">
                <x-text-input 
                    id="update_password_password" 
                    name="password" 
                    type="password" 
                    class="block w-full pl-10" 
                    autocomplete="new-password" 
                    placeholder="{{ __('Enter new password') }}"
                />
                <i class="fas fa-key absolute left-3 top-3 text-gray-400"></i>
                <button type="button" onclick="togglePassword('update_password_password')" class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <p class="mt-1 text-xs text-gray-500">{{ __('Minimum 8 characters') }}</p>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="font-medium text-gray-700" />
            <div class="relative mt-2">
                <x-text-input 
                    id="update_password_password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="block w-full pl-10" 
                    autocomplete="new-password" 
                    placeholder="{{ __('Confirm new password') }}"
                />
                <i class="fas fa-key absolute left-3 top-3 text-gray-400"></i>
                <button type="button" onclick="togglePassword('update_password_password_confirmation')" class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-lg transition-all duration-300 flex items-center shadow-md hover:shadow-lg transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-400">
                <span class="mr-2">🔧</span>
                <span class="text-white font-medium">{{ __('Save') }}</span>
            </button>

            @if (session('status') === 'password-updated')
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                     class="flex items-center text-sm text-green-600">
                    <i class="fas fa-check-circle mr-2"></i> {{ __('Saved.') }}
                </div>
            @endif
        </div>
    </form>
</section>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script>