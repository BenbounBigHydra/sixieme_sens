<template>
  <div class="w-full bg-[#fffbf1] min-h-screen">

    <!-- Part 1: Hero Section -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 pt-12 pb-16 flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
      <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start text-center lg:text-left">
        <img src="/images/YellowSquares.png" alt="Squares" class="mx-auto lg:mx-0 h-6 w-auto object-contain mb-6 origin-center lg:origin-left" />

        <h1 class="font-['Jersey_20'] text-[48px] md:text-[64px] text-black leading-[1.1] mb-6 tracking-wide">
          Le Label Partenaire du<br class="hidden md:block"/> Don, c’est quoi ?
        </h1>

        <p class="font-['Inter'] text-sm md:text-base text-black mb-8 leading-relaxed">
          L'engagement mérite d'être reconnu dès la première collecte. C'est précisément le rôle du Label Partenaire du Don : une certification officielle, délivrée par les HUG, qui atteste qu'une entreprise a organisé au moins une collecte de sang pour ses collaborateurs. Un geste concret, reconnu, qui s'inscrit naturellement dans une démarche RSE.
        </p>

        <div class="flex lg:hidden w-full justify-center mb-8">
          <img src="/images/Don.png" alt="Label Partenaire du Don" class="w-full max-w-[300px] h-auto object-contain drop-shadow-xl" />
        </div>

        <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4 mb-10 w-full sm:w-auto">
          <a href="/collecte" class="inline-block bg-[#0073e6] text-white font-['Inter'] font-semibold text-sm px-6 py-3 border-[2px] border-[#0073e6] hover:bg-[#0073e6]/90 transition-colors text-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
            Organiser une collecte
          </a>
          <a href="/companies" class="inline-block bg-[#fffbf1] text-[#0073e6] font-['Inter'] font-semibold text-sm px-6 py-3 border-[2px] border-[#0073e6] hover:bg-gray-50 transition-colors text-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
            Voir les entreprises labellisées
          </a>
        </div>

        <div class="text-black font-bold flex justify-center w-full lg:w-auto lg:justify-start">
          <img src="/images/BlackArrowDown.svg" alt="Arrow Down" class="w-8 h-auto" />
        </div>
      </div>

      <div class="hidden lg:flex lg:w-1/2 justify-center lg:justify-end mt-8 lg:mt-0">
        <img src="/images/Don.png" alt="Label Partenaire du Don" class="w-full max-w-[500px] h-auto object-contain drop-shadow-xl" />
      </div>
    </section>

    <!-- Part 2: Carousel -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 py-16">
      <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-10 gap-6 text-center md:text-left">
        <div class="w-full md:w-2/3 flex flex-col items-center md:items-start">
          <img src="/images/YellowSquares.png" alt="Squares" class="mx-auto md:mx-0 h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
          <h2 class="font-['Jersey_20'] text-[40px] md:text-[56px] text-black leading-none mb-4">Ils ont déjà fait le pas.</h2>
          <p class="font-['Inter'] text-sm md:text-base text-black hidden md:block">
            Ces entreprises ont organisé une collecte de sang pour leurs<br class="hidden md:block"/> collaborateurs et reçu la certification officielle des HUG.
          </p>
          <p class="font-['Inter'] text-sm text-black md:hidden">
            Ces entreprises ont organisé une collecte de<br/> sang pour leurs collaborateurs et reçu la<br/> certification officielle des HUG.
          </p>
        </div>
        <div class="w-full md:w-1/3 flex justify-center md:justify-end mt-4 md:mt-0">
          <a href="/companies" class="inline-block bg-[#0073e6] text-white font-['Inter'] text-sm md:text-base px-6 py-3 border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all text-center">
            Voir toutes les entreprises
          </a>
        </div>
      </div>

      <!-- Carousel Container -->
      <div class="overflow-hidden relative w-full mt-10">
        <div class="flex transition-transform duration-700 ease-in-out gap-6" :style="{ transform: `translateX(-${currentSlide * slidePercentage}%)` }">
          <div v-for="(item, index) in carouselItems" :key="index" class="flex-shrink-0" :style="{ width: `calc(${slidePercentage}% - ${(gapSize * (itemsPerView - 1)) / itemsPerView}px)` }">
            <div class="border-[4px] border-[#0073e6] bg-[#fffbf1] flex items-center justify-center p-2 md:p-6 aspect-square w-full h-full">
              <!-- Using a static image as requested -->
              <img src="/images/BCGE.png" alt="Company Logo" class="max-w-[80%] max-h-[80%] object-contain" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Part 3: Avantages -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 py-16 flex flex-col items-center md:items-start">
      <img src="/images/YellowSquares.png" alt="Squares" class="mx-auto md:mx-0 h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
      <h2 class="font-['Jersey_20'] font-bold text-[40px] md:text-[56px] text-black mb-12 leading-none text-center md:text-left">Ce que le Label vous<br class="hidden md:block"> apporte.</h2>

      <!-- Grid from HomeVitrine -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full">
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4">
            <h3 class="font-['Jersey_20'] font-bold text-[28px] md:text-[32px] text-black leading-tight text-center md:text-left">Une reconnaissance officielle</h3>
          </div>
          <div class="p-6 text-center md:text-left">
            <p class="font-inter text-sm text-black">Votre démarche est certifiée par les Hôpitaux Universitaires de Genève — l'institution de référence en matière de santé publique dans le canton.</p>
          </div>
        </div>
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4">
            <h3 class="font-['Jersey_20'] font-bold text-[28px] md:text-[32px] text-black leading-tight text-center md:text-left">Un actif RSE concret</h3>
          </div>
          <div class="p-6 text-center md:text-left">
            <p class="font-inter text-sm text-black">Le label s'intègre directement dans vos rapports et communications de responsabilité sociale. Pas une promesse — une preuve.</p>
          </div>
        </div>
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4">
            <h3 class="font-['Jersey_20'] font-bold text-[28px] md:text-[32px] text-black leading-tight text-center md:text-left">De la visibilité</h3>
          </div>
          <div class="p-6 text-center md:text-left">
            <p class="font-inter text-sm text-black">Votre entreprise apparaît dans la liste des Partenaires du Don sur ce site, consultée par d'autres entreprises, par les médias et par le grand public.</p>
          </div>
        </div>
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4">
            <h3 class="font-['Jersey_20'] font-bold text-[28px] md:text-[32px] text-black leading-tight text-center md:text-left">Un kit de comm' prêt à l'emploi</h3>
          </div>
          <div class="p-6 text-center md:text-left">
            <p class="font-inter text-sm text-black">Dès l'obtention du label, vous recevez un kit de communication complet, visuels pour LinkedIn et vos réseaux internes, modèle de newsletter, affiche pour vos locaux, tout adapté à votre identité.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Part 4: Comment l'obtenir -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 py-16 mb-12 flex flex-col items-center md:items-start text-center md:text-left">
      <img src="/images/YellowSquares.png" alt="Squares" class="mx-auto md:mx-0 h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
      <h2 class="font-['Jersey_20'] text-[40px] md:text-[56px] text-black leading-none mb-4">Comment l’obtenir ?</h2>
      <p class="font-['Inter'] text-sm md:text-base text-black mb-12">Quatre étapes, pas plus.</p>

      <div class="flex flex-col gap-8 w-full">
        <!-- Etape 1 -->
        <div class="border-[4px] border-black bg-[#8bc6ff] shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="bg-[#fffbf1] px-6 py-4 border-b-[4px] border-black">
            <h3 class="font-['Inter'] font-bold text-[24px] text-black tracking-tight">01 — Prendre contact avec le CTS</h3>
          </div>
          <div class="p-6">
            <p class="font-['Inter'] text-black text-sm md:text-base">Ensemble, vous définissez une date, un format et les modalités logistiques adaptées à votre entreprise.</p>
          </div>
        </div>

        <!-- Etape 2 -->
        <div class="border-[4px] border-black bg-[#8bc6ff] shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="bg-[#fffbf1] px-6 py-4 border-b-[4px] border-black">
            <h3 class="font-['Inter'] font-bold text-[24px] text-black tracking-tight">02 — Organiser une collecte</h3>
          </div>
          <div class="p-6">
            <p class="font-['Inter'] text-black text-sm md:text-base">Le CTS prend en charge tout le volet médical. Vous mettez à disposition un espace et des plages horaires pour vos collaborateurs.</p>
          </div>
        </div>

        <!-- Etape 3 -->
        <div class="border-[4px] border-black bg-[#8bc6ff] shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="bg-[#fffbf1] px-6 py-4 border-b-[4px] border-black">
            <h3 class="font-['Inter'] font-bold text-[24px] text-black tracking-tight">03 — Mobiliser ses collaborateurs</h3>
          </div>
          <div class="p-6">
            <p class="font-['Inter'] text-black text-sm md:text-base">Un kit de communication clé en main vous est fourni, affiche, newsletter, visuels réseaux, pour maximiser la participation en interne.</p>
          </div>
        </div>

        <!-- Etape 4 -->
        <div class="border-[4px] border-black bg-[#8bc6ff] shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="bg-[#fffbf1] px-6 py-4 border-b-[4px] border-black">
            <h3 class="font-['Inter'] font-bold text-[24px] text-black tracking-tight">04 — Recevoir le label</h3>
          </div>
          <div class="p-6">
            <p class="font-['Inter'] text-black text-sm md:text-base">Une fois la collecte réalisée, le Label Partenaire du Don vous est officiellement décerné par les HUG.</p>
          </div>
        </div>
      </div>
    </section>

  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';

// Configuration du carousel
const carouselItems = ref([1, 2, 3, 4, 5, 6, 7, 8, 9]); // Dummy data pour l'instant
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
  }

  // Slide toutes les 5 secondes
  autoSlideInterval = setInterval(() => {
    currentSlide.value = (currentSlide.value + 1) % (carouselItems.value.length - itemsPerView.value + 1);

    // Si on arrive à la fin, on retourne au début après un petit délai
    if (currentSlide.value >= carouselItems.value.length - itemsPerView.value + 1) {
      currentSlide.value = 0;
    }
  }, 5000);
});

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
  if (windowWidth.value < 1024) return 2; // Tablet: 2 elements
  return 3; // Desktop: 3 elements
});

const slidePercentage = computed(() => {
  return 100 / itemsPerView.value;
});

const gapSize = 24; // correspond à gap-6 (6 * 4px = 24px)
</script>
