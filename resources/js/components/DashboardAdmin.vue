<template>
  <div class="min-h-screen bg-[#fffbf1]">
    <HeaderAdmin />

    <main class="max-w-[1200px] mx-auto py-10 px-4 space-y-12">
      <!-- FirstPart: Action Buttons -->
      <section class="grid grid-cols-2 gap-6">
        <button class="bg-[#0073e6] text-[#fffbf1] flex items-center justify-center py-4 rounded-sm hover:bg-blue-600 transition-colors">
          <div class="h-6 w-6 mr-3 bg-[#fffbf1]" style="mask-image: url('/images/Cross.svg'); mask-size: contain; mask-repeat: no-repeat; mask-position: center; -webkit-mask-image: url('/images/Cross.svg'); -webkit-mask-size: contain; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center;"></div>
          <span class="font-inter text-lg">Ajouter une entreprise</span>
        </button>
        <button class="bg-[#0073e6] text-[#fffbf1] flex items-center justify-center py-4 rounded-sm hover:bg-blue-600 transition-colors">
          <div class="h-6 w-6 mr-3 bg-[#fffbf1]" style="mask-image: url('/images/Group.svg'); mask-size: contain; mask-repeat: no-repeat; mask-position: center; -webkit-mask-image: url('/images/Group.svg'); -webkit-mask-size: contain; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center;"></div>
          <span class="font-inter text-lg">Organiser une collecte</span>
        </button>
      </section>

      <!-- SecondPart: Collectes à clore -->
      <section>
        <div class="flex justify-between items-end mb-4">
          <h2 class="font-jersey text-[40px] text-[#393939] leading-none">Collectes à clore</h2>
          <div class="bg-[#ffb699] flex items-center px-4 py-2 rounded-sm space-x-2">
            <img src="/images/important.svg" alt="Important" class="h-5" />
            <span class="font-inter text-sm text-[#393939] font-medium">Vous avez {{ toClose.length }} collectes à clore.</span>
          </div>
        </div>

        <div class="w-full">
          <!-- Table Header -->
          <div class="grid grid-cols-4 bg-[#ffeeab] py-3 px-4 rounded-t-sm">
            <div class="font-inter font-medium text-[#393939]">Entreprise</div>
            <div class="font-inter font-medium text-[#393939]">Date(s)</div>
            <div class="font-inter font-medium text-[#393939]">Nb employés</div>
            <div class="font-inter font-medium text-[#393939] text-right">Actions</div>
          </div>

          <!-- Table Rows -->
          <div class="border border-blue-200 rounded-b-sm bg-[#fffbf1]">
            <template v-if="toClose.length > 0">
              <div v-for="(item, index) in toClose" :key="index" class="grid grid-cols-4 items-center py-3 px-4 border-b border-blue-200 last:border-0">
                <div class="flex items-center space-x-3">
                  <img :src="item.company_logo || '/images/BCGE.png'" alt="Logo" class="h-8 object-contain" />
                  <span class="font-inter font-bold text-[#393939]">{{ item.company_name || 'BCGE' }}</span>
                </div>
                <div class="font-inter text-[#393939]">{{ item.date || '02.07.2026' }}</div>
                <div class="font-inter text-[#393939]">{{ item.employees || '5000' }}</div>
                <div class="flex items-center justify-end space-x-3">
                  <button @click="openModal('cloture', item)" class="bg-[#5bb124] text-white flex items-center px-4 py-1.5 rounded-sm hover:bg-green-600 transition-colors">
                    <img src="/images/whiteCheck.svg" alt="Check" class="h-4 mr-2" />
                    <span class="font-inter text-sm">Clore</span>
                  </button>
                  <button @click="openModal('detail', item)" class="border border-[#0073e6] p-1.5 rounded-sm hover:bg-blue-50 transition-colors">
                    <img src="/images/Edit.svg" alt="Edit" class="h-4 w-4" />
                  </button>
                </div>
              </div>
            </template>
            <template v-else>
              <div class="py-6 text-center text-gray-500 font-inter">
                <!-- Fallback Mock Row -->
                <div class="grid grid-cols-4 items-center py-3 px-4">
                  <div class="flex items-center space-x-3">
                    <img src="/images/BCGE.png" alt="Logo" class="h-8 object-contain" />
                    <span class="font-inter font-bold text-[#393939]">BCGE</span>
                  </div>
                  <div class="font-inter text-[#393939]">02.07.2026</div>
                  <div class="font-inter text-[#393939]">5000</div>
                  <div class="flex items-center justify-end space-x-3">
                    <button @click="openModal('cloture', { company_name: 'BCGE', date: '02.07.2026', employees: '5000' })" class="bg-[#5bb124] text-white flex items-center px-4 py-1.5 rounded-sm hover:bg-green-600 transition-colors">
                      <img src="/images/whiteCheck.svg" alt="Check" class="h-4 mr-2" />
                      <span class="font-inter text-sm">Clore</span>
                    </button>
                    <button @click="openModal('detail', { company_name: 'BCGE', date: '02.07.2026', employees: '5000' })" class="border border-[#0073e6] p-1.5 rounded-sm hover:bg-blue-50 transition-colors">
                      <img src="/images/Edit.svg" alt="Edit" class="h-4 w-4" />
                    </button>
                  </div>
                </div>
              </div>
            </template>
          </div>
        </div>
      </section>

      <!-- ThirdPart: Collectes à venir -->
      <section>
        <div class="flex justify-between items-end mb-4">
          <h2 class="font-jersey text-[40px] text-[#393939] leading-none">Collectes à venir</h2>
          <button class="bg-[#0073e6] text-[#fffbf1] flex items-center px-4 py-2 rounded-sm hover:bg-blue-600 transition-colors">
            <div class="h-4 w-4 mr-2 bg-[#fffbf1]" style="mask-image: url('/images/Cross.svg'); mask-size: contain; mask-repeat: no-repeat; mask-position: center; -webkit-mask-image: url('/images/Cross.svg'); -webkit-mask-size: contain; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center;"></div>
            <span class="font-inter text-sm">Nouvelle collecte</span>
          </button>
        </div>

        <div class="w-full">
          <!-- Table Header -->
          <div class="grid grid-cols-6 bg-[#ffeeab] py-3 px-4 rounded-t-sm">
            <div class="font-inter font-medium text-[#393939]">Entreprise</div>
            <div class="font-inter font-medium text-[#393939]">Dates</div>
            <div class="font-inter font-medium text-[#393939]">Nb employés</div>
            <div class="font-inter font-medium text-[#393939]">Lien site co-brandé</div>
            <div class="font-inter font-medium text-[#393939]">Lien OneDoc</div>
            <div class="font-inter font-medium text-[#393939] text-right">Actions</div>
          </div>

          <!-- Table Rows -->
          <div class="border border-blue-200 rounded-b-sm bg-[#fffbf1]">
            <template v-if="toCome.length > 0">
              <div v-for="(item, index) in toCome" :key="index" class="grid grid-cols-6 items-center py-3 px-4 border-b border-blue-200 last:border-0">
                <div class="flex items-center space-x-3">
                  <img :src="item.company_logo || '/images/BCGE.png'" alt="Logo" class="h-8 object-contain" />
                  <span class="font-inter font-bold text-[#393939]">{{ item.company_name || 'BCGE' }}</span>
                </div>
                <div class="font-inter text-[#393939]">{{ item.date || '02.07.2026' }}</div>
                <div class="font-inter text-[#393939]">{{ item.employees || '5000' }}</div>
                <div class="flex items-center">
                  <button class="border border-[#0073e6] p-1.5 rounded-sm hover:bg-blue-50 transition-colors">
                    <img src="/images/Copy.svg" alt="Copy" class="h-4 w-4" />
                  </button>
                </div>
                <div class="flex items-center">
                  <button class="border border-[#0073e6] p-1.5 rounded-sm hover:bg-blue-50 transition-colors">
                    <img src="/images/Copy.svg" alt="Copy" class="h-4 w-4" />
                  </button>
                </div>
                <div class="flex items-center justify-end">
                  <button @click="openModal('detail', item)" class="border border-[#0073e6] p-1.5 rounded-sm hover:bg-blue-50 transition-colors">
                    <img src="/images/Edit.svg" alt="Edit" class="h-4 w-4" />
                  </button>
                </div>
              </div>
            </template>
            <template v-else>
              <!-- Fallback Mock Rows -->
              <div v-for="i in 3" :key="i" class="grid grid-cols-6 items-center py-3 px-4 border-b border-blue-200 last:border-0">
                <div class="flex items-center space-x-3">
                  <img src="/images/BCGE.png" alt="Logo" class="h-8 object-contain" />
                  <span class="font-inter font-bold text-[#393939]">BCGE</span>
                </div>
                <div class="font-inter text-[#393939]">02.07.2026</div>
                <div class="font-inter text-[#393939]">5000</div>
                <div class="flex items-center">
                  <button class="border border-[#0073e6] p-1.5 rounded-sm hover:bg-blue-50 transition-colors">
                    <img src="/images/Copy.svg" alt="Copy" class="h-4 w-4" />
                  </button>
                </div>
                <div class="flex items-center">
                  <button class="border border-[#0073e6] p-1.5 rounded-sm hover:bg-blue-50 transition-colors">
                    <img src="/images/Copy.svg" alt="Copy" class="h-4 w-4" />
                  </button>
                </div>
                <div class="flex items-center justify-end">
                  <button @click="openModal('detail', { company_name: 'BCGE', date: '02.07.2026', employees: '5000' })" class="border border-[#0073e6] p-1.5 rounded-sm hover:bg-blue-50 transition-colors">
                    <img src="/images/Edit.svg" alt="Edit" class="h-4 w-4" />
                  </button>
                </div>
              </div>
            </template>
          </div>
        </div>
      </section>

      <!-- FourthPart: Chart -->
      <section class="pt-8">
        <!-- Legend -->
        <div class="flex space-x-6 mb-8">
          <div class="flex items-center space-x-2">
            <div class="w-4 h-4 bg-[#0073e6]"></div>
            <span class="font-inter text-sm text-[#393939]">Mois terminé</span>
          </div>
          <div class="flex items-center space-x-2">
            <div class="w-4 h-4 bg-[#cce6ff]"></div>
            <span class="font-inter text-sm text-[#393939]">Mois à venir</span>
          </div>
          <div class="flex items-center space-x-2">
            <div class="w-4 h-4 bg-[#ffd012]"></div>
            <span class="font-inter text-sm text-[#393939]">Mois en cours</span>
          </div>
        </div>

        <!-- Chart -->
        <div class="relative h-[300px] w-full border-l border-b border-black">
          <!-- Y-axis labels -->
          <div class="absolute -left-6 bottom-[10%] text-xs font-bold font-inter">2</div>
          <div class="absolute -left-6 bottom-[30%] text-xs font-bold font-inter">4</div>
          <div class="absolute -left-6 bottom-[50%] text-xs font-bold font-inter">6</div>
          <div class="absolute -left-6 bottom-[70%] text-xs font-bold font-inter">8</div>
          <div class="absolute -left-8 bottom-[90%] text-xs font-bold font-inter">10</div>
          <div class="absolute -left-6 -bottom-2 text-xs font-bold font-inter">0</div>

          <!-- Bars -->
          <div class="absolute inset-0 flex items-end justify-around px-4">
            <div v-for="(month, i) in monthsData" :key="i" class="w-16 flex flex-col items-center cursor-pointer" @mouseenter="hoveredMonthIndex = i" @mouseleave="hoveredMonthIndex = null">
              <div :class="[month.color, 'w-full']" :style="{ height: `${(month.value / 10) * 100}%` }"></div>
              <div class="mt-4 text-xs font-bold font-inter whitespace-nowrap" style="writing-mode: vertical-rl; transform: rotate(180deg);">
                {{ month.label }}
              </div>
            </div>
          </div>

          <!-- Hover Tooltip -->
          <div v-if="hoveredMonthIndex !== null && monthsData[hoveredMonthIndex].label === 'Juin'" class="absolute top-[105%] left-0 w-full bg-[#fffbf1] border border-black z-40 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            <div class="p-4">
              <h4 class="font-inter text-xl font-bold text-black mb-2">{{ monthsData[hoveredMonthIndex].label }}</h4>
              <div class="relative w-full h-[120px]">
                <!-- Timeline Line -->
                <div class="absolute bottom-[20px] left-0 w-full h-[1px] bg-black">
                   <!-- Arrow end -->
                   <div class="absolute -right-[1px] -top-[4px] w-0 h-0 border-y-[4px] border-y-transparent border-l-[8px] border-l-black"></div>
                </div>

                <!-- Events -->
                <!-- HEIG -->
                <div class="absolute left-[15%] bottom-[20px] flex flex-col items-center -translate-x-1/2">
                   <span class="text-[10px] font-inter text-black absolute bottom-[55px] whitespace-nowrap">02.06.2026</span>
                   <div class="border border-black bg-white flex items-center justify-center z-10 w-[50px] h-[28px] absolute bottom-[25px]">
                     <div class="text-[#eb0000] font-bold text-[12px] leading-[0.8] flex gap-[2px] items-center"><div class="flex flex-col text-left"><span>HE</span><span>IG</span></div></div>
                   </div>
                   <div class="w-[1px] h-[25px] bg-black absolute bottom-0"></div>
                </div>

                <!-- EPFL -->
                <div class="absolute left-[25%] bottom-[20px] flex flex-col items-center -translate-x-1/2">
                   <span class="text-[10px] font-inter text-black absolute bottom-[85px] whitespace-nowrap">04.06.2026</span>
                   <div class="border border-black bg-white flex items-center justify-center z-10 w-[60px] h-[28px] absolute bottom-[55px]">
                     <span class="text-[#eb0000] font-bold text-[14px] font-sans tracking-widest">EPFL</span>
                   </div>
                   <div class="w-[1px] h-[55px] bg-black absolute bottom-0"></div>
                </div>

                <!-- Unil -->
                <div class="absolute left-[85%] bottom-[20px] flex flex-col items-center -translate-x-1/2">
                   <span class="text-[10px] font-inter text-black absolute bottom-[55px] whitespace-nowrap">27.06.2026</span>
                   <div class="border border-black bg-white flex items-center justify-center z-10 w-[50px] h-[28px] absolute bottom-[25px]">
                     <span class="text-[#0073e6] italic font-serif text-[16px]">Unil</span>
                   </div>
                   <div class="w-[1px] h-[25px] bg-black absolute bottom-0"></div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="h-16"></div> <!-- Spacer for labels -->
      </section>

      <!-- FifthPart: Statistics -->
      <section class="grid grid-cols-2 gap-12 mt-8">
        <!-- Taux de participation -->
        <div class="border border-black flex flex-col">
          <div class="bg-[#ffda45] flex justify-between items-center p-4 border-b border-black">
            <h3 class="font-jersey text-2xl text-[#393939]">Taux de participation</h3>
            <img src="/images/info.svg" alt="Info" class="h-6 w-6" style="filter: brightness(0);" />
          </div>
          <div class="p-8 flex flex-col items-center flex-grow">
            <div class="font-jersey text-6xl text-black">{{ participationRatio.main || '21%' }}</div>
            <div class="font-jersey text-sm text-black mb-8">De participation moyenne</div>

            <div class="w-full space-y-4 font-inter text-sm">
              <div v-for="(item, i) in participationRatio.companies || mockParticipationCompanies" :key="i" class="flex justify-between items-center border-b border-gray-300 pb-2">
                <div class="flex items-center space-x-3">
                  <img v-if="item.warning" src="/images/importantOrange.svg" alt="Warning" class="h-5" />
                  <div v-else class="h-5 w-5"></div>
                  <span>{{ item.name }}</span>
                </div>
                <div class="font-bold">{{ item.percentage }}</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Taux de rigueur -->
        <div class="border border-black flex flex-col">
          <div class="bg-[#ffda45] flex justify-between items-center p-4 border-b border-black">
            <h3 class="font-jersey text-2xl text-[#393939]">Taux de rigueur</h3>
            <img src="/images/info.svg" alt="Info" class="h-6 w-6" style="filter: brightness(0);" />
          </div>
          <div class="p-8 flex flex-col items-center flex-grow">
            <div class="font-jersey text-6xl text-black">{{ rigorRatio.main || '80%' }}</div>
            <div class="font-jersey text-sm text-black mb-8">De participation moyenne</div>

            <div class="w-full space-y-4 font-inter text-sm">
              <div v-for="(item, i) in rigorRatio.companies || mockRigorCompanies" :key="i" class="flex justify-between items-center border-b border-gray-300 pb-2">
                <div class="flex items-center space-x-3">
                  <img v-if="item.warning" src="/images/importantOrange.svg" alt="Warning" class="h-5" />
                  <div v-else class="h-5 w-5"></div>
                  <span>{{ item.name }}</span>
                </div>
                <div class="font-bold">{{ item.percentage }}</div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>

    <!-- Modals -->
    <div v-if="activeModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" @click.self="closeModal">

      <!-- Clôture Modal -->
      <div v-if="activeModal === 'cloture'" class="bg-[#fffbf1] border-[10px] border-[#5C629E] w-full max-w-[600px] p-8 relative">
        <button @click="closeModal" class="absolute top-6 right-6 flex items-center justify-center cursor-pointer transition-transform hover:scale-105">
          <img src="/images/X.svg" alt="Close" class="w-10 h-10" />
        </button>
        <h2 class="font-['Jersey_20'] text-5xl text-black leading-none mb-1">{{ selectedCollecte?.company_name || 'HEIG-VD' }}</h2>
        <p class="font-['Jersey_20'] text-2xl text-black mb-8 tracking-wide">Collecte du {{ selectedCollecte?.date || '02.03.2026' }}</p>

        <div class="space-y-6 mb-8">
          <div>
            <label class="block font-inter text-base mb-2">Nombre d'inscrits</label>
            <div class="relative">
              <input type="text" placeholder="Placeholder" class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
              <span class="absolute right-3 top-1/2 -translate-y-1/2">*</span>
            </div>
          </div>
          <div>
            <label class="block font-inter text-base mb-2">Nombre de poches collectées</label>
            <div class="relative">
              <input type="text" placeholder="Placeholder" class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
              <span class="absolute right-3 top-1/2 -translate-y-1/2">*</span>
            </div>
          </div>
        </div>

        <div class="flex space-x-4">
          <button @click="closeModal" class="border-[2px] border-[#0073e6] text-[#0073e6] bg-white px-6 py-2.5 font-inter font-medium w-32 hover:bg-gray-50">Annuler</button>
          <button @click="closeModal" class="bg-[#5bb124] text-white px-6 py-2.5 flex items-center justify-center font-inter font-medium w-32 hover:bg-green-600">
            <img src="/images/whiteCheck.svg" alt="Check" class="h-5 mr-2" /> Clore
          </button>
        </div>
      </div>

      <!-- Détail Modal -->
      <div v-if="activeModal === 'detail'" class="bg-[#fffbf1] border-[10px] border-[#0073e6] w-full max-w-[750px] p-8 relative">
        <button @click="closeModal" class="absolute top-6 right-6 flex items-center justify-center cursor-pointer transition-transform hover:scale-105">
          <img src="/images/X.svg" alt="Close" class="w-10 h-10" />
        </button>
        <h2 class="font-['Jersey_20'] text-5xl text-black leading-none mb-1">{{ selectedCollecte?.company_name || 'HEIG-VD' }}</h2>
        <p class="font-['Jersey_20'] text-2xl text-black mb-8 tracking-wide">Collecte du {{ selectedCollecte?.date || '02.07.2026' }}</p>

        <div class="grid grid-cols-2 gap-8 mb-6">
          <div>
            <label class="block font-inter text-base mb-2">Nombre d'employés</label>
            <div class="relative">
              <input type="text" placeholder="Placeholder" class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
              <span class="absolute right-3 top-1/2 -translate-y-1/2">*</span>
            </div>
          </div>
          <div>
            <label class="block font-inter text-base mb-2">Date</label>
            <div class="relative">
              <input type="text" :value="selectedCollecte?.date || '02.07.2026'" class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
              <span class="absolute right-3 top-1/2 -translate-y-1/2">*</span>
            </div>
          </div>
        </div>

        <div class="flex items-end gap-6 mb-12">
          <div class="bg-[#f2faf2] px-6 py-3 flex justify-center items-center space-x-3 w-[160px] h-[46px]">
            <span class="text-[#3b803b] font-inter font-medium">One-doc</span>
            <img src="/images/Edit.svg" alt="Edit" class="h-4" />
          </div>
          <div class="flex-grow relative h-[46px]">
            <input type="text" value="https://one-doc.ch/jlmunhzremhimrohurimhuriohgieo" class="w-full h-full border border-black p-3 font-inter text-sm bg-transparent" />
            <span class="absolute right-3 top-1/2 -translate-y-1/2">*</span>
          </div>
        </div>

        <div class="flex justify-between items-center">
          <button @click="activeModal = 'suppression'" class="bg-[#E4534B] text-white px-8 py-3 font-inter font-medium hover:bg-red-600 transition-colors">Supprimer la collecte</button>
          <div class="flex space-x-4">
            <button @click="closeModal" class="border-[2px] border-[#0073e6] text-[#0073e6] bg-white px-8 py-3 font-inter font-medium hover:bg-gray-50 transition-colors">Annuler</button>
            <button @click="closeModal" class="bg-[#0073e6] text-white px-8 py-3 font-inter font-medium hover:bg-blue-600 transition-colors">Enregistrer</button>
          </div>
        </div>
      </div>

      <!-- Suppression Modal -->
      <div v-if="activeModal === 'suppression'" class="bg-[#fffbf1] border-[10px] border-[#E4534B] w-full max-w-[650px] p-10 relative">
        <h2 class="font-['Jersey_20'] text-6xl text-[#E4534B] leading-none mb-6 tracking-wide">Attention</h2>
        <p class="font-inter text-lg text-black mb-8 leading-relaxed">
          Vous êtes sur le point de supprimer la collecte de {{ selectedCollecte?.company_name || 'HEIG-VD' }} du {{ selectedCollecte?.date || '02.03.2026' }}.<br/>
          Êtes-vous sur de vouloir procéder ?
        </p>

        <div class="mb-10">
          <label class="block font-inter text-lg mb-2">Inscrire "supprimer" pour procéder</label>
          <div class="relative">
            <input type="text" placeholder="Placeholder" class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
            <span class="absolute right-3 top-1/2 -translate-y-1/2">*</span>
          </div>
        </div>

        <div class="flex justify-end mt-4">
          <button @click="closeModal" class="bg-[#E4534B] text-white px-8 py-3 font-inter text-lg font-medium hover:bg-red-600 transition-colors">Supprimer</button>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import HeaderAdmin from './HeaderAdmin.vue';

