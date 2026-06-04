<template>
  <div class="min-h-screen bg-[#fffbf1] font-inter">
    <HeaderAdmin />

    <main class="max-w-[1200px] mx-auto py-10 px-4 space-y-12">
      <!-- Search Bar -->
      <div class="relative w-full">
        <input
          type="text"
          v-model="searchQuery"
          placeholder="Rechercher"
          class="w-full border border-gray-400 rounded-sm py-3 px-4 bg-transparent outline-none focus:border-[#0073e6] transition-colors"
        />
        <div class="absolute right-4 top-1/2 -translate-y-1/2">
          <img src="/images/Search.svg" alt="Search" class="h-5 w-5" />
        </div>
      </div>

      <!-- Title and Action -->
      <div class="flex justify-between items-center">
        <h1 class="font-inter font-bold text-3xl text-black">Entreprises partenaires</h1>
        <button @click="openNewCompanyModal" class="bg-[#0073e6] text-[#fffbf1] flex items-center px-6 py-3 rounded-sm hover:bg-blue-600 transition-colors">
          <div class="h-4 w-4 mr-2 bg-[#fffbf1]" style="mask-image: url('/images/Cross.svg'); mask-size: contain; mask-repeat: no-repeat; mask-position: center; -webkit-mask-image: url('/images/Cross.svg'); -webkit-mask-size: contain; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center;"></div>
          <span class="font-inter text-sm">Nouvelle entreprise</span>
        </button>
      </div>

      <!-- Companies Table -->
      <div class="w-full">
        <div class="border border-blue-200 rounded-t-sm overflow-hidden">
          <!-- Table Header -->
          <div class="grid grid-cols-5 items-center bg-[#ffeaa7] py-3 px-4 border-b border-blue-200">
            <!-- Entreprise -->
            <div class="flex items-center cursor-pointer group" @click="sortBy('name')">
              <span class="font-inter text-sm text-[#393939] mr-2">Entreprise</span>
              <img src="/images/BlueChevron Down.svg" alt="Sort" class="h-4 w-4 transition-transform" :class="{'rotate-180': sortKey === 'name' && sortOrder === 'asc'}" />
            </div>

            <!-- Collectes -->
            <div class="flex items-center relative group-info">
              <span class="font-inter text-sm text-[#393939] mr-2">Collectes</span>
              <div class="relative group cursor-pointer flex items-center">
                <img src="/images/info.svg" alt="Info" class="h-4 w-4" style="filter: brightness(0);" />
                <div class="absolute left-0 top-full mt-2 w-[250px] bg-[#fffbf1] border border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-4 hidden group-hover:block z-50">
                  <p class="font-inter text-xs text-black">Vert: passées, Orange: à clore, Noir: à venir</p>
                </div>
              </div>
            </div>

            <!-- Participation -->
            <div class="flex items-center cursor-pointer group" @click="sortBy('participation')">
              <span class="font-inter text-sm text-[#393939] mr-2">Participation</span>
              <div class="relative group-info cursor-default flex items-center mr-2" @click.stop>
                <img src="/images/info.svg" alt="Info" class="h-4 w-4" style="filter: brightness(0);" />
                <div class="absolute left-0 top-full mt-2 w-[300px] bg-[#fffbf1] border border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-4 hidden group-hover:block z-50">
                  <p class="font-jersey text-[20px] text-black leading-tight">Taux calculé sur l'année en cours.</p>
                  <p class="font-inter text-[14px] text-black mt-2">Ce taux correspond au ratio entre le nombre de poches de sang récoltées et le nombre total d'employés.</p>
                </div>
              </div>
              <img src="/images/BlueChevron Down.svg" alt="Sort" class="h-4 w-4 transition-transform" :class="{'rotate-180': sortKey === 'participation' && sortOrder === 'asc'}" />
            </div>

            <!-- Rigueur -->
            <div class="flex items-center cursor-pointer group" @click="sortBy('rigueur')">
              <span class="font-inter text-sm text-[#393939] mr-2">Rigueur</span>
              <div class="relative group-info cursor-default flex items-center mr-2" @click.stop>
                <img src="/images/info.svg" alt="Info" class="h-4 w-4" style="filter: brightness(0);" />
                <div class="absolute left-0 top-full mt-2 w-[300px] bg-[#fffbf1] border border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-4 hidden group-hover:block z-50">
                  <p class="font-jersey text-[20px] text-black leading-tight">Taux calculé sur l'année en cours.</p>
                  <p class="font-inter text-[14px] text-black mt-2">Ce taux correspond au ratio entre le nombre de poches de sang récoltées et le nombre de personnes inscrites à la collecte.</p>
                </div>
              </div>
              <img src="/images/BlueChevron Down.svg" alt="Sort" class="h-4 w-4 transition-transform" :class="{'rotate-180': sortKey === 'rigueur' && sortOrder === 'asc'}" />
            </div>

            <!-- Détails -->
            <div class="flex items-center justify-end">
              <span class="font-inter text-sm text-[#393939]">Détails</span>
            </div>
          </div>

          <!-- Table Body -->
          <div class="border border-blue-200 rounded-b-sm bg-[#fffbf1]">
            <template v-if="filteredAndSortedCompanies.length > 0">
              <div v-for="company in filteredAndSortedCompanies" :key="company.id" class="grid grid-cols-5 items-center py-3 px-4 border-b border-blue-200 last:border-0">
                <!-- Entreprise -->
                <div class="flex items-center space-x-3">
                  <div class="h-8 w-16 flex items-center justify-start">
                    <img :src="company.logo ? '/' + company.logo : '/images/BCGE.png'" alt="Logo" class="max-h-full max-w-full object-contain" />
                  </div>
                  <span class="font-inter font-bold text-sm text-[#393939]">{{ company.name }}</span>
                </div>

                <!-- Collectes -->
                <div class="flex items-center space-x-2">
                  <div class="h-6 w-6 rounded-full bg-[#95d070] flex items-center justify-center text-white text-xs font-bold">{{ company.collections?.past || 0 }}</div>
                  <div class="h-6 w-6 rounded-full bg-[#f39c7f] flex items-center justify-center text-white text-xs font-bold">{{ company.collections?.to_close || 0 }}</div>
                  <div class="h-6 w-6 rounded-full bg-black flex items-center justify-center text-white text-xs font-bold">{{ company.collections?.to_come || 0 }}</div>
                </div>

                <!-- Participation -->
                <div class="font-inter text-sm text-[#393939]">
                  {{ company.participation !== undefined ? (company.participation * 100).toFixed(0) + '%' : '0%' }}
                </div>

                <!-- Rigueur -->
                <div class="font-inter text-sm text-[#393939]">
                  {{ company.rigueur !== undefined ? (company.rigueur * 100).toFixed(0) + '%' : '0%' }}
                </div>

                <!-- Détails -->
                <div class="flex items-center justify-end">
                  <button @click="openEditModal(company)" class="border border-[#0073e6] p-1.5 rounded-sm hover:bg-blue-50 transition-colors">
                    <img src="/images/Edit.svg" alt="Edit" class="h-4 w-4" />
                  </button>
                </div>
              </div>
            </template>
            <template v-else>
              <div class="py-10 text-center text-gray-500 font-inter">
                Aucune entreprise trouvée.
              </div>
            </template>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import HeaderAdmin from './HeaderAdmin.vue';

