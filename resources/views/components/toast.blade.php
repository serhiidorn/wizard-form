<div class="fixed top-4 right-4 z-50 space-y-3 w-80"
     x-data="toastManager()"
     x-init="init()">

    <template x-for="toast in toasts" :key="toast.id">
        <div x-transition:enter="transform ease-out duration-300"
             x-transition:enter-start="translate-x-full opacity-0"
             x-transition:enter-end="translate-x-0 opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-full"
             class="relative bg-white rounded-lg shadow-lg border overflow-hidden"
             :class="{
                 'border-red-200 bg-red-50': toast.type === 'error',
                 'border-green-200 bg-green-50': toast.type === 'success',
                 'border-blue-200 bg-blue-50': toast.type === 'info'
             }">

            <div class="absolute left-0 top-0 h-full w-1"
                 :class="{
                     'bg-red-500': toast.type === 'error',
                     'bg-green-500': toast.type === 'success',
                     'bg-blue-500': toast.type === 'info'
                 }"></div>

            <div class="p-4 pl-6">
                <div class="flex items-start justify-between">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 mt-0.5">
                            <svg class="h-5 w-5"
                                 :class="{
                                     'text-red-500': toast.type === 'error',
                                     'text-green-500': toast.type === 'success',
                                     'text-blue-500': toast.type === 'info'
                                 }"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <template x-if="toast.type === 'error'">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </template>
                                <template x-if="toast.type === 'success'">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </template>
                                <template x-if="toast.type === 'info'">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </template>
                            </svg>
                        </div>

                        {{-- Сообщение --}}
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900" x-text="toast.message"></p>
                        </div>
                    </div>

                    {{-- Кнопка закрытия --}}
                    <button @click="removeToast(toast.id)"
                            class="ml-4 flex-shrink-0 text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600 transition-colors">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </template>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('toastManager', () => ({
            toasts: [],

            init() {
                window.showToast = (message, type = 'info') => {
                    this.show(message, type);
                };
            },

            show(message, type = 'info') {
                const id = Date.now() + Math.random();
                this.toasts.push({ id, message, type });

                setTimeout(() => {
                    this.removeToast(id);
                }, 5000);
            },

            removeToast(id) {
                this.toasts = this.toasts.filter(toast => toast.id !== id);
            }
        }));
    });
</script>