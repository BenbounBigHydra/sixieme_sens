<template>
  <div class="h-screen bg-[#2D2144] bg-cover bg-center flex flex-col justify-between transition-all duration-1000 overflow-hidden" :style="{ backgroundImage: 'url(' + currentBgSrc + ')' }">

    <!-- LANDING STATE -->
    <div v-if="currentState === 'landing'" class="p-8 md:p-12 lg:p-16 h-full flex flex-col justify-between flex-grow">
      <div>
        <!-- Back button -->
        <a :href="homeLink" class="inline-flex items-center gap-2 border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] px-4 py-2 font-inter transition-all" :style="boxStyle">
          <img src="/images/Angle Left.svg" alt="Back" class="w-4 h-4" style="filter: brightness(0) invert(1);" />
          <span class="text-inherit text-sm md:text-base">Retourner à l'accueil</span>
        </a>

        <!-- Content -->
        <div class="mt-16 md:mt-24 max-w-xl border-[2px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-6 md:p-8" :style="boxStyle">
          <h1 class="font-jersey text-[40px] md:text-[56px] lg:text-[64px] text-inherit leading-[1.1] mb-6">
            Vérifier votre éligibilité
          </h1>

          <p class="font-inter text-inherit text-sm md:text-base leading-relaxed mb-10">
            Ce quiz interactif pose quelques questions sur votre santé pour vérifier que vous puissiez donner sans risque. C'est rapide, confidentiel*, et ça remplace les formulaires habituels. Si vous passez, vous débloquez la prise de RDV.
          </p>

          <button @click="startQuiz" class="inline-block border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] px-6 md:px-8 py-3 md:py-4 font-inter text-base md:text-lg transition-all mb-6" :style="activeBtnStyle">
            Commencer le quiz
          </button>

          <p class="font-inter text-inherit opacity-80 text-[12px] md:text-sm leading-snug">
            * Les réponses ne sont pas enregistrées, elles servent<br class="hidden md:block"/> uniquement à vérifier votre éligibilité en temps réel.
          </p>
        </div>
      </div>

      <!-- Bottom left text -->
      <div class="mt-12 flex justify-start">
        <div class="max-w-md text-left">
          <p class="font-inter text-[#D5D9ED] text-[12px] md:text-sm leading-snug">
            Si vous êtes un habitué et que vous connaissez les<br class="hidden md:block"/> critères, vous pouvez ignorer le quiz <a href="#" class="text-[#b3d9ff] hover:text-[#fffbf1] transition-colors underline">en cliquant ici</a>.
          </p>
        </div>
      </div>
    </div>
    <!-- QUIZ STATE -->
    <div v-else-if="currentState === 'quiz'" class="p-8 md:p-12 lg:p-16 h-full flex flex-col justify-between flex-grow">
      <div>
        <button @click="goBackQuestion" class="inline-flex items-center gap-2 border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] px-4 py-2 font-inter transition-all" :style="boxStyle">
          <img src="/images/Angle Left.svg" alt="Back" class="w-4 h-4" style="filter: brightness(0) invert(1);" />
          <span class="text-inherit text-sm md:text-base">
            {{ currentQuestionIndex === 0 ? 'Retour à l\'introduction' : 'Question précédente' }}
          </span>
        </button>
      </div>

      <div class="mt-8 flex-grow flex flex-col md:flex-row justify-between items-end relative gap-8 md:gap-12 pb-4">
        <div class="max-w-2xl flex flex-col justify-end relative z-10 w-full md:w-1/2">
          <div class="border-[2px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-6 md:p-8" :style="boxStyle">
            <h2 class="font-jersey text-[28px] md:text-[40px] text-inherit leading-tight mb-10 whitespace-pre-line relative z-10">
              {{ questions[currentQuestionIndex].text }}&nbsp;<span
                class="inline-block align-middle cursor-pointer"
                @mouseenter="showTooltip = true"
                @mouseleave="showTooltip = false"
                @click="showTooltip = !showTooltip"
              >
                <img src="/images/info.svg" alt="Info" class="w-6 h-6 md:w-8 md:h-8" style="filter: brightness(0) invert(1);" />
              </span>
              <!-- Tooltip Popup -->
              <div
                v-if="showTooltip"
                class="absolute bottom-full left-0 mb-4 w-[calc(100vw-2rem)] md:max-w-[600px] p-4 bg-white text-black font-inter text-sm md:text-base border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-50 font-normal leading-relaxed text-left"
              >
                {{ questions[currentQuestionIndex].info }}
              </div>
            </h2>

            <div class="flex gap-4 md:gap-6">
              <button @click="answerQuestion('Oui')" :disabled="isAnimating" class="flex-1 max-w-[200px] bg-white border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:bg-gray-50 px-4 md:px-6 py-3 md:py-4 text-black font-inter text-base md:text-lg transition-all" :class="{'opacity-50 cursor-not-allowed': isAnimating && selectedAnswer !== 'Oui'}" :style="selectedAnswer === 'Oui' ? activeBtnStyle : {}">
                Oui
              </button>
              <button @click="answerQuestion('Non')" :disabled="isAnimating" class="flex-1 max-w-[200px] bg-white border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:bg-gray-50 px-4 md:px-6 py-3 md:py-4 text-black font-inter text-base md:text-lg transition-all" :class="{'opacity-50 cursor-not-allowed': isAnimating && selectedAnswer !== 'Non'}" :style="selectedAnswer === 'Non' ? activeBtnStyle : {}">
                Non
              </button>
            </div>
          </div>
        </div>

        <div class="w-full md:w-1/2 flex justify-center items-center mt-8 md:mt-0 relative z-10 md:-translate-x-12 h-full max-h-[30vh] md:max-h-[50vh]">
          <transition name="fade">
            <img :key="currentImageSrc" :src="currentImageSrc" class="absolute inset-0 m-auto object-contain" :class="[questions[currentQuestionIndex]?.imageClass || 'max-h-[30vh] md:max-h-[50vh]', flightClass]" />
          </transition>
        </div>
      </div>

      <!-- Bottom left indicator -->
      <div class="mt-8 flex justify-start">
        <div class="font-inter text-sm md:text-base font-bold px-4 py-2 border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] inline-block" :style="boxStyle">
          Question {{ currentQuestionIndex + 1 }} / {{ questions.length }}
        </div>
      </div>
    </div>

    <!-- INELIGIBLE STATE -->
    <div v-else-if="currentState === 'ineligible'" class="p-8 md:p-12 lg:p-16 h-full flex flex-col justify-between flex-grow">
      <div>
        <button @click="correctAnswer" class="inline-flex items-center gap-2 border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] px-4 py-2 font-inter transition-all" :style="boxStyle">
          <img src="/images/Angle Left.svg" alt="Back" class="w-4 h-4" style="filter: brightness(0) invert(1);" />
          <span class="text-inherit text-sm md:text-base">Je me suis trompé(e)</span>
        </button>
      </div>
      <div class="flex-grow flex flex-col md:flex-row justify-between items-center relative gap-8 md:gap-12">
        <div class="max-w-2xl flex flex-col justify-center relative z-10 w-full md:w-1/2">
          <div class="border-[2px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-6 md:p-8" :style="boxStyle">
            <h2 class="font-jersey text-[48px] md:text-[64px] text-inherit leading-tight mb-2">
              Pas cette fois...
            </h2>
            <h3 class="font-jersey text-[32px] md:text-[40px] text-inherit leading-tight mb-8">
              mais vous pouvez quand même aider
            </h3>

            <p class="font-inter text-inherit text-base md:text-lg leading-relaxed mb-12">
              Les critères d'éligibilité ne sont pas là pour décourager, ils sont là pour protéger. Protéger les patients qui recevront votre sang, mais aussi vous. Certaines contre-indications sont temporaires. Si c'est votre cas aujourd'hui, ça ne le sera peut-être plus lors de la prochaine collecte.<br/><br/>Le don du sang, ça se reporte, ça ne s'abandonne pas.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 md:gap-6">
              <button @click="copyAndRedirect" class="bg-white border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:bg-gray-50 px-6 md:px-8 py-3 md:py-4 text-black font-inter text-base md:text-lg transition-all text-center relative overflow-hidden group">
                <span :class="{'opacity-0': isCopied}">Partager à un collègue</span>
                <span v-if="isCopied" class="absolute inset-0 flex items-center justify-center font-bold text-[#3ca370]">Copié !</span>
              </button>
              <a :href="homeLink" class="border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] px-6 md:px-8 py-3 md:py-4 font-inter text-base md:text-lg transition-all text-center inline-block" :style="activeBtnStyle">
                Retourner à l'accueil
              </a>
            </div>
            
            <div class="mt-8 text-center md:text-left">
              <a href="#" @click.prevent="continueQuiz" class="font-inter text-[#fffbf1] text-sm md:text-base underline hover:text-[#b3d9ff] transition-colors">
                Continuer le quiz pour le fun
              </a>
            </div>
          </div>
        </div>

        <div class="w-full md:w-1/2 flex justify-center items-center mt-12 md:mt-0 relative z-10 md:-translate-x-12">
          <img :src="currentImageSrc" class="object-contain" :class="questions[currentQuestionIndex]?.imageClass || 'max-h-[30vh] md:max-h-[50vh]'" />
        </div>
      </div>
    </div>
    <!-- SUCCESS STATE -->
    <div v-else-if="currentState === 'success'" class="p-8 md:p-12 lg:p-16 h-full flex flex-col flex-grow">
      <div>
        <!-- Back button -->
        <a :href="homeLink" class="inline-flex items-center gap-2 border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] px-4 py-2 font-inter transition-all" :style="boxStyle">
          <img src="/images/Angle Left.svg" alt="Back" class="w-4 h-4" style="filter: brightness(0) invert(1);" />
          <span class="text-inherit text-sm md:text-base">Retourner à l'accueil</span>
        </a>
      </div>

      <div class="mt-16 md:mt-24 max-w-2xl flex-grow flex flex-col justify-center">
        <div class="border-[2px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-6 md:p-8" :style="boxStyle">
          <h2 class="font-jersey text-[48px] md:text-[64px] text-inherit leading-tight mb-2">
            On vous attend !
          </h2>
          <h3 class="font-jersey text-[32px] md:text-[40px] text-inherit leading-tight mb-8">
            plus qu'une étape
          </h3>

          <p class="font-inter text-inherit text-base md:text-lg leading-relaxed mb-12">
            La prise de rendez-vous se fait via OneDoc. Vous allez être redirigé vers le calendrier de la collecte {{ company.name || '[entreprise]' }}. Choisissez simplement le créneau qui vous convient et confirmez votre inscription.
          </p>

          <div>
            <a href="#" @click.prevent="handleOnedocClick" class="inline-block border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] px-6 md:px-8 py-3 md:py-4 font-inter text-base md:text-lg transition-all" :style="activeBtnStyle">
              Prendre rendez-vous
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch, onUnmounted } from 'vue';

