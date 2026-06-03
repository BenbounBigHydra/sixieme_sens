<template>
  <div class="w-full bg-[#fffbf1] min-h-screen relative overflow-clip">

    <!-- Part 1 -->
    <section class="relative w-full -mt-24 pt-[144px] md:pt-[224px] pb-24 md:pb-32">
      <!-- Background Union.png -->
      <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
        <img src="/images/Union.png" alt="Union Background" class="w-full h-full object-cover object-right transform scale-90 md:scale-[0.85] origin-right" onerror="this.style.display='none'" />
      </div>

      <div class="max-w-desktop mx-auto px-8 md:px-16 lg:px-24 xl:px-32 2xl:px-40 relative z-10 flex flex-col md:flex-row">
        <div class="w-full lg:w-7/12 bg-[#fffbf1] border-[3px] border-[#0073e6] p-6 md:p-10 relative z-20 flex flex-col md:flex-row items-center justify-start gap-8 md:gap-16 min-h-[350px]">

          <!-- Text Content -->
          <div class="flex flex-col justify-center h-full">
            <h1 class="font-['Jersey_20'] text-[48px] md:text-[56px] text-black leading-none mb-2 tracking-wide">
              Collecte {{ company?.name || 'HEIG-VD' }}
            </h1>
            <p class="font-['Jersey_20'] text-[48px] md:text-[56px] text-[#0073e6] mb-8 leading-none tracking-wide">
              {{ collection?.date || '15 juin 2026' }}
            </p>
            <div class="flex items-center gap-3 mb-10">
              <img src="/images/locationBlack.svg" alt="Location" class="w-5 h-5 object-contain" onerror="this.style.display='none'" />
              <span class="font-['Inter'] text-sm text-black font-medium">
                {{ collection?.location || 'Av. des Sports 20, 1401 Yverdon-les-Bains' }}
              </span>
            </div>
            <div class="flex mt-auto">
              <a :href="quizzUrl" class="bg-[#0073e6] text-white px-6 py-3 font-['Inter'] text-sm md:text-base font-bold border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:bg-[#0073e6]/90 transition-all text-center">
                Je souhaite donner
              </a>
            </div>
          </div>

          <!-- Roby Mascot -->
          <div class="relative flex items-center justify-center shrink-0 h-full mt-8 md:mt-0"
               @mouseenter="handleRobyHeroHover(true)"
               @mouseleave="handleRobyHeroHover(false)"
               @click="handleRobyHeroClick">
            <img src="/images/dono_smiling.png" alt="Roby" class="h-48 md:h-64 object-contain cursor-pointer transition-transform hover:scale-105 origin-bottom" />

            <!-- Speech Bubble -->
            <div v-show="isRobyHeroHovered || isRobyHeroClicked"
                 class="absolute bottom-full left-1/2 -translate-x-1/2 mb-4 md:mb-0 md:right-auto md:left-[90%] md:bottom-auto md:top-1/4 md:-translate-x-0 md:ml-6 bg-[#1a81e7] text-white p-4 border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] w-max max-w-[280px] z-50 pointer-events-none">
              <p class="font-['Jersey_20'] tracking-wide text-xl leading-tight text-left">
                Salut ! Je suis Roby, bienvenue sur le<br/>
                site {{ company?.name || 'HEIG-VD' }}. J'essaye de<br/>
                donner mon sang, tout comme toi. On<br/>
                part en voyage ?
              </p>

              <!-- Arrow for desktop (left) -->
              <div class="hidden md:block absolute top-6 -left-[15px] w-0 h-0 border-y-[12px] border-y-transparent border-r-[15px] border-r-black"></div>
              <div class="hidden md:block absolute top-[27px] -left-[10px] w-0 h-0 border-y-[9px] border-y-transparent border-r-[12px] border-r-[#1a81e7] z-10"></div>

              <!-- Arrow for mobile (bottom) -->
              <div class="block md:hidden absolute -bottom-[15px] left-1/2 -translate-x-1/2 w-0 h-0 border-x-[12px] border-x-transparent border-t-[15px] border-t-black"></div>
              <div class="block md:hidden absolute -bottom-[10px] left-1/2 -translate-x-1/2 w-0 h-0 border-x-[9px] border-x-transparent border-t-[12px] border-t-[#1a81e7] z-10"></div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Part 2: Pourquoi donner son sang -->
    <section class="max-w-desktop mx-auto px-8 md:px-16 lg:px-24 xl:px-32 2xl:px-40 py-16 relative z-10">
      <div class="flex flex-col lg:flex-row gap-12 lg:gap-20 items-center lg:items-start">

        <!-- Left Column -->
        <div class="w-full lg:w-1/2 flex flex-col">
          <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-6 origin-center lg:origin-left self-center lg:self-start" onerror="this.style.display='none'" />
          <h2 class="font-['Jersey_20'] text-[48px] md:text-[56px] text-black mb-8 leading-none tracking-wide text-center lg:text-left">
            Pourquoi donner son sang ?
          </h2>
          <div class="font-['Inter'] text-base md:text-lg text-black space-y-6 mb-10 leading-relaxed text-center lg:text-left">
            <p>Chaque don de sang peut sauver jusqu'à trois vies. Pas trois fois de suite, trois personnes différentes, le même jour, grâce à toi.</p>
            <p>Ton sang est séparé en plusieurs composants : globules rouges, plaquettes, plasma. Chacun part là où il est le plus nécessaire : un enfant en chimiothérapie, une femme qui vient d'accoucher, un accidenté en salle d'opération.</p>
            <p>Les besoins sont constants. Les stocks, eux, ne durent pas — certains composants sanguins se périment en quelques jours. C'est pourquoi chaque collecte compte, et chaque donneur aussi.</p>
          </div>
          <div class="flex justify-center lg:justify-start">
             <a :href="quizzUrl" class="bg-[#0073e6] text-white px-8 py-3 font-['Inter'] text-lg font-bold border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:bg-[#0073e6]/90 transition-all text-center">
               Donner mon sang
             </a>
          </div>
        </div>

        <!-- Right Column: Gauge (Same as HomeVitrine) -->
        <div class="w-full lg:w-1/2 flex flex-col pt-8 lg:pt-0">
          <!-- Desktop Grid Container -->
          <div class="hidden lg:block relative w-full mb-4">
             <div class="text-right mb-6">
                <span class="text-black font-bold text-3xl font-['Inter'] tracking-tight">50% de participation,</span>
             </div>

             <!-- Background Grid (Icons) -->
             <div style="display: grid; grid-template-columns: repeat(15, minmax(0, 1fr)); grid-auto-rows: 1fr; gap: 6px 2px;">
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
             <div class="absolute inset-0 pointer-events-none mt-[60px]" style="display: grid; grid-template-columns: repeat(15, minmax(0, 1fr)); grid-template-rows: repeat(10, minmax(0, 1fr)); gap: 6px 2px;">
               <div class="bg-[#fffbf1] flex flex-col items-center justify-center z-10 pointer-events-auto" style="grid-column: 5 / 12; grid-row: 4 / 7;">
                 <span class="text-[#0073e6] font-['Jersey_20'] text-[60px] lg:text-[64px] leading-[0.8] mb-0">130</span>
                 <span class="text-[#0073e6] font-['Jersey_20'] text-base leading-tight text-center tracking-wide -mt-1 lg:-mt-1">
                   Potentielles vies<br/>sauvées
                 </span>
               </div>
             </div>
          </div>

          <!-- Mobile Grid Container -->
          <div class="block lg:hidden relative w-[320px] mx-auto mb-4 mt-4">
             <div class="text-center mb-6">
                <span class="text-black font-bold text-3xl font-['Inter'] tracking-tight">50% de participation,</span>
             </div>
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

             <!-- Foreground Overlay Grid Mobile -->
             <div class="absolute inset-0 pointer-events-none mt-[60px]" style="display: grid; grid-template-columns: repeat(8, minmax(0, 1fr)); grid-template-rows: repeat(4, minmax(0, 1fr)); gap: 0px 0px;">
               <div class="bg-[#fffbf1] flex flex-col items-center justify-center z-10 pointer-events-auto" style="grid-column: 3 / 7; grid-row: 2 / 4;">
                 <span class="text-[#0073e6] font-['Jersey_20'] text-[40px] leading-[0.8] mb-0 mt-1">130</span>
                 <span class="text-[#0073e6] font-['Jersey_20'] text-[14px] leading-tight text-center tracking-wide mt-1">
                   Potentielles vies<br/>sauvées
                 </span>
               </div>
             </div>
          </div>

          <div class="w-full lg:w-auto text-center lg:text-right text-xs text-black font-['Inter'] mt-4">
            Chiffres renseignés sur la base du nombre d’employés de HEIG-VD.
          </div>
        </div>

      </div>
    </section>

    <!-- Part 3: Ils témoignent -->
    <section class="max-w-desktop mx-auto px-8 md:px-16 lg:px-24 xl:px-32 2xl:px-40 py-16 relative z-10">
      <div class="mb-10 flex flex-col items-center md:items-start text-center md:text-left">
        <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-6 origin-center md:origin-left" onerror="this.style.display='none'" />
        <h2 class="font-['Jersey_20'] text-[48px] md:text-[56px] text-black leading-none tracking-wide">
          Ils témoignent
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Block 1 -->
        <div class="flex flex-col xl:flex-row border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] bg-[#fffbf1]">
          <div class="w-full xl:w-1/3 p-4 flex items-center justify-center shrink-0">
             <img src="/images/dono_smiling.png" alt="Robot" class="w-24 h-24 object-contain" onerror="this.style.display='none'" />
          </div>
          <div class="w-full xl:w-2/3 bg-[#ffd012] p-6 border-t-[3px] xl:border-t-0 xl:border-l-[3px] border-black flex flex-col">
             <img src="/images/quoteBlack.svg" alt="Quote" class="w-6 h-6 mb-4" onerror="this.style.display='none'" />
             <p class="font-['Inter'] text-[15px] leading-relaxed text-black font-bold mb-4 flex-grow">J'avais toujours repoussé. Là, c'était dans les locaux, pendant la pause — j'ai sauté le pas.</p>
             <p class="font-['Inter'] text-sm text-black mt-auto">— Marie-Claire, assistante RH</p>
          </div>
        </div>

        <!-- Block 2 -->
        <div class="flex flex-col xl:flex-row border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] bg-[#fffbf1]">
          <div class="w-full xl:w-1/3 p-4 flex items-center justify-center shrink-0">
             <img src="/images/dono_smiling.png" alt="Robot" class="w-24 h-24 object-contain" onerror="this.style.display='none'" />
          </div>
          <div class="w-full xl:w-2/3 bg-[#ffd012] p-6 border-t-[3px] xl:border-t-0 xl:border-l-[3px] border-black flex flex-col">
             <img src="/images/quoteBlack.svg" alt="Quote" class="w-6 h-6 mb-4" onerror="this.style.display='none'" />
             <p class="font-['Inter'] text-[15px] leading-relaxed text-black font-bold mb-4 flex-grow">Vingt minutes, un peu de jus d'orange, et potentiellement une vie sauvée. Ça remet les choses en perspective.</p>
             <p class="font-['Inter'] text-sm text-black mt-auto">— Thomas, développeur</p>
          </div>
        </div>

        <!-- Block 3 -->
        <div class="flex flex-col xl:flex-row border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] bg-[#fffbf1]">
          <div class="w-full xl:w-1/3 p-4 flex items-center justify-center shrink-0">
             <img src="/images/dono_smiling.png" alt="Robot" class="w-24 h-24 object-contain" onerror="this.style.display='none'" />
          </div>
          <div class="w-full xl:w-2/3 bg-[#ffd012] p-6 border-t-[3px] xl:border-t-0 xl:border-l-[3px] border-black flex flex-col">
             <img src="/images/quoteBlack.svg" alt="Quote" class="w-6 h-6 mb-4" onerror="this.style.display='none'" />
             <p class="font-['Inter'] text-[15px] leading-relaxed text-black font-bold mb-4 flex-grow">Je ne savais pas si j'étais éligible. Le quiz m'a rassuré en deux minutes.</p>
             <p class="font-['Inter'] text-sm text-black mt-auto">— Anouk, chargée de projets</p>
          </div>
        </div>

      </div>
    </section>

    <!-- Part 4: Questions fréquentes -->
    <section class="max-w-desktop mx-auto px-8 md:px-16 lg:px-24 xl:px-32 2xl:px-40 py-16 mb-20 relative z-10">
      <div class="mb-10 flex flex-col items-center md:items-start text-center md:text-left">
        <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-6 origin-center md:origin-left" onerror="this.style.display='none'" />
        <h2 class="font-['Jersey_20'] text-[48px] md:text-[56px] text-black leading-none tracking-wide">
          Questions fréquentes
        </h2>
      </div>

      <div class="flex flex-col lg:flex-row gap-12 lg:gap-8 items-start">
        <!-- FAQ List (Left) -->
        <div class="w-full lg:w-7/12">
           <div v-for="(item, index) in faqList" :key="index" class="border-b-[1px] border-[#0073e6]">
              <button @click="toggleFaq(index)" class="w-full flex items-center justify-between py-4 md:py-6 text-left hover:bg-black/5 transition-colors focus:outline-none">
                 <span class="font-['Inter'] text-base md:text-lg pr-4" :class="openFaq === index ? 'font-bold text-[#0073e6]' : 'text-black'">{{ item.q }}</span>
              </button>
           </div>
        </div>

        <!-- Roby & Speech Bubble (Right) -->
        <div class="w-full lg:w-5/12 flex flex-col md:flex-row items-center md:items-start justify-center lg:justify-end gap-6 relative mt-8 lg:mt-0 lg:sticky lg:top-32">
          <!-- Speech Bubble -->
          <div class="relative bg-[#1a81e7] text-white p-6 border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] w-full md:w-[300px] z-20">
            <div v-if="openFaq === null" class="font-['Jersey_20'] tracking-wide text-[28px] leading-tight text-left">
              Qu'aimerais-tu savoir ?
            </div>
            <div v-else class="font-['Inter'] text-sm md:text-base leading-relaxed">
              <p>{{ faqList[openFaq].a }}</p>
              <div v-if="faqList[openFaq].button" class="mt-4">
                <a :href="quizzUrl" class="inline-block bg-white text-[#0073e6] px-4 py-2 font-bold text-sm border-[2px] border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:bg-gray-100 transition-colors">
                   {{ faqList[openFaq].button }}
                </a>
              </div>
            </div>

            <!-- Arrow for desktop (pointing right towards Roby) -->
            <div class="hidden md:block absolute top-10 -right-[15px] w-0 h-0 border-y-[12px] border-y-transparent border-l-[15px] border-l-black"></div>
            <div class="hidden md:block absolute top-[43px] -right-[10px] w-0 h-0 border-y-[9px] border-y-transparent border-l-[12px] border-l-[#1a81e7] z-10"></div>

            <!-- Arrow for mobile (pointing down towards Roby) -->
            <div class="block md:hidden absolute -bottom-[15px] left-1/2 -translate-x-1/2 w-0 h-0 border-x-[12px] border-x-transparent border-t-[15px] border-t-black"></div>
            <div class="block md:hidden absolute -bottom-[10px] left-1/2 -translate-x-1/2 w-0 h-0 border-x-[9px] border-x-transparent border-t-[12px] border-t-[#1a81e7] z-10"></div>
          </div>

          <!-- Roby -->
          <img src="/images/dono_smiling.png" alt="Roby" class="h-40 md:h-48 object-contain shrink-0" />
        </div>
      </div>
    </section>

  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const props = defineProps({
  initialData: {
    type: [Object, String],
    default: () => ({})
  }
});

