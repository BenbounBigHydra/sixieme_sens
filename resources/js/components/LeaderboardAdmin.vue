<template>
  <div class="min-h-screen bg-[#fffbf1] font-inter">
    <HeaderAdmin />

    <main class="max-w-desktop mx-auto px-8 md:px-16 lg:px-24 xl:px-8 py-10 space-y-12">

      <!-- Section 1: Leaderboard -->
      <section>
        <h1 class="font-jersey font-bold text-4xl md:text-[48px] text-black mb-8 leading-none">
          Leaderbord actuel ({{ currentYear }})
        </h1>

        <div class="w-full overflow-x-auto">
          <table class="w-full text-left border-collapse min-w-max md:min-w-[700px]">
            <thead>
              <tr class="border-b-[3px] border-[#B3D9FF]">
                <th class="py-2 md:py-4 px-1 md:px-2 font-inter font-bold text-xs md:text-sm text-[#034a74] text-center w-16 md:w-24"></th>
                <th class="py-2 md:py-4 px-1 md:px-2 font-inter font-bold text-xs md:text-sm text-[#034a74]">Leader</th>
                <th class="py-2 md:py-4 px-1 md:px-2 font-inter font-bold text-xs md:text-sm text-[#034a74] text-center">Total employés</th>
                <th class="py-2 md:py-4 px-1 md:px-2 font-inter font-bold text-xs md:text-sm text-[#034a74] text-center">Poches récoltées</th>
                <th class="py-2 md:py-4 px-1 md:px-2 font-inter font-bold text-xs md:text-sm text-[#034a74]">
                  <div class="flex items-center justify-center space-x-1">
                    <span>Score</span>
                    <div class="relative group cursor-pointer flex items-center">
                      <img src="/images/info.svg" alt="Info" class="h-4 w-4" style="filter: brightness(0);" />
                      <div class="absolute right-0 top-full mt-2 w-[260px] md:w-[300px] max-w-[calc(100vw-2rem)] bg-[#fffbf1] border border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-4 hidden group-hover:block z-50 text-left font-normal">
                        <p class="font-jersey text-[20px] text-black leading-tight">Calcul du score</p>
                        <p class="font-inter text-[14px] text-black mt-2">Le score affiché correspond au ratio entre le nombre de poches de sang récoltées et le nombre total d'employés de l'entreprise.</p>
                      </div>
                    </div>
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
              <!-- Row 1: Gold -->
              <tr class="border-b-[3px] border-[#ffeaa7]">
                <td class="py-2 md:py-4 px-1 md:px-2 text-center w-16 md:w-24">
                  <img src="/images/trophy_gold.png" alt="Or" class="h-10 md:h-16 w-auto mx-auto object-contain" />
                </td>
                <td class="py-2 md:py-4 px-1 md:px-2 font-jersey text-xl md:text-[32px] text-black">
                  {{ goldData?.name || '-' }}
                </td>
                <td class="py-2 md:py-4 px-1 md:px-2 font-jersey text-xl md:text-[32px] text-black text-center">
                  {{ formatNumber(goldData?.nb_employee) || '-' }}
                </td>
                <td class="py-2 md:py-4 px-1 md:px-2 font-jersey text-xl md:text-[32px] text-black text-center">
                  {{ formatNumber(goldData?.nb_blood_pouch) || '-' }}
                </td>
                <td class="py-2 md:py-4 px-1 md:px-2 font-jersey text-xl md:text-[32px] text-black text-center">
                  {{ calculateScore(goldData) }}
                </td>
              </tr>
              <!-- Row 2: Ambassador -->
              <tr class="border-b-[3px] border-[#ffeaa7]">
                <td class="py-2 md:py-4 px-1 md:px-2 text-center w-16 md:w-24">
                  <img src="/images/trophy_conviction (1).png" alt="Ambassadeur" class="h-10 md:h-16 w-auto mx-auto object-contain" />
                </td>
                <td class="py-2 md:py-4 px-1 md:px-2 font-jersey text-xl md:text-[32px] text-black">
                  {{ ambassadorData?.name || '-' }}
                </td>
                <td class="py-2 md:py-4 px-1 md:px-2 font-jersey text-xl md:text-[32px] text-black text-center">
                  {{ formatNumber(ambassadorData?.nb_employee) || '-' }}
                </td>
                <td class="py-2 md:py-4 px-1 md:px-2 font-jersey text-xl md:text-[32px] text-black text-center">
                  {{ formatNumber(ambassadorData?.nb_blood_pouch) || '-' }}
                </td>
                <td class="py-2 md:py-4 px-1 md:px-2 font-jersey text-xl md:text-[32px] text-black text-center">
                  {{ calculateScore(ambassadorData) }}
                </td>
              </tr>
              <!-- Row 3: Conviction -->
              <tr class="border-b-[3px] border-[#ffeaa7]">
                <td class="py-2 md:py-4 px-1 md:px-2 text-center w-16 md:w-24">
                  <img src="/images/trophy_conviction.png" alt="Conviction" class="h-10 md:h-16 w-auto mx-auto object-contain" />
                </td>
                <td class="py-2 md:py-4 px-1 md:px-2 font-jersey text-xl md:text-[32px] text-black">
                  {{ convictionData?.name || '-' }}
                </td>
                <td class="py-2 md:py-4 px-1 md:px-2 font-jersey text-xl md:text-[32px] text-black text-center">
                  {{ formatNumber(convictionData?.nb_employee) || '-' }}
                </td>
                <td class="py-2 md:py-4 px-1 md:px-2 font-jersey text-xl md:text-[32px] text-black text-center">
                  {{ formatNumber(convictionData?.nb_blood_pouch) || '-' }}
                </td>
                <td class="py-2 md:py-4 px-1 md:px-2 font-jersey text-xl md:text-[32px] text-black text-center">
                  {{ calculateScore(convictionData) }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Section 2: KPIs -->
      <section class="pt-8">
        <h2 class="font-jersey font-bold text-4xl md:text-[48px] text-black mb-8 leading-none">
          KPIs - Progression
        </h2>

        <div class="mb-10 flex flex-col md:flex-row md:items-center">
          <label class="font-jersey text-2xl text-black mr-4 mb-2 md:mb-0">Sélectionner une entreprise :</label>
          <div class="relative w-full md:w-[350px]">
            <!-- Custom Select Box -->
            <div 
              @click="toggleDropdown" 
              class="w-full bg-white border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] py-3 px-4 font-inter font-bold text-[#393939] cursor-pointer flex justify-between items-center transition-all hover:bg-gray-50"
              :class="{'translate-y-[2px] translate-x-[2px] shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]': isDropdownOpen}"
            >
              <span class="truncate pr-4">{{ selectedCompanyName }}</span>
              <svg class="fill-current h-5 w-5 flex-shrink-0 transition-transform duration-200" :class="{'rotate-180': isDropdownOpen}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
            
            <!-- Custom Dropdown Menu -->
            <div v-if="isDropdownOpen" ref="dropdownMenu" class="absolute z-50 w-full mt-3 bg-white border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] max-h-[300px] overflow-y-auto">
              <div 
                v-for="(data, companyId) in kpiData" 
                :key="companyId"
                @click="selectCompany(companyId)"
                class="px-4 py-3 font-inter font-bold text-[#393939] hover:bg-[#ffeaa7] hover:text-black cursor-pointer transition-colors border-b-2 border-gray-200 last:border-0 flex items-center"
              >
                <div class="w-3 h-3 rounded-full mr-3" :class="companyId === selectedCompanyKpi ? 'bg-[#0073e6]' : 'bg-transparent'"></div>
                {{ data.name }}
              </div>
            </div>

            <!-- Click Outside Overlay -->
            <div v-if="isDropdownOpen" @click="isDropdownOpen = false" class="fixed inset-0 z-40"></div>
          </div>
        </div>

        <div v-if="selectedCompanyKpi && kpiData[selectedCompanyKpi]" class="space-y-8">
          <div v-if="kpiData[selectedCompanyKpi].kpis.length === 0" class="text-gray-500 font-inter py-4">
            Aucune donnée de collecte pour cette entreprise.
          </div>
          <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
            
            <!-- Taux d'occupation -->
            <div class="border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] bg-white flex flex-col">
              <div class="bg-[#B3D9FF] border-b-2 border-black p-4 flex items-center justify-between relative z-20">
                <div class="w-6 hidden md:block"></div>
                <h3 class="font-jersey text-3xl text-black leading-none tracking-wide flex-grow text-center">Taux d'occupation</h3>
                <div class="group relative flex items-center justify-center cursor-help">
                  <svg class="w-6 h-6 transition-transform group-hover:scale-110" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 8V6H20V4H19V3H18V2H16V1H14V0H8V1H6V2H4V3H3V4H2V6H1V8H0V14H1V16H2V18H3V19H4V20H6V21H8V22H14V21H16V20H18V19H19V18H20V16H21V14H22V8H21ZM10 5H12V7H10V5ZM9 14H10V9H9V8H12V14H13V16H9V14Z" fill="black"/>
                  </svg>
                  <div class="absolute right-0 top-full mt-2 hidden group-hover:block w-64 bg-white border-2 border-black text-[#393939] text-sm font-inter font-bold p-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-50 text-left pointer-events-none">
                    Proportion de places réservées par rapport à la capacité totale de la collecte.
                  </div>
                </div>
              </div>
              <div class="p-8 flex-grow">
                <div class="flex items-end justify-around h-[220px] border-b-[3px] border-l-[3px] border-black p-2 pb-0 relative ml-8">
                  <!-- Y-axis -->
                  <div class="absolute -left-12 top-0 text-xs font-bold font-inter text-right w-10">100%</div>
                  <div class="absolute -left-12 top-[50%] text-xs font-bold font-inter text-right w-10">50%</div>
                  <div class="absolute -left-12 bottom-0 text-xs font-bold font-inter text-right w-10">0%</div>

                  <div v-for="(kpi, i) in kpiData[selectedCompanyKpi].kpis" :key="'occ-'+i" class="flex flex-col items-center group relative w-12 h-full justify-end">
                    <div class="w-8 bg-[#0073e6] border-2 border-black cursor-pointer transition-all hover:bg-[#3391ff] hover:-translate-y-1 relative" :style="{ height: `${Math.min(100, (kpi.occupancy_rate || 0) * 100)}%`, minHeight: '4px' }"></div>
                    <div class="absolute bottom-full mb-2 opacity-0 group-hover:opacity-100 transition-opacity bg-white border-2 border-black text-black font-inter font-bold text-xs px-3 py-1.5 z-10 whitespace-nowrap shadow-[3px_3px_0px_0px_rgba(0,115,230,1)] pointer-events-none">
                      {{ ((kpi.occupancy_rate || 0) * 100).toFixed(1) }}%
                    </div>
                    <div class="absolute top-[105%] text-sm font-inter font-bold text-[#393939]">Col. {{ i + 1 }}</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Taux de visite cobrandé -->
            <div class="border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] bg-white flex flex-col">
              <div class="bg-[#C1F0A8] border-b-2 border-black p-4 flex items-center justify-between relative z-20">
                <div class="w-6 hidden md:block"></div>
                <h3 class="font-jersey text-3xl text-black leading-none tracking-wide flex-grow text-center">Taux de visite (Site Co-brandé)</h3>
                <div class="group relative flex items-center justify-center cursor-help">
                  <svg class="w-6 h-6 transition-transform group-hover:scale-110" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 8V6H20V4H19V3H18V2H16V1H14V0H8V1H6V2H4V3H3V4H2V6H1V8H0V14H1V16H2V18H3V19H4V20H6V21H8V22H14V21H16V20H18V19H19V18H20V16H21V14H22V8H21ZM10 5H12V7H10V5ZM9 14H10V9H9V8H12V14H13V16H9V14Z" fill="black"/>
                  </svg>
                  <div class="absolute right-0 top-full mt-2 hidden group-hover:block w-64 bg-white border-2 border-black text-[#393939] text-sm font-inter font-bold p-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-50 text-left pointer-events-none">
                    Proportion d'employés ayant visité la page co-brandée par rapport au nombre total d'employés.
                  </div>
                </div>
              </div>
              <div class="p-8 flex-grow">
                <div class="flex items-end justify-around h-[220px] border-b-[3px] border-l-[3px] border-black p-2 pb-0 relative ml-8">
                  <!-- Y-axis -->
                  <div class="absolute -left-12 top-0 text-xs font-bold font-inter text-right w-10">100%</div>
                  <div class="absolute -left-12 top-[50%] text-xs font-bold font-inter text-right w-10">50%</div>
                  <div class="absolute -left-12 bottom-0 text-xs font-bold font-inter text-right w-10">0%</div>

                  <div v-for="(kpi, i) in kpiData[selectedCompanyKpi].kpis" :key="'cob-'+i" class="flex flex-col items-center group relative w-12 h-full justify-end">
                    <div class="w-8 bg-[#5bb124] border-2 border-black cursor-pointer transition-all hover:bg-[#72c938] hover:-translate-y-1 relative" :style="{ height: `${Math.min(100, (kpi.cobrand_visit_rate || 0) * 100)}%`, minHeight: '4px' }"></div>
                    <div class="absolute bottom-full mb-2 opacity-0 group-hover:opacity-100 transition-opacity bg-white border-2 border-black text-black font-inter font-bold text-xs px-3 py-1.5 z-10 whitespace-nowrap shadow-[3px_3px_0px_0px_rgba(91,177,36,1)] pointer-events-none">
                      {{ ((kpi.cobrand_visit_rate || 0) * 100).toFixed(1) }}%
                    </div>
                    <div class="absolute top-[105%] text-sm font-inter font-bold text-[#393939]">Col. {{ i + 1 }}</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Taux de conversion OneDoc -->
            <div class="border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] bg-white flex flex-col">
              <div class="bg-[#ffeaa7] border-b-2 border-black p-4 flex items-center justify-between relative z-20">
                <div class="w-6 hidden md:block"></div>
                <h3 class="font-jersey text-3xl text-black leading-none tracking-wide flex-grow text-center">Conversion OneDoc</h3>
                <div class="group relative flex items-center justify-center cursor-help">
                  <svg class="w-6 h-6 transition-transform group-hover:scale-110" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 8V6H20V4H19V3H18V2H16V1H14V0H8V1H6V2H4V3H3V4H2V6H1V8H0V14H1V16H2V18H3V19H4V20H6V21H8V22H14V21H16V20H18V19H19V18H20V16H21V14H22V8H21ZM10 5H12V7H10V5ZM9 14H10V9H9V8H12V14H13V16H9V14Z" fill="black"/>
                  </svg>
                  <div class="absolute right-0 top-full mt-2 hidden group-hover:block w-64 bg-white border-2 border-black text-[#393939] text-sm font-inter font-bold p-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-50 text-left pointer-events-none">
                    Proportion des visiteurs du site co-brandé ayant cliqué sur le lien de réservation OneDoc.
                  </div>
                </div>
              </div>
              <div class="p-8 flex-grow">
                <div class="flex items-end justify-around h-[220px] border-b-[3px] border-l-[3px] border-black p-2 pb-0 relative ml-8">
                  <!-- Y-axis -->
                  <div class="absolute -left-12 top-0 text-xs font-bold font-inter text-right w-10">100%</div>
                  <div class="absolute -left-12 top-[50%] text-xs font-bold font-inter text-right w-10">50%</div>
                  <div class="absolute -left-12 bottom-0 text-xs font-bold font-inter text-right w-10">0%</div>

                  <div v-for="(kpi, i) in kpiData[selectedCompanyKpi].kpis" :key="'one-'+i" class="flex flex-col items-center group relative w-12 h-full justify-end">
                    <div class="w-8 bg-[#ffd012] border-2 border-black cursor-pointer transition-all hover:bg-[#ffe35c] hover:-translate-y-1 relative" :style="{ height: `${Math.min(100, (kpi.onedoc_visit_rate || 0) * 100)}%`, minHeight: '4px' }"></div>
                    <div class="absolute bottom-full mb-2 opacity-0 group-hover:opacity-100 transition-opacity bg-white border-2 border-black text-black font-inter font-bold text-xs px-3 py-1.5 z-10 whitespace-nowrap shadow-[3px_3px_0px_0px_rgba(255,208,18,1)] pointer-events-none">
                      {{ ((kpi.onedoc_visit_rate || 0) * 100).toFixed(1) }}%
                    </div>
                    <div class="absolute top-[105%] text-sm font-inter font-bold text-[#393939]">Col. {{ i + 1 }}</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Taux d'inscription non éligible -->
            <div class="border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] bg-white flex flex-col">
              <div class="bg-[#ffb699] border-b-2 border-black p-4 flex items-center justify-between relative z-20">
                <div class="w-6 hidden md:block"></div>
                <h3 class="font-jersey text-3xl text-black leading-none tracking-wide flex-grow text-center">Inscriptions Non Éligibles</h3>
                <div class="group relative flex items-center justify-center cursor-help">
                  <svg class="w-6 h-6 transition-transform group-hover:scale-110" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 8V6H20V4H19V3H18V2H16V1H14V0H8V1H6V2H4V3H3V4H2V6H1V8H0V14H1V16H2V18H3V19H4V20H6V21H8V22H14V21H16V20H18V19H19V18H20V16H21V14H22V8H21ZM10 5H12V7H10V5ZM9 14H10V9H9V8H12V14H13V16H9V14Z" fill="black"/>
                  </svg>
                  <div class="absolute right-0 top-full mt-2 hidden group-hover:block w-64 bg-white border-2 border-black text-[#393939] text-sm font-inter font-bold p-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-50 text-left pointer-events-none">
                    Proportion d'utilisateurs qui ont testé leur éligibilité mais n'ont pas pu faire de don suite aux résultats.
                  </div>
                </div>
              </div>
              <div class="p-8 flex-grow">
                <div class="flex items-end justify-around h-[220px] border-b-[3px] border-l-[3px] border-black p-2 pb-0 relative ml-8">
                  <!-- Y-axis -->
                  <div class="absolute -left-12 top-0 text-xs font-bold font-inter text-right w-10">100%</div>
                  <div class="absolute -left-12 top-[50%] text-xs font-bold font-inter text-right w-10">50%</div>
                  <div class="absolute -left-12 bottom-0 text-xs font-bold font-inter text-right w-10">0%</div>

                  <div v-for="(kpi, i) in kpiData[selectedCompanyKpi].kpis" :key="'non-'+i" class="flex flex-col items-center group relative w-12 h-full justify-end">
                    <div class="w-8 bg-[#E4534B] border-2 border-black cursor-pointer transition-all hover:bg-[#f1716a] hover:-translate-y-1 relative" :style="{ height: `${Math.min(100, (kpi.non_eligible_rate || 0) * 100)}%`, minHeight: '4px' }"></div>
                    <div class="absolute bottom-full mb-2 opacity-0 group-hover:opacity-100 transition-opacity bg-white border-2 border-black text-black font-inter font-bold text-xs px-3 py-1.5 z-10 whitespace-nowrap shadow-[3px_3px_0px_0px_rgba(228,83,75,1)] pointer-events-none">
                      {{ ((kpi.non_eligible_rate || 0) * 100).toFixed(1) }}%
                    </div>
                    <div class="absolute top-[105%] text-sm font-inter font-bold text-[#393939]">Col. {{ i + 1 }}</div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>

    </main>
  </div>
</template>

<script>
import HeaderAdmin from './HeaderAdmin.vue';

export default {
  name: 'LeaderboardAdmin',
  components: {
    HeaderAdmin
  },
  data() {
    return {
      selectedCompanyKpi: '',
      isDropdownOpen: false
    }
  },
  props: {
    initialData: {
      type: Object,
      default: () => ({})
    }
  },
  computed: {
    goldData() {
      return this.initialData.gold;
    },
    ambassadorData() {
      return this.initialData.ambassador;
    },
    convictionData() {
      return this.initialData.conviction;
    },
    kpiData() {
      return this.initialData.kpis || {};
    },
    currentYear() {
      // Get from URL param if available, else current year
      const urlParams = new URLSearchParams(window.location.search);
      const yearParam = urlParams.get('year');
      if (yearParam && !isNaN(yearParam)) {
        return yearParam;
      }
      return new Date().getFullYear();
    },
    selectedCompanyName() {
      if (this.selectedCompanyKpi && this.kpiData[this.selectedCompanyKpi]) {
        return this.kpiData[this.selectedCompanyKpi].name;
      }
      return "Choisir une entreprise";
    }
  },
  methods: {
    toggleDropdown() {
      this.isDropdownOpen = !this.isDropdownOpen;
      if (this.isDropdownOpen) {
        this.$nextTick(() => {
          if (this.$refs.dropdownMenu) {
            this.$refs.dropdownMenu.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
          }
        });
      }
    },
    selectCompany(companyId) {
      this.selectedCompanyKpi = companyId;
      this.isDropdownOpen = false;
    },
    formatNumber(num) {
      if (num === null || num === undefined) return '';
      return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "'");
    },
    calculateScore(data) {
      if (!data || !data.nb_employee || !data.nb_blood_pouch) return '-';
      const ratio = data.nb_blood_pouch / data.nb_employee;
      return (ratio * 100).toFixed(1) + '%';
    }
  }
}
</script>