const props = defineProps({
    initialData: {
        type: String,
        default: '{}'
    }
});

const parsedData = computed(() => {
    try {
        return JSON.parse(props.initialData);
    } catch (e) {
        return {};
    }
});

const company = computed(() => parsedData.value.company || {});
const collection = computed(() => parsedData.value.collection || {});

const homeLink = computed(() => {
    if (company.value.slug && collection.value.id) {
        return `/collection/${company.value.slug}/${collection.value.id}`;
    }
    return '/';
});

// Quiz Logic
const questions = [
  {
    text: "Pour entreprendre ce voyage, cela doit être votre premier depuis un moment.\nAvez-vous voyagé en dehors de la Suisse lors des 4 derniers mois?",
    correct: "Non",
    info: "Certains pays présentent des risques de maladies transmissibles par le sang (paludisme, virus Zika, dengue, etc.). Un délai d'attente peut s'appliquer selon votre destination. (Vérifiable sur le Travelcheck de Transfusion CRS Suisse).",
    bg: "background_earth_desktop.png", mobileBg: "bkgMobile/background_earth_mobile.png", folder: "01_travel", prefix: "travel", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[50vh] translate-y-12 md:translate-y-20"
  },
  {
    text: "Avez-vous actuellement une plaie ou avez-vous été opéré récemment ?",
    correct: "Non",
    info: "Une plaie ouverte ou une intervention chirurgicale récente augmente le risque d'infection bactérienne dans le sang. Un délai est nécessaire pour s'assurer que la cicatrisation est complète et sans complication.",
    bg: "Background_spaceship_desktop.png", mobileBg: "bkgMobile/Background_spaceship_mobile.png", folder: "02_wound", prefix: "wound", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[50vh]"
  },
  {
    text: "En ce moment, vous sentez-vous en bonne santé et n’avez-vous pas de symptôme de refroidissement et de fièvre ?",
    correct: "Oui",
    info: "Pour protéger le receveur ainsi que vous-même, vous devez être en parfaite santé le jour du don. Les maux de gorge, toux, ou fièvre nécessitent d'attendre au moins 2 semaines après la disparition des symptômes.",
    bg: "background_space.png", mobileBg: "bkgMobile/background_space_mobile.png", folder: "03_fever", prefix: "fever", hasYes: true, hasNo: true, invertImages: true,
    imageClass: "max-h-[30vh] md:max-h-[50vh]"
  },
  {
    text: "Avez-vous eu des relations sexuelles avec des partenaires multiples au cours de 12 derniers mois ou avec une nouvelle ou nouveau partenaire ces quatre derniers mois ?",
    correct: "Non",
    info: "Avoir de multiples partenaires ou un nouveau partenaire sexuel récent augmente le risque d'infections transmissibles par le sang (VIH, hépatites). Un délai de 4 à 12 mois est appliqué selon les situations pour garantir la sécurité transfusionnelle.",
    bg: "background_space.png", mobileBg: "bkgMobile/background_space_mobile.png", folder: "04_sex", prefix: "sex", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[50vh]"
  },
  {
    text: "Pesez-vous au moins 50 kg ?",
    correct: "Oui",
    info: "Le volume de sang prélevé (environ 450 ml) est calculé pour être bien toléré par une personne pesant au moins 50 kg. En dessous de ce poids, le don pourrait causer des malaises ou une anémie.",
    bg: "background_space.png", mobileBg: "bkgMobile/background_space_mobile.png", folder: "05_weight", prefix: "weight", hasYes: true, hasNo: true, invertImages: true,
    imageClass: "max-h-[30vh] md:max-h-[50vh]"
  },
  {
    text: "Avez-vous été piqué par une tique dans les 4 dernières semaines?",
    correct: "Non",
    info: "La piqûre de tique peut transmettre des maladies comme la maladie de Lyme. Un délai d'attente d'un mois minimum est requis après la piqûre, à condition de n'avoir développé aucun symptôme.",
    bg: "background_space.png", mobileBg: "bkgMobile/background_space_mobile.png", folder: "06_tick", prefix: "tick", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[50vh]"
  },
  {
    text: "Avez-vous fait de l'acupuncture dans les 4 derniers mois?",
    correct: "Non",
    info: "Tout acte perçant la peau (acupuncture, tatouage, piercing) comporte un risque d'infection virale s'il n'est pas réalisé avec du matériel stérile à usage unique. Un délai de 4 mois est généralement demandé.",
    bg: "background_space.png", mobileBg: "bkgMobile/background_space_mobile.png", folder: "07_acupuncture", prefix: "acupuncture", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[50vh]"
  },
  {
    text: "Avez-vous ressenti une douleur thoracique ou un essoufflement anormal récemment?",
    correct: "Non",
    info: "Le don de sang sollicite le système cardiovasculaire. Les antécédents de maladies cardiaques ou des symptômes récents nécessitent une évaluation médicale approfondie pour ne pas mettre votre propre santé en danger.",
    bg: "background_lab_desktop.png", mobileBg: "bkgMobile/Background_lab_mobile.png", folder: "08_pain", prefix: "pain", hasYes: true, hasNo: true,
    imageClass: "max-h-[20vh] md:max-h-[35vh] translate-y-8 md:translate-y-16"
  },
  {
    text: "Avez-vous eu une gastroscopie ou coloscopie au cours des 4 derniers mois ?",
    correct: "Non",
    info: "Les examens endoscopiques comportent un risque minime mais existant de transmission virale ou bactérienne via le matériel. Un délai d'attente de 4 mois est requis après l'intervention.",
    bg: "background_lab_desktop.png", mobileBg: "bkgMobile/Background_lab_mobile.png", folder: "09_gastroscopy", prefix: "gastroscopy", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[50vh] scale-[1.3] md:scale-[1.5] translate-y-4 md:translate-y-8"
  },
  {
    text: "Avez-vous bénéficié d’un détartrage dans les 24 dernières heures ou d’un traitement dentaire dans les 7 derniers jours ?",
    correct: "Non",
    info: "Un détartrage ou un traitement dentaire peut libérer des bactéries de la bouche dans la circulation sanguine (bactériémie transitoire). Attendre de 24h à 7 jours permet d'éliminer ce risque d'infection pour le receveur.",
    bg: "background_lab_desktop.png", mobileBg: "bkgMobile/Background_lab_mobile.png", folder: "10_dental", prefix: "dental", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[50vh] scale-[1.3] md:scale-[1.5] translate-y-4 md:translate-y-8"
  },
  {
    text: "Ces quatre dernières semaines, avez-vous pris des médicaments ou reçu un vaccin ?",
    correct: "Non",
    info: "La prise de médicaments ou la vaccination récente nécessite une évaluation. Des antibiotiques nécessitent 2 semaines d'attente. Les antalgiques simples (Dafalgan, Ibuprofène) sont souvent acceptés s'ils sont pris pour des maux mineurs sans fièvre, mais la raison de la prise est toujours évaluée.",
    bg: "background_lab_desktop.png", mobileBg: "bkgMobile/Background_lab_mobile.png", folder: "11_medecine", prefix: "medecine", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[50vh] scale-[1.3] md:scale-[1.5] translate-y-12 md:translate-y-24"
  },
  {
    text: "Avez-vous déjà reçu une greffe d'organe?",
    correct: "Non",
    info: "Les receveurs d'organes ou de tissus (comme la cornée ou la dure-mère) sont définitivement exclus du don de sang en raison du risque de transmission de maladies infectieuses ou à prions.",
    bg: "background_lab_desktop.png", mobileBg: "bkgMobile/Background_lab_mobile.png", folder: "12_transplant", prefix: "transplant", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[50vh] translate-y-12 md:translate-y-24"
  }
];