export default {
  name: 'CompaniesAdmin',
  components: {
    HeaderAdmin
  },
  props: {
    initialData: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      searchQuery: '',
      sortKey: 'name',
      sortOrder: 'asc',
      companies: []
    }
  },
  created() {
    if (this.initialData && this.initialData.companies) {
      this.companies = this.initialData.companies;
    }
  },
  computed: {
    filteredAndSortedCompanies() {
      let result = this.companies;

      // Filter by search
      if (this.searchQuery) {
        const query = this.searchQuery.toLowerCase();
        result = result.filter(c => c.name && c.name.toLowerCase().includes(query));
      }

      // Sort
      result = result.sort((a, b) => {
        let valA = a[this.sortKey];
        let valB = b[this.sortKey];

        if (valA === undefined) valA = 0;
        if (valB === undefined) valB = 0;

        if (typeof valA === 'string') {
          valA = valA.toLowerCase();
          valB = (valB || '').toString().toLowerCase();
        }

        if (valA < valB) return this.sortOrder === 'asc' ? -1 : 1;
        if (valA > valB) return this.sortOrder === 'asc' ? 1 : -1;
        return 0;
      });

      return result;
    }
  },
  methods: {
    sortBy(key) {
      if (this.sortKey === key) {
        this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
      } else {
        this.sortKey = key;
        this.sortOrder = 'asc';
      }
    },
    openNewCompanyModal() {
      alert("Ouverture de la modale de création d'entreprise (à implémenter)");
    },
    openEditModal(company) {
      alert("Ouverture de la modale d'édition pour : " + company.name);
    }
  }
}
</script>
