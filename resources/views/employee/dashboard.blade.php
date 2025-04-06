<x-layout>
    <x-slot name="header">
        <!-- Footer positionné en haut comme une barre fixe -->
        <div class="fixed top-0 left-0 right-0 bg-gray-900 text-white shadow-md z-50">
            <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
                <h1 class="text-xl font-bold">🎫 Gestion des Tickets IT</h1>
                <p class="text-sm">Bienvenue, {{ Auth::user()->name }}</p>
            </div>
        </div>

        <!-- CSS personnalisé -->
        <style>
            body {
                background: linear-gradient(to right, #e0f7fa, #ffffff);
            }

            .action-card {
                transition: all 0.3s ease;
                background-color: #ffffff;
                border-left: 5px solid #4f46e5;
            }

            .action-card:hover {
                background-color: #f0f4ff;
                transform: scale(1.02);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            }

            .ticket-item {
                transition: background-color 0.3s ease;
            }

            .ticket-item:hover {
                background-color: #f1f5f9;
            }

            .fade-in {
                animation: fadeIn 0.6s ease-in-out;
            }

            @keyframes fadeIn {
                0% { opacity: 0; transform: translateY(20px); }
                100% { opacity: 1; transform: translateY(0); }
            }
        </style>
    </x-slot>

    <div class="pt-24 fade-in"> <!-- pt-24 pour ne pas être masqué par le header fixe -->
        <div class="max-w-4xl mx-auto px-4">
            <!-- Message de Bienvenue -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-2xl font-semibold text-gray-800">👋 Bonjour {{ Auth::user()->name }}</h2>
                <p class="text-gray-600 mt-2">Voici un résumé de vos tickets et des actions disponibles.</p>
            </div>

            <!-- Actions en disposition VERTICALE -->
            <div class="flex flex-col space-y-6 mb-10">
                <a href="{{ route('tickets.index') }}" class="action-card p-5 rounded-lg shadow">
                    <h3 class="text-lg font-bold text-indigo-700">📋 Voir Tous les Tickets</h3>
                    <p class="text-gray-600 mt-1">Accéder à la liste complète des tickets.</p>
                </a>

                <a href="{{ route('tickets.create') }}" class="action-card p-5 rounded-lg shadow">
                    <h3 class="text-lg font-bold text-green-700">➕ Créer un Nouveau Ticket</h3>
                    <p class="text-gray-600 mt-1">Soumettre une nouvelle demande ou signaler un problème.</p>
                </a>

                <a href="{{ route('tickets.my_tickets') }}" class="action-card p-5 rounded-lg shadow">
                    <h3 class="text-lg font-bold text-purple-700">🧾 Mes Tickets</h3>
                    <p class="text-gray-600 mt-1">Consulter les tickets que vous avez créés.</p>
                </a>
            </div>

            <!-- Tickets Assignés à Moi -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">🎯 Tickets Assignés à Moi</h3>

                @if($assignedTickets->isEmpty())
                    <p class="text-gray-500">Aucun ticket assigné pour le moment.</p>
                @else
                    <ul class="space-y-4">
                        @foreach($assignedTickets as $ticket)
                            <li class="ticket-item bg-gray-50 p-4 rounded-lg shadow-sm">
                                <h4 class="text-lg font-medium text-gray-800">{{ $ticket->title }}</h4>
                                <p class="text-gray-600 mt-2">{{ Str::limit($ticket->description, 100) }}</p>
                                <div class="mt-2 flex justify-between items-center">
                                    <span class="text-sm text-gray-500">{{ $ticket->created_at->format('d/m/Y H:i') }}</span>
                                    <a href="{{ route('tickets.show', $ticket) }}" class="text-indigo-600 hover:underline">
                                        Voir Détails
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-layout>