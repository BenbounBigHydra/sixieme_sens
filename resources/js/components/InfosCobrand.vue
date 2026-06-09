<template>
  <div class="w-full bg-[#fffbf1] min-h-screen font-['Inter']">
    <!-- Hero Banner -->
    <div class="w-full h-[110px] md:h-[180px]"
         :style="{
           backgroundColor: computedCompanyColor,
           maskImage: 'url(/images/unionUpsidedown.svg)',
           WebkitMaskImage: 'url(/images/unionUpsidedown.svg)',
           maskSize: 'cover',
           WebkitMaskSize: 'cover',
           maskPosition: 'bottom',
           WebkitMaskPosition: 'bottom',
           maskRepeat: 'no-repeat',
           WebkitMaskRepeat: 'no-repeat'
         }">
    </div>
    <div class="w-full pt-2 pb-12 mb-12">
      <h1 class="text-center font-['Jersey_20'] text-5xl md:text-6xl text-black">
        Tout savoir avant de donner
      </h1>
    </div>

    <div class="max-w-desktop mx-auto px-8 md:px-20 lg:px-32 xl:px-40 flex flex-col md:flex-row gap-12 pb-24">

      <!-- Sidebar -->
      <aside class="w-full md:w-1/4 md:border-r-[3px] md:border-black md:pr-12 lg:pr-16 shrink-0">
        <nav class="flex flex-col font-['Jersey_20'] text-[28px] tracking-wide space-y-4 mb-12">
          <button @click="activeTab = 'processus'" :class="{'bg-[#0073e6] text-white px-4 py-2 text-left': activeTab === 'processus', 'text-black hover:text-[#0073e6] text-left': activeTab !== 'processus'}">Le processus</button>
          <button @click="activeTab = 'types'" :class="{'bg-[#0073e6] text-white px-4 py-2 text-left': activeTab === 'types', 'text-black hover:text-[#0073e6] text-left': activeTab !== 'types'}">Types de don</button>
          <button @click="activeTab = 'faq'" :class="{'bg-[#0073e6] text-white px-4 py-2 text-left': activeTab === 'faq', 'text-black hover:text-[#0073e6] text-left': activeTab !== 'faq'}">FAQ</button>
          <button @click="activeTab = 'eligibility'" :class="{'bg-[#0073e6] text-white px-4 py-2 text-left': activeTab === 'eligibility', 'text-black hover:text-[#0073e6] text-left': activeTab !== 'eligibility'}">Puis-je donner ?</button>
        </nav>

        <div class="bg-[#ffcc00] border-2 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
          <h3 class="font-['Inter'] font-bold text-lg bg-white px-4 py-2 block text-center border-2 border-black mb-4">Prêt à donner ?</h3>
          <p class="font-['Inter'] text-sm text-black mb-6 text-center">Commencez par le quiz. Moins de 5min.</p>
          <a :href="quizzUrl" class="block text-center bg-[#0073e6] text-white font-['Inter'] font-bold py-3 hover:bg-[#0073e6]/90 transition-all border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">Faire le quiz</a>
        </div>
      </aside>

      <!-- Main Content -->
      <main class="w-full md:w-3/4">

        <!-- Processus Tab -->
        <div v-show="activeTab === 'processus'" class="space-y-6">
          <h2 class="font-['Jersey_20'] text-4xl md:text-5xl mb-6 text-black tracking-wide">Comment se déroule un don</h2>
          <div class="border-2 border-black bg-[#fffbf1] p-0 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex flex-col">
            <h3 class="bg-[#ffcc00] font-['Jersey_20'] text-2xl tracking-wide px-4 py-3 border-b-2 border-black">01 Accueil et vérification d'identité</h3>
            <div class="p-4 font-['Inter'] text-sm leading-relaxed text-black">
              <ul class="list-disc pl-8 space-y-1">
                <li>Se rendre au lieu de la collecte</li>
                <li>Présenter sa pièce d'identité</li>
                <li>Remplir un formulaire médical (disponible en ligne au préalable)</li>
              </ul>
            </div>
          </div>
          <div class="border-2 border-black bg-[#fffbf1] p-0 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex flex-col">
            <h3 class="bg-[#ffcc00] font-['Jersey_20'] text-2xl tracking-wide px-4 py-3 border-b-2 border-black">02 Entretien médical confidentiel</h3>
            <div class="p-4 font-['Inter'] text-sm leading-relaxed text-black">
              <ul class="list-disc pl-8 space-y-1">
                <li>Évaluation de votre état de santé par un·e médecin / infirmier·ère</li>
                <li>Vérification de votre hémoglobine avec une micropiqûre au doigt</li>
                <li>Confirmation de votre éligibilité du jour</li>
              </ul>
            </div>
          </div>
          <div class="border-2 border-black bg-[#fffbf1] p-0 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex flex-col">
            <h3 class="bg-[#ffcc00] font-['Jersey_20'] text-2xl tracking-wide px-4 py-3 border-b-2 border-black">03 Le don</h3>
            <p class="p-4 font-['Inter'] text-sm leading-relaxed text-black">Allongé confortablement, une infirmière effectue le prélèvement. La sensation est comparable à une prise de sang ordinaire. Environ 450 ml sont collectés.</p>
          </div>
          <div class="border-2 border-black bg-[#fffbf1] p-0 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex flex-col">
            <h3 class="bg-[#ffcc00] font-['Jersey_20'] text-2xl tracking-wide px-4 py-3 border-b-2 border-black">04 Collation et repos</h3>
            <p class="p-4 font-['Inter'] text-sm leading-relaxed text-black">Après le don, une collation vous est offerte. Un temps de repos est recommandé avant de reprendre vos activités. Hydratez-vous bien dans les heures qui suivent.</p>
          </div>
        </div>

        <!-- Types de don Tab -->
        <div v-show="activeTab === 'types'" class="space-y-6">
          <h2 class="font-['Jersey_20'] text-4xl md:text-5xl mb-6 text-black tracking-wide">Types de don</h2>

          <div class="border-[3px] border-black bg-[#fffbf1] p-6 md:p-8 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] flex flex-col">
            <div class="bg-[#ffcc00] px-4 md:px-6 py-3 md:py-4 flex justify-between items-center font-normal font-['Jersey_20'] tracking-wide text-2xl md:text-4xl mb-8">
              <span>Don de sang total</span>
              <span>~45 min</span>
            </div>
            <div class="flex flex-col lg:flex-row justify-between items-start gap-8 mb-12">
              <p class="font-['Inter'] text-base md:text-lg text-black lg:max-w-[50%]">Le plus courant. Le sang complet est prélevé puis séparé en composants, globules rouges, plasma, plaquettes, qui bénéficient à plusieurs patients.</p>
              
              <div class="border-[1px] border-black p-6 w-full lg:w-auto shrink-0 flex flex-col gap-2 font-['Inter'] text-base md:text-lg bg-[#fffbf1]">
                <div class="flex justify-between gap-12">
                  <span>Volume</span>
                  <span>450 ml</span>
                </div>
                <div class="flex justify-between gap-12">
                  <span>Fréquence max.</span>
                  <span>4x/an</span>
                </div>
              </div>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mt-auto">
              <a :href="quizzUrl" class="bg-[#0073e6] text-white px-8 py-3 font-['Jersey_20'] tracking-wide text-2xl border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:bg-[#0073e6]/90 transition-all">Je participe</a>
              <img src="/images/hug_icon.png" alt="HUG Logo" class="h-8 md:h-10 object-contain" onerror="this.style.display='none'" />
            </div>
          </div>

          <div class="border-[3px] border-black bg-[#fffbf1] p-6 md:p-8 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] flex flex-col">
            <div class="bg-[#ffcc00] px-4 md:px-6 py-3 md:py-4 flex justify-between items-center font-normal font-['Jersey_20'] tracking-wide text-2xl md:text-4xl mb-8">
              <span>Don de plaquettes</span>
              <span>~120 min</span>
            </div>
            <div class="flex flex-col lg:flex-row justify-between items-start gap-8 mb-12">
              <p class="font-['Inter'] text-base md:text-lg text-black lg:max-w-[50%]">Les plaquettes sont extraites du sang par aphérèse, le reste étant restitué au donneur. Essentielles aux patients sous chimiothérapie ou atteints de leucémie.</p>
              
              <div class="border-[1px] border-black p-6 w-full lg:w-auto shrink-0 flex flex-col gap-2 font-['Inter'] text-base md:text-lg bg-[#fffbf1]">
                <div class="flex justify-between gap-12">
                  <span>Volume</span>
                  <span>450 ml</span>
                </div>
                <div class="flex justify-between gap-12">
                  <span>Fréquence max.</span>
                  <span>4x/an</span>
                </div>
              </div>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mt-auto">
              <div class="bg-[#ffbfa8] px-6 py-3 font-['Inter'] text-base md:text-lg text-black">Non disponible lors de cette collecte. Pour donner vos plaquettes, contactez directement le CTS.</div>
              <img src="/images/hug_icon.png" alt="HUG Logo" class="h-8 md:h-10 object-contain" onerror="this.style.display='none'" />
            </div>
          </div>

          <div class="border-[3px] border-black bg-[#fffbf1] p-6 md:p-8 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] flex flex-col">
            <div class="bg-[#ffcc00] px-4 md:px-6 py-3 md:py-4 flex justify-between items-center font-normal font-['Jersey_20'] tracking-wide text-2xl md:text-4xl mb-8">
              <span>Don de cellules souches</span>
              <span>Sur demande</span>
            </div>
            <p class="font-['Inter'] text-base md:text-lg text-black mb-12 lg:max-w-[50%]">Le don de cellules souches permet de traiter des maladies du sang graves. L'inscription au registre est ouverte aux 18-60 ans en bonne santé.</p>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mt-auto">
              <div class="bg-[#ffbfa8] px-6 py-3 font-['Inter'] text-base md:text-lg text-black">Non disponible lors de cette collecte. Pour vous inscrire au registre, rendez-vous sur le site de la Croix-Rouge suisse.</div>
              <img src="/images/CroixRouge.svg" alt="Croix Rouge Logo" class="h-8 md:h-10 object-contain" onerror="this.style.display='none'" />
            </div>
          </div>
        </div>


        <!-- FAQ Tab -->
        <div v-show="activeTab === 'faq'" class="space-y-0">
          <h2 class="font-['Jersey_20'] text-4xl md:text-5xl mb-6 text-black tracking-wide">Questions fréquentes</h2>
          <div class="flex flex-col lg:flex-row gap-12 lg:gap-8 items-start">
            <!-- FAQ List (Left) -->
            <div class="w-full lg:w-6/12">
               <div v-for="(item, index) in faqList" :key="index" class="border-b-[1px] border-[#0073e6]">
                  <button @click="toggleFaq(index)" class="w-full flex items-center justify-between py-4 md:py-6 text-left hover:bg-black/5 transition-colors focus:outline-none">
                     <span class="font-['Inter'] text-base md:text-lg pr-4" :class="openFaq === index ? 'font-bold text-[#0073e6]' : 'text-black'">{{ item.q }}</span>
                  </button>
               </div>
            </div>

            <!-- Roby & Speech Bubble (Right) -->
            <div class="w-full lg:w-6/12 flex flex-col md:flex-row items-center md:items-start justify-center lg:justify-end gap-6 relative mt-8 lg:mt-0 lg:sticky lg:top-32" ref="robyFaqContainer">
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
              <img src="/images/roby_smiling_left.png" alt="Roby" class="h-40 md:h-48 object-contain shrink-0" />
            </div>
          </div>
        </div>

        <!-- Puis-je donner Tab -->
        <div v-show="activeTab === 'eligibility'">
          <h2 class="font-['Jersey_20'] text-4xl md:text-5xl mb-6 text-black tracking-wide">Vérification d’éligibilité</h2>
          <p class="font-['Inter'] text-base md:text-lg mb-6 text-black">Vous voulez être certain de votre éligibilité avant de prendre rendez-vous pour donner votre sang ?<br/><br/>Consultez l'ensemble des critères officiels du Centre de Transfusion Sanguine.</p>
          <a href="https://www.hug.ch/don-du-sang/puis-je-donner-mon-sang" target="_blank" class="inline-block bg-[#0073e6] text-white px-8 py-3 font-bold text-base hover:bg-[#0073e6]/90 mb-12 border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all">Consulter les critères</a>

          <p class="font-['Inter'] text-base md:text-lg mb-6 text-black">Ou répondez à notre quiz interactif en moins de 5 minutes.</p>
          <a :href="quizzUrl" class="inline-block bg-[#0073e6] text-white px-8 py-3 font-bold text-base hover:bg-[#0073e6]/90 border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all">Faire le quiz</a>
        </div>

      </main>
    </div>
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
    try {
      return JSON.parse(props.initialData);
    } catch (e) {
      return {};
    }
  }
  return props.initialData || {};
});

const activeTab = ref('processus');

const openFaq = ref(null);
const robyFaqContainer = ref(null);

const toggleFaq = (index) => {
  openFaq.value = openFaq.value === index ? null : index;
  if (openFaq.value !== null && window.innerWidth < 1024) {
    setTimeout(() => {
      if (robyFaqContainer.value) {
        robyFaqContainer.value.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
    }, 100);
  }
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

const companySlug = ref('');
const collectionId = ref('');

onMounted(() => {
  const parts = window.location.pathname.split('/');
  companySlug.value = parts[2] || '';
  collectionId.value = parts[3] || '';
});

const company = computed(() => parsedData.value.company);

const computedCompanyColor = computed(() => {
  if (!company.value?.color) return '#0073e6';
  return company.value.color.startsWith('#') ? company.value.color : `#${company.value.color}`;
});

const quizzUrl = computed(() => {
  if (!companySlug.value) return '#';
  return `/collection/${companySlug.value}/${collectionId.value}/quizz`;
});

</script>
