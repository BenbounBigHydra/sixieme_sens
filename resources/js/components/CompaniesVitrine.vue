<template>
  <div class="w-full bg-[#fffbf1] min-h-screen">
    <section class="max-w-desktop mx-auto px-4 md:px-8 pt-12 pb-8">
      
      <!-- Titre de la page -->
      <div class="flex flex-col items-center md:items-start text-center md:text-left mb-10">
        <img src="/images/YellowSquares.png" alt="Squares" class="mx-auto md:mx-0 h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
        <h1 class="font-['Jersey_20'] text-[48px] md:text-[64px] text-black leading-[1.1] mb-6 tracking-wide">
          Entreprises partenaires
        </h1>
      </div>

      <!-- Filtres -->
      <div class="flex flex-col sm:flex-row gap-6 mb-12 relative z-20">
        <!-- Filtre Année -->
        <div class="relative w-full sm:w-auto">
          <button @click="isYearOpen = !isYearOpen" class="w-full bg-[#0073e6] text-white font-['Jersey_20'] text-[24px] px-6 py-3 border-[2px] border-[#0073e6] flex items-center justify-between min-w-[200px] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all">
            <span class="mt-1">{{ selectedYear || '2025' }}</span>
            <span class="ml-4 mt-1">↓</span>
          </button>
          <div v-show="isYearOpen" class="absolute top-full left-0 mt-2 w-full min-w-max bg-[#fffbf1] border-2 border-[#0073e6] z-50 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] max-h-[200px] overflow-y-auto">
            <div v-for="year in years" :key="year" @click="selectedYear = year; isYearOpen = false" class="px-4 py-3 hover:bg-[#0073e6] hover:text-white cursor-pointer font-['Jersey_20'] text-[24px] text-[#0073e6] hover:text-white border-b border-gray-200 transition-colors whitespace-nowrap">
              {{ year }}
            </div>
          </div>
        </div>

        <!-- Filtre Prix -->
        <div class="relative w-full sm:w-auto">
          <button @click="isPrizeOpen = !isPrizeOpen" class="w-full bg-[#fffbf1] text-[#0073e6] font-['Jersey_20'] text-[24px] px-6 py-3 border-[2px] border-[#0073e6] flex items-center justify-between min-w-[200px] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all">
            <span class="mt-1">{{ selectedPrize || 'Prix' }}</span>
            <span class="text-[#0073e6] ml-4 mt-1">↓</span>
          </button>
          <div v-show="isPrizeOpen" class="absolute top-full left-0 mt-2 w-full min-w-max bg-[#fffbf1] border-2 border-[#0073e6] z-50 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            <div v-for="prize in prizes" :key="prize" @click="selectedPrize = prize; isPrizeOpen = false" class="px-4 py-3 hover:bg-[#0073e6] hover:text-white cursor-pointer font-['Jersey_20'] text-[24px] text-[#0073e6] border-b border-gray-200 transition-colors whitespace-nowrap">
              {{ prize }}
            </div>
            <!-- Option to reset prize filter -->
            <div @click="selectedPrize = null; isPrizeOpen = false" class="px-4 py-3 hover:bg-[#0073e6] hover:text-white cursor-pointer font-['Jersey_20'] text-[24px] text-[#0073e6] italic transition-colors whitespace-nowrap">
              Tous les prix
            </div>
          </div>
        </div>

        <!-- Filtre Industrie -->
        <div class="relative w-full sm:w-auto">
          <button @click="isIndustryOpen = !isIndustryOpen" class="w-full bg-[#fffbf1] text-[#0073e6] font-['Jersey_20'] text-[24px] px-6 py-3 border-[2px] border-[#0073e6] flex items-center justify-between min-w-[200px] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all">
            <span class="mt-1">{{ selectedIndustry || 'Industrie' }}</span>
            <span class="text-[#0073e6] ml-4 mt-1">↓</span>
          </button>
          <div v-show="isIndustryOpen" class="absolute top-full left-0 mt-2 w-full min-w-max bg-[#fffbf1] border-2 border-[#0073e6] z-50 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] max-h-[200px] overflow-y-auto">
            <div v-for="industry in industries" :key="industry" @click="selectedIndustry = industry; isIndustryOpen = false" class="px-4 py-3 hover:bg-[#0073e6] hover:text-white cursor-pointer font-['Jersey_20'] text-[24px] text-[#0073e6] border-b border-gray-200 transition-colors whitespace-nowrap">
              {{ industry }}
            </div>
            <!-- Option to reset industry filter -->
            <div @click="selectedIndustry = null; isIndustryOpen = false" class="px-4 py-3 hover:bg-[#0073e6] hover:text-white cursor-pointer font-['Jersey_20'] text-[24px] text-[#0073e6] italic transition-colors whitespace-nowrap">
              Toutes les industries
            </div>
          </div>
        </div>
      </div>

      <!-- Grille des entreprises -->
      <div class="relative z-10 overflow-hidden" style="min-height: 400px;">
        <transition :name="transitionName" mode="out-in">
          <div :key="currentPage" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 md:gap-6 w-full px-4 md:px-0">
            <div v-for="i in itemsPerPage" :key="i" class="relative border-[4px] border-[#0073e6] bg-[#fffbf1] aspect-square flex items-center justify-center p-4 group cursor-pointer overflow-hidden transition-colors duration-300 hover:bg-[#0073e6]">
              <!-- Default image -->
              <img src="/images/BCGE.png" alt="Company" class="max-w-[40%] md:max-w-[45%] max-h-[40%] md:max-h-[45%] object-contain transition-opacity duration-300 group-hover:opacity-0" />
              
              <!-- Hover content -->
              <div class="absolute inset-0 flex flex-col items-center justify-center text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-2 pointer-events-none">
                <h3 class="font-['Jersey_20'] text-white text-[28px] md:text-[32px] leading-none mb-2">Company name</h3>
                <p class="font-['Inter'] text-white text-xs md:text-sm">Company infos</p>
              </div>
            </div>
          </div>
        </transition>
      </div>

      <!-- Pagination -->
      <div class="flex items-center justify-center gap-6 mt-16 mb-12">
        <button @click="prevPage" class="text-[#0073e6] hover:opacity-70 transition-opacity" :disabled="currentPage === 1" :class="{'opacity-30 cursor-not-allowed': currentPage === 1}">
          <!-- left arrow SVG -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
        
        <div class="flex items-center gap-6 font-['Jersey_20'] text-4xl">
          <button v-for="p in visiblePages" :key="p" @click="currentPage = p" 
            class="transition-colors px-2" 
            :class="p === currentPage ? 'text-[#0073e6]' : 'text-black hover:text-[#0073e6]'">
            {{ p }}
          </button>
        </div>
        
        <button @click="nextPage" class="text-[#0073e6] hover:opacity-70 transition-opacity" :disabled="currentPage === totalPages" :class="{'opacity-30 cursor-not-allowed': currentPage === totalPages}">
          <!-- right arrow SVG -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>

    </section>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted, onUnmounted } from 'vue';

