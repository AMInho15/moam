<x-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <i class="fas fa-tachometer-alt mr-3 text-blue-500"></i>
            Tableau de Bord Technicien
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Message de Bienvenue -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 overflow-hidden shadow-lg sm:rounded-lg border border-blue-100">
                <div class="p-6">
                    <div class="flex items-start">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-user-cog text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Bienvenue, {{ Auth::user()->name }} !</h2>
                            <p class="mt-2 text-gray-600">
                                Voici un résumé de vos tickets assignés et des actions disponibles.
                            </p>
                            <div class="mt-4">
                                <a href="{{ route('tickets.create') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-300">
                                    <i class="fas fa-plus-circle mr-2"></i> Créer un nouveau ticket
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistiques Rapides -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Tickets en Attente -->
                <div class="bg-gradient-to-br from-blue-100 to-blue-200 border border-blue-200 p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">En Attente</h3>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $pendingTicketsCount ?? 0 }}</p>
                        </div>
                        <div class="bg-blue-500 text-white p-3 rounded-full">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('tickets.index', ['status' => 'pending']) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                            Voir tous <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Tickets en Cours -->
                <div class="bg-gradient-to-br from-green-100 to-green-200 border border-green-200 p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">En Cours</h3>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $inProgressTicketsCount ?? 0 }}</p>
                        </div>
                        <div class="bg-green-500 text-white p-3 rounded-full">
                            <i class="fas fa-tools text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('tickets.index', ['status' => 'in_progress']) }}" class="text-green-600 hover:text-green-800 text-sm font-medium flex items-center">
                            Voir tous <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Tickets Terminés -->
                <div class="bg-gradient-to-br from-purple-100 to-purple-200 border border-purple-200 p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Terminés</h3>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $completedTicketsCount ?? 0 }}</p>
                        </div>
                        <div class="bg-purple-500 text-white p-3 rounded-full">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('tickets.index', ['status' => 'completed']) }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium flex items-center">
                            Voir tous <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Derniers Tickets Assignés -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border border-gray-200">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-ticket-alt text-blue-500 mr-3"></i>
                            Derniers Tickets Assignés
                        </h3>
                        <a href="{{ route('tickets.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                            Voir tout <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>

                    @if(isset($recentTickets) && $recentTickets->isEmpty())
                        <div class="text-center py-8">
                            <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                            <p class="text-gray-500">Aucun ticket assigné récemment.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($recentTickets as $ticket)
                                <div class="bg-gray-50 hover:bg-gray-100 p-5 rounded-lg border border-gray-200 transition duration-300">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="text-lg font-medium text-gray-800 flex items-center">
                                                <span class="ticket-priority priority-{{ strtolower($ticket->priority->name ?? 'normal') }} mr-3"></span>
                                                {{ $ticket->title }}
                                            </h4>
                                            <p class="text-gray-600 mt-2">{{ Str::limit($ticket->description, 100) }}</p>
                                        </div>
                                        <span class="text-sm text-gray-500 whitespace-nowrap">
                                            {{ $ticket->created_at->format('d/m/Y H:i') }}
                                        </span>
                                    </div>
                                    <div class="mt-4 flex justify-between items-center">
                                        <div class="flex space-x-4">
                                            <span class="text-sm px-3 py-1 rounded-full bg-opacity-20 
                                                @if($ticket->status->name === 'En Attente') bg-blue-500 text-blue-800
                                                @elseif($ticket->status->name === 'En Cours') bg-green-500 text-green-800
                                                @else bg-purple-500 text-purple-800 @endif">
                                                {{ $ticket->status->name ?? 'N/A' }}
                                            </span>
                                            <span class="text-sm text-gray-500">
                                                Priorité: {{ $ticket->priority->name ?? 'N/A' }}
                                            </span>
                                        </div>
                                        <a href="{{ route('tickets.show', $ticket) }}" 
                                           class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition duration-300">
                                            <i class="fas fa-eye mr-1"></i> Voir Détails
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .ticket-priority {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }
        .priority-high {
            background-color: #ef4444;
        }
        .priority-medium {
            background-color: #f59e0b;
        }
        .priority-low {
            background-color: #10b981;
        }
        .priority-normal {
            background-color: #3b82f6;
        }
    </style>
</x-layout>