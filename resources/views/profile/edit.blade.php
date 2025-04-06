@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Carte principale -->
    <div class="bg-white rounded-xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
        <!-- En-tête avec avatar -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-center relative rounded-t-xl">
            <!-- Badge de rôle -->
            <div class="absolute top-4 right-4">
                <span class="bg-white/20 text-white text-xs px-3 py-1 rounded-full flex items-center">
                    <i class="fas fa-user-tag mr-1 text-xs"></i> {{ ucfirst($user->role) }}
                </span>
            </div>
            
            <!-- Avatar avec bouton de modification -->
            <div class="relative inline-block group">
                <div class="w-28 h-28 rounded-full bg-white flex items-center justify-center text-indigo-600 text-5xl font-bold shadow-lg ring-4 ring-white/80 transition-all duration-300 group-hover:scale-105 transform hover:rotate-12">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <button class="absolute bottom-0 right-0 bg-green-500 text-white rounded-full w-10 h-10 flex items-center justify-center hover:bg-green-600 transition-all shadow-md transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-camera text-sm"></i>
                </button>
            </div>
            
            <!-- Nom et email -->
            <h1 class="text-3xl font-extrabold text-white mt-6">{{ $user->name }}</h1>
            <p class="text-blue-100 mt-2 flex items-center justify-center">
                <i class="fas fa-envelope mr-2"></i> {{ $user->email }}
            </p>
        </div>

        <!-- Corps du formulaire -->
        <div class="p-8 bg-gradient-to-r from-gray-50 to-gray-100 rounded-b-xl">
            <!-- Notifications -->
            @if(session('status'))
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" 
                 class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                <div class="text-green-700 font-medium">{{ session('status') }}</div>
                <button @click="show = false" class="ml-auto text-green-500 hover:text-green-700 focus:outline-none">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            @endif

            <!-- Formulaire de mise à jour -->
            <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-user-edit text-blue-500 mr-2"></i> Informations du profil
                </h2>
                
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf @method('patch')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2 flex items-center">
                                <i class="fas fa-user text-gray-400 mr-2 text-sm"></i> Nom complet
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('name') border-red-500 @enderror"
                                   placeholder="Votre nom">
                            @error('name')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2 flex items-center">
                                <i class="fas fa-envelope text-gray-400 mr-2 text-sm"></i> Adresse email
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('email') border-red-500 @enderror"
                                   placeholder="Votre email">
                            @error('email')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-all duration-300 flex items-center shadow-md hover:shadow-lg transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i> Mettre à jour le profil
                        </button>
                    </div>
                </form>
            </div>

            <!-- Section mot de passe -->
            <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-lock text-indigo-500 mr-2"></i> Changer le mot de passe
                </h3>

                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf @method('put')

                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2 flex items-center">
                                <i class="fas fa-key text-gray-400 mr-2 text-sm"></i> Mot de passe actuel
                            </label>
                            <div class="relative">
                                <input type="password" name="current_password" id="current_password"
                                       class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="••••••••">
                                <i class="fas fa-key absolute left-3 top-3.5 text-gray-400"></i>
                                <button type="button" onclick="togglePassword('current_password', 'current_password_icon')" 
                                        class="absolute right-3 top-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <i class="fas fa-eye" id="current_password_icon"></i>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2 flex items-center">
                                <i class="fas fa-key text-gray-400 mr-2 text-sm"></i> Nouveau mot de passe
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="password"
                                       class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="••••••••">
                                <i class="fas fa-key absolute left-3 top-3.5 text-gray-400"></i>
                                <button type="button" onclick="togglePassword('password', 'password_icon')" 
                                        class="absolute right-3 top-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <i class="fas fa-eye" id="password_icon"></i>
                                </button>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Minimum 8 caractères</p>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2 flex items-center">
                                <i class="fas fa-key text-gray-400 mr-2 text-sm"></i> Confirmer le mot de passe
                            </label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="••••••••">
                                <i class="fas fa-key absolute left-3 top-3.5 text-gray-400"></i>
                                <button type="button" onclick="togglePassword('password_confirmation', 'password_confirmation_icon')" 
                                        class="absolute right-3 top-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <i class="fas fa-eye" id="password_confirmation_icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" 
                                class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-lg transition-all duration-300 flex items-center shadow-md hover:shadow-lg transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-400">
                            🔧 <span class="ml-2 text-base font-medium text-white">Changer le mot de passe</span>
                        </button>
                    </div>
            <!-- Zone dangereuse -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-red-100">
                <h3 class="text-xl font-bold text-red-700 mb-6 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i> Zone dangereuse
                </h3>

                <form method="POST" action="{{ route('profile.destroy') }}" id="deleteAccountForm">
                    @csrf @method('delete')

                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg mb-6">
                        <div class="flex">
                            <i class="fas fa-info-circle text-red-500 mr-3 text-lg mt-0.5"></i>
                            <div>
                                <p class="text-red-700 font-medium">Suppression du compte</p>
                                <p class="text-red-600 text-sm">Cette action est irréversible. Toutes vos données seront définitivement perdues.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2 flex items-center">
                            <i class="fas fa-lock text-gray-400 mr-2 text-sm"></i> Confirmez avec votre mot de passe
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="delete_password"
                                   class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('password') border-red-500 @enderror"
                                   placeholder="••••••••">
                            <i class="fas fa-key absolute left-3 top-3.5 text-gray-400"></i>
                            <button type="button" onclick="togglePassword('delete_password', 'delete_password_icon')" 
                                    class="absolute right-3 top-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="fas fa-eye" id="delete_password_icon"></i>
                            </button>
                        </div>
                        @error('password')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="button" onclick="confirmDelete()"
                                class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg transition-all duration-300 flex items-center shadow-md hover:shadow-lg transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i class="fas fa-trash-alt mr-2"></i> Supprimer mon compte
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script pour la confirmation de suppression -->
<script>
    function confirmDelete() {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Vous ne pourrez pas annuler cette action!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer!',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteAccountForm').submit();
            }
        });
    }

    function togglePassword(id, iconId) {
        const input = document.getElementById(id);
        const icon = document.getElementById(iconId);
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
@endsection