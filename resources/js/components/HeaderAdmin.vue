<template>
  <header class="w-full max-w-[1200px] mx-auto mt-4 mb-4 bg-[#fffbf1] flex items-center justify-between px-8 py-4">
    <!-- Logo -->
    <div class="flex items-center">
      <img src="/images/HUGLOGO.svg" alt="HUG Logo" class="h-12" />
    </div>

    <!-- Navigation -->
    <nav class="flex space-x-8">
      <a href="/admin" :class="currentPath === '/admin' ? 'text-[#0073e6]' : 'text-[#393939]'" class="font-jersey text-xl hover:text-[#0073e6] cursor-pointer transition-colors">
        Dashboard
      </a>
      <a href="/admin/companies" :class="currentPath === '/admin/companies' ? 'text-[#0073e6]' : 'text-[#393939]'" class="font-jersey text-xl hover:text-[#0073e6] cursor-pointer transition-colors">
        Entreprises
      </a>
      <a href="/admin/collections" :class="currentPath === '/admin/collections' ? 'text-[#0073e6]' : 'text-[#393939]'" class="font-jersey text-xl hover:text-[#0073e6] cursor-pointer transition-colors">
        Collectes
      </a>
      <a href="/admin/leaderboard" :class="currentPath === '/admin/leaderboard' ? 'text-[#0073e6]' : 'text-[#393939]'" class="font-jersey text-xl hover:text-[#0073e6] cursor-pointer transition-colors">
        Leaderboard
      </a>
      <a href="/admin/editorial-content" :class="currentPath === '/admin/editorial-content' ? 'text-[#0073e6]' : 'text-[#393939]'" class="font-jersey text-xl hover:text-[#0073e6] cursor-pointer transition-colors">
        Kit de communication
      </a>
    </nav>

    <!-- Profile Icon -->
    <div class="flex items-center">
      <img src="/images/Profile.svg" alt="Profile" class="h-10 w-10 cursor-pointer" />
    </div>
  </header>
</template>

<script>
export default {
  name: 'HeaderAdmin',
  computed: {
    currentPath() {
      return window.location.pathname;
    }
  }
}
</script>
