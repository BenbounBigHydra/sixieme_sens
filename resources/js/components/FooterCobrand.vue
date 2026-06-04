<template>
  <footer class="relative w-full pt-[350px] pb-16 mt-20" style="background-image: url('/images/Motif_cubique_degradeFooter.png'); background-size: cover; background-position: top;">

    <div class="max-w-desktop mx-auto px-8 md:px-16 lg:px-24 xl:px-32 2xl:px-40">

      <div class="bg-[#fffbf1] border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] px-6 md:px-20 py-12 flex flex-col">

        <div class="flex flex-col md:flex-row justify-between items-center md:items-start mb-6 md:mb-2 text-center md:text-left gap-6 md:gap-0">
          <h2 class="text-[40px] md:text-[48px] text-black font-['Jersey_20'] leading-tight md:leading-none">
            Vous pouvez <br />faire la différence.
          </h2>
          <div class="flex items-center md:items-start md:mt-2">
            <a :href="quizzUrl" class="inline-block bg-[#0073E6] text-white font-['Jersey_20'] tracking-wide text-2xl px-6 py-4 shadow-[4px_4px_0px_0px_rgba(51,51,51,1)] hover:bg-[#0073E6]/90 transition-colors whitespace-nowrap">
              Donner mon sang
            </a>
          </div>
        </div>

        <div class="border-t-[1px] border-black pt-8 flex flex-col md:flex-row justify-between items-start font-['Inter'] text-sm md:text-base text-black w-full gap-8 md:gap-0">

          <div class="w-full md:w-1/3 text-left flex flex-col gap-1">
            <p class="font-bold">Hôpitaux Universitaires de Genève</p>
            <p>Rue Gabrielle-Perret-Gentil 4</p>
            <p>1205 Genève</p>
            
            <div class="flex items-center gap-4 mt-4 mb-2">
              <img src="/images/hug_icon.png" alt="HUG Logo" class="h-8 object-contain" />
              <span class="font-bold text-lg text-[#393939]">X</span>
              <img :src="company.logo ? '/' + company.logo : '/images/HEIG-VD-red.png'" alt="Company Logo" class="h-8 object-contain" />
            </div>
            
            <p class="font-bold text-[13px] md:text-[14px] mt-2 whitespace-nowrap">Ce site est un projet académique. Ne prenez pas rendez-vous ! :)</p>
          </div>

          <div class="w-full md:w-1/3 flex md:justify-center">
            <div class="flex flex-col gap-1 text-left">
              <a href="/" class="text-[#0073E6] hover:opacity-80 transition-opacity">Site vitrine</a>
              <a href="https://www.hug.ch" class="text-[#0073E6] hover:opacity-80 transition-opacity" target="_blank">Site HUG</a>
            </div>
          </div>

          <div class="w-full md:w-1/3 text-left md:text-right">
            <p>HUG - Tous droits réservés</p>
          </div>

        </div>

      </div>

    </div>

  </footer>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

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

const company = computed(() => pageData.value?.company || {});

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
</script>
