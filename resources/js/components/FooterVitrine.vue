<template>
  <!-- Pied de page avec fond en pixel art -->
  <footer class="w-full relative pt-32 pb-16 bg-[#B5D8FC] bg-[url('/footerDesktop.png')] bg-top bg-no-repeat bg-cover">
    <div class="max-w-[700px] mx-auto px-4 relative z-10">
      
      <!-- Conteneur principal du pied de page -->
      <div class="bg-[#FCFBF6] border-[4px] border-hugBlue p-8 md:p-16 shadow-[8px_8px_0px_0px_rgba(0,0,0,0.1)] flex flex-col items-center text-center">
        
        <h2 class="font-inter font-bold text-[32px] md:text-[40px] leading-[1.2] text-black mb-8">
          Votre entreprise peut<br/>faire la différence.
        </h2>
        
        <a href="/contact" class="bg-hugBlue text-white font-bold font-inter text-[16px] px-8 py-4 shadow-[4px_4px_0px_0px_#1E40AF] hover:opacity-90 transition mb-12">
          Organiser une collecte
        </a>

        <hr class="w-full border-black mb-6" />

        <!-- Liens secondaires du pied de page -->
        <div class="w-full flex flex-col md:flex-row justify-start md:gap-8 gap-2 font-inter text-sm text-black text-left">
          <a href="/contact" class="hover:underline">Contact</a>
          <a href="#" class="hover:underline">Mentions légales</a>
          <a href="#" class="hover:underline">Autres trucs de footer</a>
        </div>
      </div>

    </div>
  </footer>
</template>

<script setup>
// Logique du composant pied de page (actuellement vide)
</script>
