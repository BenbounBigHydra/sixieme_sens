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

      <!-- Filters -->
      <div class="flex space-x-4">
        <button
          @click="toggleFilter('ongoing')"
          :class="activeFilter === 'ongoing' ? 'bg-[#0073e6] border-[#0073e6] text-[#fffbf1]' : 'bg-transparent border-[#0073e6] text-[#0073e6]'"
          class="border px-4 py-2 rounded-sm font-inter text-sm transition-colors">
          En cours
        </button>
        <button
          @click="toggleFilter('to_come')"
          :class="activeFilter === 'to_come' ? 'bg-[#0073e6] border-[#0073e6] text-[#fffbf1]' : 'bg-transparent border-[#0073e6] text-[#0073e6]'"
          class="border px-4 py-2 rounded-sm font-inter text-sm transition-colors">
          À venir
        </button>
        <button
          @click="toggleFilter('past')"
          :class="activeFilter === 'past' ? 'bg-[#0073e6] border-[#0073e6] text-[#fffbf1]' : 'bg-transparent border-[#0073e6] text-[#0073e6]'"
          class="border px-4 py-2 rounded-sm font-inter text-sm transition-colors">
          Terminées
        </button>
        <button
          @click="toggleFilter('to_close')"
          :class="activeFilter === 'to_close' ? 'bg-[#0073e6] border-[#0073e6] text-[#fffbf1]' : 'bg-transparent border-[#0073e6] text-[#0073e6]'"
          class="border px-4 py-2 rounded-sm font-inter text-sm transition-colors">
          À clore
        </button>
      </div>

      <!-- Title -->
      <div>
        <h1 class="font-inter font-bold text-2xl text-black">Collectes</h1>
      </div>

      <!-- Collections Table -->
      <div class="w-full mt-4">
        <div class="border border-blue-200 rounded-t-sm overflow-hidden">
          <!-- Table Header -->
          <div class="grid grid-cols-3 items-center bg-[#ffeaa7] py-3 px-4 border-b border-blue-200">
            <!-- Entreprise -->
            <div class="flex items-center cursor-pointer group" @click="sortBy('companyName')">
              <span class="font-inter text-sm text-[#393939] mr-2">Entreprise</span>
              <img src="/images/BlueChevron Down.svg" alt="Sort" class="h-4 w-4 transition-transform" :class="{'rotate-180': sortOrder === 'asc'}" />
            </div>

            <!-- Statut -->
            <div class="flex items-center">
              <span class="font-inter text-sm text-[#393939] mx-auto">Statut</span>
            </div>

            <!-- Détails -->
            <div class="flex items-center justify-end">
              <span class="font-inter text-sm text-[#393939]">Détails</span>
            </div>
          </div>

          <!-- Table Body -->
          <div class="border border-blue-200 rounded-b-sm bg-[#fffbf1]">
            <template v-if="filteredAndSortedCollections.length > 0">
              <div v-for="collection in filteredAndSortedCollections" :key="collection.id" class="grid grid-cols-3 items-center py-3 px-4 border-b border-blue-200 last:border-0">
                <!-- Entreprise -->
                <div class="flex items-center space-x-3">
                  <div class="h-8 w-16 flex items-center justify-start">
                    <img :src="collection.company?.logo ? '/' + collection.company.logo : '/images/BCGE.png'" alt="Logo" class="max-h-full max-w-full object-contain" />
                  </div>
                  <span class="font-inter font-bold text-sm text-[#393939]">{{ collection.company?.name || 'Inconnu' }}</span>
                </div>

                <!-- Statut -->
                <div class="flex items-center justify-center">
                  <div class="px-6 py-1.5 rounded-sm text-white font-inter text-sm text-center min-w-[120px]" :class="getStatusColor(collection.statusKey)">
                    {{ getStatusLabel(collection.statusKey) }}
                  </div>
                </div>

                <!-- Détails -->
                <div class="flex items-center justify-end">
                  <button @click="openEditModal(collection)" class="border border-[#0073e6] p-1.5 rounded-sm hover:bg-blue-50 transition-colors">
                    <img src="/images/Edit.svg" alt="Edit" class="h-4 w-4" />
                  </button>
                </div>
              </div>
            </template>
            <template v-else>
              <div class="py-10 text-center text-gray-500 font-inter">
                Aucune collecte trouvée.
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
  name: 'CollectionsAdmin',
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
      activeFilter: null, // null means show all
      sortOrder: 'asc',
      allCollections: []
    }
  },
  created() {
    if (this.initialData && this.initialData.collections) {
      const collectionsGroups = this.initialData.collections;
      const all = [];

      if (collectionsGroups.ongoing) {
        collectionsGroups.ongoing.forEach(c => all.push({ ...c, statusKey: 'ongoing' }));
      }
      if (collectionsGroups.to_come) {
        collectionsGroups.to_come.forEach(c => all.push({ ...c, statusKey: 'to_come' }));
      }
      if (collectionsGroups.past) {
        collectionsGroups.past.forEach(c => all.push({ ...c, statusKey: 'past' }));
      }
      if (collectionsGroups.to_close) {
        collectionsGroups.to_close.forEach(c => all.push({ ...c, statusKey: 'to_close' }));
      }

      this.allCollections = all;
    }
  },
  computed: {
    filteredAndSortedCollections() {
      let result = this.allCollections;

      // Filter by status tab
      if (this.activeFilter) {
        result = result.filter(c => c.statusKey === this.activeFilter);
      }

      // Filter by search
      if (this.searchQuery) {
        const query = this.searchQuery.toLowerCase();
        result = result.filter(c => c.company?.name && c.company.name.toLowerCase().includes(query));
      }

      // Sort by company name
      result = result.sort((a, b) => {
        let valA = (a.company?.name || '').toLowerCase();
        let valB = (b.company?.name || '').toLowerCase();

        if (valA < valB) return this.sortOrder === 'asc' ? -1 : 1;
        if (valA > valB) return this.sortOrder === 'asc' ? 1 : -1;
        return 0;
      });

      return result;
    }
  },
  methods: {
    toggleFilter(filter) {
      if (this.activeFilter === filter) {
        this.activeFilter = null; // deselect
      } else {
        this.activeFilter = filter;
      }
    },
    sortBy(key) {
      if (key === 'companyName') {
        this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
      }
    },
    getStatusLabel(key) {
      const labels = {
        'ongoing': 'En cours',
        'to_come': 'À venir',
        'past': 'Terminée',
        'to_close': 'À clore'
      };
      return labels[key] || 'Inconnu';
    },
    getStatusColor(key) {
      const colors = {
        'ongoing': 'bg-[#5b6bb9]',   // Purple-ish blue
        'to_come': 'bg-[#facc15]',   // Yellow
        'past': 'bg-[#65a30d]',      // Green
        'to_close': 'bg-[#f87171]'   // Coral/Red
      };
      return colors[key] || 'bg-gray-500';
    },
    openEditModal(collection) {
      alert("Ouverture de la modale d'édition pour la collecte de l'entreprise : " + (collection.company?.name || 'Inconnu'));
    }
  }
}
</script>
