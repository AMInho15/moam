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
                                <a href="{{ route('tickets.index') }}" class="text-blue-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-all duration-200">
                                    <i class="fas fa-list mr-1"></i> Mes Tickets
                                </a>
                                <a href="{{ route('tickets.create') }}" class="text-blue-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-all duration-200">
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
            <i class="fas fa-ticket-alt mr-3 text-blue-300"></i>
            <h1 class="text-lg font-medium">Détails du Ticket</h1>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen" style="background: linear-gradient(135deg, #f0f4ff, #e6f0ff, #d9e8ff)">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">
                    <!-- En-tête avec boutons d'action -->
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                                <i class="fas fa-ticket-alt text-blue-500 mr-3"></i>
                                {{ $ticket->title }}
                            </h2>
                            <div class="flex items-center mt-2 space-x-4">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $ticket->status->name === 'Open' ? 'bg-green-100 text-green-800' : 
                                       ($ticket->status->name === 'Resolved' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $ticket->status->name }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-user-circle mr-1"></i> {{ $ticket->user->name }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-calendar-alt mr-1"></i> {{ $ticket->created_at->format('d/m/Y H:i') }}
                                </span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('tickets.edit', $ticket->id) }}" 
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
                                <i class="fas fa-edit mr-2"></i> Modifier
                            </a>
                            <a href="{{ route('tickets.index') }}" 
                               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">
                                <i class="fas fa-arrow-left mr-2"></i> Retour
                            </a>
                        </div>
                    </div>

                    <!-- Description du ticket -->
                    <div class="bg-blue-50 p-6 rounded-xl mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-align-left text-blue-500 mr-2"></i> Description
                        </h3>
                        <p class="text-gray-700 whitespace-pre-line">{{ $ticket->description }}</p>
                    </div>

                    <!-- Métadonnées du ticket -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                            <h4 class="text-sm font-medium text-gray-500 mb-2 flex items-center">
                                <i class="fas fa-tag text-blue-500 mr-2"></i> Catégorie
                            </h4>
                            <p class="text-lg font-medium text-gray-800">{{ $ticket->category->name }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                            <h4 class="text-sm font-medium text-gray-500 mb-2 flex items-center">
                                <i class="fas fa-exclamation-triangle text-blue-500 mr-2"></i> Priorité
                            </h4>
                            <p class="text-lg font-medium text-gray-800">{{ $ticket->priority->name }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                            <h4 class="text-sm font-medium text-gray-500 mb-2 flex items-center">
                                <i class="fas fa-building text-blue-500 mr-2"></i> Département
                            </h4>
                            <p class="text-lg font-medium text-gray-800">{{ $ticket->department->name ?? 'Non assigné' }}</p>
                        </div>
                    </div>

                    <!-- Mise à jour du statut -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm mb-8">
                        <h3 class="text-xl font-bold mb-4 flex items-center">
                            <i class="fas fa-sync-alt text-blue-500 mr-2"></i> Mettre à Jour le Statut
                        </h3>
                        <form action="{{ route('tickets.update_status', $ticket) }}" method="POST" class="flex flex-col md:flex-row items-start md:items-end space-y-4 md:space-y-0 md:space-x-4">
                            @csrf
                            @method('PATCH')

                            <div class="flex-grow">
                                <label for="status_id" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                                <div class="relative">
                                    <select id="status_id" name="status_id" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}" {{ $ticket->status_id == $status->id ? 'selected' : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tag text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 shadow-md hover:shadow-lg inline-flex items-center">
                                <i class="fas fa-save mr-2"></i> Mettre à Jour
                            </button>
                        </form>
                    </div>

                    <!-- Section des commentaires -->
                    <div class="space-y-8">
                        <div>
                            <h3 class="text-xl font-bold mb-4 flex items-center">
                                <i class="fas fa-comments text-blue-500 mr-2"></i> Commentaires
                                <span class="ml-auto text-sm font-normal text-gray-500">{{ $ticket->comments->count() }} commentaire(s)</span>
                            </h3>

                            @if($ticket->comments->isEmpty())
                                <div class="bg-gray-50 p-8 rounded-xl text-center">
                                    <i class="fas fa-comment-slash text-3xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-500">Aucun commentaire pour ce ticket</p>
                                </div>
                            @else
                                <div class="space-y-4">
                                    @foreach($ticket->comments as $comment)
                                        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                                            <div class="flex justify-between items-start mb-2">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                                                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                                    </div>
                                                    <span class="font-medium text-gray-800">{{ $comment->user->name }}</span>
                                                </div>
                                                <span class="text-sm text-gray-500">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
                                            </div>
                                            <p class="text-gray-700 mt-2 whitespace-pre-line">{{ $comment->content }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Formulaire d'ajout de commentaire -->
                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                            <h3 class="text-xl font-bold mb-4 flex items-center">
                                <i class="fas fa-plus-circle text-blue-500 mr-2"></i> Ajouter un Commentaire
                            </h3>
                            <form action="{{ route('comments.store', $ticket) }}" method="POST">
                                @csrf
                                <div class="relative">
                                    <textarea name="content" rows="3" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400" 
                                              placeholder="Écrivez votre commentaire ici..." required></textarea>
                                    <div class="absolute top-3 left-3">
                                        <i class="fas fa-comment-dots text-gray-400"></i>
                                    </div>
                                </div>
                                <button type="submit" class="mt-4 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 shadow-md hover:shadow-lg inline-flex items-center">
                                    <i class="fas fa-paper-plane mr-2"></i> Publier le Commentaire
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>