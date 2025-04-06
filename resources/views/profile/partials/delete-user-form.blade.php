<section class="space-y-6">
    <header class="bg-white p-6 rounded-lg shadow-sm border border-red-100">
        <h2 class="text-xl font-bold text-red-700 flex items-center">
            <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-3 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>

        <div class="mt-6">
            <x-danger-button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="flex items-center justify-center w-full md:w-auto"
            >
                <i class="fas fa-trash-alt mr-2"></i> {{ __('Delete Account') }}
            </x-danger-button>
        </div>
    </header>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="flex items-start">
                <div class="bg-red-100 p-3 rounded-full mr-4">
                    <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        {{ __('Are you sure you want to delete your account?') }}
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        {{ __('This action cannot be undone. All your data will be permanently erased.') }}
                    </p>
                </div>
            </div>

            <div class="mt-6">
                <x-input-label for="password" :value="__('Password')" class="block mb-2 font-medium text-gray-700" />
                <div class="relative">
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="block w-full pl-10"
                        placeholder="{{ __('Enter your password') }}"
                    />
                    <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                    <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex justify-end space-x-4">
                <x-secondary-button x-on:click="$dispatch('close')" class="flex items-center">
                    <i class="fas fa-times mr-2"></i> {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="flex items-center">
                    <i class="fas fa-trash-alt mr-2"></i> {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
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