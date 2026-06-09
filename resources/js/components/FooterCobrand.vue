<template>
  <footer class="relative w-full pt-[200px] md:pt-[350px] pb-16 mt-20 overflow-hidden md:overflow-visible">
    <div class="absolute inset-0 z-0 pointer-events-none"
         :style="{
            backgroundColor: computedCompanyColor,
            maskImage: 'url(/images/Motif_cubique_degradeFooter.svg)',
            WebkitMaskImage: 'url(/images/Motif_cubique_degradeFooter.svg)',
            maskSize: 'cover',
            WebkitMaskSize: 'cover',
            maskPosition: 'top',
            WebkitMaskPosition: 'top',
            maskRepeat: 'no-repeat',
            WebkitMaskRepeat: 'no-repeat'
          }">
    </div>

    <div class="max-w-desktop mx-auto px-4 md:px-8 lg:px-32 xl:px-40 relative z-10">

      <div class="bg-[#fffbf1] border-[3px] md:border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] md:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] px-3 md:px-20 py-6 md:py-12 flex flex-col relative z-10 w-full overflow-hidden">

        <div class="flex flex-col md:flex-row justify-between items-center md:items-start mb-6 md:mb-2 text-center md:text-left gap-4 md:gap-0">
          <h2 class="text-[28px] md:text-[48px] text-black font-['Jersey_20'] leading-tight md:leading-none">
            Vous pouvez <br class="hidden md:block" />faire la différence
          </h2>
          <div class="flex items-center md:items-start md:mt-2">
            <a :href="quizzUrl" class="inline-block bg-[#0073E6] text-white font-['Jersey_20'] tracking-wide text-lg md:text-2xl px-3 py-2 md:px-6 md:py-4 shadow-[4px_4px_0px_0px_rgba(51,51,51,1)] hover:bg-[#0073E6]/90 transition-colors whitespace-nowrap">
              Donner mon sang
            </a>
          </div>
        </div>

        <div class="border-t-[1px] border-black pt-6 md:pt-8 flex flex-col md:flex-row justify-between items-start font-['Inter'] text-[12px] md:text-base text-black w-full gap-6 md:gap-0">

          <div class="w-full md:w-1/3 text-center md:text-left flex flex-col gap-1">
            <p class="font-bold">Hôpitaux Universitaires de Genève</p>
            <p>Rue Gabrielle-Perret-Gentil 4</p>
            <p>1205 Genève</p>
            
            <div class="flex items-center justify-center md:justify-start gap-4 mt-4 mb-2">
              <img src="/images/hug_icon.png" alt="HUG Logo" class="h-6 md:h-8 object-contain" />
              <span class="font-bold text-base md:text-lg text-[#393939]">X</span>
              <img :src="company.logo ? '/' + company.logo : '/images/HEIG-VD-red.png'" alt="Company Logo" class="h-6 md:h-8 object-contain" />
            </div>
            
            <p class="font-bold text-[11px] md:text-[14px] mt-2 whitespace-normal md:whitespace-nowrap leading-tight text-center md:text-left">Ce site est un projet académique. Ne prenez pas rendez-vous ! :)</p>
          </div>

          <div class="w-full md:w-1/3 flex justify-center mt-4 md:mt-0">
            <div class="flex flex-col gap-1 text-center md:text-left">
              <a href="/" class="text-[#0073E6] hover:opacity-80 transition-opacity">Site vitrine</a>
              <a href="https://www.hug.ch" class="text-[#0073E6] hover:opacity-80 transition-opacity" target="_blank">Site HUG</a>
            </div>
          </div>

          <div class="w-full md:w-1/3 text-center md:text-right mt-4 md:mt-0">
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

const computedCompanyColor = computed(() => {
  if (!company.value?.color) return '#0073e6';
  return company.value.color.startsWith('#') ? company.value.color : `#${company.value.color}`;
});

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
