<template>
  <!-- Composant principal pour la page d'accueil -->
  <div class="w-full bg-[#fffbf1] min-h-screen">

    <!-- Section principale (Hero) -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 lg:px-32 xl:px-40 pt-12 pb-20">

      <div class="flex flex-col lg:flex-row justify-between gap-12 lg:gap-20">

        <!-- Left Column (Titles & Stats) -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center lg:items-start text-center lg:text-left order-1 lg:order-none">
          <!-- Yellow Squares Image -->
          <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-8 origin-center lg:origin-left" />

          <!-- Main Title -->
          <h1 class="font-['Jersey_20'] text-[36px] md:text-[56px] lg:text-[48px] xl:text-[56px] 2xl:text-[64px] leading-[1.1] font-normal text-black mb-10 tracking-wide">
            Mobilisez votre équipe pour sauver des vies !
          </h1>

          <!-- Stats Replacement -->
          <div class="flex flex-row items-center justify-center lg:justify-start gap-3 mb-10 w-full relative">
            <div class="font-['Jersey_20'] text-[48px] md:text-[80px] text-[#0073e6] leading-none tracking-wide -mt-1">
              50%
            </div>
            <div class="flex flex-col justify-center text-left mt-1">
              <span class="font-['Jersey_20'] text-[20px] md:text-[32px] font-normal text-black leading-tight tracking-wide">de participation,</span>
              <span class="font-['Jersey_20'] text-[20px] md:text-[32px] font-normal text-black leading-tight tracking-wide flex items-center">
                <span><span class="text-[#0073e6]">130</span> vies sauvées.</span>
                <div class="relative group inline-flex ml-1 -mt-3">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer text-black hover:text-[#0073e6] transition-colors">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                    <path d="M12 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="12" cy="8" r="1" fill="currentColor"/>
                  </svg>
                  <div class="absolute bottom-full right-[-20px] md:right-auto md:left-1/2 md:-translate-x-1/2 mb-2 w-[250px] bg-white border-2 border-black p-3 text-sm text-black font-['Inter'] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                    Les 130 vies sauvées sont une estimation basée sur le fait qu'un don de sang peut sauver jusqu'à 3 vies.
                  </div>
                </div>
              </span>
            </div>
          </div>

          <!-- Action Button (Desktop Only) -->
          <div class="hidden lg:block">
            <a href="/contact" class="inline-block bg-[#0073e6] text-white font-['Jersey_20'] text-2xl tracking-wide px-8 py-3 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[4px] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] border-2 border-black hover:bg-[#0073e6]/90 transition-all">
              Organiser une collecte
            </a>
          </div>

          <!-- Arrow (Desktop Only) -->
          <div class="mt-8 hidden lg:block">
            <img src="/images/BlackArrowDown.svg" alt="Arrow Down" class="w-8 h-auto" />
          </div>
        </div>

        <!-- Right Column (Grids & Text) -->
        <div class="w-full lg:w-1/2 flex flex-col order-2 lg:order-none">
          <!-- Top Text removed -->

          <!-- Desktop Grid Container (Hidden on mobile) -->
          <div class="hidden lg:block relative w-full lg:max-w-[450px] ml-auto mb-4 lg:mt-[56px]">
            <!-- Background Grid (Icons) -->
            <div style="display: grid; grid-template-columns: repeat(15, minmax(0, 1fr)); grid-auto-rows: 1fr; gap: 6px 2px;">
              <!-- Render 150 Icons using Vue v-for -->
              <template v-for="i in 150" :key="i">
                <div v-if="i === desktopRobyIndex" class="relative w-full h-full flex items-center justify-center cursor-pointer" :class="(isHovered || isClicked) ? 'z-40' : 'z-0'" @mouseenter="handleRobotHover(true)" @mouseleave="handleRobotHover(false)" @click="handleRobotClick">
                  <img src="/images/dono_default.png" 
                       alt="Robot" 
                       class="w-[80%] h-[80%] object-contain cursor-pointer transform hover:scale-110 transition-transform origin-bottom" 
                       :class="{'animate-bounce': !isClicked}" />
                  <div v-show="isHovered || isClicked" class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-[#0073e6] text-white font-['Jersey_20'] tracking-wide text-2xl px-4 py-2 border-2 border-black whitespace-nowrap shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] pointer-events-none z-[100]">
                    Tu m'as trouvé !
                  </div>
                </div>
                <img v-else-if="i <= blueCountDesktop" src="/images/littleman_blue.png" alt="Blue Person" class="w-full h-auto object-contain scale-[2]" />
                <img v-else src="/images/littleman_grey.png" alt="Grey Person" class="w-full h-auto object-contain scale-[2]" />
              </template>
            </div>

            <!-- Foreground Overlay Grid (Center White Square) -->
            <div class="absolute inset-0 pointer-events-none" style="display: grid; grid-template-columns: repeat(15, minmax(0, 1fr)); grid-template-rows: repeat(10, minmax(0, 1fr)); gap: 6px 2px;">
              <div class="bg-[#fffbf1] ring-8 ring-[#fffbf1] flex flex-col items-center justify-center relative z-10 pointer-events-auto" style="grid-column: 5 / 12; grid-row: 4 / 7;">
                <span class="text-[#0073e6] font-['Jersey_20'] text-[60px] lg:text-[64px] leading-[0.8] mb-0">130</span>
                <span class="text-[#0073e6] font-['Jersey_20'] text-base leading-tight text-center tracking-wide -mt-1 lg:-mt-1">
                  Potentielles vies<br/>sauvées
                </span>
              </div>
            </div>
          </div>

          <!-- Mobile Grid Container (Hidden on desktop) -->
          <div class="block lg:hidden relative w-full max-w-[320px] mx-auto mb-4 mt-4">
            <!-- Background Grid (Icons) -->
            <div style="display: grid; grid-template-columns: repeat(8, minmax(0, 1fr)); grid-auto-rows: 1fr; gap: 0px 0px;">
              <template v-for="i in 32" :key="'mobile-'+i">
                <div v-if="i === mobileRobyIndex" class="relative w-full h-full flex items-center justify-center cursor-pointer" :class="(isHovered || isClicked) ? 'z-40' : 'z-0'">
                  <img src="/images/dono_default.png" 
                       alt="Robot" 
                       class="w-[70%] h-[70%] md:w-[60%] md:h-[60%] object-contain cursor-pointer transform hover:scale-110 transition-transform origin-bottom" 
                       :class="{'animate-bounce': !isClicked}"
                       @mouseenter="isHovered = true" 
                       @mouseleave="isHovered = false"
                       @click="handleRobotClick" />

                  <!-- Info Bubble -->
                  <div v-show="isHovered || isClicked" 
                       class="absolute bottom-full mb-2 bg-[#0073e6] text-white font-['Jersey_20'] tracking-wide text-xl md:text-2xl px-2 py-1 md:px-4 md:py-2 border-2 border-black whitespace-nowrap shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] pointer-events-none z-[100]"
                       :class="[
                         // Desktop: always centered
                         'md:left-1/2 md:-translate-x-1/2 md:right-auto',
                         // Mobile: align left if on left edge, right if on right edge, otherwise center
                         (i - 1) % 8 < 3 ? 'max-md:left-0 max-md:translate-x-0' : '',
                         (i - 1) % 8 > 4 ? 'max-md:right-0 max-md:translate-x-0' : '',
                         (i - 1) % 8 >= 3 && (i - 1) % 8 <= 4 ? 'max-md:left-1/2 max-md:-translate-x-1/2' : ''
                       ]">
                    Tu m'as trouvé !
                  </div>
                </div>
                <img v-else-if="i <= blueCountMobile" src="/images/littleman_blue.png" alt="Blue Person" class="w-full h-auto object-contain scale-[1.5]" />
                <img v-else src="/images/littleman_grey.png" alt="Grey Person" class="w-full h-auto object-contain scale-[1.5]" />
              </template>
            </div>

            <!-- Foreground Overlay Grid Mobile (Center White Square) -->
            <div class="absolute inset-0 pointer-events-none" style="display: grid; grid-template-columns: repeat(8, minmax(0, 1fr)); grid-template-rows: repeat(4, minmax(0, 1fr)); gap: 0px 0px;">
              <div class="bg-[#fffbf1] flex flex-col items-center justify-center relative z-10 pointer-events-auto" style="grid-column: 3 / 7; grid-row: 2 / 4;">
                <span class="text-[#0073e6] font-['Jersey_20'] text-[36px] leading-[0.8] mb-0 mt-1">130</span>
                <span class="text-[#0073e6] font-['Jersey_20'] text-[12px] leading-tight text-center tracking-wide mt-1">
                  Potentielles vies<br/>sauvées
                </span>
              </div>
            </div>
          </div>

          <!-- Bottom Text removed -->
        </div>

        <!-- Action Button & Arrow (Mobile Only) -->
        <div class="w-full flex flex-col items-center justify-center order-3 lg:hidden mt-8">
          <a href="/contact" class="inline-block bg-[#0073e6] text-white font-['Jersey_20'] text-2xl tracking-wide px-8 py-3 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[4px] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] border-2 border-black hover:bg-[#0073e6]/90 transition-all">
            Organiser une collecte
          </a>
          <div class="mt-8">
            <img src="/images/BlackArrowDown.svg" alt="Arrow Down" class="w-8 h-auto" />
          </div>
        </div>

      </div>
    </section>

    <!-- Section Classement 2025 -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 lg:px-32 xl:px-40 py-16">

      <!-- Conteneur style fenêtre rétro -->
      <div class="border-[4px] border-black bg-[#fffbf1] shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] max-w-5xl mx-auto">
        <!-- Barre de titre de la fenêtre -->
        <div class="bg-[#322947] h-8 flex items-center justify-end px-4 gap-2 border-b-[4px] border-black">
          <span class="w-3 h-3 bg-green-500"></span>
          <span class="w-3 h-3 bg-hugCream"></span>
          <span class="w-3 h-3 bg-red-500"></span>
        </div>

        <!-- Contenu du classement -->
        <div class="p-6 md:p-12 md:py-20 overflow-hidden">

          <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-16 md:mb-24 gap-4 md:gap-8">
            <!-- Title block on the left -->
            <div class="w-full md:w-1/2 flex flex-col items-center md:items-start text-center md:text-left">
              <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
              <h2 class="font-['Jersey_20'] text-[32px] md:text-[56px] text-black leading-none m-0">Trophées</h2>
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

            <!-- Trophée 2 : Ambassadeur -->
            <div class="flex flex-col items-center w-1/3 md:w-auto">
              <p class="font-['Inter'] font-bold text-[12px] md:text-[24px] mb-2 md:mb-4 relative z-10 text-center">{{ ambassadorWinner }}</p>
              <img src="/images/trophy_conviction (1).png" alt="Trophée Ambassadeur" class="w-[50px] h-[50px] md:w-[160px] md:h-[160px] lg:w-[200px] lg:h-[200px] object-contain mb-2 md:mb-4">
              <p class="font-['Jersey_20'] text-[12px] md:text-[28px] text-black mt-1 md:mt-2 text-center leading-tight">Trophée <br/>Ambassadeur</p>
            </div>

            <!-- Trophée 1 : Or -->
            <div class="flex flex-col items-center mb-0 md:-mt-8 w-1/3 md:w-auto">
              <p class="font-['Inter'] font-bold text-[12px] md:text-[24px] -mb-2 md:-mb-8 relative z-10 text-center leading-tight">{{ goldWinner }}</p>
              <div class="relative w-[70px] h-[70px] md:w-[240px] md:h-[240px] lg:w-[320px] lg:h-[320px] mb-2 md:mb-4 group cursor-pointer md:translate-y-6 lg:translate-y-8">
                <img src="/images/trophy_gold.png" alt="Trophée Or" class="absolute inset-0 w-full h-full object-contain group-hover:opacity-0 transition-opacity duration-300">
                <img src="/images/trophy_gold_sparks.png" alt="Trophée Or Sparks" class="absolute inset-0 w-full h-full object-contain opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              </div>
              <p class="font-['Jersey_20'] text-[12px] md:text-[28px] text-black mt-1 md:mt-2 text-center leading-tight">Trophée <br/>Or</p>
            </div>

            <!-- Trophée 3 : Conviction -->
            <div class="flex flex-col items-center w-1/3 md:w-auto">
              <p class="font-['Inter'] font-bold text-[12px] md:text-[24px] mb-2 md:mb-4 relative z-10 text-center">{{ convictionWinner }}</p>
              <img src="/images/trophy_conviction.png" alt="Trophée Conviction" class="w-[50px] h-[50px] md:w-[160px] md:h-[160px] lg:w-[200px] lg:h-[200px] object-contain mb-2 md:mb-4">
              <p class="font-['Jersey_20'] text-[12px] md:text-[28px] text-black mt-1 md:mt-2 text-center leading-tight">Trophée <br/>Conviction</p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- Section Avantages du Label -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 lg:px-32 xl:px-40 py-20 flex flex-col items-center md:items-start">
      <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
      <h2 class="font-['Jersey_20'] font-normal text-[36px] md:text-[56px] text-black mb-6 leading-none text-center md:text-left">Les avantages du Label Partenaire du Don</h2>
      <p class="font-['Inter'] text-sm md:text-lg text-black mb-12 max-w-[1000px] text-center md:text-left">Le Label Partenaire du Don est décerné à toute entreprise participante au mouvement. Il accompagne votre communication RH, renforce votre marque employeur et vous positionne sur le leaderboard public.</p>

      <!-- Grid from HomeVitrine -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full">
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4 min-h-[96px] flex items-center justify-center md:justify-start">
            <h3 class="font-['Jersey_20'] font-normal text-[20px] md:text-[32px] text-black leading-tight text-center md:text-left w-full">Une reconnaissance officielle</h3>
          </div>
          <div class="p-6 text-center md:text-left flex-1">
            <p class="font-inter text-[13px] md:text-sm text-black">Votre démarche est certifiée par les Hôpitaux Universitaires de Genève, l'institution de référence en matière de santé publique dans le canton.</p>
          </div>
        </div>
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4 min-h-[96px] flex items-center justify-center md:justify-start">
            <h3 class="font-['Jersey_20'] font-normal text-[20px] md:text-[32px] text-black leading-tight text-center md:text-left w-full">Un actif RSE concret</h3>
          </div>
          <div class="p-6 text-center md:text-left flex-1">
            <p class="font-inter text-[13px] md:text-sm text-black">Le Label s'intègre directement dans vos rapports et communications de responsabilité sociale. Pas une promesse, une preuve.</p>
          </div>
        </div>
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4 min-h-[96px] flex items-center justify-center md:justify-start">
            <h3 class="font-['Jersey_20'] font-normal text-[20px] md:text-[32px] text-black leading-tight text-center md:text-left w-full">De la visibilité</h3>
          </div>
          <div class="p-6 text-center md:text-left flex-1">
            <p class="font-inter text-[13px] md:text-sm text-black">Votre entreprise apparaît dans la liste des Partenaires du Don sur ce site, consultée par d'autres entreprises, par les médias et par le grand public.</p>
          </div>
        </div>
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4 min-h-[96px] flex items-center justify-center md:justify-start">
            <h3 class="font-['Jersey_20'] font-normal text-[20px] md:text-[32px] text-black leading-tight text-center md:text-left w-full">Un kit de communication prêt à l’emploi</h3>
          </div>
          <div class="p-6 text-center md:text-left flex-1">
            <p class="font-inter text-[13px] md:text-sm text-black">Pour l'organisation de votre collecte, vous recevez un kit complet de templates personnalisables : visuels pour LinkedIn et vos réseaux internes, affiches pour vos locaux, emails de mobilisation.</p>
          </div>
        </div>
      </div>
    </section>

  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const props = defineProps({
  initialData: {
    type: [Object, String],
    default: () => ({})
  }
});

const pageData = computed(() => {
  if (typeof props.initialData === 'string') {
    try {
      return JSON.parse(props.initialData);
    } catch (e) {
      return {};
    }
  }
  return props.initialData || {};
});

const currentYear = computed(() => pageData.value?.year || '2025');
const ambassadorWinner = computed(() => pageData.value?.winner?.ambassador || 'Rolex');
const goldWinner = computed(() => pageData.value?.winner?.gold || 'Pictet & Cie');
const convictionWinner = computed(() => pageData.value?.winner?.conviction || 'BCGE');

const isHovered = ref(false);
const isClicked = ref(false);
let clickTimeout = null;

const handleRobotHover = (state) => {
  isHovered.value = state;
};

const handleRobotClick = () => {
  isClicked.value = true;
  if (robyInterval) clearInterval(robyInterval); // Stop roby from moving
  if (clickTimeout) clearTimeout(clickTimeout);
  clickTimeout = setTimeout(() => {
    window.location.href = '/quizz';
  }, 1000);
};

const participationRate = 50;
const blueCountDesktop = Math.round((participationRate / 100) * 150);
const blueCountMobile = Math.round((participationRate / 100) * 32);

const desktopRobyIndex = ref(73);
const mobileRobyIndex = ref(23);
let robyInterval = null;

onMounted(() => {
  robyInterval = setInterval(() => {
    desktopRobyIndex.value = Math.floor(Math.random() * 150) + 1;
    mobileRobyIndex.value = Math.floor(Math.random() * 32) + 1;
  }, 5000);
});

onUnmounted(() => {
  if (robyInterval) clearInterval(robyInterval);
});
</script>
