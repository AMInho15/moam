<x-layout>
    <x-slot name="header">
        <!-- Barre de navigation cohérente -->
        <nav class="bg-gradient-to-r from-blue-600 to-blue-800 shadow-xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo et titre -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <i class="fas fa-ticket-alt text-white text-2xl mr-3"></i>
                            <span class="text-white font-bold text-xl">Helpdesk Pro</span>
                        </div>
                        
                        <!-- Liens principaux -->
                        <div class="hidden md:block ml-10">
                            <div class="flex space-x-4">
                                <a href="{{ route('tickets.index') }}" class="bg-blue-500 text-white px-3 py-2 rounded-md text-sm font-medium">
                                    <i class="fas fa-list mr-1"></i> Mes Tickets
                                </a>
                                <a href="{{ route('tickets.create') }}" class="text-blue-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition-all duration-200">
                                    <i class="fas fa-plus-circle mr-1"></i> Nouveau Ticket
                                </a>
                                <a href="#" class="text-blue-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-all duration-200">
                                    <i class="fas fa-chart-bar mr-1"></i> Statistiques
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Section droite -->
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <!-- Notification -->
                            <button class="p-1 rounded-full text-blue-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-800 focus:ring-white">
                                <span class="sr-only">Notifications</span>
                                <i class="fas fa-bell"></i>
                            </button>

                            <!-- Menu profil -->
                            <div class="ml-3 relative">
                                <div>
                                    <button class="max-w-xs bg-blue-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-800 focus:ring-white" id="user-menu">
                                        <span class="sr-only">Ouvrir le menu utilisateur</span>
                                        <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </div>
                                        <span class="ml-2 text-white text-sm font-medium hidden md:inline">{{ Auth::user()->name }}</span>
                                        <i class="fas fa-chevron-down ml-1 text-blue-200 text-xs hidden md:inline"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu mobile -->
                    <div class="-mr-2 flex md:hidden">
                        <button type="button" class="bg-blue-800 inline-flex items-center justify-center p-2 rounded-md text-blue-200 hover:text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-800 focus:ring-white">
                            <span class="sr-only">Ouvrir le menu principal</span>
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex items-center px-6 py-4 bg-blue-700 text-white md:hidden">
            <i class="fas fa-list mr-3 text-blue-300"></i>
            <h1 class="text-lg font-medium">Liste des Tickets</h1>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen" style="background: linear-gradient(135deg, #f0f4ff, #e6f0ff, #d9e8ff)">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">
                    <!-- En-tête avec bouton -->
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-ticket-alt text-blue-500 mr-3"></i>
                            Liste des Tickets
                        </h2>
                        <a href="{{ route('tickets.create') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 shadow-md hover:shadow-lg inline-flex items-center">
                            <i class="fas fa-plus-circle mr-2"></i> Créer un Ticket
                        </a>
                    </div>

                    <!-- Formulaire de Filtrage amélioré -->
                    <form action="{{ route('tickets.index') }}" method="GET" class="mb-8 bg-blue-50 p-6 rounded-xl">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Filtre par Statut -->
                            <div class="space-y-2">
                                <label for="status" class="block text-sm font-medium text-gray-700 flex items-center">
                                    <i class="fas fa-tag mr-2 text-blue-500"></i>Statut
                                </label>
                                <div class="relative">
                                    <select name="status" id="status" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                                        <option value="">Tous les Statuts</option>
                                        @foreach (\App\Models\TicketStatus::all() as $status)
                                            <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tag text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Filtre par Priorité -->
                            <div class="space-y-2">
                                <label for="priority" class="block text-sm font-medium text-gray-700 flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2 text-blue-500"></i>Priorité
                                </label>
                                <div class="relative">
                                    <select name="priority" id="priority" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                                        <option value="">Toutes les Priorités</option>
                                        @foreach (\App\Models\Priority::all() as $priority)
                                            <option value="{{ $priority->id }}" {{ request('priority') == $priority->id ? 'selected' : '' }}>
                                                {{ $priority->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-flag text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Bouton de Soumission -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-transparent">Filtrer</label>
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-medium transition-all duration-200 shadow-md hover:shadow-lg inline-flex items-center justify-center">
                                    <i class="fas fa-filter mr-2"></i> Appliquer
                                </button>
                            </div>

                            <!-- Bouton Réinitialiser -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-transparent">Réinitialiser</label>
                                <a href="{{ route('tickets.index') }}" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 px-4 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md inline-flex items-center justify-center">
                                    <i class="fas fa-sync-alt mr-2"></i> Réinitialiser
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Tableau des Tickets amélioré -->
                    <div class="overflow-x-auto rounded-xl shadow-sm border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        <i class="fas fa-hashtag mr-1 text-blue-500"></i> ID
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        <i class="fas fa-heading mr-1 text-blue-500"></i> Titre
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        <i class="fas fa-tag mr-1 text-blue-500"></i> Statut
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        <i class="fas fa-exclamation-triangle mr-1 text-blue-500"></i> Priorité
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        <i class="fas fa-calendar-alt mr-1 text-blue-500"></i> Créé le
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        <i class="fas fa-cog mr-1 text-blue-500"></i> Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if ($tickets->isEmpty())
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            <i class="fas fa-inbox text-3xl mb-2 text-gray-300"></i>
                                            <p>Aucun ticket trouvé.</p>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($tickets as $ticket)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150 {{ $ticket->status?->name === 'Open' ? 'bg-green-50' : ($ticket->status?->name === 'Resolved' ? 'bg-blue-50' : '') }}">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                #{{ $ticket->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                                    {{ Str::limit($ticket->title, 40) }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $ticket->status?->name === 'Open' ? 'bg-green-100 text-green-800' : 
                                                       ($ticket->status?->name === 'Resolved' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                                    {{ $ticket->status?->name ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $ticket->priority?->name === 'High' ? 'bg-red-100 text-red-800' : 
                                                       ($ticket->priority?->name === 'Medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                                    {{ $ticket->priority?->name ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $ticket->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('tickets.show', $ticket->id) }}" 
                                                       class="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                                                       title="Voir les détails">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('tickets.edit', $ticket->id) }}" 
                                                       class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200"
                                                       title="Modifier">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                                                title="Supprimer"
                                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce ticket ?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination stylisée -->
                    <div class="mt-6 flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            Affichage de <span class="font-medium">{{ $tickets->firstItem() }}</span> à <span class="font-medium">{{ $tickets->lastItem() }}</span> sur <span class="font-medium">{{ $tickets->total() }}</span> tickets
                        </div>
                        <div class="flex space-x-2">
                            {{ $tickets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>