const currentState = ref('landing'); // 'landing', 'quiz', 'ineligible', 'success'
const currentQuestionIndex = ref(0);
const userAnswers = ref([]); // Track their answers
const showTooltip = ref(false); // Track tooltip visibility
const isAnimating = ref(false);
const selectedAnswer = ref(null);
const flightClass = ref('');
const isCopied = ref(false);
const isMobile = ref(false);

const colors = computed(() => {
  const bgImg = currentBgSrc.value.toLowerCase();
  if (bgImg.includes('space')) {
    return { box: '#422445', btn: '#473b78' };
  } else if (bgImg.includes('earth')) {
    return { box: '#43434f', btn: '#3ca370' };
  } else if (bgImg.includes('lab')) {
    return { box: '#463b78', btn: '#322947' };
  }
  return { box: '#422445', btn: '#473b78' };
});

const boxStyle = computed(() => ({ background: colors.value.box, color: '#fffbf1' }));
const activeBtnStyle = computed(() => ({ background: colors.value.btn, color: '#fffbf1' }));

const currentBgSrc = computed(() => {
  if (currentState.value === 'landing') {
    return isMobile.value ? '/images/quiz/00_bkg/bkgMobile/background_earth_mobile.png' : '/images/quiz/00_bkg/background_earth_desktop.png';
  } else if (currentState.value === 'quiz' || currentState.value === 'ineligible') {
    const q = questions[currentQuestionIndex.value];
    if (!q) return '';
    return isMobile.value && q.mobileBg ? `/images/quiz/00_bkg/${q.mobileBg}` : `/images/quiz/00_bkg/${q.bg}`;
  } else if (currentState.value === 'success') {
    return isMobile.value ? '/images/quiz/00_bkg/bkgMobile/Background_spaceship_mobile.png' : '/images/quiz/00_bkg/Background_spaceship_desktop.png';
  }
  return '';
});

