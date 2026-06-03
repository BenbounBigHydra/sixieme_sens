<template>
  <div class="min-h-screen bg-[#fffbf1] flex flex-col font-['Inter']">
    <!-- Header with HUG logo -->
    <header class="w-full flex justify-center pt-8 md:pt-12">
      <img src="/images/HUGLOGO.svg" alt="HUG Logo" class="h-12 md:h-16 object-contain" onerror="this.style.display='none'" />
    </header>

    <main class="flex-grow flex flex-col items-center justify-center px-4 py-8">
      <div class="w-full max-w-[600px] flex flex-col items-center">
        <!-- Title -->
        <h1 class="font-['Jersey_20'] text-black text-5xl md:text-6xl tracking-wide mb-6 text-center">
          Connexion
        </h1>

        <!-- Subtitle -->
        <p class="text-center text-black text-sm md:text-[15px] leading-relaxed mb-12 max-w-[520px]">
          Espace réservé aux administrateurs des HUG. Gérez les entreprises partenaires, suivez les collectes en cours et pilotez les éditions des Trophées depuis un seul tableau de bord.
        </p>

        <!-- Form -->
        <form :action="loginRoute" method="POST" class="w-full flex flex-col max-w-[380px]">
          <!-- CSRF Token -->
          <input type="hidden" name="_token" :value="csrfToken" />

          <!-- Errors -->
          <div v-if="errors.length > 0" class="w-full bg-red-100 text-red-700 border-[2px] border-red-500 p-3 mb-6 text-sm">
            <ul class="list-disc list-inside">
              <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
            </ul>
          </div>

          <!-- Email -->
          <div class="flex flex-col mb-6">
            <label for="email" class="text-black text-sm font-medium text-center mb-2">Adresse e-mail</label>
            <input 
              type="email" 
              id="email" 
              name="email" 
              class="w-full bg-[#fffbf1] border-[2px] border-black p-3 text-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] focus:outline-none focus:ring-0" 
              required
            />
          </div>

          <!-- Password -->
          <div class="flex flex-col mb-6">
            <label for="password" class="text-black text-sm font-medium text-center mb-2">Mot de passe</label>
            <input 
              type="password" 
              id="password" 
              name="password" 
              class="w-full bg-[#fffbf1] border-[2px] border-black p-3 text-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] focus:outline-none focus:ring-0" 
              required
            />
          </div>

          <!-- Remember me -->
          <div class="flex items-center justify-center mb-10 gap-3">
            <input 
              type="checkbox" 
              id="remember" 
              name="remember" 
              class="w-4 h-4 text-black focus:ring-black border-black cursor-pointer rounded-none" 
            />
            <label for="remember" class="text-[#6b7280] text-xs cursor-pointer select-none">
              Se souvenir de moi
            </label>
          </div>

          <!-- Submit Button -->
          <div class="flex justify-center">
            <button 
              type="submit" 
              class="bg-[#0073e6] text-white px-10 py-3 font-medium text-sm hover:bg-[#0073e6]/90 transition-colors border-none"
            >
              Se connecter
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</template>

<script setup>
defineProps({
  csrfToken: {
    type: String,
    required: true
  },
  loginRoute: {
    type: String,
    default: '/login'
  },
  errors: {
    type: Array,
    default: () => []
  }
});
</script>
