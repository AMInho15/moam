<x-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold text-blue-600 mb-6">Tableau de Bord Administrateur</h1>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Bouton pour Accéder à la Liste des Utilisateurs -->
            <div class="mb-6 flex justify-center">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg shadow-lg hover:bg-gray-100 transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-users mr-3"></i> Voir la Liste des Utilisateurs
                </a>
            </div>
            

            <!-- Messages de Confirmation ou d'Erreur -->
            @if(session('success'))
                <div class="bg-green-200 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-md mb-6 shadow-lg" role="alert">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-200 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-md mb-6 shadow-lg" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                </div>
            @endif

            <!-- Statistiques Globales -->
            <h2 class="text-2xl font-semibold text-blue-600 mb-6">Statistiques</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                
                <!-- Carte : Tickets au Total -->
                <div class="bg-white p-6 rounded-lg shadow-lg border border-blue-300 hover:shadow-xl transform transition-all duration-200 ease-in-out">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-ticket-alt text-4xl text-blue-600"></i>
                        <div>
                            <p class="text-3xl font-bold text-blue-600">{{ $totalTickets }}</p>
                            <p class="text-blue-500">Tickets au Total</p>
                        </div>
                    </div>
                </div>

                <!-- Carte : Tickets Ouverts -->
                <div class="bg-white p-6 rounded-lg shadow-lg border border-blue-300 hover:shadow-xl transform transition-all duration-200 ease-in-out">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-folder-open text-4xl text-yellow-600"></i>
                        <div>
                            <p class="text-3xl font-bold text-blue-600">{{ $openTickets }}</p>
                            <p class="text-blue-500">Tickets Ouverts</p>
                        </div>
                    </div>
                </div>

                <!-- Carte : Tickets Résolus -->
                <div class="bg-white p-6 rounded-lg shadow-lg border border-blue-300 hover:shadow-xl transform transition-all duration-200 ease-in-out">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-check-circle text-4xl text-green-600"></i>
                        <div>
                            <p class="text-3xl font-bold text-blue-600">{{ $resolvedTickets }}</p>
                            <p class="text-blue-500">Tickets Résolus</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Temps Moyen de Résolution par Technicien -->
            <h3 class="text-2xl font-semibold text-blue-600 mb-4">Temps Moyen de Résolution par Technicien</h3>
            <div class="bg-white p-6 rounded-lg shadow-lg border border-blue-300 mb-12">
                @if ($averageResolutionTimeByTechnician->isEmpty())
                    <p class="text-blue-500 flex items-center space-x-2">
                        <i class="fas fa-info-circle text-blue-400"></i>
                        Aucun ticket résolu pour le moment.
                    </p>
                @else
                    <ul class="space-y-4">
                        @foreach ($averageResolutionTimeByTechnician as $data)
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-user text-blue-400"></i>
                                <span>{{ optional($data->assignedTo)->name ?? 'Non Assigné' }} :</span>
                                <span class="font-bold text-blue-600">{{ number_format($data->avg_resolution_time, 2) }} heures</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Tickets Prioritaires (Critiques) -->
            <h3 class="text-2xl font-semibold text-blue-600 mb-4">Tickets Critiques</h3>
            <div class="bg-white p-6 rounded-lg shadow-lg border border-blue-300">
                @if ($criticalTickets->isEmpty())
                    <p class="text-blue-500 flex items-center space-x-2">
                        <i class="fas fa-exclamation-triangle text-blue-400"></i>
                        Aucun ticket critique pour le moment.
                    </p>
                @else
                    <ul class="space-y-4">
                        @foreach ($criticalTickets as $ticket)
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-exclamation-circle text-blue-400"></i>
                                <span>{{ $ticket->title }} - Priorité : {{ $ticket->priority->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </div>
</x-layout>
