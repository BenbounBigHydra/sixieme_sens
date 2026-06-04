<template>
    <div class="min-h-screen bg-[#2D2144] bg-cover bg-center flex flex-col justify-between"
        style="background-image: url('/images/Background-Space.png');">

        <!-- LANDING STATE -->
        <div v-if="currentState === 'landing'"
            class="p-8 md:p-12 lg:p-16 h-full flex flex-col justify-between flex-grow">
            <div>
                <!-- Back button -->
                <a :href="homeLink"
                    class="inline-flex items-center gap-2 border-[2px] border-[#b3d9ff] px-4 py-2 text-[#D5D9ED] font-inter hover:bg-[#fffbf1]/10 transition-colors">
                    <img src="/images/Angle Left.svg" alt="Back" class="w-4 h-4"
                        style="filter: brightness(0) saturate(100%) invert(91%) sepia(8%) saturate(996%) hue-rotate(193deg) brightness(99%) contrast(93%);" />
                    <span class="text-[#fffbf1] text-sm md:text-base">Retourner à l'accueil</span>
                </a>

                <!-- Content -->
                <div class="mt-16 md:mt-24 max-w-xl">
                    <h1 class="font-jersey text-[40px] md:text-[56px] lg:text-[64px] text-[#fffbf1] leading-[1.1] mb-6">
                        Bienvenue dans<br />l’aventure de Roby !
                    </h1>

                    <p class="font-inter text-[#fffbf1] text-sm md:text-base leading-relaxed mb-10">
                        Ce quiz interactif pose quelques questions sur votre santé pour vérifier que vous puissiez
                        donner sans risque. C'est rapide, confidentiel*, et ça remplace les formulaires habituels. Si
                        vous passez, vous débloquez la prise de RDV.
                    </p>

                    <button @click="startQuiz"
                        class="inline-block border-[2px] border-[#b3d9ff] px-6 md:px-8 py-3 md:py-4 text-[#fffbf1] font-inter text-base md:text-lg hover:bg-[#fffbf1]/10 transition-colors mb-6">
                        Commencer le quizz
                    </button>

                    <p class="font-inter text-[#fffbf1]/80 text-[12px] md:text-sm leading-snug">
                        *Les réponses ne sont pas enregistrées, elles servent<br class="hidden md:block" /> uniquement à
                        vérifier votre éligibilité en temps réel
                    </p>
                </div>
            </div>

            <!-- Bottom left text -->
            <div class="mt-12 flex justify-start">
                <div class="max-w-md text-left">
                    <p class="font-inter text-[#D5D9ED] text-[12px] md:text-sm leading-snug">
                        Si vous êtes un habitué et que vous connaissez les<br class="hidden md:block" /> critères, vous
                        pouvez ignorer le quiz <a href="#"
                            class="text-[#b3d9ff] hover:text-[#fffbf1] transition-colors underline">en cliquant ici</a>.
                    </p>
                </div>
            </div>
        </div>

        <!-- QUIZ STATE -->
        <div v-else-if="currentState === 'quiz'"
            class="p-8 md:p-12 lg:p-16 h-full flex flex-col justify-between flex-grow">
            <div>
                <button @click="goBackQuestion"
                    class="inline-flex items-center gap-2 border-[2px] border-[#b3d9ff] px-4 py-2 text-[#D5D9ED] font-inter hover:bg-[#fffbf1]/10 transition-colors">
                    <img src="/images/Angle Left.svg" alt="Back" class="w-4 h-4"
                        style="filter: brightness(0) saturate(100%) invert(91%) sepia(8%) saturate(996%) hue-rotate(193deg) brightness(99%) contrast(93%);" />
                    <span class="text-[#fffbf1] text-sm md:text-base">
                        {{ currentQuestionIndex === 0 ? 'Retour à l\'introduction' : 'Question précédente' }}
                    </span>
                </button>
            </div>

            <div class="mt-28 md:mt-36 max-w-2xl flex-grow flex flex-col justify-center">
                <h2
                    class="font-jersey text-[28px] md:text-[40px] text-[#fffbf1] leading-tight mb-10 whitespace-pre-line relative z-10">
                    {{ questions[currentQuestionIndex].text }}&nbsp;<span
                        class="inline-block align-middle cursor-pointer" @mouseenter="showTooltip = true"
                        @mouseleave="showTooltip = false" @click="showTooltip = !showTooltip">
                        <img src="/images/info.svg" alt="Info" class="w-6 h-6 md:w-8 md:h-8"
                            style="filter: brightness(0) invert(1);" />
                    </span>
                    <!-- Tooltip Popup -->
                    <div v-if="showTooltip"
                        class="absolute bottom-full left-0 mb-4 w-[calc(100vw-2rem)] md:max-w-[600px] p-4 bg-[#fffbf1] text-black font-inter text-sm md:text-base border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-50 font-normal leading-relaxed text-left">
                        {{ questions[currentQuestionIndex].info }}
                    </div>
                </h2>

                <div class="flex gap-6">
                    <button @click="answerQuestion('Oui')"
                        class="flex-1 max-w-[200px] border-[2px] border-[#b3d9ff] px-6 py-4 text-[#fffbf1] font-inter text-lg hover:bg-[#fffbf1]/10 transition-colors">
                        Oui
                    </button>
                    <button @click="answerQuestion('Non')"
                        class="flex-1 max-w-[200px] border-[2px] border-[#b3d9ff] px-6 py-4 text-[#fffbf1] font-inter text-lg hover:bg-[#fffbf1]/10 transition-colors">
                        Non
                    </button>
                </div>
            </div>

            <!-- Footer Counter -->
            <div class="mt-8 font-inter font-bold text-[#b3d9ff] text-sm tracking-widest uppercase">
                QUESTION {{ currentQuestionIndex + 1 }} / {{ questions.length }}
            </div>
        </div>

        <!-- INELIGIBLE STATE -->
        <div v-else-if="currentState === 'ineligible'"
            class="p-8 md:p-12 lg:p-16 h-full flex flex-col justify-center flex-grow">
            <div class="max-w-2xl">
                <h2 class="font-jersey text-[48px] md:text-[64px] text-[#fffbf1] leading-tight mb-8">
                    Pas cette fois…
                </h2>

                <p class="font-inter text-[#fffbf1] text-base md:text-lg leading-relaxed mb-12">
                    Les critères d'éligibilité ne sont pas là pour décourager, ils sont là pour protéger. Protéger les
                    patients qui recevront votre sang, mais aussi vous. Certaines contre-indications sont temporaires.
                    Si c'est votre cas aujourd'hui, ça ne le sera peut-être plus lors de la prochaine collecte.
                </p>

                <div class="flex flex-col sm:flex-row gap-6">
                    <button @click="continueQuiz"
                        class="border-[2px] border-[#b3d9ff] px-8 py-4 text-[#fffbf1] font-inter text-lg hover:bg-[#fffbf1]/10 transition-colors text-center">
                        Continuer le quizz
                    </button>
                    <a :href="homeLink"
                        class="border-[2px] border-[#b3d9ff] px-8 py-4 text-[#fffbf1] font-inter text-lg hover:bg-[#fffbf1]/10 transition-colors text-center inline-block">
                        Retourner à l'accueil
                    </a>
                </div>
            </div>
        </div>

        <!-- SUCCESS STATE -->
        <div v-else-if="currentState === 'success'" class="p-8 md:p-12 lg:p-16 h-full flex flex-col flex-grow">
            <div>
                <!-- Back button -->
                <a :href="homeLink"
                    class="inline-flex items-center gap-2 border-[2px] border-[#b3d9ff] px-4 py-2 text-[#D5D9ED] font-inter hover:bg-[#fffbf1]/10 transition-colors">
                    <img src="/images/Angle Left.svg" alt="Back" class="w-4 h-4"
                        style="filter: brightness(0) saturate(100%) invert(91%) sepia(8%) saturate(996%) hue-rotate(193deg) brightness(99%) contrast(93%);" />
                    <span class="text-[#fffbf1] text-sm md:text-base">Retourner à l'accueil</span>
                </a>
            </div>

            <div class="mt-16 md:mt-24 max-w-2xl flex-grow flex flex-col justify-center">
                <h2 class="font-jersey text-[48px] md:text-[64px] text-[#fffbf1] leading-tight mb-8">
                    On vous attend !
                </h2>

                <p class="font-inter text-[#fffbf1] text-base md:text-lg leading-relaxed mb-12">
                    La prise de rendez-vous se fait via OneDoc. Vous allez être redirigé vers le calendrier de la
                    collecte {{ company.name || '[entreprise]' }}. Choisissez simplement le créneau qui vous convient et
                    confirmez votre inscription.
                </p>

                <div>
                    <a href="#"
                    @click.prevent="handleOnedocClick"
                        class="inline-block border-[2px] border-[#b3d9ff] px-8 py-4 text-[#fffbf1] font-inter text-lg hover:bg-[#fffbf1]/10 transition-colors">
                        Prendre rendez-vous
                    </a>
                </div>
            </div>
        </div>

    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';

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
        info: "Certains pays présentent des risques de maladies transmissibles par le sang (paludisme, virus Zika, dengue, etc.). Un délai d'attente peut s'appliquer selon votre destination. (Vérifiable sur le Travelcheck de Transfusion CRS Suisse)."
    },
    {
        text: "Avez-vous actuellement une plaie ou avez-vous été opéré récemment ?",
        correct: "Non",
        info: "Une plaie ouverte ou une intervention chirurgicale récente augmente le risque d'infection bactérienne dans le sang. Un délai est nécessaire pour s'assurer que la cicatrisation est complète et sans complication."
    },
    {
        text: "En ce moment, vous sentez-vous en bonne santé et n’avez-vous pas de symptôme de refroidissement et de fièvre ?",
        correct: "Oui",
        info: "Pour protéger le receveur ainsi que vous-même, vous devez être en parfaite santé le jour du don. Les maux de gorge, toux, ou fièvre nécessitent d'attendre au moins 2 semaines après la disparition des symptômes."
    },
    {
        text: "Avez-vous eu des relations sexuelles avec des partenaires multiples au cours de 12 derniers mois ou avec une nouvelle ou nouveau partenaire ces quatre derniers mois ?",
        correct: "Non",
        info: "Avoir de multiples partenaires ou un nouveau partenaire sexuel récent augmente le risque d'infections transmissibles par le sang (VIH, hépatites). Un délai de 4 à 12 mois est appliqué selon les situations pour garantir la sécurité transfusionnelle."
    },
    {
        text: "Pesez-vous au moins 50 kg ?",
        correct: "Oui",
        info: "Le volume de sang prélevé (environ 450 ml) est calculé pour être bien toléré par une personne pesant au moins 50 kg. En dessous de ce poids, le don pourrait causer des malaises ou une anémie."
    },
    {
        text: "Avez-vous été piqué par une tique dans les 4 dernières semaines?",
        correct: "Non",
        info: "La piqûre de tique peut transmettre des maladies comme la maladie de Lyme. Un délai d'attente d'un mois minimum est requis après la piqûre, à condition de n'avoir développé aucun symptôme."
    },
    {
        text: "Avez-vous fait de l'acupuncture dans les 4 derniers mois?",
        correct: "Non",
        info: "Tout acte perçant la peau (acupuncture, tatouage, piercing) comporte un risque d'infection virale s'il n'est pas réalisé avec du matériel stérile à usage unique. Un délai de 4 mois est généralement demandé."
    },
    {
        text: "Avez-vous ressenti une douleur thoracique ou un essoufflement anormal récemment?",
        correct: "Non",
        info: "Le don de sang sollicite le système cardiovasculaire. Les antécédents de maladies cardiaques ou des symptômes récents nécessitent une évaluation médicale approfondie pour ne pas mettre votre propre santé en danger."
    },
    {
        text: "Avez-vous eu une gastroscopie ou coloscopie au cours des 4 derniers mois ?",
        correct: "Non",
        info: "Les examens endoscopiques comportent un risque minime mais existant de transmission virale ou bactérienne via le matériel. Un délai d'attente de 4 mois est requis après l'intervention."
    },
    {
        text: "Avez-vous bénéficié d’un détartrage dans les 24 dernières heures ou d’un traitement dentaire dans les 7 derniers jours ?",
        correct: "Non",
        info: "Un détartrage ou un traitement dentaire peut libérer des bactéries de la bouche dans la circulation sanguine (bactériémie transitoire). Attendre de 24h à 7 jours permet d'éliminer ce risque d'infection pour le receveur."
    },
    {
        text: "Ces quatre dernières semaines, avez-vous pris des médicaments ou reçu un vaccin ?",
        correct: "Non",
        info: "La prise de médicaments ou la vaccination récente nécessite une évaluation. Des antibiotiques nécessitent 2 semaines d'attente. Les antalgiques simples (Dafalgan, Ibuprofène) sont souvent acceptés s'ils sont pris pour des maux mineurs sans fièvre, mais la raison de la prise est toujours évaluée."
    },
    {
        text: "Avez-vous déjà reçu une greffe d'organe?",
        correct: "Non",
        info: "Les receveurs d'organes ou de tissus (comme la cornée ou la dure-mère) sont définitivement exclus du don de sang en raison du risque de transmission de maladies infectieuses ou à prions."
    }
];

