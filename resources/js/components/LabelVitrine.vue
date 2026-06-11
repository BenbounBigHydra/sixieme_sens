<template>
  <div class="w-full bg-[#fffbf1] min-h-screen">

    <!-- Part 1: Hero Section -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 lg:px-32 xl:px-40 pt-12 pb-16 flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
      <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start text-center lg:text-left">
        <img src="/images/YellowSquares.png" alt="Squares" class="mx-auto lg:mx-0 h-6 w-auto object-contain mb-6 origin-center lg:origin-left" />

        <h1 class="font-['Jersey_20'] text-[36px] md:text-[64px] leading-[1.1] font-normal text-black mb-6 tracking-wide">
          Le Label Partenaire du Don, c’est quoi ?
        </h1>

        <p class="font-['Inter'] text-sm md:text-base text-black mb-8 leading-relaxed">
          L'engagement mérite d'être reconnu dès la première collecte. C'est précisément le rôle du Label Partenaire du Don : une certification officielle, délivrée par les HUG, qui atteste qu'une entreprise a organisé au moins une collecte de sang pour ses collaborateurs. Un geste concret, reconnu, qui s'inscrit naturellement dans une démarche RSE.
        </p>

        <div class="flex lg:hidden w-full justify-center mb-8">
          <img src="/images/Don.svg" alt="Label Partenaire du Don" class="w-full max-w-[300px] h-auto object-contain drop-shadow-xl" />
        </div>

        <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4 mb-10 w-full sm:w-auto">
          <a href="/contact" class="inline-block bg-[#0073e6] text-white font-['Inter'] font-semibold text-sm px-6 py-3 border-[2px] border-[#0073e6] hover:bg-[#0073e6]/90 transition-colors text-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
            Organiser une collecte
          </a>
          <a href="/companies" @click.prevent="goToCompanies" class="inline-flex items-center justify-center bg-[#fffbf1] text-[#0073e6] font-['Inter'] font-semibold text-sm px-6 py-3 border-[2px] border-[#0073e6] hover:bg-gray-50 transition-colors text-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] w-full sm:w-auto">
            <svg v-if="isLoadingCompanies" class="animate-spin -ml-1 mr-2 h-4 w-4 text-[#0073e6]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ isLoadingCompanies ? 'Chargement...' : 'Voir les entreprises labellisées' }}
          </a>
        </div>

        <div class="text-black font-bold flex justify-center w-full lg:w-auto lg:justify-start">
          <img src="/images/BlackArrowDown.svg" alt="Arrow Down" class="w-8 h-auto" />
        </div>
      </div>

      <div class="hidden lg:flex lg:w-1/2 justify-center lg:justify-end mt-8 lg:mt-0">
        <img src="/images/Don.svg" alt="Label Partenaire du Don" class="w-full max-w-[350px] lg:max-w-[400px] h-auto object-contain drop-shadow-xl" />
      </div>
    </section>

    <!-- Part 2: Carousel -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 lg:px-32 xl:px-40 pt-16">
      <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-10 gap-6 text-center md:text-left">
        <div class="w-full md:w-2/3 flex flex-col items-center md:items-start">
          <img src="/images/YellowSquares.png" alt="Squares" class="mx-auto md:mx-0 h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
          <h2 class="font-['Jersey_20'] text-[36px] md:text-[56px] text-black leading-none mb-4">Ils ont déjà fait le pas</h2>
          <p class="font-['Inter'] text-sm md:text-lg text-black mb-12 max-w-full text-center md:text-left">Le Label Partenaire du Don est décerné à toute entreprise participante au mouvement. Il accompagne votre communication RH, renforce votre marque employeur<br class="hidden lg:block"/> et vous positionne sur le leaderboard public.</p>
        </div>
        <div class="w-full md:w-1/3 flex justify-center md:justify-end mt-4 md:mt-0">
          <a href="/companies" @click.prevent="goToCompanies" class="inline-flex items-center justify-center bg-[#0073e6] text-white font-['Inter'] text-sm md:text-base px-6 py-3 border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all text-center w-full sm:w-auto">
            <svg v-if="isLoadingCompanies" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ isLoadingCompanies ? 'Chargement...' : 'Voir toutes les entreprises' }}
          </a>
        </div>
      </div>
    </section>

    <!-- Carousel Container Full Width -->
    <div class="relative w-full mb-16 max-w-desktop mx-auto group">
      <!-- Arrow Left -->
      <button @click="prevSlide" class="hidden md:block absolute left-4 top-1/2 -translate-y-1/2 z-20 p-2 text-[#0073e6] hover:scale-125 transition-transform bg-[#fffbf1] border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
          <path d="M14 6H12v2H10v2H8v4h2v2h2v2h2v-2h-2v-2h-2v-4h2V8h2V6z"/>
        </svg>
      </button>

      <div class="overflow-hidden relative w-full px-4 md:px-24">
        <div class="flex transition-transform duration-700 ease-in-out gap-6" :style="{ transform: `translateX(-${currentSlide * slidePercentage}%)` }">
          <div v-for="(item, index) in carouselItems" :key="index" class="flex-shrink-0" :style="{ width: `calc(${slidePercentage}% - ${(gapSize * (itemsPerView - 1)) / itemsPerView}px)` }">
            <div class="border-[4px] border-[#0073e6] bg-[#fffbf1] flex items-center justify-center p-2 md:p-6 aspect-square w-full h-full">
              <img :src="'/' + item.logo" :alt="item.name" class="max-w-[80%] max-h-[80%] object-contain" />
            </div>
          </div>
        </div>
      </div>

      <!-- Arrow Right -->
      <button @click="nextSlide" class="hidden md:block absolute right-4 top-1/2 -translate-y-1/2 z-20 p-2 text-[#0073e6] hover:scale-125 transition-transform bg-[#fffbf1] border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
          <path d="M10 6h2v2h2v2h2v4h-2v2h-2v2h-2v-2h2v-2h2v-4h-2V8h-2V6z"/>
        </svg>
      </button>

      <!-- Mobile Arrows Under Carousel -->
      <div class="flex md:hidden justify-center items-center gap-6 mt-6">
        <button @click="prevSlide" class="p-2 text-[#0073e6] hover:scale-125 transition-transform bg-[#fffbf1] border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path d="M14 6H12v2H10v2H8v4h2v2h2v2h2v-2h-2v-2h-2v-4h2V8h2V6z"/>
          </svg>
        </button>
        <button @click="nextSlide" class="p-2 text-[#0073e6] hover:scale-125 transition-transform bg-[#fffbf1] border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path d="M10 6h2v2h2v2h2v4h-2v2h-2v2h-2v-2h2v-2h2v-4h-2V8h-2V6z"/>
          </svg>
        </button>
      </div>
    </div>

    <!-- Part 3: Avantages -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 lg:px-32 xl:px-40 py-16 flex flex-col items-center md:items-start">
      <img src="/images/YellowSquares.png" alt="Squares" class="mx-auto md:mx-0 h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
      <h2 class="font-['Jersey_20'] font-normal text-[36px] md:text-[56px] text-black mb-12 leading-none text-center md:text-left">Ce que le Label vous<br class="hidden md:block"> apporte</h2>

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
            <h3 class="font-['Jersey_20'] font-normal text-[20px] md:text-[32px] text-black leading-tight text-center md:text-left w-full">Un kit de communication prêt à l'emploi</h3>
          </div>
          <div class="p-6 text-center md:text-left flex-1">
            <p class="font-inter text-[13px] md:text-sm text-black">Pour l'organisation de votre collecte, vous recevez un kit complet de templates personnalisables : visuels pour LinkedIn et vos réseaux internes, affiches pour vos locaux, emails de mobilisation.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Part 4: Comment l'obtenir -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 lg:px-32 xl:px-40 py-16 mb-12 flex flex-col items-center md:items-start text-center md:text-left">
      <img src="/images/YellowSquares.png" alt="Squares" class="mx-auto md:mx-0 h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
      <h2 class="font-['Jersey_20'] text-[36px] md:text-[56px] text-black leading-none mb-4">Comment l’obtenir ?</h2>
      <p class="font-['Inter'] text-sm md:text-base text-black mb-12">Quatre étapes, pas plus.</p>

      <div class="grid grid-cols-2 gap-4 md:gap-8 w-full">
        <!-- Etape 1 -->
        <div class="border-[4px] border-black bg-[#8bc6ff] shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="bg-[#fffbf1] px-4 md:px-6 py-4 border-b-[4px] border-black min-h-[60px] lg:min-h-[120px] flex items-center w-full">
            <a href="/contact" class="hover:text-[#0073e6] transition-colors group block w-full">
              <h3 class="font-['Inter'] font-bold text-[14px] sm:text-[16px] md:text-[24px] text-black group-hover:text-[#0073e6] tracking-tight leading-snug text-center md:text-left w-full">01<span class="hidden md:inline"> —</span><br class="block md:hidden"> Prendre contact<br class="block md:hidden"> avec le CTS</h3>
            </a>
          </div>
          <div class="p-4 md:p-6 flex-1">
            <p class="font-['Inter'] text-black text-[12px] md:text-base leading-tight md:leading-normal">Ensemble, vous définissez une date, un format et les modalités logistiques adaptées à votre entreprise.</p>
          </div>
        </div>

        <!-- Etape 2 -->
        <div class="border-[4px] border-black bg-[#8bc6ff] shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="bg-[#fffbf1] px-4 md:px-6 py-4 border-b-[4px] border-black min-h-[60px] lg:min-h-[120px] flex items-center w-full">
            <h3 class="font-['Inter'] font-bold text-[14px] sm:text-[16px] md:text-[24px] text-black tracking-tight leading-snug text-center md:text-left w-full">02<span class="hidden md:inline"> —</span><br class="block md:hidden"> Organiser<br class="block md:hidden"> une collecte</h3>
          </div>
          <div class="p-4 md:p-6 flex-1">
            <p class="font-['Inter'] text-black text-[12px] md:text-base leading-tight md:leading-normal">Le CTS prend en charge tout le volet médical. Vous mettez à disposition un espace et des plages horaires pour vos collaborateurs.</p>
          </div>
        </div>

        <!-- Etape 3 -->
        <div class="border-[4px] border-black bg-[#8bc6ff] shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="bg-[#fffbf1] px-4 md:px-6 py-4 border-b-[4px] border-black min-h-[60px] lg:min-h-[120px] flex items-center w-full">
            <h3 class="font-['Inter'] font-bold text-[14px] sm:text-[16px] md:text-[24px] text-black tracking-tight leading-snug text-center md:text-left w-full">03<span class="hidden md:inline"> —</span><br class="block md:hidden"> Mobiliser ses<br class="block md:hidden"> collaborateurs</h3>
          </div>
          <div class="p-4 md:p-6 flex-1">
            <p class="font-['Inter'] text-black text-[12px] md:text-base leading-tight md:leading-normal">Un kit de communication clé en main vous est fourni (affiche, newsletter, visuels réseaux), pour maximiser la participation en interne.</p>
          </div>
        </div>

        <!-- Etape 4 -->
        <div class="border-[4px] border-black bg-[#8bc6ff] shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="bg-[#fffbf1] px-4 md:px-6 py-4 border-b-[4px] border-black min-h-[60px] lg:min-h-[120px] flex items-center w-full">
            <h3 class="font-['Inter'] font-bold text-[14px] sm:text-[16px] md:text-[24px] text-black tracking-tight leading-snug text-center md:text-left w-full">04<span class="hidden md:inline"> —</span><br class="block md:hidden"> Recevoir<br class="block md:hidden"> le label</h3>
          </div>
          <div class="p-4 md:p-6 flex-1">
            <p class="font-['Inter'] text-black text-[12px] md:text-base leading-tight md:leading-normal">Une fois la collecte réalisée, le Label Partenaire du Don vous est officiellement décerné par les HUG.</p>
          </div>
        </div>
      </div>
    </section>

  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';

const props = defineProps({
  initialData: {
    type: [Array, String],
    default: () => []
  }
});

const companiesList = computed(() => {
  let list = [];
  if (typeof props.initialData === 'string') {
    try {
      list = JSON.parse(props.initialData);
    } catch (e) {
      list = [];
    }
  } else {
    list = props.initialData || [];
  }

  // Duplique la liste pour avoir plus d'éléments dans le carrousel (pour l'effet de défilement)
  return [...list, ...list, ...list];
});

// Configuration du carousel
const carouselItems = computed(() => companiesList.value);
const currentSlide = ref(0);
let autoSlideInterval = null;

// Détection de la largeur de l'écran pour ajuster le nombre d'éléments visibles
const windowWidth = ref(typeof window !== 'undefined' ? window.innerWidth : 1024);

const updateWidth = () => {
  windowWidth.value = window.innerWidth;
};

onMounted(() => {
  if (typeof window !== 'undefined') {
    window.addEventListener('resize', updateWidth);

    // Try to heavily cache the next page by making a real background fetch
    fetch('/companies', { priority: 'low' }).catch(() => {});
  }

  // Slide toutes les 2 secondes
  resetInterval();
});

const isLoadingCompanies = ref(false);

const goToCompanies = () => {
  isLoadingCompanies.value = true;
  window.location.href = '/companies';
};

const resetInterval = () => {
  if (autoSlideInterval) clearInterval(autoSlideInterval);
  autoSlideInterval = setInterval(() => {
    nextSlide();
  }, 2000);
};

const nextSlide = () => {
  currentSlide.value = (currentSlide.value + 1) % (carouselItems.value.length - itemsPerView.value + 1);
  if (currentSlide.value >= carouselItems.value.length - itemsPerView.value + 1) {
    currentSlide.value = 0;
  }
};

const prevSlide = () => {
  let maxSlide = carouselItems.value.length - itemsPerView.value;
  currentSlide.value = (currentSlide.value - 1 + maxSlide + 1) % (maxSlide + 1);
  resetInterval();
};

const nextSlideManual = () => {
  nextSlide();
  resetInterval();
};

onUnmounted(() => {
  if (typeof window !== 'undefined') {
    window.removeEventListener('resize', updateWidth);
  }
  if (autoSlideInterval) {
    clearInterval(autoSlideInterval);
  }
});

const itemsPerView = computed(() => {
  if (windowWidth.value < 768) return 3; // Mobile: 3 elements
  if (windowWidth.value < 1024) return 5; // Tablet: 5 elements
  return 5; // Desktop: 5 elements
});

const slidePercentage = computed(() => {
  return 100 / itemsPerView.value;
});

const gapSize = 24; // correspond à gap-6 (6 * 4px = 24px)
</script>