const handleResize = () => {
  isMobile.value = window.innerWidth < 768;
};

const currentImageSrc = computed(() => {
  const q = questions[currentQuestionIndex.value];
  if (!q) return '';
  let suffix = 'base';
  if (selectedAnswer.value) {
    let evalAnswer = selectedAnswer.value;
    if (q.invertImages) {
      evalAnswer = evalAnswer === 'Oui' ? 'Non' : 'Oui';
    }
    if (evalAnswer === 'Oui' && q.hasYes) suffix = 'yes';
    else if (evalAnswer === 'Non' && q.hasNo) suffix = 'no';
  }
  return `/images/quiz/${q.folder}/${q.prefix}_${suffix}.png`;
});

// Load state from local storage on mount
onMounted(() => {
    isMobile.value = window.innerWidth < 768;
    window.addEventListener('resize', handleResize);

    const savedState = localStorage.getItem('quizzState_' + collection.value.id);
    if (savedState) {
        const parsed = JSON.parse(savedState);
        currentState.value = parsed.currentState || 'landing';
        currentQuestionIndex.value = parsed.currentQuestionIndex || 0;
        userAnswers.value = parsed.userAnswers || [];
    }
});

onUnmounted(() => {
    window.removeEventListener('resize', handleResize);
});

// Save state to local storage whenever it changes
watch([currentState, currentQuestionIndex, userAnswers], () => {
    if (collection.value.id) {
        localStorage.setItem('quizzState_' + collection.value.id, JSON.stringify({
            currentState: currentState.value,
            currentQuestionIndex: currentQuestionIndex.value,
            userAnswers: userAnswers.value
        }));
    }
}, { deep: true });

