<template>
    <div class="min-h-screen bg-[#fffbf1]">
        <HeaderAdmin />

        <main class="max-w-desktop mx-auto px-8 md:px-20 lg:px-32 xl:px-40 py-10 space-y-12">
            <!-- FirstPart: Action Buttons -->
            <section class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                <a href="/admin/companies?action=new"
                    class="bg-[#0073e6] text-[#fffbf1] flex items-center justify-center py-4 rounded-sm hover:bg-blue-600 transition-colors">
                    <div class="h-6 w-6 mr-3 bg-[#fffbf1]"
                        style="mask-image: url('/images/Cross.svg'); mask-size: contain; mask-repeat: no-repeat; mask-position: center; -webkit-mask-image: url('/images/Cross.svg'); -webkit-mask-size: contain; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center;">
                    </div>
                    <span class="font-inter text-lg">Ajouter une entreprise</span>
                </a>
                <a href="/admin/collections?action=new"
                    class="bg-[#0073e6] text-[#fffbf1] flex items-center justify-center py-4 rounded-sm hover:bg-blue-600 transition-colors">
                    <div class="h-6 w-6 mr-3 bg-[#fffbf1]"
                        style="mask-image: url('/images/Group.svg'); mask-size: contain; mask-repeat: no-repeat; mask-position: center; -webkit-mask-image: url('/images/Group.svg'); -webkit-mask-size: contain; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center;">
                    </div>
                    <span class="font-inter text-lg">Organiser une collecte</span>
                </a>
            </section>

            <!-- SecondPart: Collectes à clore -->
            <section>
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-4 gap-4 md:gap-0">
                    <h2 class="font-jersey text-[32px] md:text-[40px] text-[#393939] leading-none">Collectes à clore
                    </h2>
                    <div class="bg-[#ff9166] flex items-center px-4 py-2 rounded-sm space-x-2">
                        <img src="/images/important.svg" alt="Important" class="h-5" />
                        <span class="font-inter text-sm text-[#393939] font-medium">Vous avez {{ toClose.length }}
                            collectes à clore.</span>
                    </div>
                </div>

                <div class="w-full">
                    <!-- Table Header (Desktop Only) -->
                    <div class="hidden md:grid grid-cols-4 bg-[#ffeeab] py-3 px-4 rounded-t-sm">
                        <div class="font-inter font-medium text-[#393939]">Entreprise</div>
                        <div class="font-inter font-medium text-[#393939]">Date(s)</div>
                        <div class="font-inter font-medium text-[#393939]">Total employés</div>
                        <div class="font-inter font-medium text-[#393939] text-right">Actions</div>
                    </div>

                    <!-- Table Rows -->
                    <div class="border border-blue-200 rounded-b-sm rounded-t-sm md:rounded-t-none bg-[#fffbf1]">
                        <template v-if="toClose.length > 0">
                            <div v-for="(item, index) in toClose" :key="index"
                                class="flex flex-col md:grid md:grid-cols-4 items-start md:items-center py-4 px-4 border-b border-blue-200 last:border-0 gap-4 md:gap-0">
                                <div class="flex flex-col items-start justify-center">
                                    <div class="h-8 w-16 flex items-center justify-start mb-1">
                                        <img :src="item.company?.logo || '/images/BCGE.png'" alt="Logo"
                                            class="max-h-full max-w-full object-contain" />
                                    </div>
                                    <span class="font-inter font-bold text-sm md:text-xs text-[#393939]">{{
                                        item.company?.name || 'Inconnu' }}</span>
                                </div>
                                <div class="font-inter text-[#393939] w-full flex justify-between md:block"><span
                                        class="md:hidden font-bold">Date(s): </span><span>{{ formatDate(item.day_start)
                                            || '02.07.2026' }}</span></div>
                                <div class="font-inter text-[#393939] w-full flex justify-between md:block"><span
                                        class="md:hidden font-bold">Total employés: </span><span>{{ item.nb_employee ||
                                            '0' }}</span></div>
                                <div
                                    class="flex items-center justify-start md:justify-end space-x-3 w-full pt-2 md:pt-0 border-t md:border-0 border-gray-100">
                                    <button @click="openModal('cloture', item)"
                                        class="bg-[#5bb124] text-white flex items-center px-4 py-2 md:py-1.5 rounded-sm hover:bg-green-600 transition-colors w-full md:w-auto justify-center">
                                        <img src="/images/whiteCheck.svg" alt="Check" class="h-4 mr-2" />
                                        <span class="font-inter text-sm">Clore</span>
                                    </button>
                                    <button @click="openModal('detail', item)"
                                        class="border border-[#0073e6] p-2 md:p-1.5 rounded-sm hover:bg-blue-50 transition-colors shrink-0">
                                        <img src="/images/Edit.svg" alt="Edit" class="h-4 w-4" />
                                    </button>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <div class="py-6 text-center text-gray-500 font-inter">
                                Aucune collecte à clore
                            </div>
                        </template>
                    </div>
                </div>
            </section>

            <!-- ThirdPart: Collectes à venir -->
            <section>
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-4 gap-4 md:gap-0">
                    <h2 class="font-jersey text-[32px] md:text-[40px] text-[#393939] leading-none">Collectes à venir
                    </h2>
                    <a href="/admin/collections?action=new"
                        class="bg-[#0073e6] text-[#fffbf1] flex items-center px-4 py-2 md:py-2 rounded-sm hover:bg-blue-600 transition-colors w-full md:w-auto justify-center">
                        <div class="h-4 w-4 mr-2 bg-[#fffbf1]"
                            style="mask-image: url('/images/Cross.svg'); mask-size: contain; mask-repeat: no-repeat; mask-position: center; -webkit-mask-image: url('/images/Cross.svg'); -webkit-mask-size: contain; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center;">
                        </div>
                        <span class="font-inter text-sm">Nouvelle collecte</span>
                    </a>
                </div>

                <div class="w-full">
                    <!-- Table Header (Desktop) -->
                    <div class="hidden md:grid grid-cols-6 bg-[#ffeeab] py-3 px-4 rounded-t-sm">
                        <div class="font-inter font-medium text-[#393939]">Entreprise</div>
                        <div class="font-inter font-medium text-[#393939]">Dates</div>
                        <div class="font-inter font-medium text-[#393939]">Total employés</div>
                        <div class="font-inter font-medium text-[#393939]">Lien site co-brandé</div>
                        <div class="font-inter font-medium text-[#393939]">Lien OneDoc</div>
                        <div class="font-inter font-medium text-[#393939] text-right">Actions</div>
                    </div>

                    <!-- Table Rows -->
                    <div class="border border-blue-200 rounded-b-sm rounded-t-sm md:rounded-t-none bg-[#fffbf1]">
                        <template v-if="toCome.length > 0">
                            <div v-for="(item, index) in toCome" :key="index"
                                class="flex flex-col md:grid md:grid-cols-6 items-start md:items-center py-4 px-4 border-b border-blue-200 last:border-0 gap-4 md:gap-0">
                                <div class="flex flex-col items-start justify-center">
                                    <div class="h-8 w-16 flex items-center justify-start mb-1">
                                        <img :src="item.company?.logo || '/images/BCGE.png'" alt="Logo"
                                            class="max-h-full max-w-full object-contain" />
                                    </div>
                                    <span class="font-inter font-bold text-sm md:text-xs text-[#393939]">{{
                                        item.company?.name || 'Inconnu' }}</span>
                                </div>
                                <div class="font-inter text-[#393939] w-full flex justify-between md:block"><span
                                        class="md:hidden font-bold">Date(s): </span><span>{{ formatDate(item.day_start)
                                            || '02.07.2026' }}</span></div>
                                <div class="font-inter text-[#393939] w-full flex justify-between md:block"><span
                                        class="md:hidden font-bold">Total employés: </span><span>{{ item.nb_employee ||
                                            '0' }}</span></div>

                                <div
                                    class="flex items-center space-x-2 w-full md:w-auto bg-gray-50 md:bg-transparent p-2 md:p-0 rounded-sm overflow-hidden">
                                    <span class="md:hidden font-bold text-sm text-[#393939] mr-2 shrink-0">Site:</span>
                                    <button @click="copyToClipboard(getCoBrandLink(item))"
                                        class="border border-[#0073e6] p-1.5 rounded-sm hover:bg-blue-50 transition-colors shrink-0 bg-white">
                                        <img src="/images/Copy.svg" alt="Copy" class="h-4 w-4" />
                                    </button>
                                    <a :href="getCoBrandLink(item)" target="_blank"
                                        class="text-xs md:text-[10px] font-inter text-[#0073e6] truncate hover:underline"
                                        :title="getCoBrandLink(item)">
                                        {{ getCoBrandLink(item) }}
                                    </a>
                                </div>

                                <div
                                    class="flex items-center space-x-2 w-full md:w-auto bg-gray-50 md:bg-transparent p-2 md:p-0 rounded-sm overflow-hidden mt-2 md:mt-0">
                                    <span
                                        class="md:hidden font-bold text-sm text-[#393939] mr-2 shrink-0">OneDoc:</span>
                                    <button @click="copyToClipboard(item.onedoc_link)"
                                        class="border border-[#0073e6] p-1.5 rounded-sm hover:bg-blue-50 transition-colors shrink-0 bg-white">
                                        <img src="/images/Copy.svg" alt="Copy" class="h-4 w-4" />
                                    </button>
                                    <a v-if="item.onedoc_link" :href="item.onedoc_link" target="_blank"
                                        class="text-xs md:text-[10px] font-inter text-[#0073e6] truncate hover:underline"
                                        :title="item.onedoc_link">
                                        {{ item.onedoc_link }}
                                    </a>
                                    <span v-else class="text-xs md:text-[10px] font-inter text-gray-400 italic">Aucun
                                        lien</span>
                                </div>

                                <div
                                    class="flex items-center justify-start md:justify-end w-full pt-2 md:pt-0 border-t md:border-0 border-gray-100 mt-2 md:mt-0">
                                    <button @click="openModal('detail', item)"
                                        class="border border-[#0073e6] p-2 md:p-1.5 rounded-sm hover:bg-blue-50 transition-colors w-full md:w-auto flex justify-center">
                                        <img src="/images/Edit.svg" alt="Edit" class="h-4 w-4" />
                                        <span class="md:hidden ml-2 text-sm text-[#0073e6]">Modifier</span>
                                    </button>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <div class="py-6 text-center text-gray-500 font-inter">
                                Aucune collecte à venir
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
                    <!-- Y-axis labels dynamically generated based on maxChartValue -->
                    <div v-for="i in (maxChartValue / 2)" :key="'y-' + i"
                        class="absolute -left-8 text-xs font-bold font-inter text-right w-6"
                        :style="{ bottom: `${(i / (maxChartValue / 2)) * 100 - 2}%` }">
                        {{ i * 2 }}
                    </div>
                    <div class="absolute -left-8 -bottom-2 text-xs font-bold font-inter text-right w-6">0</div>

                    <!-- Bars -->
                    <div class="absolute inset-0 flex items-end justify-around px-2 md:px-4">
                        <div v-for="(month, i) in computedMonthsData" :key="i"
                            class="w-6 md:w-16 h-full flex flex-col justify-end items-center relative">
                            <div :class="[month.color, 'w-full cursor-pointer']"
                                :style="{ height: `${(month.value / maxChartValue) * 100}%`, minHeight: month.value > 0 ? '4px' : '0' }"
                                @mouseenter="hoveredMonthIndex = i" @mouseleave="hoveredMonthIndex = null"></div>
                            <div class="absolute top-[105%] text-xs font-bold font-inter whitespace-nowrap"
                                style="writing-mode: vertical-rl; transform: rotate(180deg);">
                                {{ month.label }}
                            </div>
                        </div>
                    </div>

                    <!-- Hover Tooltip -->
                    <div v-if="hoveredMonthIndex !== null"
                        class="absolute top-0 left-0 w-full bg-[#fffbf1] border border-black z-40 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] pointer-events-none">
                        <div class="p-4">
                            <h4 class="font-inter text-xl font-bold text-black mb-2">{{
                                computedMonthsData[hoveredMonthIndex].label
                            }}</h4>

                            <div v-if="computedMonthsData[hoveredMonthIndex].collections.length === 0"
                                class="text-sm font-inter text-gray-500 py-4">
                                Aucune collecte ce mois-ci.
                            </div>

                            <div v-else class="relative w-full h-[120px]">
                                <!-- Timeline Line -->
                                <div class="absolute bottom-[20px] left-0 w-full h-[1px] bg-black">
                                    <!-- Arrow end -->
                                    <div
                                        class="absolute -right-[1px] -top-[4px] w-0 h-0 border-y-[4px] border-y-transparent border-l-[8px] border-l-black">
                                    </div>
                                </div>

                                <!-- Events -->
                                <div v-for="(col, index) in computedMonthsData[hoveredMonthIndex].collections"
                                    :key="col.id || index"
                                    class="absolute bottom-[20px] flex flex-col items-center -translate-x-1/2"
                                    :style="{ left: `${((index + 1) / (computedMonthsData[hoveredMonthIndex].collections.length + 1)) * 100}%` }">

                                    <span class="text-[10px] font-inter text-black absolute whitespace-nowrap"
                                        :class="index % 2 === 0 ? 'bottom-[55px]' : 'bottom-[85px]'">
                                        {{ formatDate(col.day_start) }}
                                    </span>

                                    <div class="border border-black bg-white flex items-center justify-center z-10 min-w-[60px] w-max px-2 h-[28px] absolute left-1/2 -translate-x-1/2"
                                        :class="index % 2 === 0 ? 'bottom-[25px]' : 'bottom-[55px]'">
                                        <span class="font-bold text-[12px] whitespace-nowrap"
                                            :style="{ color: col.company?.color || '#0073e6' }">
                                            {{ col.company?.name || '...' }}
                                        </span>
                                    </div>

                                    <div class="w-[1px] bg-black absolute bottom-0"
                                        :class="index % 2 === 0 ? 'h-[25px]' : 'h-[55px]'"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-16"></div> <!-- Spacer for labels -->
            </section>

            <!-- FifthPart: Statistics -->
            <section class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-8">
                <!-- Taux de participation -->
                <div class="border border-black flex flex-col">
                    <div class="bg-[#ffda45] flex justify-between items-center p-4 border-b border-black relative">
                        <h3 class="font-jersey text-2xl text-[#393939]">Taux de participation</h3>
                        <div class="relative group cursor-pointer flex items-center">
                            <img src="/images/info.svg" alt="Info" class="h-6 w-6" style="filter: brightness(0);" />
                            <div
                                class="absolute right-0 top-full mt-2 w-[260px] md:w-[300px] max-w-[calc(100vw-2rem)] bg-[#fffbf1] border border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-4 hidden group-hover:block z-50">
                                <p class="font-jersey text-[20px] text-black leading-tight">Taux calculé sur l'année en
                                    cours.</p>
                                <p class="font-inter text-[14px] text-black mt-2">Ce taux correspond au ratio entre le
                                    nombre de
                                    poches de sang récoltées et le nombre total d'employés.</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col items-center flex-grow">
                        <div class="font-jersey text-6xl text-black">{{ participationRatio.globalAverage !== undefined ?
                            (participationRatio.globalAverage * 100).toFixed(0) + '%' : '21%' }}</div>
                        <div class="font-jersey text-sm text-black mb-8">De participation moyenne</div>

                        <div class="w-full space-y-4 font-inter text-sm">
                            <div v-for="(item, i) in participationRatio.lowestCompanies || mockParticipationCompanies"
                                :key="i" class="flex justify-between items-center border-b border-gray-300 pb-2">
                                <div class="flex items-center space-x-3">
                                    <img v-if="item.warning" src="/images/importantOrange.svg" alt="Warning"
                                        class="h-5" />
                                    <div v-else class="h-5 w-5"></div>
                                    <span>{{ item.company?.name || item.name }}</span>
                                </div>
                                <div class="font-bold">{{ item.ratio !== undefined ? (item.ratio * 100).toFixed(0) + '%'
                                    :
                                    item.percentage }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Taux de rigueur -->
                <div class="border border-black flex flex-col">
                    <div class="bg-[#ffda45] flex justify-between items-center p-4 border-b border-black relative">
                        <h3 class="font-jersey text-2xl text-[#393939]">Taux de rigueur</h3>
                        <div class="relative group cursor-pointer flex items-center">
                            <img src="/images/info.svg" alt="Info" class="h-6 w-6" style="filter: brightness(0);" />
                            <div
                                class="absolute right-0 top-full mt-2 w-[260px] md:w-[300px] max-w-[calc(100vw-2rem)] bg-[#fffbf1] border border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-4 hidden group-hover:block z-50">
                                <p class="font-jersey text-[20px] text-black leading-tight">Taux calculé sur l'année en
                                    cours.</p>
                                <p class="font-inter text-[14px] text-black mt-2">Ce taux correspond au ratio entre le
                                    nombre de
                                    poches de sang récoltées et le nombre de personnes inscrites à la collecte.</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col items-center flex-grow">
                        <div class="font-jersey text-6xl text-black">{{ rigorRatio.globalAverage !== undefined ?
                            (rigorRatio.globalAverage * 100).toFixed(0) + '%' : '80%' }}</div>
                        <div class="font-jersey text-sm text-black mb-8">De rigueur moyenne</div>

                        <div class="w-full space-y-4 font-inter text-sm">
                            <div v-for="(item, i) in rigorRatio.lowestCompanies || mockRigorCompanies" :key="i"
                                class="flex justify-between items-center border-b border-gray-300 pb-2">
                                <div class="flex items-center space-x-3">
                                    <img v-if="item.warning" src="/images/importantOrange.svg" alt="Warning"
                                        class="h-5" />
                                    <div v-else class="h-5 w-5"></div>
                                    <span>{{ item.company?.name || item.name }}</span>
                                </div>
                                <div class="font-bold">{{ item.ratio !== undefined ? (item.ratio * 100).toFixed(0) + '%'
                                    :
                                    item.percentage }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <!-- Modals -->
        <div v-if="activeModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
            @click.self="closeModal">

            <!-- Clôture Modal -->
            <div v-if="activeModal === 'cloture'"
                class="bg-[#fffbf1] border-[10px] border-[#5C629E] w-full max-w-[600px] p-8 relative">
                <button @click="closeModal"
                    class="absolute top-6 right-6 flex items-center justify-center cursor-pointer transition-transform hover:scale-105">
                    <img src="/images/X.svg" alt="Close" class="w-10 h-10" />
                </button>
                <h2 class="font-['Jersey_20'] text-5xl text-black leading-none mb-1">{{ selectedCollecte?.company?.name
                    ||
                    'HEIG-VD' }}</h2>
                <p class="font-['Jersey_20'] text-2xl text-black mb-8 tracking-wide">Collecte du {{
                    formatDate(selectedCollecte?.day_start) || '02.03.2026' }}</p>

                <div class="space-y-6 mb-8">
                    <div>
                        <label class="block font-inter text-base mb-2">Nombre d'inscrits</label>
                        <div class="relative">
                            <input type="number" v-model="clotureForm.nb_registered" placeholder="Placeholder" min="0"
                                class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            <span class="absolute right-3 top-1/2 -translate-y-1/2">*</span>
                        </div>
                    </div>
                    <div>
                        <label class="block font-inter text-base mb-2">Nombre de poches collectées</label>
                        <div class="relative">
                            <input type="number" v-model="clotureForm.nb_blood_pouch" placeholder="Placeholder" min="0"
                                class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            <span class="absolute right-3 top-1/2 -translate-y-1/2">*</span>
                        </div>
                    </div>
                    <p v-if="clotureError" class="text-red-600 font-inter text-sm">{{ clotureError }}</p>
                </div>

                <div class="flex space-x-4">
                    <button @click="closeModal"
                        class="border-[2px] border-[#0073e6] text-[#0073e6] bg-white px-6 py-2.5 font-inter font-medium w-32 hover:bg-gray-50">Annuler</button>
                    <button @click="submitCloture"
                        class="bg-[#5bb124] text-white px-6 py-2.5 flex items-center justify-center font-inter font-medium w-32 hover:bg-green-600">
                        <img src="/images/whiteCheck.svg" alt="Check" class="h-5 mr-2" /> Clore
                    </button>
                </div>
            </div>

            <!-- Détail Modal -->
            <div v-if="activeModal === 'detail'"
                class="bg-[#fffbf1] border-[10px] border-[#0073e6] w-full max-w-[750px] p-8 relative">
                <button @click="closeModal"
                    class="absolute top-6 right-6 flex items-center justify-center cursor-pointer transition-transform hover:scale-105">
                    <img src="/images/X.svg" alt="Close" class="w-10 h-10" />
                </button>
                <h2 class="font-['Jersey_20'] text-5xl text-black leading-none mb-1">{{ selectedCollecte?.company?.name
                    ||
                    'HEIG-VD' }}</h2>
                <p class="font-['Jersey_20'] text-2xl text-black mb-8 tracking-wide">Collecte du {{
                    formatDate(selectedCollecte?.day_start) || '02.07.2026' }}</p>

                <div class="grid grid-cols-2 gap-8 mb-6">
                    <div>
                        <label class="block font-inter text-base mb-2">Nombre d'employés</label>
                        <div class="relative">
                            <input type="number" v-model="detailForm.nb_employee" placeholder="Ex: 5000"
                                class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            <span class="absolute right-3 top-1/2 -translate-y-1/2">*</span>
                        </div>
                    </div>
                    <div></div>
                    <div>
                        <label class="block font-inter text-base mb-2">Début de la collecte</label>
                        <div class="relative">
                            <input type="date" v-model="detailForm.day_start"
                                class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            <span class="absolute right-3 top-1/2 -translate-y-1/2">*</span>
                        </div>
                    </div>
                    <div>
                        <label class="block font-inter text-base mb-2">Fin de la collecte</label>
                        <div class="relative">
                            <input type="date" v-model="detailForm.day_end"
                                class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            <span class="absolute right-3 top-1/2 -translate-y-1/2">*</span>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label class="block font-inter text-base mb-2">Lieu</label>
                        <div class="relative">
                            <input type="text" v-model="detailForm.location" placeholder="Ex: Rue de l'entreprise 12"
                                class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            <span class="absolute right-3 top-1/2 -translate-y-1/2">*</span>
                        </div>
                    </div>
                    <div>
                        <label class="block font-inter text-base mb-2">Heure de début</label>
                        <div class="relative">
                            <input type="time" step="1" v-model="detailForm.hour_start"
                                class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            <span class="absolute right-3 top-1/2 -translate-y-1/2">*</span>
                        </div>
                    </div>
                    <div>
                        <label class="block font-inter text-base mb-2">Heure de fin</label>
                        <div class="relative">
                            <input type="time" step="1" v-model="detailForm.hour_end"
                                class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
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
                        <input type="url" v-model="detailForm.onedoc_link" placeholder="Lien OneDoc"
                            class="w-full h-full border border-black p-3 font-inter text-sm bg-transparent" />
                        <span class="absolute right-3 top-1/2 -translate-y-1/2">*</span>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <button @click="activeModal = 'suppression'"
                        class="bg-[#E4534B] text-white px-8 py-3 font-inter font-medium hover:bg-red-600 transition-colors">Supprimer
                        la collecte</button>
                    <div class="flex space-x-4">
                        <button @click="closeModal"
                            class="border-[2px] border-[#0073e6] text-[#0073e6] bg-white px-8 py-3 font-inter font-medium hover:bg-gray-50 transition-colors">Annuler</button>
                        <button @click="submitDetail"
                            class="bg-[#0073e6] text-white px-8 py-3 font-inter font-medium hover:bg-blue-600 transition-colors">Enregistrer</button>
                    </div>
                </div>
            </div>

            <!-- Suppression Modal -->
            <div v-if="activeModal === 'suppression'"
                class="bg-[#fffbf1] border-[10px] border-[#E4534B] w-full max-w-[650px] p-10 relative">
                <h2 class="font-['Jersey_20'] text-6xl text-[#E4534B] leading-none mb-6 tracking-wide">Attention</h2>
                <p class="font-inter text-lg text-black mb-8 leading-relaxed">
                    Vous êtes sur le point de supprimer la collecte de {{ selectedCollecte?.company?.name || 'HEIG-VD'
                    }} du {{
                        formatDate(selectedCollecte?.day_start) || '02.03.2026' }}.<br />
                    Êtes-vous sur de vouloir procéder ?
                </p>

                <div class="mb-10">
                    <label class="block font-inter text-lg mb-2">Inscrire "supprimer" pour procéder</label>
                    <div class="relative">
                        <input type="text" v-model="suppressionInput" placeholder="supprimer"
                            class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                        <span class="absolute right-3 top-1/2 -translate-y-1/2">*</span>
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <button @click="submitSuppression"
                        class="bg-[#E4534B] text-white px-8 py-3 font-inter text-lg font-medium hover:bg-red-600 transition-colors">Supprimer</button>
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
            suppressionInput: '',
            clotureForm: {
                nb_registered: '',
                nb_blood_pouch: ''
            },
            clotureError: null,
            detailForm: {
                nb_employee: '',
                day_start: '',
                onedoc_link: '',
                location: '',
                hour_start: '',
                hour_end: ''
            },
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
        getCoBrandLink(item) {
            if (!item || !item.id) return '';
            const baseUrl = window.location.origin;
            const slug = item.company?.slug || item.company?.name?.toLowerCase().replace(/[^a-z0-9]/g, '-') || 'inconnu';
            return `${baseUrl}/collection/${slug}/${item.id}`;
        },
        async copyToClipboard(text) {
            if (!text) return;
            try {
                await navigator.clipboard.writeText(text);
                alert('Lien copié dans le presse-papiers !');
            } catch (err) {
                console.error('Erreur lors de la copie', err);
            }
        },
        formatDate(dateStr) {
            if (!dateStr) return '';
            const d = new Date(dateStr);
            return d.toLocaleDateString('fr-CH');
        },
        openModal(type, item) {
            this.activeModal = type;
            this.selectedCollecte = item || null;
            this.detailForm.day_start = item?.day_start ? item.day_start.split('T')[0].split(' ')[0] : '';
            this.detailForm.day_end = item?.day_end ? item.day_end.split('T')[0].split(' ')[0] : '';
            if (type === 'cloture') {
                this.clotureForm.nb_registered = '';
                this.clotureForm.nb_blood_pouch = '';
            } else if (type === 'detail') {
                this.detailForm.nb_employee = item?.nb_employee || '';
                this.detailForm.day_start = item?.day_start ? item.day_start.split('T')[0].split(' ')[0] : '';
                this.detailForm.day_end = item?.day_end ? item.day_end.split('T')[0].split(' ')[0] : '';
                this.detailForm.onedoc_link = item?.onedoc_link || '';
                this.detailForm.location = item?.location || '';
                this.detailForm.hour_start = item?.hour_start || '';
                this.detailForm.hour_end = item?.hour_end || '';
            } else if (type === 'suppression') {
                this.suppressionInput = '';
            }
        },
        closeModal() {
            this.activeModal = null;
            this.selectedCollecte = null;
        },
        async submitCloture() {
            this.clotureError = null;
            try {
                const xsrfToken = decodeURIComponent(
                    document.cookie
                        .split('; ')
                        .find(row => row.startsWith('XSRF-TOKEN='))
                        ?.split('=')[1] ?? ''
                );

                const response = await fetch(`/api/collection/${this.selectedCollecte.id}/close`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        // 'X-XSRF-TOKEN': xsrfToken,
                    },
                    credentials: 'include',
                    body: JSON.stringify({
                        nb_registered: parseInt(this.clotureForm.nb_registered, 10),
                        nb_blood_pouch: parseInt(this.clotureForm.nb_blood_pouch, 10),
                    })
                });

                if (!response.ok) {
                    const data = await response.json();
                    this.clotureError = data.error || data.message || 'Une erreur est survenue.';
                    return;
                }

                window.location.reload();
            } catch (err) {
                console.error(err);
                this.clotureError = 'Erreur réseau lors de la clôture.';
            }
        },
        async submitDetail() {
            try {
                const response = await fetch(`/api/collection/${this.selectedCollecte.id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(this.detailForm)
                });
                if (!response.ok) throw new Error("API Error");
                window.location.reload();
            } catch (err) {
                console.error(err);
                alert("Erreur lors de l'enregistrement.");
            }
        },
        async submitSuppression() {
            if (this.suppressionInput.toLowerCase() !== 'supprimer') return;
            try {
                const response = await fetch(`/api/collection/${this.selectedCollecte.id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!response.ok) throw new Error("API Error");
                window.location.reload();
            } catch (err) {
                console.error(err);
                alert("Erreur lors de la suppression.");
            }
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
        },
        maxChartValue() {
            const collections = this.initialData.currentYearCollections || [];
            let monthCounts = Array(12).fill(0);
            collections.forEach(col => {
                if (col.day_start) {
                    const d = new Date(col.day_start);
                    monthCounts[d.getMonth()]++;
                }
            });
            const maxCount = Math.max(...monthCounts);
            let scale = maxCount + (maxCount % 2 === 0 ? 2 : 1);
            return scale < 4 ? 4 : scale;
        },
        computedMonthsData() {
            const collections = this.initialData.currentYearCollections || [];
            const labels = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
            const currentMonthIndex = new Date().getMonth();

            let monthDataMap = Array(12).fill(null).map(() => ({ count: 0, collections: [] }));

            collections.forEach(col => {
                if (col.day_start) {
                    const d = new Date(col.day_start);
                    const monthIndex = d.getMonth();
                    monthDataMap[monthIndex].count++;
                    monthDataMap[monthIndex].collections.push(col);
                }
            });

            return labels.map((label, i) => {
                const sortedCols = monthDataMap[i].collections.sort((a, b) => new Date(a.day_start) - new Date(b.day_start));
                return {
                    label,
                    value: monthDataMap[i].count,
                    color: i < currentMonthIndex ? 'bg-[#0073e6]' : (i === currentMonthIndex ? 'bg-[#ffd012]' : 'bg-[#cce6ff]'),
                    collections: sortedCols
                };
            });
        }
    }
}
</script>
