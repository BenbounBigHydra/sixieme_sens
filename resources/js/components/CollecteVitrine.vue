<template>
  <div class="w-full bg-[#fffbf1] min-h-screen">
    <section class="max-w-desktop mx-auto px-4 md:px-8 lg:px-32 xl:px-40 pt-12 pb-20">

      <!-- Header text -->
      <div class="flex flex-col items-center md:items-start text-center md:text-left mb-10">
        <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
        <h1 class="font-['Jersey_20'] text-[36px] md:text-[64px] leading-[1.1] font-normal text-black mb-4 tracking-wide">
          Organiser une collecte
        </h1>
        <p class="font-['Inter'] text-sm md:text-base text-black w-full max-w-4xl leading-relaxed">
          Pour accueillir une collecte en entreprise, deux conditions sont requises : disposer d'un espace d'au moins 100 m² et avoir réuni plus de 50 promesses de don. La planification doit être initiée au moins 3 mois à l'avance. Remplissez le formulaire ci-dessous et le CTS vous recontactera pour établir le planning ensemble.
        </p>
      </div>

      <!-- Success Message -->
      <div v-if="isSubmitted" ref="successMessageRef" class="bg-[#caefb2] text-black font-['Inter'] px-6 py-4 flex items-center gap-4 mb-8 w-full">
        <img src="/images/BlackCheck.svg" alt="Check" class="w-6 h-6 flex-shrink-0" />
        <span class="text-base md:text-lg font-bold">Merci ! Votre demande a bien été transmise.</span>
      </div>

      <!-- Form -->
      <!-- Form -->
      <form v-else @submit.prevent="submitForm" class="w-full font-['Inter'] text-black flex flex-col gap-6">

        <!-- Row 1 -->
        <div class="flex flex-col md:flex-row gap-6 md:gap-12">
          <!-- Nom de l'entreprise -->
          <div class="flex-1 flex flex-col gap-2">
            <label class="text-sm md:text-base text-left">Nom de l'entreprise</label>
            <div class="w-full border-[2px] border-black px-4 bg-[#fffbf1] shadow-[8px_8px_0px_0px_#0073e6] flex justify-between items-center h-[60px] focus-within:ring-2 focus-within:ring-[#0073e6] transition-shadow">
              <input type="text" v-model="form.nom" class="flex-1 bg-transparent focus:outline-none w-full" />
              <span class="text-red-500 font-bold ml-2 flex-shrink-0">*</span>
            </div>
          </div>

          <!-- Nombre d'employés -->
          <div class="flex-1 flex flex-col gap-2">
            <label class="text-sm md:text-base text-left">Nombre d'employés</label>
            <div class="w-full border-[2px] border-black px-4 bg-[#fffbf1] shadow-[8px_8px_0px_0px_#0073e6] flex justify-between items-center h-[60px] focus-within:ring-2 focus-within:ring-[#0073e6] transition-shadow">
              <input type="text" v-model="form.employes" @input="form.employes = form.employes.replace(/\D/g, '')" class="flex-1 bg-transparent focus:outline-none w-full" />
              <span class="text-red-500 font-bold ml-2 flex-shrink-0">*</span>
            </div>
          </div>
        </div>

        <!-- Row 2 -->
        <div class="flex flex-col md:flex-row gap-6 md:gap-12">
          <!-- Mail -->
          <div class="flex-1 flex flex-col gap-2">
            <label class="text-sm md:text-base text-left">Mail</label>
            <div :class="['w-full border-[2px] px-4 shadow-[8px_8px_0px_0px_#0073e6] flex justify-between items-center h-[60px] transition-colors',
                         showEmailError ? 'border-[#e62b1d] bg-[#fad7d5] text-[#e62b1d]' : 'border-black bg-[#fffbf1] text-black focus-within:ring-2 focus-within:ring-[#0073e6]']">
              <input type="email" v-model="form.mail" @input="validateEmail" class="flex-1 bg-transparent focus:outline-none w-full" />
              <span class="font-bold ml-2 flex-shrink-0" :class="showEmailError ? 'text-[#e62b1d]' : 'text-red-500'">*</span>
            </div>
            <span v-if="showEmailError" class="text-xs text-[#e62b1d] mt-1">Veuillez entrer un mail valide.</span>
          </div>

          <!-- Téléphone -->
          <div class="flex-1 flex flex-col gap-2">
            <label class="text-sm md:text-base text-left">Téléphone</label>
            <div class="w-full border-[2px] border-black px-4 bg-[#fffbf1] shadow-[8px_8px_0px_0px_#0073e6] flex justify-between items-center h-[60px] focus-within:ring-2 focus-within:ring-[#0073e6] transition-shadow">
              <input type="tel" v-model="form.telephone" @input="form.telephone = form.telephone.replace(/[^\d+]/g, '')" class="flex-1 bg-transparent focus:outline-none w-full" />
            </div>
          </div>
        </div>

        <!-- Row 3 -->
        <div class="flex flex-col gap-2 mb-4">
          <label class="text-sm md:text-base text-left">Message</label>
          <div class="w-full border-[2px] border-black px-4 bg-[#fffbf1] shadow-[8px_8px_0px_0px_#0073e6] flex justify-between items-center h-[60px] focus-within:ring-2 focus-within:ring-[#0073e6] transition-shadow">
            <input type="text" v-model="form.message" placeholder="Vos questions ou précisions" class="flex-1 bg-transparent focus:outline-none w-full placeholder-gray-400" />
          </div>
        </div>

        <!-- Submit Button -->
        <div>
          <button type="submit"
            :disabled="!isFormValid"
            :class="['font-[\'Jersey_20\'] tracking-wide px-6 md:px-20 py-3 md:py-4 transition-colors text-black text-xl md:text-2xl border-[2px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] w-full sm:w-auto min-w-0 md:min-w-[350px]',
                     isFormValid ? 'bg-[#0073e6] hover:bg-[#0073e6]/90' : 'bg-[#e5e7eb] cursor-not-allowed']">
            Envoyer ma demande
          </button>
        </div>

      </form>

    </section>
  </div>
</template>

<script setup>
import { ref, computed, nextTick } from 'vue';

const successMessageRef = ref(null);

const form = ref({
    nom: '',
    employes: '',
    mail: '',
    telephone: '',
    message: ''
});

const isSubmitted = ref(false);
const emailTouched = ref(false);
const isEmailValid = ref(false);

const validateEmail = () => {
    emailTouched.value = true;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    isEmailValid.value = emailRegex.test(form.value.mail);
};

const showEmailError = computed(() => {
    return emailTouched.value && form.value.mail !== '' && !isEmailValid.value;
});

const isFormValid = computed(() => {
  const isEmployesValid = form.value.employes.trim() !== '' && !isNaN(form.value.employes);
  return form.value.nom.trim() !== '' &&
         isEmployesValid &&
         form.value.mail.trim() !== '' &&
         isEmailValid.value;
});

const isLoading = ref(false);

const submitForm = async () => {
    if (!isFormValid.value) return;

    isLoading.value = true;
    try {
        await fetch('/api/mail', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(form.value),
        });
        isSubmitted.value = true;
        
        await nextTick();
        if (successMessageRef.value) {
            successMessageRef.value.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    } catch (error) {
        console.error('Erreur envoi formulaire', error);
        // Tu peux afficher un message d'erreur à l'utilisateur ici
    } finally {
        isLoading.value = false;
    }
};
</script>
