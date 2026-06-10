<template>
    <div class="min-h-screen bg-[#fffbf1] font-inter">
        <HeaderAdmin />

        <main class="max-w-desktop mx-auto px-8 md:px-20 lg:px-32 xl:px-40 py-10 space-y-12">

            <!-- Section 1: Leaderboard -->
            <section>
                <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-8 gap-4">
                    <h1 class="font-jersey font-bold text-3xl md:text-[48px] text-black leading-none">
                        Leaderboard ({{ selectedYear }})
                    </h1>

                    <!-- Year selector -->
                    <div class="mb-10 flex flex-col md:flex-row md:items-center">
                        <label class="font-jersey text-xl md:text-2xl text-black mr-4 mb-2 md:mb-0">
                            Année :
                        </label>

                        <div class="flex items-center gap-4">
                            <div class="relative w-full md:w-[200px]">
                                <div @click="isYearDropdownOpen = !isYearDropdownOpen"
                                    class="w-full bg-white border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] py-3 px-4 font-inter font-bold text-[#393939] cursor-pointer flex justify-between items-center transition-all hover:bg-gray-50"
                                    :class="{ 'translate-y-[2px] translate-x-[2px] shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]': isYearDropdownOpen }">

                                    <span class="truncate pr-4">{{ selectedYear || 'Choisir...' }}</span>

                                    <svg class="fill-current h-5 w-5 flex-shrink-0 transition-transform duration-200"
                                        :class="{ 'rotate-180': isYearDropdownOpen }" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>

                                <div v-if="isYearDropdownOpen"
                                    class="absolute z-50 w-full mt-3 bg-white border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] max-h-[250px] overflow-y-auto">

                                    <div v-for="year in availableYears" :key="year"
                                        @click="selectYear(year); isYearDropdownOpen = false"
                                        class="px-4 py-3 font-inter font-bold text-[#393939] hover:bg-[#ffeaa7] hover:text-black cursor-pointer transition-colors border-b-2 border-gray-200 last:border-0 flex items-center">

                                        <div class="w-3 h-3 rounded-full mr-3"
                                            :class="year === selectedYear ? 'bg-[#034a74]' : 'bg-transparent border border-gray-300'">
                                        </div>

                                        {{ year }}
                                    </div>
                                </div>

                                <div v-if="isYearDropdownOpen" @click="isYearDropdownOpen = false"
                                    class="fixed inset-0 z-40"></div>
                            </div>

                            <div v-if="isLoadingYear"
                                class="w-5 h-5 border-2 border-[#034a74] border-t-transparent rounded-full animate-spin flex-shrink-0">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Year load error -->
                <div v-if="yearLoadError"
                    class="mb-6 border-2 border-[#E4534B] bg-[#fff0ef] px-4 py-3 font-inter text-sm text-[#E4534B] font-bold shadow-[3px_3px_0px_0px_rgba(228,83,75,1)]">
                    {{ yearLoadError }}
                </div>

                <div class="w-full overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-max md:min-w-[700px]">
                        <thead>
                            <tr class="border-b-[3px] border-[#B3D9FF]">
                                <th
                                    class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-inter font-bold text-[9px] sm:text-xs md:text-sm text-[#034a74] text-center w-12 sm:w-16 md:w-24">
                                </th>
                                <th
                                    class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-inter font-bold text-[9px] sm:text-xs md:text-sm text-[#034a74]">
                                    Leader</th>
                                <th
                                    class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-inter font-bold text-[9px] sm:text-xs md:text-sm text-[#034a74] text-center">
                                    Total employés</th>
                                <th
                                    class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-inter font-bold text-[9px] sm:text-xs md:text-sm text-[#034a74] text-center">
                                    Poches récoltées</th>
                                <th
                                    class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-inter font-bold text-[9px] sm:text-xs md:text-sm text-[#034a74]">
                                    <div class="flex items-center justify-center space-x-1">
                                        <span>Score</span>
                                        <div class="relative group cursor-pointer flex items-center">
                                            <img src="/images/info.svg" alt="Info" class="h-4 w-4"
                                                style="filter: brightness(0);" />
                                            <div
                                                class="absolute right-0 top-full mt-2 w-[260px] md:w-[300px] max-w-[calc(100vw-2rem)] bg-[#fffbf1] border border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-4 hidden group-hover:block z-50 text-left font-normal">
                                                <p class="font-jersey text-[20px] text-black leading-tight">Calcul du
                                                    score</p>
                                                <p class="font-inter text-[14px] text-black mt-2">Le score affiché
                                                    correspond au ratio entre le nombre de poches de sang récoltées et
                                                    le nombre total d'employés de l'entreprise.</p>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b-[3px] border-[#ffeaa7]">
                                <td class="py-2 md:py-4 px-1 md:px-2 text-center w-16 md:w-24">
                                    <img src="/images/trophy_gold.png" alt="Or"
                                        class="h-10 md:h-16 w-auto mx-auto object-contain" />
                                </td>
                                <td class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-jersey text-base sm:text-xl md:text-[32px] text-black">{{
                                    goldData?.name || '-' }}</td>
                                <td
                                    class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-jersey text-base sm:text-xl md:text-[32px] text-black text-center">
                                    {{ formatNumber(goldData?.nb_employee) || '-' }}</td>
                                <td
                                    class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-jersey text-base sm:text-xl md:text-[32px] text-black text-center">
                                    {{ formatNumber(goldData?.nb_blood_pouch) || '-' }}</td>
                                <td
                                    class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-jersey text-base sm:text-xl md:text-[32px] text-black text-center">
                                    {{ calculateScore(goldData) }}</td>
                            </tr>
                            <tr class="border-b-[3px] border-[#ffeaa7]">
                                <td class="py-2 md:py-4 px-1 md:px-2 text-center w-16 md:w-24">
                                    <img src="/images/trophy_conviction (1).png" alt="Ambassadeur"
                                        class="h-10 md:h-16 w-auto mx-auto object-contain" />
                                </td>
                                <td class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-jersey text-base sm:text-xl md:text-[32px] text-black">{{
                                    ambassadorData?.name || '-' }}</td>
                                <td
                                    class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-jersey text-base sm:text-xl md:text-[32px] text-black text-center">
                                    {{ formatNumber(ambassadorData?.nb_employee) || '-' }}</td>
                                <td
                                    class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-jersey text-base sm:text-xl md:text-[32px] text-black text-center">
                                    {{ formatNumber(ambassadorData?.nb_blood_pouch) || '-' }}</td>
                                <td
                                    class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-jersey text-base sm:text-xl md:text-[32px] text-black text-center">
                                    {{ ambassadorData?.consecutive ? formatNumber(ambassadorData.consecutive) + " ans" :
                                    '-' }}</td>
                            </tr>
                            <tr class="border-b-[3px] border-[#ffeaa7]">
                                <td class="py-2 md:py-4 px-1 md:px-2 text-center w-16 md:w-24">
                                    <img src="/images/trophy_conviction.png" alt="Conviction"
                                        class="h-10 md:h-16 w-auto mx-auto object-contain" />
                                </td>
                                <td class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-jersey text-base sm:text-xl md:text-[32px] text-black">{{
                                    convictionData?.name || '-' }}</td>
                                <td
                                    class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-jersey text-base sm:text-xl md:text-[32px] text-black text-center">
                                    {{ formatNumber(convictionData?.nb_employee) || '-' }}</td>
                                <td
                                    class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-jersey text-base sm:text-xl md:text-[32px] text-black text-center">
                                    {{ formatNumber(convictionData?.nb_blood_pouch) || '-' }}</td>
                                <td
                                    class="py-2 md:py-4 px-0.5 sm:px-1 md:px-2 font-jersey text-base sm:text-xl md:text-[32px] text-black text-center">
                                    {{ calculateScore(convictionData) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Section 2: KPIs -->
            <section class="pt-8">
                <h2 class="font-jersey font-bold text-3xl md:text-[48px] text-black mb-8 leading-none">
                    KPIs — Progression mensuelle
                </h2>

                <div class="mb-10 flex flex-col md:flex-row md:items-center">
                    <label class="font-jersey text-xl md:text-2xl text-black mr-4 mb-2 md:mb-0">Sélectionner une entreprise
                        :</label>
                    <div class="relative w-full md:w-[350px]">
                        <div @click="toggleDropdown"
                            class="w-full bg-white border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] py-3 px-4 font-inter font-bold text-[#393939] cursor-pointer flex justify-between items-center transition-all hover:bg-gray-50"
                            :class="{ 'translate-y-[2px] translate-x-[2px] shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]': isDropdownOpen }">
                            <input v-if="isDropdownOpen" ref="searchInput" v-model="searchQuery" @keydown.enter.prevent="selectFirstOption" class="w-full bg-transparent outline-none font-inter font-bold text-[#393939] placeholder-gray-400 truncate pr-4" placeholder="Rechercher..." @click.stop />
                            <span v-else class="truncate pr-4">{{ selectedCompanyName }}</span>
                            <svg class="fill-current h-5 w-5 flex-shrink-0 transition-transform duration-200"
                                :class="{ 'rotate-180': isDropdownOpen }" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>

                        <div v-if="isDropdownOpen" ref="dropdownMenu"
                            class="absolute z-50 w-full mt-3 bg-white border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] max-h-[300px] overflow-y-auto">
                            <div v-for="comp in filteredCompanies" :key="comp.id" @click="selectCompany(comp.id)"
                                class="px-4 py-3 font-inter font-bold text-[#393939] hover:bg-[#ffeaa7] hover:text-black cursor-pointer transition-colors border-b-2 border-gray-200 last:border-0 flex items-center">
                                <div class="w-3 h-3 rounded-full mr-3"
                                    :class="comp.id === selectedCompanyKpi ? 'bg-[#0073e6]' : 'bg-transparent border border-gray-300'">
                                </div>
                                {{ comp.name }}
                            </div>
                            <div v-if="filteredCompanies.length === 0" class="px-4 py-3 font-inter font-bold text-gray-500">
                                Aucun résultat
                            </div>
                        </div>

                        <div v-if="isDropdownOpen" @click="isDropdownOpen = false" class="fixed inset-0 z-40"></div>
                    </div>
                </div>

                <div v-if="selectedCompanyKpi">
                    <div v-if="hasNoKpiData" class="text-gray-500 font-inter py-4">
                        Aucune donnée de collecte pour cette sélection.
                    </div>

                    <div v-else>
                        <!-- Legend badges -->
                        <div class="mb-6 flex flex-wrap gap-2">
                            <template v-for="(monthData, monthIdx) in ALL_MONTHS" :key="monthIdx">
                                <div v-if="monthlyKpis[monthIdx]"
                                    class="inline-flex items-center gap-1.5 bg-white border-2 border-black px-3 py-1 text-xs font-inter font-bold text-[#393939] shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                    <span class="font-jersey text-base">{{ monthData }}</span>
                                    <span class="text-[#034a74]">{{ monthlyKpis[monthIdx].count }} collecte{{
                                        monthlyKpis[monthIdx].count > 1 ? 's' : '' }}</span>
                                </div>
                            </template>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">

                            <!-- Taux d'occupation -->
                            <div
                                class="border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] bg-white flex flex-col">
                                <div
                                    class="bg-[#B3D9FF] border-b-2 border-black p-4 flex items-center justify-between relative z-20">
                                    <div class="w-6 hidden md:block"></div>
                                    <h3
                                        class="font-jersey text-2xl md:text-3xl text-black leading-none tracking-wide flex-grow text-center">
                                        Taux
                                        d'occupation</h3>
                                    <InfoTooltip
                                        text="Proportion de places réservées par rapport à la capacité totale. Moyenne des collectes du mois." />
                                </div>
                                <div class="p-4 pt-10 md:p-8 flex-grow">
                                    <BarChart :monthly-kpis="monthlyKpis" field="occupancy_rate" color="#0073e6"
                                        hover-color="#3391ff" hover-shadow="rgba(0,115,230,1)" />
                                </div>
                            </div>

                            <!-- Taux de visite cobrandé -->
                            <div
                                class="border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] bg-white flex flex-col">
                                <div
                                    class="bg-[#C1F0A8] border-b-2 border-black p-4 flex items-center justify-between relative z-20">
                                    <div class="w-6 hidden md:block"></div>
                                    <h3
                                        class="font-jersey text-2xl md:text-3xl text-black leading-none tracking-wide flex-grow text-center">
                                        Taux de visite
                                        (Site Co-brandé)</h3>
                                    <InfoTooltip
                                        text="Proportion d'employés ayant visité la page co-brandée. Moyenne des collectes du mois." />
                                </div>
                                <div class="p-4 pt-10 md:p-8 flex-grow">
                                    <BarChart :monthly-kpis="monthlyKpis" field="cobrand_visit_rate" color="#5bb124"
                                        hover-color="#72c938" hover-shadow="rgba(91,177,36,1)" />
                                </div>
                            </div>

                            <!-- Conversion OneDoc -->
                            <div
                                class="border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] bg-white flex flex-col">
                                <div
                                    class="bg-[#ffeaa7] border-b-2 border-black p-4 flex items-center justify-between relative z-20">
                                    <div class="w-6 hidden md:block"></div>
                                    <h3
                                        class="font-jersey text-2xl md:text-3xl text-black leading-none tracking-wide flex-grow text-center">
                                        Conversion
                                        OneDoc</h3>
                                    <InfoTooltip
                                        text="Proportion des visiteurs co-brandés ayant cliqué sur le lien OneDoc. Moyenne des collectes du mois." />
                                </div>
                                <div class="p-4 pt-10 md:p-8 flex-grow">
                                    <BarChart :monthly-kpis="monthlyKpis" field="onedoc_visit_rate" color="#ffd012"
                                        hover-color="#ffe35c" hover-shadow="rgba(255,208,18,1)" />
                                </div>
                            </div>

                            <!-- Inscriptions Non Éligibles -->
                            <div
                                class="border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] bg-white flex flex-col">
                                <div
                                    class="bg-[#ffb699] border-b-2 border-black p-4 flex items-center justify-between relative z-20">
                                    <div class="w-6 hidden md:block"></div>
                                    <h3
                                        class="font-jersey text-2xl md:text-3xl text-black leading-none tracking-wide flex-grow text-center">
                                        Inscriptions
                                        Non Éligibles</h3>
                                    <InfoTooltip
                                        text="Proportion d'utilisateurs non éligibles après test. Moyenne des collectes du mois." />
                                </div>
                                <div class="p-4 pt-10 md:p-8 flex-grow">
                                    <BarChart :monthly-kpis="monthlyKpis" field="non_eligible_rate" color="#E4534B"
                                        hover-color="#f1716a" hover-shadow="rgba(228,83,75,1)" />
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

const MONTH_LABELS = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];

// ─── InfoTooltip sub-component ───────────────────────────────────────────────
const InfoTooltip = {
    name: 'InfoTooltip',
    props: { text: String },
    template: `
    <div class="group relative flex items-center justify-center cursor-help">
      <svg class="w-6 h-6 transition-transform group-hover:scale-110" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M21 8V6H20V4H19V3H18V2H16V1H14V0H8V1H6V2H4V3H3V4H2V6H1V8H0V14H1V16H2V18H3V19H4V20H6V21H8V22H14V21H16V20H18V19H19V18H20V16H21V14H22V8H21ZM10 5H12V7H10V5ZM9 14H10V9H9V8H12V14H13V16H9V14Z" fill="black"/>
      </svg>
      <div class="absolute right-0 top-full mt-2 hidden group-hover:block w-64 bg-white border-2 border-black text-[#393939] text-sm font-inter font-bold p-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-50 text-left pointer-events-none">
        {{ text }}
      </div>
    </div>
  `
};

// ─── BarChart sub-component ───────────────────────────────────────────────────
// Always renders all 12 months on the x-axis so positions are fixed.
// Months without data show a ghost bar at min height.
const BarChart = {
    name: 'BarChart',
    props: {
        monthlyKpis: { type: Object, default: () => ({}) },
        field: { type: String, required: true },
        color: { type: String, default: '#0073e6' },
        hoverColor: { type: String, default: '#3391ff' },
        hoverShadow: { type: String, default: 'rgba(0,115,230,1)' },
    },
    data() {
        return { MONTH_LABELS };
    },
    computed: {
        // Build a 12-slot array, one entry per calendar month
        slots() {
            return MONTH_LABELS.map((label, i) => {
                const data = this.monthlyKpis[i];
                return {
                    label,
                    value: data ? (data[this.field] ?? 0) : null, // null = no data
                    hasData: !!data,
                };
            });
        },
    },
    methods: {
        barHeight(value) {
            if (value === null) return '0%';
            return `${Math.min(100, value * 100)}%`;
        },
        formatPct(value) {
            if (value === null) return 'Aucune donnée';
            return `${(value * 100).toFixed(1)}%`;
        },
    },
    template: `
    <div class="flex items-end h-[220px] border-b-[3px] border-l-[3px] border-black relative ml-8 mt-6 mb-10 md:mb-7">
      <!-- Y-axis labels -->
      <div class="absolute -left-12 top-0      text-xs font-bold font-inter text-right w-10">100%</div>
      <div class="absolute -left-12 top-[50%]  text-xs font-bold font-inter text-right w-10">50%</div>
      <div class="absolute -left-12 bottom-0   text-xs font-bold font-inter text-right w-10">0%</div>

      <!-- 12 fixed month columns -->
      <div
        v-for="(slot, i) in slots"
        :key="i"
        class="flex flex-col items-center group relative h-full justify-end"
        style="flex: 1 1 0; min-width: 0;"
      >
        <!-- Bar -->
        <div
          v-if="slot.hasData"
          class="border-2 border-black cursor-pointer transition-all hover:-translate-y-1"
          :style="{
            width: '60%',
            maxWidth: '2rem',
            height: barHeight(slot.value),
            minHeight: '4px',
            backgroundColor: color,
          }"
          @mouseenter="e => e.target.style.backgroundColor = hoverColor"
          @mouseleave="e => e.target.style.backgroundColor = color"
        ></div>
        <!-- Ghost placeholder when no data -->
        <div v-else style="width:60%; max-width:2rem; height:4px;"></div>

        <!-- Tooltip (only when data exists) -->
        <div
          v-if="slot.hasData"
          class="absolute bottom-full mb-1 opacity-0 group-hover:opacity-100 transition-opacity bg-white border-2 border-black text-black font-inter font-bold text-xs px-3 py-1.5 z-10 whitespace-nowrap pointer-events-none"
          :style="{ boxShadow: '3px 3px 0px 0px ' + hoverShadow }"
        >
          {{ formatPct(slot.value) }}
        </div>

        <!-- X-axis label -->
        <div class="absolute top-[105%] md:top-[105%] mt-2 md:mt-0 text-[10px] font-inter font-bold text-[#393939] whitespace-nowrap origin-top-left -rotate-90 translate-y-3 md:translate-y-0 md:rotate-0">{{ slot.label }}</div>
      </div>
    </div>
  `,
};

// ─── Main component ───────────────────────────────────────────────────────────
export default {
    name: 'ResultAdmin',
    components: { HeaderAdmin, BarChart, InfoTooltip },

    props: {
        initialData: { type: Object, default: () => ({}) },
    },

    data() {
        const currentYear = new Date().getFullYear();
        return {
            // Dynamic data (replaced when switching year)
            activeData: null,

            selectedCompanyKpi: 'all',
            isDropdownOpen: false,
            searchQuery: '',

            selectedYear: currentYear,
            isLoadingYear: false,
            yearLoadError: null,
            isYearDropdownOpen: false,

            ALL_MONTHS: MONTH_LABELS,
        };
    },

    computed: {
        // Use activeData (fetched) if available, otherwise fall back to initialData (SSR)
        data() {
            return this.activeData ?? this.initialData;
        },

        // Years available for the selector — read from initialData.available_years (sent by backend),
        // or fall back to the last 4 years if the backend doesn't provide the list yet.
        availableYears() {
            const fromData = this.initialData?.availableYears;
            if (Array.isArray(fromData) && fromData.length > 0) {
                return [...fromData].sort((a, b) => b - a); // descending
            }
            const y = new Date().getFullYear();
            return [y, y - 1, y - 2, y - 3];
        },

        goldData() { return this.data.gold; },
        ambassadorData() { return this.data.ambassador; },
        convictionData() { return this.data.conviction; },
        kpiData() { return this.data.kpis || {}; },

        selectedCompanyName() {
            if (this.selectedCompanyKpi === 'all') return 'Toutes les entreprises';
            if (this.selectedCompanyKpi && this.kpiData[this.selectedCompanyKpi]) {
                return this.kpiData[this.selectedCompanyKpi].name;
            }
            return 'Toutes les entreprises';
        },

        filteredCompanies() {
            const query = this.searchQuery.toLowerCase();
            const allOption = { id: 'all', name: 'Toutes les entreprises' };
            const companiesList = Object.entries(this.kpiData).map(([id, data]) => ({ id, name: data.name }));

            if (!query) {
                return [allOption, ...companiesList];
            }

            const result = [];
            if ('toutes les entreprises'.includes(query)) {
                result.push(allOption);
            }
            
            companiesList.forEach(comp => {
                if (comp.name.toLowerCase().includes(query)) {
                    result.push(comp);
                }
            });
            
            return result;
        },

        /**
         * Aggregates KPIs by month (0-indexed) for the current selection.
         * Returns { [monthIndex]: { label, count, occupancy_rate, non_eligible_rate, cobrand_visit_rate, onedoc_visit_rate } }
         */
        monthlyKpis() {
            let kpis = [];
            if (this.selectedCompanyKpi === 'all') {
                Object.values(this.kpiData).forEach(company => {
                    if (Array.isArray(company.kpis)) kpis = kpis.concat(company.kpis);
                });
            } else {
                if (!this.kpiData[this.selectedCompanyKpi]) return {};
                kpis = this.kpiData[this.selectedCompanyKpi].kpis || [];
            }

            const byMonth = {};
            kpis.forEach(kpi => {
                if (!kpi.collection_day_start) return;
                const m = new Date(kpi.collection_day_start).getMonth();
                if (!byMonth[m]) {
                    byMonth[m] = { label: MONTH_LABELS[m], count: 0, occupancy_rate: [], non_eligible_rate: [], cobrand_visit_rate: [], onedoc_visit_rate: [] };
                }
                byMonth[m].count++;
                byMonth[m].occupancy_rate.push(kpi.occupancy_rate ?? 0);
                if (kpi.non_eligible_rate !== null) byMonth[m].non_eligible_rate.push(kpi.non_eligible_rate);
                byMonth[m].cobrand_visit_rate.push(kpi.cobrand_visit_rate ?? 0);
                if (kpi.onedoc_visit_rate !== null) byMonth[m].onedoc_visit_rate.push(kpi.onedoc_visit_rate);
            });

            const avg = arr => arr.length ? arr.reduce((a, b) => a + b, 0) / arr.length : 0;
            const result = {};
            Object.entries(byMonth).forEach(([m, d]) => {
                result[m] = {
                    label: d.label,
                    count: d.count,
                    occupancy_rate: avg(d.occupancy_rate),
                    non_eligible_rate: avg(d.non_eligible_rate),
                    cobrand_visit_rate: avg(d.cobrand_visit_rate),
                    onedoc_visit_rate: avg(d.onedoc_visit_rate),
                };
            });
            return result;
        },

        hasNoKpiData() {
            return Object.keys(this.monthlyKpis).length === 0;
        },
    },

    methods: {
        async selectYear(year) {
            if (year === this.selectedYear && this.activeData !== null) return;
            if (year === this.selectedYear && this.activeData === null) return; // already showing initialData for current year

            this.isLoadingYear = true;
            this.yearLoadError = null;
            try {
                const baseUrl = window.location.origin;
                const res = await fetch(`${baseUrl}/api/result/${year}`, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
                if (!res.ok) throw new Error(`Erreur ${res.status}`);
                const json = await res.json();
                this.activeData = json;
                this.selectedYear = year;
                // Reset company filter when switching year
                this.selectedCompanyKpi = 'all';
            } catch (e) {
                this.yearLoadError = `Impossible de charger les données pour ${year} : ${e.message}`;
            } finally {
                this.isLoadingYear = false;
            }
        },

        toggleDropdown() {
            this.isDropdownOpen = !this.isDropdownOpen;
            if (this.isDropdownOpen) {
                this.searchQuery = '';
                this.$nextTick(() => {
                    if (this.$refs.searchInput) {
                        this.$refs.searchInput.focus();
                    }
                    if (this.$refs.dropdownMenu) {
                        this.$refs.dropdownMenu.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                });
            }
        },

        selectFirstOption() {
            if (this.filteredCompanies.length > 0) {
                this.selectCompany(this.filteredCompanies[0].id);
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
            return ((data.nb_blood_pouch / data.nb_employee) * 100).toFixed(1) + '%';
        },
    },
};
</script>
