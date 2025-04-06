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
            <h1 class="text-lg font-medium">Mes Tickets</h1>
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
                            Mes Tickets
                        </h2>
                        <a href="{{ route('tickets.create') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 shadow-md hover:shadow-lg inline-flex items-center">
                            <i class="fas fa-plus-circle mr-2"></i> Nouveau Ticket
                        </a>
                    </div>

                    <!-- Message si aucun ticket -->
                    @if($tickets->isEmpty())
                        <div class="bg-gray-50 p-12 rounded-xl text-center">
                            <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-500 mb-2">Vous n'avez pas encore créé de ticket</h3>
                            <p class="text-gray-400 mb-4">Commencez par créer votre premier ticket pour obtenir de l'aide</p>
                            <a href="{{ route('tickets.create') }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg inline-flex items-center">
                                <i class="fas fa-plus-circle mr-2"></i> Créer un ticket
                            </a>
                        </div>
                    @else
                        <!-- Tableau des tickets amélioré -->
                        <div class="overflow-x-auto rounded-xl shadow-sm border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                            <i class="fas fa-heading mr-1 text-blue-500"></i> Titre
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                            <i class="fas fa-tag mr-1 text-blue-500"></i> Catégorie
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                            <i class="fas fa-exclamation-triangle mr-1 text-blue-500"></i> Priorité
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                            <i class="fas fa-tag mr-1 text-blue-500"></i> Statut
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                            <i class="fas fa-calendar-alt mr-1 text-blue-500"></i> Date
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                            <i class="fas fa-cog mr-1 text-blue-500"></i> Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($tickets as $ticket)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                                    {{ Str::limit($ticket->title, 30) }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $ticket->category->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($ticket->priority->name === 'High') bg-red-100 text-red-800
                                                    @elseif($ticket->priority->name === 'Medium') bg-yellow-100 text-yellow-800
                                                    @else bg-green-100 text-green-800
                                                    @endif">
                                                    {{ $ticket->priority->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($ticket->status->name === 'Open') bg-green-100 text-green-800
                                                    @elseif($ticket->status->name === 'In Progress') bg-yellow-100 text-yellow-800
                                                    @elseif($ticket->status->name === 'Resolved') bg-blue-100 text-blue-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ $ticket->status->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $ticket->created_at->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('tickets.show', $ticket) }}" 
                                                       class="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                                                       title="Voir les détails">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('tickets.edit', $ticket) }}" 
                                                       class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200"
                                                       title="Modifier">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination améliorée -->
                        <div class="mt-6 flex items-center justify-between">
                            <div class="text-sm text-gray-500">
                                Affichage de <span class="font-medium">{{ $tickets->firstItem() }}</span> à <span class="font-medium">{{ $tickets->lastItem() }}</span> sur <span class="font-medium">{{ $tickets->total() }}</span> tickets
                            </div>
                            <div class="flex space-x-2">
                                {{ $tickets->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>