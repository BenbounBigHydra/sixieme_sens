<template>
  <div class="w-full bg-[#fffbf1] min-h-screen">

    <!-- Part 1: Hero Section -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 lg:px-32 xl:px-40 pt-12 pb-16">
      <div class="flex flex-col lg:flex-row justify-between items-center gap-2 lg:gap-20">

        <!-- Left Column -->
        <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start text-center lg:text-left order-1 lg:order-1 mt-6 lg:mt-0">
          <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-8 origin-center lg:origin-left" />

          <h1 class="font-['Jersey_20'] text-[36px] md:text-[64px] leading-[1.1] font-normal text-black mb-6 tracking-wide">
            Trois trophées pour une  mission commune
          </h1>

          <p class="font-['Inter'] text-lg text-black mb-0 lg:mb-10 max-w-lg">
            Chaque année, les Trophées HUG récompensent les entreprises genevoises selon trois critères distincts : mobilisation, fidélité et rigueur.
          </p>

          <a href="/contact" class="hidden lg:inline-block bg-[#0073e6] text-white font-['Inter'] text-base md:text-xl font-bold tracking-wide px-8 py-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] border-2 border-black hover:bg-[#0073e6]/90 transition-all">
            Rejoindre le mouvement
          </a>

          <div class="hidden lg:flex mt-8 w-full justify-start">
            <img src="/images/BlackArrowDown.svg" alt="Arrow Down" class="w-8 h-auto" />
          </div>
        </div>

        <!-- Right Column -->
        <div class="w-full lg:w-1/2 flex justify-center order-2 lg:order-2 mt-2 lg:mt-0">
          <div class="relative w-[380px] h-[380px] md:w-[500px] md:h-[500px] lg:w-[550px] lg:h-[550px] group cursor-pointer">
            <img src="/images/trophy_gold.png" alt="Trophée" class="absolute inset-0 w-full h-full object-contain group-hover:opacity-0 transition-opacity duration-300">
            <img src="/images/trophy_gold_sparks.png" alt="Trophée Étincelles" class="absolute inset-0 w-full h-full object-contain opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          </div>
        </div>

        <!-- Mobile Button & Arrow -->
        <div class="w-full flex flex-col items-center justify-center order-3 lg:hidden mt-2">
          <a href="/contact" class="inline-block bg-[#0073e6] text-white font-['Inter'] text-base md:text-xl font-bold tracking-wide px-8 py-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] border-2 border-black hover:bg-[#0073e6]/90 transition-all">
            Rejoindre le mouvement
          </a>
          <div class="mt-8">
            <img src="/images/BlackArrowDown.svg" alt="Arrow Down" class="w-8 h-auto" />
          </div>
        </div>

      </div>
    </section>

    <!-- Part 2: 3 Trophies -->
    <section class="max-w-desktop mx-auto px-8 md:px-20 lg:px-32 xl:px-40 py-16">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Or -->
        <div class="bg-[#fffbf1] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="bg-[#ffd012] p-4 border-b-[4px] border-black">
            <h2 class="font-['Jersey_20'] font-normal text-[28px] md:text-[32px] text-black">Trophée Or</h2>
          </div>
          <div class="p-6 flex flex-row items-center gap-6 flex-1">
            <div class="w-24 shrink-0">
              <img src="/images/trophy_gold.png" alt="Trophée Or" class="w-full h-auto object-contain">
            </div>
            <div class="font-['Inter'] text-sm md:text-base text-black">
              Le ratio le plus élevé entre poches collectées et collaborateurs. La meilleure mobilisation de l'année.
            </div>
          </div>
        </div>

        <!-- Ambassadeur -->
        <div class="bg-[#fffbf1] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="bg-[#ffd012] p-4 border-b-[4px] border-black">
            <h2 class="font-['Jersey_20'] font-normal text-[28px] md:text-[32px] text-black">Trophée Ambassadeur</h2>
          </div>
          <div class="p-6 flex flex-row items-center gap-6 flex-1">
            <div class="w-24 shrink-0">
              <img src="/images/trophy_conviction (1).png" alt="Trophée Ambassadeur" class="w-full h-auto object-contain">
            </div>
            <div class="font-['Inter'] text-sm md:text-base text-black">
              Années consécutives de participation multipliées par le ratio de collecte. La fidélité récompensée dans la durée.
            </div>
          </div>
        </div>

        <!-- Conviction -->
        <div class="bg-[#fffbf1] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="bg-[#ffd012] p-4 border-b-[4px] border-black">
            <h2 class="font-['Jersey_20'] font-normal text-[28px] md:text-[32px] text-black">Trophée Conviction</h2>
          </div>
          <div class="p-6 flex flex-row items-center gap-6 flex-1">
            <div class="w-24 shrink-0">
              <img src="/images/trophy_conviction.png" alt="Trophée Conviction" class="w-full h-auto object-contain">
            </div>
            <div class="font-['Inter'] text-sm md:text-base text-black">
              Rapport entre le nombre de donneurs effectivement présents et le nombre de collaborateurs initialement inscrits.
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- Part 3: Palmarès -->
    <section class="max-w-desktop mx-auto px-8 md:px-20 lg:px-32 xl:px-40 py-16">
      <div class="flex flex-col mb-10 w-full relative">
        <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-6 origin-center md:origin-left self-center md:self-start" />

        <div class="flex flex-col md:flex-row md:justify-between w-full items-center md:items-end">
          <h2 class="font-['Jersey_20'] font-normal text-[36px] md:text-[56px] text-black leading-none">Palmarès {{ selectedYear }}</h2>

          <!-- Desktop Filter Button (Above Score) -->
          <div class="hidden md:block relative">
            <button @click="isFilterOpen = !isFilterOpen" class="bg-[#0073e6] text-white font-['Inter'] px-6 py-2 flex items-center gap-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] border-2 border-black hover:bg-[#0073e6]/90 transition-all">
              Filtres
              <img src="/images/WhiteChevronDown.svg" alt="Chevron Down" class="w-4 h-4" />
            </button>
            <!-- Dropdown -->
            <div v-if="isFilterOpen" class="absolute right-0 top-full mt-2 w-full min-w-[120px] bg-white border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-10 flex flex-col">
              <button v-for="year in availableYears" :key="year" @click="selectYear(year)" class="px-4 py-2 text-left text-black font-['Inter'] font-bold hover:bg-gray-100 border-b border-gray-200 last:border-b-0">
                {{ year }}
              </button>
            </div>
          </div>
        </div>

        <!-- Mobile Filter Button -->
        <div class="mt-6 md:hidden relative w-full flex justify-center">
          <button @click="isFilterOpen = !isFilterOpen" class="bg-[#0073e6] text-white font-['Inter'] px-6 py-2 flex items-center gap-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] border-2 border-black transition-all">
            Filtres
            <img src="/images/WhiteChevronDown.svg" alt="Chevron Down" class="w-4 h-4" />
          </button>
          <div v-if="isFilterOpen" class="absolute top-full mt-2 w-auto min-w-[120px] bg-white border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-10 flex flex-col">
            <button v-for="year in availableYears" :key="year" @click="selectYear(year)" class="px-4 py-2 text-center text-black font-['Inter'] font-bold hover:bg-gray-100 border-b border-gray-200 last:border-b-0">
              {{ year }}
            </button>
          </div>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full table-fixed min-w-0 md:min-w-[700px] text-left border-collapse">
          <thead>
            <tr class="border-b-[3px] border-[#B3D9FF]">
              <th class="py-1 md:py-4 px-0.5 md:px-2 w-[10%] md:w-auto"></th>
              <th class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[12px] sm:text-[14px] md:text-[24px] text-black font-normal w-[35%] md:w-auto break-words">Gagnant</th>
              <th class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[12px] sm:text-[14px] md:text-[24px] text-black font-normal text-center leading-tight w-[20%] md:w-auto">Total<br class="block md:hidden">employés</th>
              <th class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[12px] sm:text-[14px] md:text-[24px] text-black font-normal text-center leading-tight w-[20%] md:w-auto">Poches<br class="block md:hidden">collectées</th>
              <th class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[12px] sm:text-[14px] md:text-[24px] text-black font-normal text-center w-[15%] md:w-auto">Score</th>
            </tr>
          </thead>
          <tbody>
            <!-- Or -->
            <tr v-if="goldWinner" class="border-b-[3px] border-[#B3D9FF]">
              <td class="py-1 md:py-4 px-0.5 md:px-2">
                <img src="/images/trophy_gold.png" alt="Or" class="w-6 h-6 md:w-20 md:h-20 object-contain mx-auto">
              </td>
              <td class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[13px] sm:text-[15px] md:text-[28px] text-black leading-tight break-words">{{ goldWinner.name }}</td>
              <td class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[13px] sm:text-[15px] md:text-[28px] text-black text-center">{{ formatNumber(goldWinner.nb_employee) }}</td>
              <td class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[13px] sm:text-[15px] md:text-[28px] text-black text-center">{{ formatNumber(goldWinner.nb_blood_pouch) }}</td>
              <td class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[13px] sm:text-[15px] md:text-[28px] text-black text-center">{{ (goldWinner.ratio * 100).toFixed(1) }}%</td>
            </tr>
            <!-- Ambassadeur -->
            <tr v-if="ambassadorWinner" class="border-b-[3px] border-[#B3D9FF]">
              <td class="py-1 md:py-4 px-0.5 md:px-2">
                <img src="/images/trophy_conviction (1).png" alt="Ambassadeur" class="w-6 h-6 md:w-20 md:h-20 object-contain mx-auto">
              </td>
              <td class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[13px] sm:text-[15px] md:text-[28px] text-black leading-tight break-words">{{ ambassadorWinner.name }}</td>
              <td class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[13px] sm:text-[15px] md:text-[28px] text-black text-center">{{ formatNumber(ambassadorWinner.nb_employee) }}</td>
              <td class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[13px] sm:text-[15px] md:text-[28px] text-black text-center">{{ formatNumber(ambassadorWinner.nb_blood_pouch) }}</td>
              <td class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[13px] sm:text-[15px] md:text-[28px] text-black text-center">{{ ambassadorWinner.consecutive }} ans</td>
            </tr>
            <!-- Conviction -->
            <tr v-if="convictionWinner" class="border-b-[3px] border-[#B3D9FF]">
              <td class="py-1 md:py-4 px-0.5 md:px-2">
                <img src="/images/trophy_conviction.png" alt="Conviction" class="w-6 h-6 md:w-20 md:h-20 object-contain mx-auto">
              </td>
              <td class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[13px] sm:text-[15px] md:text-[28px] text-black leading-tight break-words">{{ convictionWinner.name }}</td>
              <td class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[13px] sm:text-[15px] md:text-[28px] text-black text-center">{{ formatNumber(convictionWinner.nb_employee) }}</td>
              <td class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[13px] sm:text-[15px] md:text-[28px] text-black text-center">{{ formatNumber(convictionWinner.nb_blood_pouch) }}</td>
              <td class="py-1 md:py-4 px-0.5 md:px-2 font-['Jersey_20'] text-[13px] sm:text-[15px] md:text-[28px] text-black text-center">{{ (convictionWinner.ratio * 100).toFixed(1) }}%</td>
            </tr>

            <tr v-if="!goldWinner && !ambassadorWinner && !convictionWinner" class="border-b-[3px] border-[#B3D9FF]">
              <td colspan="5" class="py-8 px-2 font-['Jersey_20'] text-[20px] md:text-[28px] text-center text-gray-500">Aucun lauréat pour cette année.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Part 4: Section avantages -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 lg:px-32 xl:px-40 py-20 flex flex-col items-center md:items-start">
      <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
      <h2 class="font-['Jersey_20'] font-normal text-[36px] md:text-[56px] text-black leading-none text-center md:text-left w-full">Ce que les Trophées distinguent</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-12">
        <!-- Block 1 -->
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4 h-[120px] flex items-center justify-center md:justify-start">
            <h3 class="font-['Jersey_20'] font-normal text-[28px] text-black leading-tight text-center md:text-left w-full">La distinction publique</h3>
          </div>
          <div class="p-6 text-center md:text-left flex-1">
            <p class="font-inter text-sm text-black">Vos collaborateurs, vos partenaires et les médias genevois voient votre nom en tête du palmarès.</p>
          </div>
        </div>
        <!-- Block 2 -->
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4 h-[120px] flex items-center justify-center md:justify-start">
            <h3 class="font-['Jersey_20'] font-normal text-[28px] text-black leading-tight text-center md:text-left w-full">Un symbole fort</h3>
          </div>
          <div class="p-6 text-center md:text-left flex-1">
            <p class="font-inter text-sm text-black">Un trophée physique remis par le Directeur Général des HUG lors d'une cérémonie officielle.</p>
          </div>
        </div>
        <!-- Block 3 -->
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4 h-[120px] flex items-center justify-center md:justify-start">
            <h3 class="font-['Jersey_20'] font-normal text-[28px] text-black leading-tight text-center md:text-left w-full">Une caisse de résonnance</h3>
          </div>
          <div class="p-6 text-center md:text-left flex-1">
            <p class="font-inter text-sm text-black">Un communiqué de presse co-signé HUG diffusé auprès des médias genevois.</p>
          </div>
        </div>
        <!-- Block 4 -->
        <div class="bg-[#ffd012] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4 h-[120px] flex items-center justify-center md:justify-start">
            <h3 class="font-['Jersey_20'] font-normal text-[28px] text-black leading-tight text-center md:text-left w-full">Une présence permanente</h3>
          </div>
          <div class="p-6 text-center md:text-left flex-1">
            <p class="font-inter text-sm text-black">Votre entreprise en première page du site pendant un an.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Part 5: Comment participer -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 lg:px-32 xl:px-40 py-20 flex flex-col items-center md:items-start pb-32">
      <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
      <h2 class="font-['Jersey_20'] font-normal text-[36px] md:text-[56px] text-black leading-none">Comment participer ?</h2>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8 mt-12 w-full">
        <!-- Block 1 -->
        <div class="bg-[#80c0ff] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
          <div class="bg-[#fffbf1] m-2 mb-3 py-2 flex items-center justify-center border-2 border-transparent">
            <h3 class="font-['Inter'] font-bold text-[16px] md:text-[20px] text-black leading-tight text-center">01</h3>
          </div>
          <div class="px-4 pb-4 flex-1 flex flex-col justify-start">
            <p class="font-['Inter'] text-[12px] md:text-sm text-black">
              <a href="/contact" class="underline hover:text-[#0073e6] transition-colors">Prendre contact avec le CTS</a>.
            </p>
          </div>
        </div>
        <!-- Block 2 -->
        <div class="bg-[#80c0ff] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
          <div class="bg-[#fffbf1] m-2 mb-3 py-2 flex items-center justify-center border-2 border-transparent">
            <h3 class="font-['Inter'] font-bold text-[16px] md:text-[20px] text-black leading-tight text-center">02</h3>
          </div>
          <div class="px-4 pb-4 flex-1 flex flex-col justify-start">
            <p class="font-['Inter'] text-[12px] md:text-sm text-black">Organiser une collecte.</p>
          </div>
        </div>
        <!-- Block 3 -->
        <div class="bg-[#80c0ff] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
          <div class="bg-[#fffbf1] m-2 mb-3 py-2 flex items-center justify-center border-2 border-transparent">
            <h3 class="font-['Inter'] font-bold text-[16px] md:text-[20px] text-black leading-tight text-center">03</h3>
          </div>
          <div class="px-4 pb-4 flex-1 flex flex-col justify-start">
            <p class="font-['Inter'] text-[12px] md:text-sm text-black">Mobiliser ses collaborateurs.</p>
          </div>
        </div>
        <!-- Block 4 -->
        <div class="bg-[#80c0ff] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
          <div class="bg-[#fffbf1] m-2 mb-3 py-2 flex items-center justify-center border-2 border-transparent">
            <h3 class="font-['Inter'] font-bold text-[16px] md:text-[20px] text-black leading-tight text-center">04</h3>
          </div>
          <div class="px-4 pb-4 flex-1 flex flex-col justify-start">
            <p class="font-['Inter'] text-[12px] md:text-sm text-black">Participer automatiquement<br>aux Trophées HUG.</p>
          </div>
        </div>
      </div>
    </section>

  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

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

const palmares = computed(() => pageData.value?.palmares || {});

const isFilterOpen = ref(false);
const availableYears = computed(() => Object.keys(palmares.value).map(Number).reverse());;
const selectedYear = ref(null);
const defaultYear = availableYears.value[0] ?? null;
selectedYear.value = defaultYear;

const selectYear = (year) => {
  selectedYear.value = year;
  isFilterOpen.value = false;
};

const goldWinner = computed(() => palmares.value[selectedYear.value]?.gold || null);
const ambassadorWinner = computed(() => palmares.value[selectedYear.value]?.ambassador || null);
const convictionWinner = computed(() => palmares.value[selectedYear.value]?.conviction || null);

const formatNumber = (num) => {
  if (!num && num !== 0) return '-';
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "'");
};
</script>