const parsedData = computed(() => {
  if (typeof props.initialData === 'string') {
    try { return JSON.parse(props.initialData); } catch(e) { return {}; }
  }
  return props.initialData || {};
});

const collection = computed(() => parsedData.value.collection);
const company = computed(() => parsedData.value.company);

const companySlug = ref('');
const collectionId = ref('');

onMounted(() => {
  const parts = window.location.pathname.split('/');
  companySlug.value = parts[2] || '';
  collectionId.value = parts[3] || '';
});

const quizzUrl = computed(() => {
  if (!companySlug.value) return '#';
  return `/collection/${companySlug.value}/${collectionId.value}/quizz`;
});

// Gauge Logic
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

// Roby Hero Logic
const isRobyHeroHovered = ref(false);
const isRobyHeroClicked = ref(false);
let robyHeroTimeout = null;

const handleRobyHeroHover = (state) => {
  isRobyHeroHovered.value = state;
};

const handleRobyHeroClick = () => {
  isRobyHeroClicked.value = true;
  if (robyHeroTimeout) clearTimeout(robyHeroTimeout);
  robyHeroTimeout = setTimeout(() => {
    isRobyHeroClicked.value = false;
  }, 4000);
};

// FAQ Logic
const openFaq = ref(null);
const toggleFaq = (index) => {
  openFaq.value = openFaq.value === index ? null : index;
};

