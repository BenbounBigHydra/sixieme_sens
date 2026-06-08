<template>
  <div class="min-h-screen bg-[#fffbf1] font-inter">
    <HeaderAdmin />

    <main class="max-w-desktop mx-auto px-8 md:px-16 lg:px-24 xl:px-8 py-10 space-y-12">
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
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-0">
        <h1 class="font-inter font-bold text-3xl text-black">Entreprises partenaires</h1>
        <button @click="openNewCompanyModal" class="bg-[#0073e6] text-[#fffbf1] flex items-center px-6 py-3 rounded-sm hover:bg-blue-600 transition-colors w-full md:w-auto justify-center">
          <div class="h-4 w-4 mr-2 bg-[#fffbf1]" style="mask-image: url('/images/Cross.svg'); mask-size: contain; mask-repeat: no-repeat; mask-position: center; -webkit-mask-image: url('/images/Cross.svg'); -webkit-mask-size: contain; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center;"></div>
          <span class="font-inter text-sm">Nouvelle entreprise</span>
        </button>
      </div>

      <!-- Companies Table -->
      <div class="w-full">
        <div class="border border-blue-200 rounded-t-sm overflow-hidden">
          <!-- Table Header (Desktop Only) -->
          <div class="hidden md:grid grid-cols-5 items-center bg-[#ffeaa7] py-3 px-4 border-b border-blue-200">
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
                  <p class="font-inter text-xs text-black">Vert: à clore, Orange: à venir, Noir: passées</p>
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
          <div class="border border-blue-200 rounded-b-sm rounded-t-sm md:rounded-t-none bg-[#fffbf1]">
            <template v-if="filteredAndSortedCompanies.length > 0">
              <div v-for="company in filteredAndSortedCompanies" :key="company.id" class="flex flex-col md:grid md:grid-cols-5 items-start md:items-center py-4 px-4 border-b border-blue-200 last:border-0 gap-4 md:gap-0">
                <!-- Entreprise -->
                <div class="flex items-center space-x-3">
                  <div class="h-8 w-16 flex items-center justify-start">
                    <img :src="company.logo ? '/' + company.logo : '/images/BCGE.png'" alt="Logo" class="max-h-full max-w-full object-contain" />
                  </div>
                  <span class="font-inter font-bold text-lg md:text-sm text-[#393939]">{{ company.name }}</span>
                </div>

                <!-- Collectes -->
                <div class="flex items-center justify-between md:justify-start w-full md:w-auto">
                  <span class="md:hidden font-bold text-sm text-[#393939]">Collectes:</span>
                  <div class="flex items-center space-x-2">
                    <div class="h-6 w-6 rounded-full bg-[#95d070] flex items-center justify-center text-white text-xs font-bold">{{ company.collections?.to_close || 0 }}</div>
                    <div class="h-6 w-6 rounded-full bg-[#f39c7f] flex items-center justify-center text-white text-xs font-bold">{{ company.collections?.to_come || 0 }}</div>
                    <div class="h-6 w-6 rounded-full bg-black flex items-center justify-center text-white text-xs font-bold">{{ company.collections?.past || 0 }}</div>
                  </div>
                </div>

                <!-- Participation -->
                <div class="font-inter text-sm text-[#393939] flex justify-between md:block w-full md:w-auto">
                  <span class="md:hidden font-bold">Participation:</span>
                  <span>{{ company.participation !== undefined ? (company.participation * 100).toFixed(0) + '%' : '0%' }}</span>
                </div>

                <!-- Rigueur -->
                <div class="font-inter text-sm text-[#393939] flex justify-between md:block w-full md:w-auto">
                  <span class="md:hidden font-bold">Rigueur:</span>
                  <span>{{ company.rigueur !== undefined ? (company.rigueur * 100).toFixed(0) + '%' : '0%' }}</span>
                </div>

                <!-- Détails -->
                <div class="flex items-center justify-start md:justify-end w-full pt-2 md:pt-0 border-t md:border-0 border-gray-100 mt-2 md:mt-0">
                  <button @click="openEditModal(company)" class="border border-[#0073e6] p-2 md:p-1.5 rounded-sm hover:bg-blue-50 transition-colors w-full md:w-auto flex justify-center">
                    <img src="/images/Edit.svg" alt="Edit" class="h-4 w-4" />
                    <span class="md:hidden ml-2 text-[#0073e6] text-sm">Modifier</span>
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

    <!-- Company Modal -->
    <div v-if="isModalOpen" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
      <div class="bg-[#fffbf1] w-full max-w-4xl rounded-sm shadow-xl border border-blue-200 overflow-hidden flex flex-col max-h-[90vh]">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 border-b border-blue-200">
          <h2 class="font-inter font-bold text-2xl text-black">
            {{ editingCompany ? 'Modifier L\'entreprise' : 'Nouvelle entreprise' }}
          </h2>
          <button @click="closeModal" class="text-gray-500 hover:text-black transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6 space-y-5 overflow-y-auto">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Colonne 1 -->
            <div class="space-y-5">
              <!-- Nom -->
              <div>
                <label class="block font-inter text-sm font-bold text-[#393939] mb-2">Nom *</label>
                <input
                  type="text"
                  v-model="form.name"
                  class="w-full border border-gray-400 rounded-sm py-2 px-3 bg-transparent outline-none focus:border-[#0073e6] transition-colors"
                  placeholder="Nom de l'entreprise"
                />
                <p v-if="errors.name" class="text-red-500 text-xs mt-1">{{ errors.name[0] }}</p>
              </div>

              <!-- Logo -->
              <div>
                <label class="block font-inter text-sm font-bold text-[#393939] mb-2">Logo</label>
                <input
                  type="file"
                  @change="handleFileUpload"
                  accept="image/*"
                  class="w-full border border-gray-400 rounded-sm py-2 px-3 bg-transparent outline-none focus:border-[#0073e6] transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-sm file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-[#0073e6] hover:file:bg-blue-100"
                />
                <div v-if="previewLogo || (editingCompany && editingCompany.logo)" class="mt-4 border border-gray-200 p-2 rounded-sm inline-block">
                  <img :src="previewLogo || '/' + editingCompany.logo" alt="Logo preview" class="h-16 object-contain" />
                </div>
                <p v-if="errors.logo" class="text-red-500 text-xs mt-1">{{ errors.logo[0] }}</p>
              </div>

              <!-- Couleur -->
              <div>
                <label class="block font-inter text-sm font-bold text-[#393939] mb-2">Couleur de la marque</label>
                <div class="flex items-center space-x-3">
                  <input
                    type="color"
                    v-model="form.color"
                    class="h-10 w-10 border-0 p-0 cursor-pointer"
                  />
                  <input
                    type="text"
                    v-model="form.color"
                    class="w-full border border-gray-400 rounded-sm py-2 px-3 bg-transparent outline-none focus:border-[#0073e6] transition-colors"
                    placeholder="#000000"
                  />
                </div>
                <p v-if="errors.color" class="text-red-500 text-xs mt-1">{{ errors.color[0] }}</p>
              </div>
            </div>

            <!-- Colonne 2 -->
            <div class="space-y-5">
              <!-- Informations de collecte (Lecture seule, visible uniquement si édition) -->
              <div v-if="editingCompany" class="bg-blue-50 p-4 rounded-sm border border-blue-100 space-y-3 mt-4">
                <h3 class="font-inter text-sm font-bold text-[#0073e6] mb-2">Statistiques de collectes</h3>
                <div class="flex justify-between items-center text-sm font-inter text-[#393939]">
                  <span class="font-medium">Nombre de collectes :</span>
                  <span>{{ editingCompany.collections_total || 0 }}</span>
                </div>
                <div class="flex justify-between items-center text-sm font-inter text-[#393939]">
                  <span class="font-medium">Dernière collecte :</span>
                  <span>{{ editingCompany.last_collection_date || 'Aucune' }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Footer -->
        <div class="flex justify-end items-center p-6 border-t border-blue-200 bg-gray-50/50 space-x-4">
          <button @click="closeModal" class="font-inter text-sm font-bold text-gray-600 hover:text-black transition-colors">
            Annuler
          </button>
          <button
            @click="saveCompany"
            :disabled="isSaving || !form.name"
            class="bg-[#0073e6] text-[#fffbf1] px-6 py-2.5 rounded-sm hover:bg-blue-600 transition-colors disabled:opacity-50 font-inter text-sm font-bold flex items-center"
          >
            <span v-if="isSaving" class="mr-2">
              <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
            </span>
            {{ isSaving ? 'Enregistrement...' : (editingCompany ? 'Enregistrer les modifications' : 'Créer l\'entreprise') }}
          </button>
        </div>
      </div>
    </div>
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
      companies: [],
      // Modal state
      isModalOpen: false,
      isSaving: false,
      editingCompany: null,
      form: {
        name: '',
        color: '#000000',
        logo: null
      },
      previewLogo: null,
      errors: {}
    }
  },
  created() {
    if (this.initialData && this.initialData.companies) {
      this.companies = this.initialData.companies;
    }
  },
  mounted() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('action') === 'new') {
      this.openNewCompanyModal();
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
      this.editingCompany = null;
      this.form = {
        name: '', color: '#000000', logo: null
      };
      this.previewLogo = null;
      this.errors = {};
      this.isModalOpen = true;
    },
    openEditModal(company) {
      this.editingCompany = company;
      this.form = {
        name: company.name || '',
        color: company.color || '#000000',
        logo: null
      };
      this.previewLogo = null;
      this.errors = {};
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
      this.editingCompany = null;
    },
    handleFileUpload(event) {
      const file = event.target.files[0];
      if (!file) return;
      this.form.logo = file;
      this.previewLogo = URL.createObjectURL(file);
    },
    async saveCompany() {
      this.isSaving = true;
      this.errors = {};

      const formData = new FormData();
      formData.append('name', this.form.name);
      if (this.form.color) formData.append('color', this.form.color);
      if (this.form.logo) formData.append('logo', this.form.logo);

      try {
        let response;

        const getCookie = (name) => {
          const value = `; ${document.cookie}`;
          const parts = value.split(`; ${name}=`);
          if (parts.length === 2) return decodeURIComponent(parts.pop().split(';').shift());
          return null;
        };

        const headers = {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        };

        const csrfToken = getCookie('XSRF-TOKEN');
        if (csrfToken) {
          headers['X-XSRF-TOKEN'] = csrfToken;
        }

        if (this.editingCompany) {
          // Update via POST with _method=PUT to handle multipart/form-data
          formData.append('_method', 'PUT');
          response = await fetch(`/api/company/${this.editingCompany.id}`, {
            method: 'POST',
            headers: headers,
            body: formData
          });
        } else {
          // Create new
          response = await fetch('/api/company', {
            method: 'POST',
            headers: headers,
            body: formData
          });
        }

        const responseData = await response.json();

        if (!response.ok) {
          if (response.status === 422) {
            this.errors = responseData.errors || {};
            return;
          } else {
            throw new Error('Network response was not ok');
          }
        }

        if (this.editingCompany) {
          const index = this.companies.findIndex(c => c.id === this.editingCompany.id);
          if (index !== -1) {
            this.companies[index] = { ...this.companies[index], ...responseData };
          }
        } else {
          this.companies.push(responseData);
        }

        this.closeModal();
      } catch (error) {
        alert("Une erreur s'est produite lors de l'enregistrement de l'entreprise.");
        console.error(error);
      } finally {
        this.isSaving = false;
      }
    }
  }
}
</script>
