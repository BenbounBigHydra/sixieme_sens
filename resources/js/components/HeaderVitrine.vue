<template>
  <header class="w-full h-24 px-6 flex items-center justify-between bg-[#fffbf1] font-['Jersey_20'] tracking-wide border-b border-gray-100">
    
    <div class="flex items-center h-full">
      <img src="/images/hug_icon.png" alt="Logo HUG" class="h-12 w-auto object-contain" />
    </div>

    <nav class="hidden md:flex items-center space-x-8 text-2xl">
      <a href="/" class="text-[#0073E6] hover:text-[#0073E6]/80 transition-colors">Accueil</a>
      <a href="/trophees" class="text-[#000000] hover:text-[#0073E6] transition-colors">Trophées</a>
      <a href="/label" class="text-[#000000] hover:text-[#0073E6] transition-colors">Label</a>
      <a href="/collecte" class="bg-[#0073E6] text-[#FFFFFF] px-6 py-2 rounded hover:bg-[#0073E6]/90 transition-colors">
        Organiser une collecte
      </a>
    </nav>

    <div class="md:hidden flex items-center">
      <button class="text-[#0073E6] hover:text-[#0073E6]/80 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
    
  </header>
</template>

<script>
export default {
  name: 'HeaderVitrine'
}
</script>