export default {
  name: 'DashboardAdmin',
  components: {
    HeaderAdmin
  },
  props: {
    initialData: {
      type: Object,
      default: () => ({})
    }
  },
  data() {
    return {
      activeModal: null,
      selectedCollecte: null,
      hoveredMonthIndex: null,
      monthsData: [
        { label: 'Janvier', value: 3, color: 'bg-[#0073e6]' },
        { label: 'Février', value: 3.5, color: 'bg-[#0073e6]' },
        { label: 'Mars', value: 7, color: 'bg-[#0073e6]' },
        { label: 'Avril', value: 6, color: 'bg-[#0073e6]' },
        { label: 'Mai', value: 6.5, color: 'bg-[#0073e6]' },
        { label: 'Juin', value: 10, color: 'bg-[#ffd012]' },
        { label: 'Juillet', value: 8, color: 'bg-[#cce6ff]' },
        { label: 'Août', value: 6.5, color: 'bg-[#cce6ff]' },
        { label: 'Septembre', value: 8, color: 'bg-[#cce6ff]' },
        { label: 'Octobre', value: 6.5, color: 'bg-[#cce6ff]' },
        { label: 'Novembre', value: 4, color: 'bg-[#cce6ff]' },
        { label: 'Décembre', value: 5, color: 'bg-[#cce6ff]' }
      ],
      mockParticipationCompanies: [
        { name: 'Entreprise A', percentage: '8%', warning: true },
        { name: 'Entreprise B', percentage: '8%', warning: true },
        { name: 'Entreprise C', percentage: '10%', warning: false },
        { name: 'Entreprise D', percentage: '12%', warning: false },
        { name: 'Entreprise E', percentage: '14%', warning: false },
      ],
      mockRigorCompanies: [
        { name: 'Entreprise A', percentage: '43%', warning: true },
        { name: 'Entreprise B', percentage: '45%', warning: true },
        { name: 'Entreprise C', percentage: '47%', warning: true },
        { name: 'Entreprise D', percentage: '78%', warning: false },
        { name: 'Entreprise E', percentage: '82%', warning: false },
      ]
    }
  },
  methods: {
    openModal(type, item) {
      this.activeModal = type;
      this.selectedCollecte = item || null;
    },
    closeModal() {
      this.activeModal = null;
      this.selectedCollecte = null;
    }
  },
  computed: {
    toClose() {
      return this.initialData.toClose || [];
    },
    toCome() {
      return this.initialData.toCome || [];
    },
    participationRatio() {
      return this.initialData.participationRatio || {};
    },
    rigorRatio() {
      return this.initialData.rigorRatio || {};
    }
  }
}
</script>
