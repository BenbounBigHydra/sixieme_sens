<template>
  <header class="w-full h-24 bg-[#fffbf1] font-['Jersey_20'] tracking-wide border-b border-gray-100 sticky top-0 z-50 shadow-md">
    <div class="max-w-desktop mx-auto px-4 md:px-8 w-full h-full flex items-center justify-between relative bg-[#fffbf1] z-50">
      
      <a href="/" class="flex items-center h-full cursor-pointer hover:opacity-90 transition-opacity">
        <!-- Desktop Logo -->
        <img src="/images/hug_icon.png" alt="Logo HUG Desktop" class="hidden md:block h-12 w-auto object-contain" />
        <!-- Mobile Logo -->
        <img src="/images/hug_icon_Mobile.png" alt="Logo HUG Mobile" class="md:hidden h-12 w-auto object-contain" />
      </a>

      <nav class="hidden md:flex items-center space-x-8 text-2xl">
        <a href="/" :class="currentPath === '/' ? 'text-[#0073E6]' : 'text-[#000000]'" class="hover:text-[#0073E6] transition-colors">Accueil</a>
        <a href="/trophees" :class="currentPath === '/trophees' ? 'text-[#0073E6]' : 'text-[#000000]'" class="hover:text-[#0073E6] transition-colors">Trophées</a>
        <a href="/label" :class="currentPath === '/label' ? 'text-[#0073E6]' : 'text-[#000000]'" class="hover:text-[#0073E6] transition-colors">Label</a>
        <a href="/collecte" class="bg-[#0073E6] text-[#FFFFFF] px-6 py-2 rounded hover:bg-[#0073E6]/90 transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
          Organiser une collecte
        </a>
      </nav>

      <div class="md:hidden flex items-center">
        <button 
          @click="isMenuOpen = !isMenuOpen" 
          class="text-[#0073E6] hover:text-[#0073E6]/80 focus:outline-none transition-transform duration-300"
          :class="{ 'rotate-90': isMenuOpen }"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
      
    </div>

    <!-- Mobile Menu Overlay -->
    <div 
      v-show="isMenuOpen" 
      class="absolute top-24 left-0 w-full bg-[#0073E6] z-40 md:hidden flex flex-col font-['Inter'] shadow-lg"
    >
      <a href="/" class="block px-6 hover:bg-[#fffbf1]/10 transition-colors">
        <div class="flex items-center justify-between text-white text-[17px] py-5 border-b border-white">
          <span>Accueil</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </div>
      </a>
      <a href="/trophees" class="block px-6 hover:bg-[#fffbf1]/10 transition-colors">
        <div class="flex items-center justify-between text-white text-[17px] py-5 border-b border-white">
          <span>Trophées</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </div>
      </a>
      <a href="/label" class="block px-6 hover:bg-[#fffbf1]/10 transition-colors">
        <div class="flex items-center justify-between text-white text-[17px] py-5 border-b border-white">
          <span>Label</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </div>
      </a>
      <a href="/collecte" class="block px-6 hover:bg-[#fffbf1]/10 transition-colors">
        <div class="flex items-center justify-between text-white text-[17px] py-5 border-b border-white">
          <span>Organiser une collecte</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </div>
      </a>
    </div>
  </header>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const isMenuOpen = ref(false)
const currentPath = ref('')

onMounted(() => {
  currentPath.value = window.location.pathname
})
</script>
