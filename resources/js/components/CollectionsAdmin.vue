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
      <div class="flex flex-wrap gap-2 md:gap-4 md:space-x-0">
        <button
          @click="toggleFilter('ongoing')"
          :class="activeFilter === 'ongoing' ? 'bg-[#0073e6] border-[#0073e6] text-[#fffbf1]' : 'bg-transparent border-[#0073e6] text-[#0073e6]'"
          class="border px-4 py-2 rounded-sm font-inter text-sm transition-colors w-full md:w-auto">
          En cours
        </button>
        <button
          @click="toggleFilter('to_come')"
          :class="activeFilter === 'to_come' ? 'bg-[#0073e6] border-[#0073e6] text-[#fffbf1]' : 'bg-transparent border-[#0073e6] text-[#0073e6]'"
          class="border px-4 py-2 rounded-sm font-inter text-sm transition-colors w-full md:w-auto">
          À venir
        </button>
        <button
          @click="toggleFilter('past')"
          :class="activeFilter === 'past' ? 'bg-[#0073e6] border-[#0073e6] text-[#fffbf1]' : 'bg-transparent border-[#0073e6] text-[#0073e6]'"
          class="border px-4 py-2 rounded-sm font-inter text-sm transition-colors w-full md:w-auto">
          Terminées
        </button>
        <button
          @click="toggleFilter('to_close')"
          :class="activeFilter === 'to_close' ? 'bg-[#0073e6] border-[#0073e6] text-[#fffbf1]' : 'bg-transparent border-[#0073e6] text-[#0073e6]'"
          class="border px-4 py-2 rounded-sm font-inter text-sm transition-colors w-full md:w-auto">
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
          <div class="hidden md:grid grid-cols-3 items-center bg-[#ffeaa7] py-3 px-4 border-b border-blue-200">
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
          <div class="border border-blue-200 rounded-b-sm rounded-t-sm md:rounded-t-none bg-[#fffbf1]">
            <template v-if="filteredAndSortedCollections.length > 0">
              <div v-for="collection in filteredAndSortedCollections" :key="collection.id" class="flex flex-col md:grid md:grid-cols-3 items-start md:items-center py-4 px-4 border-b border-blue-200 last:border-0 gap-4 md:gap-0">
                <!-- Entreprise -->
                <div class="flex items-center space-x-3 w-full">
                  <div class="h-8 w-16 flex items-center justify-start shrink-0">
                    <img :src="collection.company?.logo ? '/' + collection.company.logo : '/images/BCGE.png'" alt="Logo" class="max-h-full max-w-full object-contain" />
                  </div>
                  <span class="font-inter font-bold text-lg md:text-sm text-[#393939]">{{ collection.company?.name || 'Inconnu' }}</span>
                </div>

                <!-- Statut -->
                <div class="flex items-center justify-start md:justify-center w-full">
                  <div class="px-6 py-1.5 rounded-sm text-white font-inter text-sm text-center min-w-[120px]" :class="getStatusColor(collection.statusKey)">
                    {{ getStatusLabel(collection.statusKey) }}
                  </div>
                </div>

                <!-- Détails -->
                <div class="flex items-center justify-start md:justify-end w-full pt-2 md:pt-0 border-t md:border-0 border-gray-100 mt-2 md:mt-0">
                  <button @click="openEditModal(collection)" class="border border-[#0073e6] p-2 md:p-1.5 rounded-sm hover:bg-blue-50 transition-colors w-full md:w-auto flex justify-center">
                    <img src="/images/Edit.svg" alt="Edit" class="h-4 w-4" />
                    <span class="md:hidden ml-2 text-[#0073e6] text-sm">Modifier</span>
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

    <!-- Options Modal -->
    <div v-if="activeModal === 'options'" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" @click.self="closeModal">
      <div :class="['bg-[#fffbf1] border-[10px] w-full max-w-[750px] p-8 relative flex flex-col max-h-[90vh]', getModalBorderClass]">
        <button @click="closeModal" class="absolute top-6 right-6 flex items-center justify-center cursor-pointer transition-transform hover:scale-105">
          <img src="/images/X.svg" alt="Close" class="w-10 h-10" />
        </button>
        <h2 class="font-['Jersey_20'] text-5xl text-black leading-none mb-1">{{ selectedCollecte?.company?.name || 'Inconnu' }}</h2>
        <p class="font-['Jersey_20'] text-2xl text-black mb-6 tracking-wide">Collecte du {{ formatDate(selectedCollecte?.day_start) }}</p>

        <!-- Tabs -->
        <div class="flex space-x-4 border-b border-gray-300 mb-6 shrink-0">
          <button @click="activeTab = 'modifier'" :class="{'border-b-2 border-[#0073e6] text-[#0073e6] font-bold': activeTab === 'modifier', 'text-gray-500': activeTab !== 'modifier'}" class="pb-2 px-4 font-inter text-lg">Modifier</button>
          <button @click="activeTab = 'cloturer'" :class="{'border-b-2 border-[#5C629E] text-[#5C629E] font-bold': activeTab === 'cloturer', 'text-gray-500': activeTab !== 'cloturer'}" class="pb-2 px-4 font-inter text-lg">Clôturer</button>
          <button @click="activeTab = 'supprimer'" :class="{'border-b-2 border-[#E4534B] text-[#E4534B] font-bold': activeTab === 'supprimer', 'text-gray-500': activeTab !== 'supprimer'}" class="pb-2 px-4 font-inter text-lg">Supprimer</button>
        </div>

        <div class="overflow-y-auto overflow-x-hidden flex-grow px-1">
          <!-- Tab Content: Modifier -->
          <div v-if="activeTab === 'modifier'" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
              <div>
                <label class="block font-inter text-base mb-2">Nombre d'employés</label>
                <div class="relative">
                  <input type="number" v-model="detailForm.nb_employee" placeholder="Ex: 5000" class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                </div>
              </div>
              <div>
                <label class="block font-inter text-base mb-2">Date de la collecte</label>
                <div class="relative">
                  <input type="date" v-model="detailForm.day_start" class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                </div>
              </div>
              <div class="col-span-1 md:col-span-2">
                <label class="block font-inter text-base mb-2">Lieu</label>
                <div class="relative">
                  <input type="text" v-model="detailForm.location" placeholder="Ex: Rue de l'entreprise 12" class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                </div>
              </div>
              <div>
                <label class="block font-inter text-base mb-2">Heure de début</label>
                <div class="relative">
                  <input type="time" step="1" v-model="detailForm.hour_start" class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                </div>
              </div>
              <div>
                <label class="block font-inter text-base mb-2">Heure de fin</label>
                <div class="relative">
                  <input type="time" step="1" v-model="detailForm.hour_end" class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                </div>
              </div>
            </div>

            <div class="flex flex-col md:flex-row items-stretch md:items-end gap-4 md:gap-6 mb-8">
              <div class="bg-[#f2faf2] px-6 py-3 flex justify-center items-center space-x-3 w-full md:w-[160px] h-[46px]">
                <span class="text-[#3b803b] font-inter font-medium">One-doc</span>
                <img src="/images/Edit.svg" alt="Edit" class="h-4" />
              </div>
              <div class="flex-grow relative h-[46px]">
                <input type="url" v-model="detailForm.onedoc_link" placeholder="Lien OneDoc" class="w-full h-full border border-black p-3 font-inter text-sm bg-transparent" />
              </div>
            </div>

            <div class="flex flex-col md:flex-row justify-end gap-4 md:space-x-4 pt-4">
              <button @click="closeModal" class="border-[2px] border-[#0073e6] text-[#0073e6] bg-white px-8 py-3 font-inter font-medium hover:bg-gray-50 transition-colors w-full md:w-auto">Annuler</button>
              <button @click="submitDetail" class="bg-[#0073e6] text-white px-8 py-3 font-inter font-medium hover:bg-blue-600 transition-colors flex items-center justify-center w-full md:w-auto">
                <span v-if="isSaving" class="mr-2">...</span>
                Enregistrer
              </button>
            </div>
          </div>

          <!-- Tab Content: Clôturer -->
          <div v-if="activeTab === 'cloturer'" class="space-y-6">
            <div class="space-y-6 mb-8">
              <div>
                <label class="block font-inter text-base mb-2">Nombre d'inscrits</label>
                <div class="relative">
                  <input type="number" v-model="clotureForm.nb_registered" placeholder="Ex: 50" class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                </div>
              </div>
              <div>
                <label class="block font-inter text-base mb-2">Nombre de poches collectées</label>
                <div class="relative">
                  <input type="number" v-model="clotureForm.nb_blood_pouch" placeholder="Ex: 45" class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                </div>
              </div>
            </div>

            <div class="flex flex-col md:flex-row gap-4 md:space-x-4 pt-4">
              <button @click="closeModal" class="border-[2px] border-[#0073e6] text-[#0073e6] bg-white px-6 py-2.5 font-inter font-medium w-full md:w-32 hover:bg-gray-50">Annuler</button>
              <button @click="submitCloture" class="bg-[#5bb124] text-white px-6 py-2.5 flex items-center justify-center font-inter font-medium w-full md:w-32 hover:bg-green-600">
                <span v-if="isSaving" class="mr-2">...</span>
                <img v-else src="/images/whiteCheck.svg" alt="Check" class="h-5 mr-2" /> Clore
              </button>
            </div>
          </div>

          <!-- Tab Content: Supprimer -->
          <div v-if="activeTab === 'supprimer'" class="space-y-6">
            <h2 class="font-['Jersey_20'] text-5xl text-[#E4534B] leading-none mb-6 tracking-wide">Attention</h2>
            <p class="font-inter text-lg text-black mb-8 leading-relaxed">
              Vous êtes sur le point de supprimer la collecte de {{ selectedCollecte?.company?.name || 'Inconnu' }} du {{ formatDate(selectedCollecte?.day_start) }}.<br/>
              Êtes-vous sûr de vouloir procéder ?
            </p>

            <div class="mb-10">
              <label class="block font-inter text-lg mb-2">Inscrire "supprimer" pour procéder</label>
              <div class="relative">
                <input type="text" v-model="suppressionInput" placeholder="supprimer" class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
              </div>
            </div>

            <div class="flex justify-end mt-4">
              <button @click="submitSuppression" class="bg-[#E4534B] text-white px-8 py-3 font-inter text-lg font-medium hover:bg-red-600 transition-colors flex items-center">
                <span v-if="isSaving" class="mr-2">...</span>
                Supprimer
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
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
      allCollections: [],
      activeModal: null,
      activeTab: 'modifier',
      selectedCollecte: null,
      isSaving: false,
      suppressionInput: '',
      clotureForm: {
        nb_registered: '',
        nb_blood_pouch: ''
      },
      detailForm: {
        nb_employee: '',
        day_start: '',
        onedoc_link: '',
        location: '',
        hour_start: '',
        hour_end: ''
      }
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
    },
    getModalBorderClass() {
      if (this.activeTab === 'modifier') return 'border-[#0073e6]';
      if (this.activeTab === 'cloturer') return 'border-[#5C629E]';
      if (this.activeTab === 'supprimer') return 'border-[#E4534B]';
      return 'border-[#0073e6]';
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
      this.selectedCollecte = collection;
      this.activeTab = 'modifier';
      this.activeModal = 'options';
      
      this.clotureForm.nb_registered = collection?.nb_registered || '';
      this.clotureForm.nb_blood_pouch = collection?.nb_blood_pouch || '';
      
      this.detailForm.nb_employee = collection?.nb_employee || '';
      this.detailForm.day_start = collection?.day_start ? collection.day_start.split(' ')[0] : '';
      this.detailForm.onedoc_link = collection?.onedoc_link || '';
      this.detailForm.location = collection?.location || '';
      this.detailForm.hour_start = collection?.hour_start || '';
      this.detailForm.hour_end = collection?.hour_end || '';
      
      this.suppressionInput = '';
    },
    closeModal() {
      this.activeModal = null;
      this.selectedCollecte = null;
    },
    formatDate(dateStr) {
      if (!dateStr) return '';
      const d = new Date(dateStr);
      return d.toLocaleDateString('fr-CH');
    },
    getCsrfHeaders() {
      const getCookie = (name) => {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return decodeURIComponent(parts.pop().split(';').shift());
        return null;
      };
      
      const headers = {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
      };
      
      const csrfToken = getCookie('XSRF-TOKEN');
      if (csrfToken) {
        headers['X-XSRF-TOKEN'] = csrfToken;
      }
      return headers;
    },
    async submitDetail() {
      if (this.isSaving) return;
      this.isSaving = true;
      try {
        const response = await fetch(`/api/collection/${this.selectedCollecte.id}`, {
          method: 'PUT',
          headers: this.getCsrfHeaders(),
          body: JSON.stringify(this.detailForm)
        });
        if (!response.ok) throw new Error("API Error");
        window.location.reload();
      } catch (err) {
        console.error(err);
        alert("Erreur lors de l'enregistrement.");
      } finally {
        this.isSaving = false;
      }
    },
    async submitCloture() {
      if (this.isSaving) return;
      this.isSaving = true;
      try {
        const response = await fetch(`/api/collection/${this.selectedCollecte.id}/close`, {
          method: 'PATCH',
          headers: this.getCsrfHeaders(),
          body: JSON.stringify(this.clotureForm)
        });
        if (!response.ok) throw new Error("API Error");
        window.location.reload();
      } catch (err) {
        console.error(err);
        alert("Erreur lors de la clôture.");
      } finally {
        this.isSaving = false;
      }
    },
    async submitSuppression() {
      if (this.suppressionInput.toLowerCase() !== 'supprimer') return;
      if (this.isSaving) return;
      this.isSaving = true;
      try {
        const response = await fetch(`/api/collection/${this.selectedCollecte.id}`, {
          method: 'DELETE',
          headers: this.getCsrfHeaders()
        });
        if (!response.ok) throw new Error("API Error");
        window.location.reload();
      } catch (err) {
        console.error(err);
        alert("Erreur lors de la suppression.");
      } finally {
        this.isSaving = false;
      }
    }
  }
}
</script>
