<x-layout title="Proceso de Selección | Coca-Cola">
    <div class="image mb-3">
        <img src="/assets/images/logo.png" alt="Coca-Cola" class="object-cover">
    </div>
    <!-- Background pattern -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/assets/images/background-company.png');"></div>
    </div>
    <div x-data="{
        sidebarOpen: false,
        fileName: '',
        isUploading: false,
        showSuccessPopup: false,
        messages: [
            {
                sender: 'coca-cola',
                content: 'Hola!👋 Bienvenido(a) al proceso de selección para la posición de Gerente de Recursos Humanos e Grupo Soluciones Integradas.',
                time: '10:30 AM',
                buttons: []
            },
            {
                sender: 'coca-cola',
                content: 'Soy Teambot, tu primer contacto en esta entrevista. Esta conversación tomará solo unos minutos. ¿Listo para comenzar?',
                time: '10:31 AM',
                buttons: [
                    { text: '¡Sí, adelante!', class: 'bg-white text-blue-500 border border-blue-500' },
                    { text: 'Iniciar más tarde', class: 'bg-white text-gray-500 border border-gray-300' }
                ]
            },
            {
                sender: 'user',
                content: '¡Si, adelante!',
                time: '10:31 AM',
                buttons: []
            },
            {
                sender: 'coca-cola',
                content: 'Perfecto! Para iniciar, ¿podrías subir tu curriculum vitae? Esto nos ayudará a agilizar la entrevista.',
                time: '10:32 AM',
                buttons: [
                    { text: 'Subir curriculum vitae', class: 'bg-white text-blue-500 border border-blue-500' }
                ]
            }
        ],
        newMessage: '',
        sendMessage() {
            if (this.newMessage.trim() === '') return;
            
            // Create a new user message
            const userMessage = {
                sender: 'user',
                content: this.newMessage,
                time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}),
                buttons: []
            };
            
            // Add to messages array
            this.messages.push(userMessage);
            
            // Clear input
            this.newMessage = '';
            
            // Auto-reply after a short delay (simulating bot response)
            setTimeout(() => {
                const botReply = {
                    sender: 'coca-cola',
                    content: 'Gracias por tu mensaje. Nuestro equipo lo revisará pronto.',
                    time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}),
                    buttons: []
                };
                this.messages.push(botReply);
                
                // Scroll to bottom after bot replies
                this.$nextTick(() => {
                    const chatContainer = document.getElementById('chat-container');
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                });
            }, 1000);
            
            // Scroll to bottom after message is sent
            this.$nextTick(() => {
                const chatContainer = document.getElementById('chat-container');
                chatContainer.scrollTop = chatContainer.scrollHeight;
            });
        },
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
        },
        closeSidebar() {
            this.sidebarOpen = false;
        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.fileName = file.name;
                this.isUploading = true;
                
                // Here you would typically handle the file upload to your server
                // For example, using fetch or FormData API
                
                // Simulating upload completion after 2 seconds
                setTimeout(() => {
                    this.isUploading = false;
                    this.showSuccessPopup = true;
                    // You can add the file to your message or do other processing here
                }, 2000);
            }
        },
        closePopup() {
            this.showSuccessPopup = false;
        }
    }" class="bg-white min-h-[82vh] font-sans">
        <!-- Main container -->
        <div class="relative z-10 flex flex-col md:flex-row gap-3 h-[82vh]">
            <!-- Mobile header -->
            <div class="md:hidden bg-white border-b border-gray-200 px-4 py-2 flex items-center justify-between">
                <button @click="toggleSidebar" class="text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="flex items-center space-x-2">
                    <div class="h-8 w-8 bg-red-600 rounded-full flex items-center justify-center">
                        <img src="assets/images/admin-avatar.png" alt="Coca-Cola" class="h-6 w-6 rounded-full">
                    </div>
                    <div>
                        <div class="font-semibold text-sm">Coca-Cola</div>
                        <div class="text-xs text-gray-500">Asistente de Carrera</div>
                    </div>
                </div>
                <div class="w-6">
                    <!-- Right spacing -->
                </div>
            </div>
            
            <!-- Sidebar -->
            <div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" class="bg-white border-r border-gray-200 w-full md:w-72 md:min-w-72 md:translate-x-0 fixed md:static top-0 left-0 h-full z-30 transition-transform duration-300 ease-in-out overflow-x-hidden rounded-xl">
                <!-- Mobile sidebar header with close button -->
                <div class="flex justify-between items-center p-4 border-b border-gray-200 md:hidden">
                    <h2 class="font-bold text-lg">Información</h2>
                    <button @click="closeSidebar" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="p-6">
                    <h1 class="text-lg font-bold mb-6 md:block hidden">Postulación</h1>
                    
                    <div class="mb-6">
                        <h2 class="text-sm font-semibold text-gray-700 mb-3">Descripción del puesto:</h2>
                    </div>
                    
                    <div class="mb-6">
                        <h2 class="text-sm font-semibold text-gray-700 mb-2">Asistente de Carrera</h2>
                        <div class="text-xs text-gray-500 mb-2">Coca-Cola</div>
                        
                        <div class="mb-4">
                            <h3 class="text-sm font-medium mb-1">Descripción</h3>
                            <p class="text-xs text-gray-600">
                                Coca-Cola, una empresa de Marketing y Producción, busca incorporar un Asistente de Carrera para cubrir la siguiente vacante: Asistente de Marketing Jr. El candidato será responsable de apoyar al Gerente en la toma de decisiones estratégicas y en la gestión diaria de las operaciones de la empresa. El Asistente de Carrera será un contribuidor al crecimiento y éxito continuo de la empresa.
                            </p>
                        </div>
                        
                        <div class="mb-2">
                            <h3 class="text-xs font-medium mb-1">Línea roja</h3>
                            <div class="text-xs text-gray-600">Cómo reconocerlo del proceso</div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h2 class="text-sm font-semibold text-gray-700 mb-2">Conocimientos del puesto:</h2>
                    </div>
                    
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs">15 Min</span>
                        <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs">24 de Junio</span>
                        <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs">Licenciatura</span>
                        <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs">1-3 años</span>
                        <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs">Remoto | Credit | Mexico</span>
                        <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs">45,000 - 50,000 MXN (Aproximado)</span>
                    </div>
                </div>
            </div>
            
            <!-- Main chat area with border -->
            <div class="flex-1 flex flex-col h-full md:h-[82vh] overflow-hidden md:ml-2 bg-white rounded-xl">
                <!-- Desktop header -->
                <div class="hidden md:flex items-center justify-between p-3 border-b border-gray-200 bg-[#F1F1F1]">
                    <div class="flex items-center space-x-3">
                        <div class="h-10 w-10 bg-red-600 rounded-full flex items-center justify-center">
                            <img src="assets/images/admin-avatar.png" alt="Coca-Cola" class="h-7 w-7 rounded-full">
                        </div>
                        <div>
                            <div class="font-semibold">Coca-Cola</div>
                            <div class="text-xs text-gray-500">Asistente de Carrera</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="text-xs text-green-500 flex items-center">
                            <span class="h-2 w-2 bg-green-500 rounded-full mr-1"></span>
                            Test Bot
                        </div>
                    </div>
                </div>
                
                <!-- Messages -->
                <div id="chat-container" class="flex-1 overflow-y-auto p-4 bg-white">
                    <template x-for="(message, index) in messages" :key="index">
                        <div class="mb-4">
                            <!-- For Coca-Cola messages -->
                            <template x-if="message.sender === 'coca-cola'">
                                <div class="flex flex-col">
                                    <div class="flex items-start space-x-2">
                                        <div class="h-8 w-8 bg-red-600 rounded-full flex items-center justify-center flex-shrink-0">
                                            <img src="/assets/images/admin-avatar.png" alt="Coca-Cola" class="h-6 w-6 rounded-full">
                                        </div>
                                        <div class="flex flex-col">
                                            <div class="bg-blue-100 text-blue-800 rounded-lg rounded-tl-none px-4 py-3 max-w-md" x-html="message.content"></div>
                                            <template x-if="message.time">
                                                <div class="text-xs text-gray-500 mt-1" x-text="message.time"></div>
                                            </template>
                                        </div>
                                    </div>
                                    
                                    <!-- Dynamic buttons for this message -->
                                    <template x-if="message.buttons && message.buttons.length > 0">
                                        <div class="flex flex-wrap gap-2 mb-4 ml-10 mt-2">
                                            <template x-for="(button, buttonIndex) in message.buttons" :key="buttonIndex">
                                                <button 
                                                    @click="newMessage = button.text; sendMessage()" 
                                                    :class="button.class + ' rounded-full px-4 py-1 text-sm hover:bg-blue-50 focus:outline-none'"
                                                    x-text="button.text">
                                                </button>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </template>
                            
                            <!-- For user messages -->
                            <template x-if="message.sender === 'user' && message.content !== ''">
                                <div class="flex items-start justify-end space-x-2">
                                    <div class="flex flex-col items-end">
                                        <div class="bg-blue-500 text-white rounded-lg rounded-tr-none px-4 py-3 max-w-md" x-text="message.content"></div>
                                        <template x-if="message.time">
                                            <div class="text-xs text-gray-500 mt-1" x-text="message.time"></div>
                                        </template>
                                    </div>
                                    <div class="h-8 w-8 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                                        <img src="assets/images/candidate-avatar.png" alt="User" class="h-6 w-6 rounded-full">
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
                
                <!-- Input area -->
                <div class="border-t border-gray-200 p-4 bg-white">
                    <div class="flex items-center gap-3 relative">
                        <input 
                            type="file" 
                            id="fileUpload" 
                            class="hidden" 
                            @change="handleFileUpload($event)"
                            accept=".pdf,.doc,.docx,.txt,.jpg,.jpeg,.png"
                        >
                        <button @click="$refs.fileInput.click()" type="button" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg>
                        </button>
                        <!-- File input that's properly referenced in Alpine -->
                        <input 
                            type="file" 
                            x-ref="fileInput" 
                            class="hidden" 
                            @change="handleFileUpload($event)"
                            accept=".pdf,.doc,.docx,.txt,.jpg,.jpeg,.png"
                        >
                        <input 
                            type="text" 
                            x-model="newMessage" 
                            @keyup.enter="sendMessage"
                            placeholder="Escribe tu respuesta aquí..." 
                            class="w-full border border-gray-300 rounded-full py-2 px-4 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-300"
                        >
                        <button 
                            @click="sendMessage"
                            class="absolute right-2 top-1/2 cursor-pointer transform -translate-y-1/2 text-blue-500 hover:text-blue-600">
                            <svg width="24" height="24" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21.7419 18.2818L23.7439 12.2734C25.4939 7.02576 26.3689 4.40192 24.9829 3.01709C23.5969 1.63226 20.9743 2.50609 15.7254 4.25609L9.71828 6.25809C5.48328 7.66976 3.36578 8.37676 2.76495 9.41159C2.48426 9.89538 2.33643 10.4448 2.33643 11.0041C2.33643 11.5634 2.48426 12.1128 2.76495 12.5966C3.36578 13.6326 5.48328 14.3384 9.71828 15.7513C10.3996 15.9776 10.7391 16.0908 11.0238 16.2809C11.2991 16.4653 11.5359 16.7021 11.7203 16.9774C11.9104 17.2621 12.0236 17.6016 12.2499 18.2818C13.6616 22.5168 14.3686 24.6354 15.4034 25.2374C15.8874 25.5183 16.437 25.6663 16.9965 25.6663C17.5561 25.6663 18.1057 25.5183 18.5896 25.2374C19.6244 24.6354 20.3291 22.5179 21.7419 18.2818Z" stroke="black" stroke-width="1.5"/>
                                <path d="M18.9138 10.3228C19.0743 10.1586 19.1638 9.93801 19.1631 9.70846C19.1624 9.47891 19.0715 9.25884 18.91 9.09568C18.7486 8.93252 18.5294 8.83936 18.2999 8.83626C18.0704 8.83317 17.8488 8.92039 17.683 9.07914L18.9138 10.3228ZM12.4388 16.7255L18.9138 10.3228L17.683 9.07914L11.208 15.4818L12.4388 16.7255Z" fill="black"/>
                            </svg>
                        </button>
                    </div>
                    <!-- File name display (optional) -->
                    <div x-show="fileName" class="mt-2 text-sm text-gray-600">
                        <span x-text="fileName"></span>
                        <span x-show="isUploading" class="ml-2 text-blue-500">Uploading...</span>
                    </div>
                </div>
            </div>
            
            <!-- Mobile sidebar backdrop -->
            <div 
                @click="sidebarOpen = false"
                :class="{'opacity-50 pointer-events-auto': sidebarOpen, 'opacity-0 pointer-events-none': !sidebarOpen}"
                class="fixed inset-0 bg-black transition-opacity duration-300 ease-in-out md:hidden z-20">
            </div>

             <!-- Success Popup -->
            <div x-show="showSuccessPopup" 
                class="fixed inset-0 flex items-center justify-center z-50 bg-black/50"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
                
                <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full mx-4 relative"
                    @click.away="closePopup()">
                    
                    <!-- Close button -->
                    <button @click="closePopup()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    
                    <!-- Success content -->
                    <div class="text-center">
                        <h2 class="text-xl font-bold mb-3">¡Postulación recibida!</h2>
                        <p class="text-gray-600 mb-2">Gracias por participar del proceso de selección de TalentTalent.</p>
                        <p class="text-gray-600 mb-4">Nos comunicaremos vía correo electrónico para informarte sobre los siguientes pasos.</p>
                        <p class="font-medium">¡Muchos éxitos!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-1/2 translate-x-[-50%] text-xs text-gray-500 text-center">© Powered by Test Talent</div>
</x-layout>