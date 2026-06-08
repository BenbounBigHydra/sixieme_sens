<template>
  <header class="w-full h-24 bg-[#fffbf1] font-['Jersey_20'] tracking-wide border-b border-gray-100 sticky top-0 z-50 shadow-md">
    <div class="max-w-desktop mx-auto px-8 md:px-20 lg:px-32 xl:px-40 w-full h-full flex items-center justify-between relative bg-[#fffbf1] z-50">

      <a :href="`/collection/${companySlug}/${collectionId}`" class="flex items-center h-full gap-2 md:gap-4 hover:opacity-90 transition-opacity max-w-[70vw]">
        <!-- Desktop Logo HUG -->
        <img src="/images/hug_icon.png" alt="Logo HUG Desktop" class="hidden md:block h-12 w-auto object-contain" />
        <!-- Mobile Logo HUG -->
        <img src="/images/hug_icon_Mobile.png" alt="Logo HUG Mobile" class="md:hidden h-7 w-auto object-contain shrink-0" />

        <span class="text-sm md:text-xl font-bold mx-1 md:mx-2 font-['Inter'] text-black font-light shrink-0">x</span>

        <!-- Company Logo -->
        <img :src="company.logo ? '/' + company.logo : '/images/HEIG-VD-red.png'" alt="Logo Partenaire" class="h-7 md:h-12 w-auto object-contain shrink-0" />
      </a>

      <nav class="hidden md:flex items-center space-x-8 text-[28px]">
        <a :href="`/collection/${companySlug}/${collectionId}`"
           class="hover:text-[#0073E6] transition-colors tracking-wide"
           :class="isHomePage ? 'text-[#0073E6]' : 'text-[#000000]'">Accueil</a>
        <a :href="`/collection/${companySlug}/${collectionId}/infos`"
           class="hover:text-[#0073E6] transition-colors tracking-wide"
           :class="isInfosPage ? 'text-[#0073E6]' : 'text-[#000000]'">Informations</a>
        <a :href="`/collection/${companySlug}/${collectionId}/quizz`" class="bg-[#0073E6] text-[#FFFFFF] px-6 py-2 hover:bg-[#0073E6]/90 transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] tracking-wide">
          Donner mon sang
        </a>
      </nav>

      <!-- Mobile menu button -->
      <div class="md:hidden flex items-center">
        <button @click="isMenuOpen = !isMenuOpen" class="text-[#0073E6] focus:outline-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>

    </div>

    <!-- Mobile Menu -->
    <div v-show="isMenuOpen" class="absolute top-24 left-0 w-full bg-[#0073E6] z-40 md:hidden flex flex-col font-['Inter'] shadow-lg">
      <a :href="`/collection/${companySlug}/${collectionId}`" class="block px-6 hover:bg-[#fffbf1]/10 transition-colors">
        <div class="flex items-center justify-between text-white text-[17px] py-5 border-b border-white">
          <span>Accueil</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
        </div>
      </a>
      <a :href="`/collection/${companySlug}/${collectionId}/infos`" class="block px-6 hover:bg-[#fffbf1]/10 transition-colors">
        <div class="flex items-center justify-between text-white text-[17px] py-5 border-b border-white">
          <span>Informations</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
        </div>
      </a>
      <a :href="`/collection/${companySlug}/${collectionId}/quizz`" class="block px-6 hover:bg-[#fffbf1]/10 transition-colors">
        <div class="flex items-center justify-between text-white text-[17px] py-5 border-b border-white">
          <span>Donner mon sang</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
        </div>
      </a>
    </div>
  </header>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

const props = defineProps({
  initialData: {
    type: [Object, String],
    default: () => ({})
  }
})

const pageData = computed(() => {
  if (typeof props.initialData === 'string') {
    try {
      return JSON.parse(props.initialData)
    } catch (e) {
      return {}
    }
  }
  return props.initialData || {}
})

const company = computed(() => pageData.value?.company || {})

const isMenuOpen = ref(false)
const companySlug = ref('')
const collectionId = ref('')
const isInfosPage = ref(false)
const isHomePage = ref(false)

onMounted(() => {
  const parts = window.location.pathname.split('/');
  companySlug.value = parts[2] || '';
  collectionId.value = parts[3] || '';
  isInfosPage.value = window.location.pathname.endsWith('/infos');
  isHomePage.value = window.location.pathname === `/collection/${companySlug.value}/${collectionId.value}`;
})
</script>