const startQuiz = () => {
  currentState.value = 'quiz';
  currentQuestionIndex.value = 0;
  userAnswers.value = [];
  showTooltip.value = false;
  selectedAnswer.value = null;
  isAnimating.value = false;
  flightClass.value = '';
};

const goBackQuestion = () => {
  if (isAnimating.value) return;
  showTooltip.value = false;
  selectedAnswer.value = null;
  flightClass.value = '';
  if (currentQuestionIndex.value > 0) {
    currentQuestionIndex.value--;
    // Clear answers for the current question and any subsequent ones
    userAnswers.value = userAnswers.value.slice(0, currentQuestionIndex.value);
  } else {
    userAnswers.value = [];
    currentState.value = 'landing';
  }
};

const answerQuestion = (answer) => {
  if (isAnimating.value) return;
  showTooltip.value = false;

  // Save the answer
  selectedAnswer.value = answer;
  userAnswers.value[currentQuestionIndex.value] = answer;
  isAnimating.value = true;

  if (currentQuestionIndex.value === 0 && answer === 'Non') {
    flightClass.value = 'fly-up-animation';
  }

  setTimeout(() => {
    isAnimating.value = false;
    const isCorrect = questions[currentQuestionIndex.value].correct === answer;

    if (!isCorrect) {
      currentState.value = 'ineligible';
      flightClass.value = '';
    } else {
      flightClass.value = '';
      proceedToNext();
    }
  }, 2800);
};

