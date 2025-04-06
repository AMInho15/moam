@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
        <!-- En-tête avec avatar -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-center relative">
            <div class="absolute top-4 right-4">
                <span class="bg-white/20 text-white text-xs px-3 py-1 rounded-full">{{ ucfirst($user->role) }}</span>
            </div>
            
            <div class="relative inline-block group">
                <div class="w-28 h-28 rounded-full bg-white flex items-center justify-center text-indigo-600 text-5xl font-bold shadow-lg ring-4 ring-white/80 transition-transform duration-300 group-hover:scale-105">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <button class="absolute bottom-0 right-0 bg-green-500 text-white rounded-full w-10 h-10 flex items-center justify-center hover:bg-green-600 transition-all shadow-md transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-camera text-sm"></i>
                </button>
            </div>
            
            <h1 class="text-3xl font-bold text-white mt-6">{{ $user->name }}</h1>
            <p class="text-blue-100 mt-2">{{ $user->email }}</p>
        </div>

        <!-- Corps du formulaire -->
        <div class="p-8">
            <!-- Notifications -->
            @if(session('status'))
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" 
                 class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                <div class="text-green-700">{{ session('status') }}</div>
                <button @click="show = false" class="ml-auto text-green-500 hover:text-green-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif

            <!-- Formulaire de mise à jour -->
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf @method('patch')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Nom complet</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                                   placeholder="Votre nom">
                        </div>
                        @error('name')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Adresse email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                                   placeholder="Votre email">
                        </div>
                        @error('email')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-all duration-300 flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-save mr-2"></i> Mettre à jour le profil
                    </button>
                </div>
            </form>

            <!-- Section mot de passe -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-lock mr-2"></i> Changer le mot de passe
                </h3>
                
                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf @method('put')

                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2">Mot de passe actuel</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-key text-gray-400"></i>
                                </div>
                                <input type="password" name="current_password" id="current_password"
                                       class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="••••••••">
                                <button type="button" onclick="togglePassword('current_password', 'current_password_icon')" 
                                        class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-eye" id="current_password_icon"></i>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2">Nouveau mot de passe</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-key text-gray-400"></i>
                                </div>
                                <input type="password" name="password" id="password"
                                       class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="••••••••">
                                <button type="button" onclick="togglePassword('password', 'password_icon')" 
                                        class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-eye" id="password_icon"></i>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2">Confirmer le mot de passe</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-key text-gray-400"></i>
                                </div>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="••••••••">
                                <button type="button" onclick="togglePassword('password_confirmation', 'password_confirmation_icon')" 
                                        class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-eye" id="password_confirmation_icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg transition-all duration-300 flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-sync-alt mr-2"></i> Changer le mot de passe
                        </button>
                    </div>
                </form>
            </div>

            <!-- Zone dangereuse -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <h3 class="text-lg font-medium text-red-700 mb-6 flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Zone dangereuse
                </h3>
                
                <form method="POST" action="{{ route('profile.destroy') }}" id="deleteAccountForm">
                    @csrf @method('delete')
                    
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-red-500 mr-3"></i>
                            <p class="text-red-700">La suppression de votre compte est irréversible. Toutes vos données seront définitivement perdues.</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Confirmez avec votre mot de passe</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="password" id="delete_password"
                                   class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('password') border-red-500 @enderror"
                                   placeholder="••••••••">
                            <button type="button" onclick="togglePassword('delete_password', 'delete_password_icon')" 
                                    class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-eye" id="delete_password_icon"></i>
                            </button>
                        </div>
                        @error('password')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="button" onclick="confirmDelete()"
                                class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg transition-all duration-300 flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i class="fas fa-trash-alt mr-2"></i> Supprimer définitivement mon compte
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Fonction pour basculer la visibilité du mot de passe
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Confirmation avant suppression
    function confirmDelete() {
        Swal.fire({
            title: 'Êtes-vous absolument sûr ?',
            text: "Cette action est irréversible et supprimera définitivement votre compte et toutes vos données.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler',
            reverseButtons: true,
            backdrop: `
                rgba(220, 38, 38, 0.4)
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23ffffff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'%3E%3C/path%3E%3Cline x1='12' y1='9' x2='12' y2='13'%3E%3C/line%3E%3Cline x1='12' y1='17' x2='12.01' y2='17'%3E%3C/line%3E%3C/svg%3E")
                left top
                no-repeat
            `
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteAccountForm').submit();
            }
        });
    }

    // Animation au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const profileCard = document.querySelector('.bg-white');
        if (profileCard) {
            profileCard.style.opacity = '0';
            profileCard.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                profileCard.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                profileCard.style.opacity = '1';
                profileCard.style.transform = 'translateY(0)';
            }, 100);
        }
    });
</script>

@if(config('app.env') === 'production')
<!-- SweetAlert2 pour les confirmations -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endif
@endsection