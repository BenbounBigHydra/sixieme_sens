<template>
    <header class="w-full h-20 md:h-24 bg-[#fffbf1] tracking-wide border-b border-gray-100 sticky top-0 z-50 shadow-md">
        <div
            class="max-w-desktop mx-auto px-4 md:px-8 lg:px-20 xl:px-32 w-full h-full flex items-center justify-between relative bg-[#fffbf1] z-50">
            <!-- Logo -->
            <a href="/admin"
                class="flex items-center h-full shrink-0 cursor-pointer hover:opacity-90 transition-opacity">
                <img src="/images/hug_icon.png" alt="Logo HUG Desktop"
                    class="hidden md:block h-12 w-auto object-contain shrink-0" />
                <img src="/images/hug_icon_Mobile.png" alt="Logo HUG Mobile"
                    class="md:hidden h-10 w-auto object-contain shrink-0" />
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-8 items-center h-full">
                <a href="/admin" :class="currentPath === '/admin' ? 'text-[#0073e6]' : 'text-[#393939]'"
                    class="font-['Jersey_20'] text-[28px] hover:text-[#0073e6] cursor-pointer transition-colors tracking-wide">
                    Dashboard
                </a>
                <a href="/admin/companies"
                    :class="currentPath === '/admin/companies' ? 'text-[#0073e6]' : 'text-[#393939]'"
                    class="font-['Jersey_20'] text-[28px] hover:text-[#0073e6] cursor-pointer transition-colors tracking-wide">
                    Entreprises
                </a>
                <a href="/admin/collections"
                    :class="currentPath === '/admin/collections' ? 'text-[#0073e6]' : 'text-[#393939]'"
                    class="font-['Jersey_20'] text-[28px] hover:text-[#0073e6] cursor-pointer transition-colors tracking-wide">
                    Collectes
                </a>
                <a href="/admin/result" :class="currentPath === '/admin/result' ? 'text-[#0073e6]' : 'text-[#393939]'"
                    class="font-['Jersey_20'] text-[28px] hover:text-[#0073e6] cursor-pointer transition-colors tracking-wide">
                    Résultats
                </a>
                <!-- Logout Button -->
                <button @click="logout"
                    class="hidden md:flex items-center gap-2 text-[#393939] hover:text-[#0073e6] transition-colors font-inter text-sm px-4 py-2 hover:bg-[#0073e6]/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </nav>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center h-full">
                <button @click="isMenuOpen = !isMenuOpen" class="text-[#0073E6] focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div v-show="isMenuOpen"
            class="absolute top-20 left-0 w-full bg-[#0073E6] z-40 md:hidden flex flex-col font-['Inter'] shadow-lg border-t border-white/20">
            <a href="/admin" class="block px-6 hover:bg-[#fffbf1]/10 transition-colors">
                <div class="flex items-center justify-between text-white text-[17px] py-5 border-b border-white/30">
                    <span :class="{ 'font-bold': currentPath === '/admin' }">Dashboard</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
            <a href="/admin/companies" class="block px-6 hover:bg-[#fffbf1]/10 transition-colors">
                <div class="flex items-center justify-between text-white text-[17px] py-5 border-b border-white/30">
                    <span :class="{ 'font-bold': currentPath === '/admin/companies' }">Entreprises</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
            <a href="/admin/collections" class="block px-6 hover:bg-[#fffbf1]/10 transition-colors">
                <div class="flex items-center justify-between text-white text-[17px] py-5 border-b border-white/30">
                    <span :class="{ 'font-bold': currentPath === '/admin/collections' }">Collectes</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
            <a href="/admin/result" class="block px-6 hover:bg-[#fffbf1]/10 transition-colors">
                <div class="flex items-center justify-between text-white text-[17px] py-5 border-b border-white/30">
                    <span :class="{ 'font-bold': currentPath === '/admin/result' }">Résultats</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
            <button @click="logout" class="text-left px-6 hover:bg-[#fffbf1]/10 transition-colors">
                <div class="flex items-center justify-between text-white text-[17px] py-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>
            </button>
        </div>
    </header>
</template>

<script>
export default {
    name: 'HeaderAdmin',
    data() {
        return {
            isMenuOpen: false
        };
    },
    computed: {
        currentPath() {
            return window.location.pathname;
        }
    },
    methods: {
        logout() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/logout';

            const token = document.querySelector('meta[name="csrf-token"]');
            if (token) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = '_token';
                input.value = token.content;
                form.appendChild(input);
            }

            document.body.appendChild(form);
            form.submit();
        }
    }
}
</script>
