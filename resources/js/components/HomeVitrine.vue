<template>
  <!-- Composant principal pour la page d'accueil -->
  <div class="w-full bg-[#fffbf1] min-h-screen">
    
    <!-- Section principale (Hero) -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 pt-12 pb-20">

      <div class="flex flex-col lg:flex-row justify-between gap-12 lg:gap-20">
        
        <!-- Left Column (Titles & Stats) -->
        <div class="w-full lg:w-5/12 flex flex-col justify-center items-center lg:items-start text-center lg:text-left order-1 lg:order-none">
          <!-- Yellow Squares Image -->
          <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-8 origin-center lg:origin-left" />
          
          <!-- Main Title -->
          <h1 class="font-['Jersey_20'] text-[56px] leading-[105%] text-black mb-10 tracking-wide">
            Mobilisez votre équipe<br />pour le don du sang !
          </h1>
          
          <!-- Stats -->
          <div class="flex flex-row justify-center lg:justify-start gap-4 lg:gap-12 mb-10 w-full">
            <div class="flex items-center justify-center gap-2 lg:gap-4 flex-col text-center md:flex-row md:text-left">
              <span class="font-['Jersey_20'] text-[40px] md:text-[64px] text-[#0073e6] leading-none">142</span>
              <span class="font-['Inter'] text-xs md:text-sm font-bold text-black leading-tight">Entreprises<br/>mobilisées</span>
            </div>
            <div class="flex items-center justify-center gap-2 lg:gap-4 flex-col text-center md:flex-row md:text-left">
              <span class="font-['Jersey_20'] text-[40px] md:text-[64px] text-[#0073e6] leading-none">1500</span>
              <span class="font-['Inter'] text-xs md:text-sm font-bold text-black leading-tight">Collectes<br/>organisées</span>
            </div>
          </div>

          <!-- Action Button (Desktop Only) -->
          <div class="hidden lg:block">
            <a href="/collecte" class="inline-block bg-[#0073e6] text-white font-['Jersey_20'] text-2xl tracking-wide px-8 py-3 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] border-2 border-black hover:bg-[#0073e6]/90 transition-colors">
              Organiser une collecte
            </a>
          </div>
          
          <!-- Arrow (Desktop Only) -->
          <div class="mt-8 hidden lg:block">
            <img src="/images/BlackArrowDown.svg" alt="Arrow Down" class="w-8 h-auto" />
          </div>
        </div>

        <!-- Right Column (Grids & Text) -->
        <div class="w-full lg:w-7/12 flex flex-col order-2 lg:order-none">
          <!-- Top Text (Hidden on mobile) -->
          <div class="hidden lg:block text-left md:text-right mb-6">
            <span class="text-black font-bold text-3xl font-['Inter'] tracking-tight">50% de participation,</span>
          </div>
          
          <!-- Desktop Grid Container (Hidden on mobile) -->
          <div class="hidden lg:block relative w-full lg:w-[65%] ml-auto mb-4">
            <!-- Background Grid (Icons) -->
            <div style="display: grid; grid-template-columns: repeat(15, minmax(0, 1fr)); grid-auto-rows: 1fr; gap: 6px 2px;">
              <!-- Render 150 Icons using Vue v-for -->
              <template v-for="i in 150" :key="i">
                <img v-if="i <= 72" src="/images/littleman_blue.png" alt="Blue Person" class="w-full h-auto object-contain scale-[2]" />
                <div v-else-if="i === 73" class="relative w-full h-full flex items-center justify-center cursor-pointer z-40" @mouseenter="handleRobotHover(true)" @mouseleave="handleRobotHover(false)" @click="handleRobotClick">
                  <img src="/images/dono_default.png" alt="Robot" class="w-full h-full object-contain scale-[0.8]" />
                  <div v-show="isHovered || isClicked" class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-[#0073e6] text-white font-['Jersey_20'] tracking-wide text-2xl px-4 py-2 border-2 border-black whitespace-nowrap shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] pointer-events-none">
                    Tu m'as trouvé !
                  </div>
                </div>
                <img v-else-if="i <= 75" src="/images/littleman_blue.png" alt="Blue Person" class="w-full h-auto object-contain scale-[2]" />
                <img v-else src="/images/littleman_grey.png" alt="Grey Person" class="w-full h-auto object-contain scale-[2]" />
              </template>
            </div>
            
            <!-- Foreground Overlay Grid (Center White Square) -->
            <div class="absolute inset-0 pointer-events-none" style="display: grid; grid-template-columns: repeat(15, minmax(0, 1fr)); grid-template-rows: repeat(10, minmax(0, 1fr)); gap: 6px 2px;">
              <div class="bg-[#fffbf1] flex flex-col items-center justify-center z-10 pointer-events-auto" style="grid-column: 5 / 12; grid-row: 4 / 7;">
                <span class="text-[#0073e6] font-['Jersey_20'] text-[60px] lg:text-[64px] leading-[0.8] mb-0">130</span>
                <span class="text-[#0073e6] font-['Jersey_20'] text-base leading-tight text-center tracking-wide -mt-1 lg:-mt-1">
                  Potentielles vies<br/>sauvées
                </span>
              </div>
            </div>
          </div>

          <!-- Mobile Grid Container (Hidden on desktop) -->
          <div class="block lg:hidden relative w-[320px] mx-auto mb-4 mt-4">
            <!-- Background Grid (Icons) -->
            <div style="display: grid; grid-template-columns: repeat(8, minmax(0, 1fr)); grid-auto-rows: 1fr; gap: 0px 0px;">
              <template v-for="i in 32" :key="'mobile-'+i">
                <img v-if="i <= 22" src="/images/littleman_blue.png" alt="Blue Person" class="w-full h-auto object-contain scale-[1.5]" />
                <div v-else-if="i === 23" class="relative w-full h-full flex items-center justify-center cursor-pointer z-40" @mouseenter="handleRobotHover(true)" @mouseleave="handleRobotHover(false)" @click="handleRobotClick">
                  <img src="/images/dono_default.png" alt="Robot" class="w-full h-full object-contain scale-[0.6]" />
                  <div v-show="isHovered || isClicked" class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-[#0073e6] text-white font-['Jersey_20'] tracking-wide text-2xl px-4 py-2 border-2 border-black whitespace-nowrap shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] pointer-events-none">
                    Tu m'as trouvé !
                  </div>
                </div>
                <img v-else src="/images/littleman_grey.png" alt="Grey Person" class="w-full h-auto object-contain scale-[1.5]" />
              </template>
            </div>
            
            <!-- Foreground Overlay Grid Mobile (Center White Square) -->
            <div class="absolute inset-0 pointer-events-none" style="display: grid; grid-template-columns: repeat(8, minmax(0, 1fr)); grid-template-rows: repeat(4, minmax(0, 1fr)); gap: 0px 0px;">
              <div class="bg-[#fffbf1] flex flex-col items-center justify-center z-10 pointer-events-auto" style="grid-column: 3 / 7; grid-row: 2 / 4;">
                <span class="text-[#0073e6] font-['Jersey_20'] text-[40px] leading-[0.8] mb-0 mt-1">130</span>
                <span class="text-[#0073e6] font-['Jersey_20'] text-[14px] leading-tight text-center tracking-wide mt-1">
                  Potentielles vies<br/>sauvées
                </span>
              </div>
            </div>
          </div>
          
          <!-- Bottom Text -->
          <div class="w-[320px] lg:w-[65%] mx-auto lg:ml-auto text-right text-xs text-black font-['Inter'] mt-4 lg:mt-0">
            Chiffres renseignés sur la base d’une société de 1’000 employés.
          </div>
        </div>

        <!-- Action Button & Arrow (Mobile Only) -->
        <div class="w-full flex flex-col items-center justify-center order-3 lg:hidden mt-8">
          <a href="/collecte" class="inline-block bg-[#0073e6] text-white font-['Jersey_20'] text-2xl tracking-wide px-8 py-3 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] border-2 border-black hover:bg-[#0073e6]/90 transition-colors">
            Organiser une collecte
          </a>
          <div class="mt-8">
            <img src="/images/BlackArrowDown.svg" alt="Arrow Down" class="w-8 h-auto" />
          </div>
        </div>
        
      </div>
    </section>

    <!-- Section Classement 2025 -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 py-16">
      
      <!-- Conteneur style fenêtre rétro -->
      <div class="border-[4px] border-black bg-[#fffbf1] shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
        <!-- Barre de titre de la fenêtre -->
        <div class="bg-[#322947] h-8 flex items-center justify-end px-4 gap-2 border-b-[4px] border-black">
          <span class="w-3 h-3 bg-green-500"></span>
          <span class="w-3 h-3 bg-hugCream"></span>
          <span class="w-3 h-3 bg-red-500"></span>
        </div>
        
        <!-- Contenu du classement -->
        <div class="p-8 md:p-12 md:py-24">
          
          <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-16 md:mb-24 gap-4 md:gap-8">
            <!-- Title block on the left -->
            <div class="w-full md:w-1/2 flex flex-col items-center md:items-start text-center md:text-left">
              <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
              <h2 class="font-['Jersey_20'] text-[40px] md:text-[56px] text-black leading-none m-0">Classement 2025</h2>
            </div>
            
            <!-- Text block on the right -->
            <div class="w-full md:w-1/2 flex justify-center md:justify-end pb-1 text-center md:text-right">
              <p class="font-['Inter'] text-sm md:text-lg font-bold text-black leading-snug mt-4 md:mt-0 px-4 md:px-0">
                <a href="/trophees" class="text-[#0073e6] hover:underline cursor-pointer">Les Trophées HUG</a> distinguent chaque année<br class="hidden md:block"/>
                les entreprises genevoises les plus engagées pour le don de sang.
              </p>
            </div>
          </div>
          
          <!-- Conteneur flexible pour aligner les trophées -->
          <div class="flex flex-row justify-between md:justify-center items-end gap-2 md:gap-24 w-full">
            
            <!-- Trophée 2 : Rolex -->
            <div class="flex flex-col items-center w-1/3 md:w-auto">
              <p class="font-['Inter'] font-bold text-[14px] md:text-[24px] mb-4 md:mb-8 text-center">Rolex</p>
              <img src="/images/trophy_conviction (1).png" alt="Trophée Ambassadeur" class="w-[60px] h-[60px] md:w-[200px] md:h-[200px] object-contain mb-2 md:mb-4">
              <p class="font-['Jersey_20'] text-[12px] md:text-[28px] text-black mt-1 md:mt-2 text-center leading-tight">Trophée <br class="block md:hidden"/>Ambassadeur*</p>
            </div>

            <!-- Trophée 1 : Pictet & Cie (Hover effect) -->
            <div class="flex flex-col items-center mb-0 md:-mt-8 w-1/3 md:w-auto">
              <p class="font-['Inter'] font-bold text-[14px] md:text-[24px] mb-4 md:mb-8 text-center leading-tight">Pictet & Cie</p>
              <div class="relative w-[80px] h-[80px] md:w-[260px] md:h-[260px] mb-2 md:mb-4 group cursor-pointer">
                <img src="/images/trophy_gold.png" alt="Trophée Or" class="absolute inset-0 w-full h-full object-contain group-hover:opacity-0 transition-opacity duration-300">
                <img src="/images/trophy_gold_sparks.png" alt="Trophée Or Sparks" class="absolute inset-0 w-full h-full object-contain opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              </div>
              <p class="font-['Jersey_20'] text-[12px] md:text-[28px] text-black mt-1 md:mt-2 text-center leading-tight">Trophée <br class="block md:hidden"/>Or*</p>
            </div>

            <!-- Trophée 3 : BCGE -->
            <div class="flex flex-col items-center w-1/3 md:w-auto">
              <p class="font-['Inter'] font-bold text-[14px] md:text-[24px] mb-4 md:mb-8 text-center">BCGE</p>
              <img src="/images/trophy_conviction.png" alt="Trophée Conviction" class="w-[60px] h-[60px] md:w-[200px] md:h-[200px] object-contain mb-2 md:mb-4">
              <p class="font-['Jersey_20'] text-[12px] md:text-[28px] text-black mt-1 md:mt-2 text-center leading-tight">Trophée <br class="block md:hidden"/>Conviction*</p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- Section Avantages du Label -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 py-20 flex flex-col items-center md:items-start">
      <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
      <h2 class="font-['Jersey_20'] font-bold text-[48px] md:text-[56px] text-black mb-6 leading-none text-center md:text-left">Une reconnaissance officielle pour votre engagement.</h2>
      <p class="font-['Inter'] text-base md:text-lg text-black mb-12 max-w-3xl text-center md:text-left">Le Label Partenaire du Don est décerné à toute entreprise participante au mouvement.<br class="hidden md:block"/> Il accompagne votre communication RH, renforce votre marque employeur<br class="hidden md:block"/> et vous positionne sur le leaderboard public.</p>
      
      <!-- Grille responsive : 1 colonne sur mobile, 2 sur bureau -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full">
        
        <!-- Carte Avantage 1 -->
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4 flex-1 flex items-center justify-center">
            <h3 class="font-['Jersey_20'] font-bold text-[32px] text-black leading-tight text-center">01 — S'inscrire au programme</h3>
          </div>
        </div>
        
        <!-- Carte Avantage 2 -->
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4 flex-1 flex items-center justify-center">
            <h3 class="font-['Jersey_20'] font-bold text-[32px] text-black leading-tight text-center">02 — Organiser une collecte</h3>
          </div>
        </div>

        <!-- Carte Avantage 3 -->
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4 flex-1 flex items-center justify-center">
            <h3 class="font-['Jersey_20'] font-bold text-[32px] text-black leading-tight text-center">03 — Mobiliser ses collaborateurs</h3>
          </div>
        </div>

        <!-- Carte Avantage 4 -->
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4 flex-1 flex items-center justify-center">
            <h3 class="font-['Jersey_20'] font-bold text-[32px] text-black leading-tight text-center">04 — Recevoir le label et ses ressources</h3>
          </div>
        </div>

      </div>
    </section>

  </div>
</template>

<script setup>
import { ref } from 'vue';

const isHovered = ref(false);
const isClicked = ref(false);
let clickTimeout = null;

const handleRobotHover = (state) => {
  isHovered.value = state;
};

const handleRobotClick = () => {
  isClicked.value = true;
  if (clickTimeout) clearTimeout(clickTimeout);
  clickTimeout = setTimeout(() => {
    isClicked.value = false;
  }, 3000);
};
</script>
