<template>
  <div class="w-full bg-[#fffbf1] min-h-screen relative overflow-clip font-['Inter']">
    <!-- Hero Banner (similar to InfosCobrand) -->
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

    <section class="max-w-desktop mx-auto px-8 md:px-20 lg:px-32 xl:px-40 py-16 relative z-10">
      <!-- Title Section -->
      <div class="mb-16 flex flex-col items-center md:items-start text-center md:text-left">
        <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-6 origin-center md:origin-left" onerror="this.style.display='none'" />
        <h1 class="font-['Jersey_20'] text-[48px] md:text-[56px] text-black leading-none tracking-wide">
          Cette collecte est passée
        </h1>
      </div>

      <!-- Robot and Message Section -->
      <div class="flex flex-col md:flex-row items-center md:items-start justify-center md:justify-start gap-8">
        
        <!-- Roby (Left) -->
        <!-- Adding transform scaleX(-1) so he looks towards the speech bubble, or we can just keep him as is if it fits well. The original roby_smiling_left.png looks to the left. Let's keep it as the user specified: "use the same robot as the FAQ robot" -->
        <img src="/images/roby_smiling_left.png" alt="Roby" class="h-40 md:h-48 object-contain shrink-0" style="transform: scaleX(-1);" />

        <!-- Speech Bubble (Right) -->
        <div class="relative bg-[#1a81e7] text-white p-6 border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] w-full md:w-[350px] z-20">
          <div class="font-['Inter'] text-base md:text-lg leading-relaxed">
            <template v-if="hasOpenCollection">
              <p class="mb-6 font-bold">Une collecte est actuellement ouverte pour votre entreprise !</p>
              <a :href="'/collection/' + nextCollectionUrl" class="inline-block bg-[#0073e6] text-white px-6 py-3 font-bold text-sm md:text-base border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all text-center w-full md:w-auto">
                Voir la collecte
              </a>
            </template>
            <template v-else>
              <p>Il n'y a pas de collecte ouverte pour le moment pour votre entreprise.</p>
            </template>
          </div>

          <!-- Arrow pointing left towards Roby (for desktop) -->
          <div class="hidden md:block absolute top-10 -left-[15px] w-0 h-0 border-y-[12px] border-y-transparent border-r-[15px] border-r-black"></div>
          <div class="hidden md:block absolute top-[43px] -left-[10px] w-0 h-0 border-y-[9px] border-y-transparent border-r-[12px] border-r-[#1a81e7] z-10"></div>

          <!-- Arrow pointing up towards Roby (for mobile, since Roby is above) -->
          <div class="block md:hidden absolute -top-[15px] left-1/2 -translate-x-1/2 w-0 h-0 border-x-[12px] border-x-transparent border-b-[15px] border-b-black"></div>
          <div class="block md:hidden absolute -top-[10px] left-1/2 -translate-x-1/2 w-0 h-0 border-x-[9px] border-x-transparent border-b-[12px] border-b-[#1a81e7] z-10"></div>
        </div>

      </div>
    </section>
  </div>
</template>

<script setup>
import { computed } from 'vue';

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

const company = computed(() => parsedData.value.company);
const nextCollectionUrl = computed(() => parsedData.value.url);
const hasOpenCollection = computed(() => !!parsedData.value.url);

const computedCompanyColor = computed(() => {
  if (!company.value?.color) return '#0073e6';
  return company.value.color.startsWith('#') ? company.value.color : `#${company.value.color}`;
});
</script>