const faqList = [
  {
    q: "J'ai peur des aiguilles, est-ce que ça fait mal ?",
    a: "La sensation est brève et comparable à une prise de sang. La plupart des donneurs sont surpris par la simplicité du geste."
  },
  {
    q: "Je ne sais pas si je peux donner, comment le savoir ?",
    a: "C'est normal de ne pas savoir. Notre quiz d'éligibilité vous répond en moins de 5 minutes.",
    button: "Faire le quiz"
  },
  {
    q: "Est-ce que ça prend beaucoup de temps ?",
    a: "Le don dure 45 minutes en tout, pause collation comprise. Vous pouvez reprendre vos activités immédiatement après."
  },
  {
    q: "Puis-je donner si je prends des médicaments ?",
    a: "Cela dépend du médicament. Certains traitements sont compatibles avec le don, d'autres non. Le médecin présent le jour de la collecte peut vous renseigner. En cas de doute, contactez le CTS avant."
  },
  {
    q: "Combien de fois par an puis-je donner ?",
    a: "Pour le don de sang total, vous pouvez donner jusqu'à 4 fois par an, avec un intervalle minimum de 8 semaines entre chaque don."
  },
  {
    q: "Est-ce que je peux manger avant de donner ?",
    a: "Oui, et c'est même recommandé. Mangez normalement avant votre don et hydratez-vous bien. Évitez les repas trop gras dans les heures qui précèdent."
  },
  {
    q: "Que se passe-t-il si je ne suis pas éligible le jour J ?",
    a: "Aucun souci. L'éligibilité est évaluée le jour même par un médecin. Si vous ne pouvez pas donner ce jour-là, vous recevrez des informations sur les prochaines opportunités."
  },
  {
    q: "Mes données médicales sont-elles confidentielles ?",
    a: "Oui, entièrement. L'entretien médical est confidentiel et vos données sont traitées selon la législation suisse sur la protection des données."
  }
];
</script>
