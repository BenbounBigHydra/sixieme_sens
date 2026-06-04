<template>
  <div class="min-h-screen bg-[#fffbf1] font-inter">
    <HeaderAdmin />

    <main class="max-w-[1200px] mx-auto py-10 px-4 space-y-12">

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
                <th class="py-2 md:py-4 px-1 md:px-2 font-inter font-bold text-xs md:text-sm text-[#034a74] text-center">Nbr employé total</th>
                <th class="py-2 md:py-4 px-1 md:px-2 font-inter font-bold text-xs md:text-sm text-[#034a74] text-center">Nbr de poches récoltées</th>
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
          KPIs
        </h2>

        <div class="space-y-6">
          <!-- KPI 1 -->
          <div class="border-[2px] border-[#ffeaa7] bg-[#fffbf1] p-6 flex flex-col md:flex-row gap-6">
            <div class="flex-grow">
              <div class="bg-[#ffeaa7] inline-block px-4 py-2 mb-6">
                <span class="font-inter font-bold text-sm text-black">Acquisition entreprises</span>
              </div>
              <div class="space-y-4 font-inter text-sm md:text-base text-black">
                <div class="flex justify-between items-center">
                  <span>Taux de conversion des entreprises (cible : 8-10%)</span>
                  <span class="font-bold text-[#E4534B]">6%</span>
                </div>
                <div class="flex justify-between items-center">
                  <span>Trafic généré par les liens uniques</span>
                  <span class="font-bold text-[#5bb124]">482</span>
                </div>
              </div>
            </div>
          </div>

          <!-- KPI 2 -->
          <div class="border-[2px] border-[#ffeaa7] bg-[#fffbf1] p-6 flex flex-col md:flex-row gap-6">
            <div class="flex-grow">
              <div class="bg-[#ffeaa7] inline-block px-4 py-2 mb-6">
                <span class="font-inter font-bold text-sm text-black">Engagement collaborateurs</span>
              </div>
              <div class="space-y-4 font-inter text-sm md:text-base text-black">
                <div class="flex justify-between items-center">
                  <span>Taux de complétion de l'outil interactif (cible : &ge;70%)</span>
                  <span class="font-bold text-[#E4534B]">67%</span>
                </div>
                <div class="flex justify-between items-center">
                  <span>Taux d'abandon par étape (pour détecter les points de friction)</span>
                  <span class="font-bold text-black">-</span>
                </div>
                <div class="flex justify-between items-center">
                  <span>Temps de session moyen sur l'évaluation (cible : &lt;5 min)</span>
                  <span class="font-bold text-[#5bb124]">3min48s</span>
                </div>
              </div>
            </div>
          </div>

          <!-- KPI 3 -->
          <div class="border-[2px] border-[#ffeaa7] bg-[#fffbf1] p-6 flex flex-col md:flex-row gap-6">
            <div class="flex-grow">
              <div class="bg-[#ffeaa7] inline-block px-4 py-2 mb-6">
                <span class="font-inter font-bold text-sm text-black">Conversion & fidélisation</span>
              </div>
              <div class="space-y-4 font-inter text-sm md:text-base text-black">
                <div class="flex justify-between items-center">
                  <span>Taux d'intention de participation (cible : 65% donneurs réguliers / 35% primo-donneurs)</span>
                  <span class="font-bold text-[#E4534B]">67%</span>
                </div>
                <div class="flex justify-between items-center">
                  <span>Taux d'obtention du label officiel (cible : &ge;85%)</span>
                  <span class="font-bold text-black">-</span>
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
    currentYear() {
      // Get from URL param if available, else current year
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has('year')) {
        return urlParams.get('year');
      }
      return new Date().getFullYear();
    }
  },
  methods: {
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
