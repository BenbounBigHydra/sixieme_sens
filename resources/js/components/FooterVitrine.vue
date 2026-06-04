<template>
  <footer class="relative w-full pt-[350px] pb-16 mt-20" style="background-image: url('/images/Motif_cubique_degradeFooter.png'); background-size: cover; background-position: top;">

    <div class="max-w-desktop mx-auto px-8 md:px-16 lg:px-24 xl:px-32 2xl:px-40">

      <div class="bg-[#fffbf1] border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] px-6 md:px-20 py-12 flex flex-col">

        <div class="flex flex-col md:flex-row justify-between items-center md:items-start mb-6 md:mb-2 text-center md:text-left gap-6 md:gap-0">
          <h2 class="text-[40px] md:text-[48px] text-black font-['Jersey_20'] leading-tight md:leading-none">
            Votre entreprise peut <br />faire la différence.
          </h2>
          <div class="flex flex-col items-center md:items-start md:mt-2">
            <a href="/contact" class="inline-block bg-[#0073E6] text-white font-['Jersey_20'] tracking-wide text-2xl px-6 py-4 shadow-[4px_4px_0px_0px_rgba(51,51,51,1)] hover:bg-[#0073E6]/90 transition-colors whitespace-nowrap">
              Organiser une collecte
            </a>
            <!-- Mobile Logo HUG -->
            <img src="/images/hug_icon.png" alt="HUG Logo" class="block md:hidden h-24 object-contain mt-10" />
          </div>
        </div>

        <!-- Removed middle blue text -->

        <div class="border-t-[1px] border-black pt-8 flex flex-col md:flex-row justify-between items-center md:items-start font-['Inter'] text-sm md:text-base text-black w-full gap-8 md:gap-0 text-center md:text-left">

          <div class="w-full md:w-1/3 flex flex-col gap-1 items-center md:items-start">
            <p class="font-bold">Hôpitaux Universitaires de Genève</p>
            <p>Rue Gabrielle-Perret-Gentil 4</p>
            <p>1205 Genève</p>
            
            <div class="hidden md:block mt-4 mb-2">
              <img src="/images/hug_icon.png" alt="HUG Logo" class="h-8 object-contain" />
            </div>
            
            <p class="hidden md:block font-bold text-[13px] md:text-[14px] mt-4 md:mt-2 whitespace-normal md:whitespace-nowrap">Ce site est un projet académique. N'organisez pas de collecte ! :)</p>
          </div>

          <div class="w-full md:w-1/3 flex justify-center">
            <div class="flex flex-col gap-3 md:gap-1 items-center md:items-start">
              <a href="/mentions" class="text-[#0073E6] hover:opacity-80 transition-opacity">Mentions légales</a>
              <a href="/politique" class="text-[#0073E6] hover:opacity-80 transition-opacity">Confidentialité</a>
              <a href="/cookies" class="text-[#0073E6] hover:opacity-80 transition-opacity">Cookies</a>
            </div>
          </div>

          <div class="w-full md:w-1/3 text-center md:text-right">
            <p>HUG - Tous droits réservés</p>
          </div>

        </div>

      </div>

    </div>

  </footer>
</template>

<script setup>
// Logique du composant pied de page (actuellement vide)
</script>