const continueQuiz = () => {
  selectedAnswer.value = null;
  if (currentQuestionIndex.value === questions.length - 1) {
    // Si on est à la dernière question, "Continuer le quiz" nous ramène à la question
    currentState.value = 'quiz';
  } else {
    proceedToNext();
  }
};

const correctAnswer = () => {
  selectedAnswer.value = null;
  currentState.value = 'quiz';
  // Clear the answer for current question so they can answer again
  userAnswers.value[currentQuestionIndex.value] = null;
};

const copyAndRedirect = async () => {
  const shareText = `Salut ! Notre entreprise organise une collecte de sang. Viens tester ton éligibilité ici : ${window.location.origin}${homeLink.value}`;
  try {
    await navigator.clipboard.writeText(shareText);
    isCopied.value = true;
    setTimeout(() => {
      isCopied.value = false;
      window.location.href = homeLink.value;
    }, 1500);
  } catch (err) {
    console.error('Failed to copy text: ', err);
    // Fallback redirect if copy fails
    window.location.href = homeLink.value;
  }
};

const proceedToNext = () => {
  selectedAnswer.value = null;
  if (currentQuestionIndex.value < questions.length - 1) {
    currentQuestionIndex.value++;
    currentState.value = 'quiz';
  } else {
    // End of quiz
    // Vérifier si toutes les réponses données sont correctes
    let isAllCorrect = true;
    for (let i = 0; i < questions.length; i++) {
      if (userAnswers.value[i] !== questions[i].correct) {
        isAllCorrect = false;
        break;
      }
    }

    if (isAllCorrect) {
      currentState.value = 'success';
    } else {
      currentState.value = 'ineligible';
    }
  }
};

const handleOnedocClick = async () => {
    try {
        await fetch(`/api/collection/${collection.value.id}/track-click`, {
            method: 'POST',
            headers: {
                'X-XSRF-TOKEN': decodeURIComponent(
                    document.cookie.match(/XSRF-TOKEN=([^;]+)/)?.[1] ?? ''
                ),
            },
        });
    } catch (e) {
        console.error('Tracking error:', e);
    } finally {
        window.location.href = collection.value.onedoc_link;
    }
};
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 1.2s ease-in-out;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
.fly-up-animation {
  animation: flyUp 2.5s linear forwards;
}
@keyframes flyUp {
  0% { transform: translateY(3rem); }
  100% { transform: translateY(calc(-100vh + 3rem)); }
}
@media (min-width: 768px) {
  @keyframes flyUp {
    0% { transform: translateY(5rem); }
    100% { transform: translateY(calc(-100vh + 5rem)); }
  }
}
</style>