const currentState = ref('landing'); // 'landing', 'quiz', 'ineligible', 'success'
const currentQuestionIndex = ref(0);
const userAnswers = ref([]); // Track their answers
const showTooltip = ref(false); // Track tooltip visibility

// Load state from local storage on mount
onMounted(() => {
    const savedState = localStorage.getItem('quizzState_' + collection.value.id);
    if (savedState) {
        const parsed = JSON.parse(savedState);
        currentState.value = parsed.currentState || 'landing';
        currentQuestionIndex.value = parsed.currentQuestionIndex || 0;
        userAnswers.value = parsed.userAnswers || [];
    }
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
};

const goBackQuestion = () => {
    showTooltip.value = false;
    if (currentQuestionIndex.value > 0) {
        currentQuestionIndex.value--;
    } else {
        currentState.value = 'landing';
    }
};

const answerQuestion = (answer) => {
    showTooltip.value = false;
    // Save the answer
    userAnswers.value[currentQuestionIndex.value] = answer;

    const isCorrect = questions[currentQuestionIndex.value].correct === answer;

    if (!isCorrect) {
        currentState.value = 'ineligible';
    } else {
        proceedToNext();
    }
};

const continueQuiz = () => {
    if (currentQuestionIndex.value === questions.length - 1) {
        // Si on est à la dernière question, "Continuer le quizz" nous ramène à la question
        currentState.value = 'quiz';
    } else {
        proceedToNext();
    }
};

const proceedToNext = () => {
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
            currentState.value = 'ineligible'; // Stay or go back to ineligible if finished with errors
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
        window.location.href = collection._value.onedoc_link;
    }
};
</script>