// Responsive Grid
const windowWidth = ref(1024);

onMounted(() => {
  windowWidth.value = window.innerWidth;
  const handleResize = () => { windowWidth.value = window.innerWidth; };
  window.addEventListener('resize', handleResize);
  onUnmounted(() => window.removeEventListener('resize', handleResize));
});

const itemsPerPage = computed(() => {
  return windowWidth.value < 768 ? 8 : 18; // 8 items (4 rows of 2) on mobile, 18 (3 rows of 6) on desktop
});

// Filtres
const years = ref(['2026', '2025', '2024', '2023', '2022', '2021', '2020']);
const prizes = ref(['Or', 'Ambassadeur', 'Conviction']);
const industries = ref(['Banque / Finance', 'Horlogerie', 'Médical', 'Services', 'Tech']);

const selectedYear = ref('2025');
const selectedPrize = ref(null);
const selectedIndustry = ref(null);

const isYearOpen = ref(false);
const isPrizeOpen = ref(false);
const isIndustryOpen = ref(false);

// Pagination
const currentPage = ref(1);
const totalPages = ref(10);

const visiblePages = computed(() => {
  if (totalPages.value <= 3) {
    return Array.from({ length: totalPages.value }, (_, i) => i + 1);
  }
  if (currentPage.value === 1) {
    return [1, 2, 3];
  }
  if (currentPage.value === totalPages.value) {
    return [totalPages.value - 2, totalPages.value - 1, totalPages.value];
  }
  return [currentPage.value - 1, currentPage.value, currentPage.value + 1];
});

const prevPage = () => {
  if (currentPage.value > 1) currentPage.value--;
};
const nextPage = () => {
  if (currentPage.value < totalPages.value) currentPage.value++;
};

// Transition Logic
const transitionName = ref('slide-left');
watch(currentPage, (newVal, oldVal) => {
  if (newVal > oldVal) {
    transitionName.value = 'slide-left';
  } else {
    transitionName.value = 'slide-right';
  }
});
</script>

<style scoped>
.slide-left-enter-active,
.slide-left-leave-active,
.slide-right-enter-active,
.slide-right-leave-active {
  transition: all 0.3s ease-in-out;
}

.slide-left-enter-from {
  opacity: 0;
  transform: translateX(30px);
}
.slide-left-leave-to {
  opacity: 0;
  transform: translateX(-30px);
}

.slide-right-enter-from {
  opacity: 0;
  transform: translateX(-30px);
}
.slide-right-leave-to {
  opacity: 0;
  transform: translateX(30px);
}
</style>
