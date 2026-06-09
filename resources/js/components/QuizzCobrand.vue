<template>
  <div class="h-[100dvh] bg-[#2D2144] bg-cover bg-center flex flex-col justify-between transition-all duration-1000 overflow-hidden" :style="{ backgroundImage: 'url(' + currentBgSrc + ')' }">

    <!-- LANDING STATE -->
    <div v-if="currentState === 'landing'" class="p-6 md:p-12 lg:p-16 h-full flex flex-col justify-between flex-grow">
      <div>
        <!-- Back button -->
        <a :href="homeLink" class="inline-flex items-center gap-2 border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] px-4 py-2 font-inter transition-all" :style="boxStyle">
          <img src="/images/Angle Left.svg" alt="Back" class="w-4 h-4" style="filter: brightness(0) invert(1);" />
          <span class="text-inherit text-sm md:text-base">Retourner à l'accueil</span>
        </a>

        <!-- Content -->
        <div class="mt-12 md:mt-24 max-w-xl border-[2px] border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] md:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-4 md:p-8" :style="boxStyle">
          <h1 class="font-jersey text-[28px] sm:text-[36px] md:text-[56px] lg:text-[64px] text-inherit leading-[1.1] mb-4 md:mb-6">
            Vérifier votre éligibilité
          </h1>

          <p class="font-inter text-inherit text-xs sm:text-sm md:text-base leading-relaxed mb-6 md:mb-10">
            Ce quiz interactif pose quelques questions sur votre santé pour vérifier que vous puissiez donner sans risque. C'est rapide, confidentiel*, si vous passez, vous débloquez la prise de RDV.
          </p>

          <button @click="startQuiz" class="inline-block border-[2px] border-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] md:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] md:hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] px-5 md:px-8 py-2 md:py-4 font-inter text-sm md:text-lg transition-all mb-4 md:mb-6" :style="activeBtnStyle">
            Commencer le quiz
          </button>

          <p class="font-inter text-inherit opacity-80 text-[12px] md:text-sm leading-snug">
            * Les réponses ne sont pas enregistrées, elles servent<br class="hidden md:block"/> uniquement à vérifier votre éligibilité en temps réel.
          </p>
        </div>
      </div>

      <!-- Bottom left text -->
      <div class="mt-8 flex justify-start">
        <div class="max-w-md text-left">
          <p class="font-inter text-[#D5D9ED] text-[10px] md:text-sm leading-snug">
            Si vous êtes un habitué et que vous connaissez les<br class="hidden md:block"/> critères, vous pouvez ignorer le quiz <a href="#" @click.prevent="handleOnedocClick" class="text-[#b3d9ff] hover:text-[#fffbf1] transition-colors underline">en cliquant ici</a>.
          </p>
        </div>
      </div>
    </div>
    <!-- QUIZ STATE -->
    <div v-else-if="currentState === 'quiz'" class="p-6 md:p-12 lg:p-16 h-full flex flex-col justify-between flex-grow">
      <div>
        <button @click="goBackQuestion" class="inline-flex items-center gap-1 md:gap-2 border-[2px] border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] md:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] md:hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] px-2 md:px-4 py-1 md:py-2 font-inter transition-all" :style="boxStyle">
          <img src="/images/Angle Left.svg" alt="Back" class="w-3 h-3 md:w-4 md:h-4" style="filter: brightness(0) invert(1);" />
          <span class="text-inherit text-sm md:text-base">
            {{ currentQuestionIndex === 0 ? 'Retour à l\'introduction' : 'Question précédente' }}
          </span>
        </button>
      </div>

      <div class="mt-2 md:mt-8 flex-grow flex flex-col-reverse md:flex-row justify-between items-center md:items-end relative gap-0 sm:gap-2 md:gap-12 pb-2 md:pb-4">
        <div class="max-w-2xl flex flex-col justify-end relative z-10 w-full md:w-1/2">
          <div class="border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] md:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-3 sm:p-4 md:p-8" :style="boxStyle">
            <h2 class="font-jersey text-[16px] sm:text-[18px] md:text-[32px] text-inherit leading-tight mb-3 md:mb-8 whitespace-pre-line relative z-10">
              {{ questions[currentQuestionIndex].text }}&nbsp;<span
                class="inline-block align-middle cursor-pointer"
                @mouseenter="showTooltip = true"
                @mouseleave="showTooltip = false"
                @click="showTooltip = !showTooltip"
              >
                <img src="/images/info.svg" alt="Info" class="w-4 h-4 md:w-6 md:h-6" style="filter: brightness(0) invert(1);" />
              </span>
              <!-- Tooltip Popup -->
              <div
                v-if="showTooltip"
                class="absolute bottom-full -left-2 md:left-0 mb-2 md:mb-4 w-max max-w-[240px] md:max-w-[600px] p-2 md:p-4 bg-white text-black font-inter text-[11px] md:text-base border-[2px] border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] md:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-50 font-normal leading-snug md:leading-relaxed text-left"
              >
                {{ questions[currentQuestionIndex].info }}
              </div>
            </h2>

            <div class="min-h-[40px] md:min-h-[64px]">
              <transition name="fade" mode="out-in">
                <div v-if="!selectedAnswer" class="flex gap-2 md:gap-6">
                  <button @click="answerQuestion('Oui')" class="flex-1 max-w-[200px] bg-white border-[2px] border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] md:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] md:hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:bg-gray-50 px-2 md:px-5 py-1.5 md:py-3 text-black font-inter text-[13px] md:text-base transition-all">
                    Oui
                  </button>
                  <button @click="answerQuestion('Non')" class="flex-1 max-w-[200px] bg-white border-[2px] border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] md:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] md:hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:bg-gray-50 px-2 md:px-5 py-1.5 md:py-3 text-black font-inter text-[13px] md:text-base transition-all">
                    Non
                  </button>
                </div>
                <div v-else-if="selectedAnswer === 'Non'" class="font-inter text-[#4ade80] font-bold text-[13px] md:text-lg">
                  <span v-html="questions[currentQuestionIndex].noText"></span>
                </div>
              </transition>
            </div>
          </div>
        </div>

        <div class="w-full md:w-1/2 flex justify-end flex-col items-center relative z-10 md:-translate-x-12 h-full min-h-[25vh] max-h-[35vh] md:min-h-0 md:max-h-[75vh]">
          <transition name="fade">
            <img :key="currentImageSrc" :src="currentImageSrc" class="absolute bottom-0 left-0 right-0 mx-auto object-contain md:inset-0 md:m-auto" :class="[questions[currentQuestionIndex]?.imageClass || 'max-h-[30vh] md:max-h-[75vh]', flightClass]" />
          </transition>
        </div>
      </div>

      <!-- Bottom left indicator -->
      <div class="mt-4 md:mt-8 flex justify-start">
        <div class="font-inter text-[11px] md:text-base font-bold px-2 md:px-4 py-1 md:py-2 border-[2px] border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] md:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] inline-block" :style="boxStyle">
          Question {{ currentQuestionIndex + 1 }} / {{ questions.length }}
        </div>
      </div>
    </div>

    <!-- INELIGIBLE STATE -->
    <div v-else-if="currentState === 'ineligible'" class="p-6 md:p-12 lg:p-16 h-full flex flex-col justify-between flex-grow">
      <div>
        <button @click="correctAnswer" class="inline-flex items-center gap-1 md:gap-2 border-[2px] border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] md:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] md:hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] px-2 md:px-4 py-1 md:py-2 font-inter transition-all" :style="boxStyle">
          <img src="/images/Angle Left.svg" alt="Back" class="w-3 h-3 md:w-4 md:h-4" style="filter: brightness(0) invert(1);" />
          <span class="text-inherit text-[11px] md:text-base">Je me suis trompé(e)</span>
        </button>
      </div>
      <div class="flex-grow flex flex-col-reverse md:flex-row justify-between items-center relative gap-4 md:gap-12">
        <div class="max-w-2xl flex flex-col justify-center relative z-10 w-full md:w-1/2">
          <div class="border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] md:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-3 md:p-6" :style="boxStyle">
            <h2 class="font-jersey text-[20px] sm:text-[24px] md:text-[48px] text-inherit leading-tight mb-1">
              Pas cette fois...
            </h2>
            <h3 class="font-jersey text-[16px] sm:text-[18px] md:text-[32px] text-inherit leading-tight mb-2 md:mb-4">
              mais vous pouvez quand même aider
            </h3>

            <p class="font-inter text-[#f87171] font-bold text-[11px] md:text-base leading-relaxed mb-2 md:mb-4" v-if="questions[currentQuestionIndex]?.yesText" v-html="questions[currentQuestionIndex].yesText"></p>
            <p class="font-inter text-inherit text-[11px] md:text-base leading-relaxed mb-3 md:mb-6 opacity-80">
              Les critères d'éligibilité ne sont pas là pour décourager, ils sont là pour protéger. Protéger les patients qui recevront votre sang, mais aussi vous. Certaines contre-indications sont temporaires. Si c'est votre cas aujourd'hui, ça ne le sera peut-être plus lors de la prochaine collecte.<br/><br/>Le don du sang, ça se reporte, ça ne s'abandonne pas.
            </p>

            <div class="flex flex-row sm:flex-row gap-2 md:gap-4 w-full">
              <button @click="copyAndRedirect" class="flex-1 bg-white border-[2px] border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] md:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] md:hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:bg-gray-50 px-2 sm:px-3 md:px-6 py-1.5 md:py-3 text-black font-inter text-[10px] sm:text-[11px] md:text-base transition-all text-center relative overflow-hidden group">
                <span :class="{'opacity-0': isCopied}">Partager à un collègue</span>
                <span v-if="isCopied" class="absolute inset-0 flex items-center justify-center font-bold text-[#3ca370]">Copié !</span>
              </button>
              <a :href="homeLink" class="flex-1 border-[2px] border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] md:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] md:hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] px-2 sm:px-3 md:px-6 py-1.5 md:py-3 font-inter text-[10px] sm:text-[11px] md:text-base transition-all text-center flex items-center justify-center" :style="activeBtnStyle">
                Retourner à l'accueil
              </a>
            </div>
            
            <div v-if="currentQuestionIndex < questions.length - 1" class="mt-3 md:mt-4 text-center md:text-left">
              <a href="#" @click.prevent="continueQuiz" class="font-inter text-[#fffbf1] text-[11px] md:text-base underline hover:text-[#b3d9ff] transition-colors">
                Continuer le quiz pour le fun
              </a>
            </div>
          </div>
        </div>

        <div class="w-full md:w-1/2 flex justify-center items-center relative z-10 md:-translate-x-12 min-h-[25vh] md:min-h-0">
          <img :src="currentImageSrc" class="object-contain relative" :class="questions[currentQuestionIndex]?.imageClass || 'max-h-[30vh] md:max-h-[75vh]'" />
        </div>
      </div>
    </div>
    <!-- SUCCESS STATE -->
    <div v-else-if="currentState === 'success'" class="p-6 md:p-12 lg:p-16 h-full flex flex-col flex-grow">
      <div>
        <!-- Back button -->
        <a :href="homeLink" class="inline-flex items-center gap-2 border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] px-4 py-2 font-inter transition-all" :style="boxStyle">
          <img src="/images/Angle Left.svg" alt="Back" class="w-4 h-4" style="filter: brightness(0) invert(1);" />
          <span class="text-inherit text-sm md:text-base">Retourner à l'accueil</span>
        </a>
      </div>

      <div class="mt-12 md:mt-24 max-w-2xl flex-grow flex flex-col justify-center">
        <div class="border-[2px] border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] md:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-5 md:p-8" :style="boxStyle">
          <h2 class="font-jersey text-[32px] sm:text-[36px] md:text-[64px] text-inherit leading-tight mb-1 md:mb-2">
            On vous attend !
          </h2>
          <h3 class="font-jersey text-[24px] sm:text-[28px] md:text-[40px] text-inherit leading-tight mb-4 md:mb-8">
            plus qu'une étape
          </h3>

          <p class="font-inter text-inherit text-sm md:text-lg leading-relaxed mb-8 md:mb-12">
            La prise de rendez-vous se fait via OneDoc. Vous allez être redirigé vers le calendrier de la collecte {{ company.name || '[entreprise]' }}. Choisissez simplement le créneau qui vous convient et confirmez votre inscription.
          </p>

          <div>
            <a href="#" @click.prevent="handleOnedocClick" class="inline-block border-[2px] border-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] md:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] md:hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] px-5 md:px-8 py-2 md:py-4 font-inter text-sm md:text-lg transition-all" :style="activeBtnStyle">
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
    text: "Pour entreprendre ce voyage avec Roby, cela doit être ton premier depuis un moment.\n\nAs-tu voyagé en dehors de la Suisse lors des 4 derniers mois?",
    correct: "Non",
    info: "Certains pays ont des risques de maladies transmissibles par le sang. Un délai d'attente peut s'appliquer.",
    yesText: "Aaah dommage. Certains pays présentent des risques sanitaires qui nécessitent un délai d'attente avant de donner son sang. Tu peux vérifier ça grâce à notre travel-check : <a href='https://www.hug.ch/travelcheck' target='_blank' class='underline hover:text-gray-300'>https://www.hug.ch/travelcheck</a>",
    noText: "Accroche ta ceinture, ça risque de secouer !",
    bg: "background_earth_desktop.png", mobileBg: "bkgMobile/background_earth_mobile.png", folder: "01_travel", prefix: "travel", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[75vh] translate-y-8 md:translate-y-20"
  },
  {
    text: "As-tu actuellement une plaie ou as-tu été opéré récemment ?",
    correct: "Non",
    info: "Une plaie ou une opération récente augmente le risque d'infection bactérienne dans le sang.",
    yesText: "Laisse ton corps se reposer d'abord ! Une plaie ou opération récente peut fragiliser ton organisme.",
    noText: "La comète a dévié, ton corps est intact !",
    bg: "Background_spaceship_desktop.png", mobileBg: "bkgMobile/Background_spaceship_mobile.png", folder: "02_wound", prefix: "wound", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[75vh]"
  },
  {
    text: "As-tu actuellement des symptômes de refroidissement ou de la fièvre ?",
    correct: "Non",
    info: "Pour te protéger et protéger le receveur, tu dois être en parfaite santé le jour du don.",
    yesText: "Soigne-toi bien et reviens nous voir quand tu seras au top ! Donner pendant une infection pourrait nuire à ta santé.",
    noText: "On est passés proche du soleil, mais on a survécu !",
    bg: "background_space.png", mobileBg: "bkgMobile/background_space_mobile.png", folder: "03_fever", prefix: "fever", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[75vh]"
  },
  {
    text: "As-tu eu des relations sexuelles avec des partenaires multiples au cours de 12 derniers mois ou avec une nouvelle ou nouveau partenaire ces quatre derniers mois ?",
    correct: "Non",
    info: "Un nouveau partenaire ou des partenaires multiples augmentent le risque d'infections transmissibles par le sang.",
    yesText: "Ce critère vise à réduire le risque de transmission de certaines infections par le sang.",
    noText: "La sécurité avant tout, c'est parfait !",
    bg: "background_space.png", mobileBg: "bkgMobile/background_space_mobile.png", folder: "04_sex", prefix: "sex", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[75vh]"
  },
  {
    text: "Pèses-tu moins de 50 kg ?",
    correct: "Non",
    info: "Un poids minimum de 50 kg est requis pour bien tolérer le volume de sang prélevé.",
    yesText: "Le prélèvement d'une poche de sang représente un certain volume. Pour que tu le tolères bien, sans fatigue excessive, un poids minimum de 50 kg est demandé pour te protéger.",
    noText: "Tu as le gabarit pour donner !",
    bg: "background_space.png", mobileBg: "bkgMobile/background_space_mobile.png", folder: "05_weight", prefix: "weight", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[75vh]"
  },
  {
    text: "As-tu été piqué par une tique dans les 4 dernières semaines?",
    correct: "Non",
    info: "Les tiques peuvent transmettre des maladies. Il faut attendre un mois sans développer de symptômes.",
    yesText: "Aïe, c’est vraiment des sales bêtes! Pour être sûr qu’elle ne t’ait rien transmis, il va falloir attendre un peu avant de pouvoir donner du sang.",
    noText: "La tique a raté sa cible, zéro souci !",
    bg: "background_space.png", mobileBg: "bkgMobile/background_space_mobile.png", folder: "06_tick", prefix: "tick", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[75vh] translate-x-4 md:translate-x-12"
  },
  {
    text: "As-tu fait de l'acupuncture ou un tatouage dans les 4 derniers mois?",
    correct: "Non",
    info: "Tout acte perçant la peau comporte un risque d'infection virale. Un délai de 4 mois est demandé.",
    yesText: "Si tu t’es fait piquer récemment, il va falloir attendre un moment avant de pouvoir donner.",
    noText: "Les aliens ont tout géré, tu es sauvé !",
    bg: "background_space.png", mobileBg: "bkgMobile/background_space_mobile.png", folder: "07_acupuncture", prefix: "acupuncture", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[75vh]"
  },
  {
    text: "As-tu ressenti une douleur thoracique ou un essoufflement anormal récemment?",
    correct: "Non",
    info: "Le don sollicite le cœur. Des douleurs récentes nécessitent un avis médical pour ta sécurité.",
    yesText: "Il faudrait peut-être consulter un médecin sur le sujet? Je ne voudrais pas que tu fasses un malaise en donnant ton sang, il faudrait régler ça d’abord!",
    noText: "Ton cœur brille, il est au top !",
    bg: "background_lab_desktop.png", mobileBg: "bkgMobile/Background_lab_mobile.png", folder: "08_pain", prefix: "pain", hasYes: true, hasNo: true,
    imageClass: "max-h-[25vh] md:max-h-[55vh] translate-y-6 md:translate-y-16"
  },
  {
    text: "As-tu eu une gastroscopie ou coloscopie au cours des 4 derniers mois ?",
    correct: "Non",
    info: "Ces examens comportent un faible risque de transmission virale ou bactérienne.",
    yesText: "J’espère que ce n’était rien de grave pour toi. Après une anesthésie, il faut attendre un moment avant de donner son sang. Reviens bientôt!",
    noText: "Analyse terminée, l'alien valide, tout va bien !",
    bg: "background_lab_desktop.png", mobileBg: "bkgMobile/Background_lab_mobile.png", folder: "09_gastroscopy", prefix: "gastroscopy", hasYes: true, hasNo: true,
    imageClass: "max-h-[35vh] md:max-h-[70vh] translate-y-4 md:translate-y-12"
  },
  {
    text: "As-tu bénéficié d’un détartrage dans les 24 dernières heures ou d’un traitement dentaire dans les 7 derniers jours ?",
    correct: "Non",
    info: "Les soins dentaires peuvent libérer des bactéries dans le sang. Un délai d'attente élimine ce risque.",
    yesText: "C’est super pour tes dents, mais le risque d’infection est trop élevé pour donner du sang tout suite. Réessayons plus tard!",
    noText: "Une seule dent au compteur, mais ça passe !",
    bg: "background_lab_desktop.png", mobileBg: "bkgMobile/Background_lab_mobile.png", folder: "10_dental", prefix: "dental", hasYes: true, hasNo: true,
    imageClass: "max-h-[25vh] md:max-h-[60vh] translate-y-6 md:translate-y-12"
  },
  {
    text: "Ces quatre dernières semaines, as-tu pris des médicaments ou reçu un vaccin ?",
    correct: "Non",
    info: "La prise de médicaments ou une vaccination récente nécessite une évaluation et parfois un délai d'attente.",
    yesText: "Oups... On ne peut pas risquer de transmettre des produits avec le sang donné, il va falloir attendre qu’ils quittent ton organisme!",
    noText: "Le deuxième alien veille au grain, pas de substance parasite !",
    bg: "background_lab_desktop.png", mobileBg: "bkgMobile/Background_lab_mobile.png", folder: "11_medecine", prefix: "medecine", hasYes: true, hasNo: true,
    imageClass: "max-h-[30vh] md:max-h-[75vh] scale-[1.3] md:scale-[1.5] translate-y-8 md:translate-y-24"
  },
  {
    text: "As-tu déjà reçu une greffe d'organe?",
    correct: "Non",
    info: "Les receveurs d'organes sont définitivement exclus du don pour éviter tout risque de transmission.",
    yesText: "Moi aussi! Malheureusement, je viens d’apprendre que pour des raisons de sécurité les receveurs de greffe ne pouvaient pas donner leur sang. Merci d’avoir fait ce voyage avec moi! Invitons d’autres personnes à y aller pour nous!",
    noText: "Génial ! Ton voyage intergalactique touche à sa fin, tu as tous les critères pour sauver des vies !",
    bg: "background_lab_desktop.png", mobileBg: "bkgMobile/Background_lab_mobile.png", folder: "12_transplant", prefix: "transplant", hasYes: true, hasNo: true,
    imageClass: "max-h-[25vh] md:max-h-[65vh] translate-y-8 md:translate-y-24"
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
    if (selectedAnswer.value === 'Oui' && q.hasYes) suffix = 'yes';
    else if (selectedAnswer.value === 'Non' && q.hasNo) suffix = 'no';
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

  const isCorrect = questions[currentQuestionIndex.value].correct === answer;

  if (!isCorrect) {
    setTimeout(() => {
      isAnimating.value = false;
      currentState.value = 'ineligible';
      flightClass.value = '';
    }, 300);
  } else {
    if (currentQuestionIndex.value === 0 && answer === 'Non') {
      flightClass.value = 'fly-up-animation';
    }

    setTimeout(() => {
      isAnimating.value = false;
      flightClass.value = '';
      proceedToNext();
    }, 3800);
  }
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
  transition: opacity 0.5s ease-in-out;
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
