<x-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <i class="fas fa-plus-circle mr-3 text-blue-500"></i>
            Créer un Nouveau Ticket
        </div>
    </x-slot>

    <!-- Modification du fond pour correspondre à la page d'accueil -->
    <div class="py-8 min-h-screen" style="background: linear-gradient(135deg, #f0f4ff, #e6f0ff, #d9e8ff)">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-200 transition-all duration-300 hover:shadow-2xl">
                <div class="p-8">
                    <!-- En-tête avec icône -->
                    <div class="flex items-center mb-8">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <i class="fas fa-ticket-alt text-xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800">Nouveau Ticket</h2>
                    </div>

                    <!-- Messages d'Erreur -->
                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg flex items-start">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3 mt-1"></i>
                            <div>
                                <h3 class="text-red-800 font-medium">Veuillez corriger les erreurs suivantes :</h3>
                                <ul class="list-disc list-inside text-red-600 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!-- Formulaire de Création -->
                    <form id="ticketForm" action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Titre -->
                        <div class="space-y-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 flex items-center">
                                <i class="fas fa-heading mr-2 text-blue-500"></i>Titre du Ticket
                            </label>
                            <div class="relative">
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition-all duration-200"
                                       placeholder="Décrivez brièvement le problème" required>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-pen text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="space-y-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 flex items-center">
                                <i class="fas fa-align-left mr-2 text-blue-500"></i>Description détaillée
                            </label>
                            <div class="relative">
                                <textarea name="description" id="description" rows="5"
                                          class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition-all duration-200"
                                          placeholder="Décrivez le problème en détail..." required>{{ old('description') }}</textarea>
                                <div class="absolute top-3 left-3">
                                    <i class="fas fa-file-alt text-gray-400"></i>
                                </div>
                            </div>
                            <div class="flex justify-between items-center mt-1">
                                <p class="text-xs text-gray-500">Minimum 30 caractères</p>
                                <p id="charCount" class="text-xs font-medium">0/2000 caractères</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Catégorie -->
                            <div class="space-y-2">
                                <label for="category_id" class="block text-sm font-medium text-gray-700 flex items-center">
                                    <i class="fas fa-tag mr-2 text-blue-500"></i>Catégorie
                                </label>
                                <div class="relative">
                                    <select name="category_id" id="category_id" 
                                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white" required>
                                        <option value="">Sélectionnez une catégorie</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-folder text-gray-400"></i>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Priorité -->
                            <div class="space-y-2">
                                <label for="priority_id" class="block text-sm font-medium text-gray-700 flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2 text-blue-500"></i>Priorité
                                </label>
                                <div class="relative">
                                    <select name="priority_id" id="priority_id" 
                                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white" required>
                                        <option value="">Sélectionnez une priorité</option>
                                        @foreach ($priorities as $priority)
                                            <option value="{{ $priority->id }}" {{ old('priority_id') == $priority->id ? 'selected' : '' }}>
                                                {{ $priority->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-flag text-gray-400"></i>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Département -->
                            <div class="space-y-2">
                                <label for="department_id" class="block text-sm font-medium text-gray-700 flex items-center">
                                    <i class="fas fa-building mr-2 text-blue-500"></i>Département
                                </label>
                                <div class="relative">
                                    <select name="department_id" id="department_id" 
                                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white" required>
                                        <option value="">Sélectionnez un département</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-sitemap text-gray-400"></i>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Assignation au Technicien -->
                        <div class="space-y-2">
                            <label for="assigned_to" class="block text-sm font-medium text-gray-700 flex items-center">
                                <i class="fas fa-user-cog mr-2 text-blue-500"></i>Assigner à un Technicien (Optionnel)
                            </label>
                            <div class="relative">
                                <select name="assigned_to" id="assigned_to" 
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                                    <option value="">-- Optionnel : Sélectionnez un technicien --</option>
                                    @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}" {{ old('assigned_to') == $technician->id ? 'selected' : '' }}>
                                            {{ $technician->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user-shield text-gray-400"></i>
                                </div>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Fichiers Joints -->
                        <div class="space-y-2">
                            <label for="attachments" class="block text-sm font-medium text-gray-700 flex items-center">
                                <i class="fas fa-paperclip mr-2 text-blue-500"></i>Fichiers Joints (Optionnel)
                            </label>
                            <div class="relative">
                                <input type="file" name="attachments[]" id="attachments" multiple 
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all duration-200">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-cloud-upload-alt text-gray-400"></i>
                                </div>
                            </div>
                            <div id="filePreview" class="mt-2 space-y-2"></div>
                            <p class="text-xs text-gray-500 mt-1">Formats acceptés : .jpg, .png, .pdf, .doc, .docx (Max 5MB par fichier)</p>
                        </div>

                        <!-- Boutons - Section bien visible -->
                        <div class="flex justify-end space-x-4 pt-8 border-t border-gray-200 mt-8">
                            <a href="{{ route('tickets.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                                <i class="fas fa-times mr-2"></i> Annuler
                            </a>
                            <button type="submit" id="submitBtn" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <i class="fas fa-paper-plane mr-2"></i> Envoyer le Ticket
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript amélioré -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Compteur de caractères pour la description
            const description = document.getElementById('description');
            const charCount = document.getElementById('charCount');
            
            if (description && charCount) {
                description.addEventListener('input', function() {
                    const count = this.value.length;
                    charCount.textContent = `${count}/2000 caractères`;
                    
                    if (count < 30) {
                        charCount.classList.add('text-red-500');
                        charCount.classList.remove('text-green-500');
                    } else {
                        charCount.classList.remove('text-red-500');
                        charCount.classList.add('text-green-500');
                    }
                });
                
                // Déclenche l'événement input pour initialiser le compteur
                description.dispatchEvent(new Event('input'));
            }

            // Prévisualisation des fichiers joints
            const attachments = document.getElementById('attachments');
            const filePreview = document.getElementById('filePreview');
            
            if (attachments && filePreview) {
                attachments.addEventListener('change', function() {
                    filePreview.innerHTML = '';
                    
                    if (this.files.length > 0) {
                        const fileList = document.createElement('div');
                        fileList.className = 'space-y-2';
                        
                        Array.from(this.files).forEach(file => {
                            const fileItem = document.createElement('div');
                            fileItem.className = 'flex items-center justify-between p-2 bg-gray-50 rounded-lg';
                            
                            const fileInfo = document.createElement('div');
                            fileInfo.className = 'flex items-center';
                            
                            const fileIcon = document.createElement('i');
                            fileIcon.className = 'fas fa-file text-gray-500 mr-2';
                            
                            const fileName = document.createElement('span');
                            fileName.className = 'text-sm text-gray-700';
                            fileName.textContent = file.name;
                            
                            const fileSize = document.createElement('span');
                            fileSize.className = 'text-xs text-gray-500 ml-2';
                            fileSize.textContent = `(${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                            
                            fileInfo.appendChild(fileIcon);
                            fileInfo.appendChild(fileName);
                            fileInfo.appendChild(fileSize);
                            
                            const removeBtn = document.createElement('button');
                            removeBtn.type = 'button';
                            removeBtn.className = 'text-red-500 hover:text-red-700';
                            removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                            removeBtn.addEventListener('click', () => {
                                // Créer un nouveau DataTransfer pour supprimer le fichier
                                const newFiles = new DataTransfer();
                                Array.from(attachments.files).forEach(f => {
                                    if (f !== file) {
                                        newFiles.items.add(f);
                                    }
                                });
                                attachments.files = newFiles.files;
                                fileItem.remove();
                            });
                            
                            fileItem.appendChild(fileInfo);
                            fileItem.appendChild(removeBtn);
                            fileList.appendChild(fileItem);
                        });
                        
                        filePreview.appendChild(fileList);
                    }
                });
            }

            // Validation du formulaire avant soumission
            const ticketForm = document.getElementById('ticketForm');
            const submitBtn = document.getElementById('submitBtn');
            
            if (ticketForm && submitBtn) {
                ticketForm.addEventListener('submit', function(e) {
                    // Désactiver le bouton pour éviter les doubles soumissions
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Envoi en cours...';
                    
                    // Validation supplémentaire si nécessaire
                    if (description.value.length < 30) {
                        e.preventDefault();
                        alert('La description doit contenir au moins 30 caractères');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Envoyer le Ticket';
                    }
                });
            }
        });
    </script>
</x-layout>