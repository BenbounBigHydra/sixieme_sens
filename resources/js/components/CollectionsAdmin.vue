<template>
    <div class="min-h-screen bg-[#fffbf1] font-inter">
        <HeaderAdmin />

        <main class="max-w-desktop mx-auto px-8 md:px-20 lg:px-32 xl:px-40 py-10 space-y-12">
            <!-- Search Bar -->
            <div class="flex gap-3 items-center w-full">
                <div class="relative flex-1">
                    <input type="text" v-model="searchQuery" placeholder="Rechercher"
                        class="w-full border border-gray-400  py-3 px-4 bg-transparent outline-none focus:border-[#0073e6] transition-colors" />
                    <div class="absolute right-4 top-1/2 -translate-y-1/2">
                        <img src="/images/Search.svg" alt="Search" class="h-5 w-5" />
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="flex flex-wrap gap-2 md:gap-4 md:space-x-0 items-stretch">
                <!-- Year Filter -->
                <select v-model="selectedYear" @change="changeYear" :disabled="loadingYear"
                    class="border border-[#0073e6] px-4 py-2 font-inter text-sm bg-[#fffbf1] text-[#0073e6] transition-colors disabled:opacity-50 w-full md:w-auto">
                    <option v-for="year in availableYears" :key="year" :value="year">
                        {{ year }}
                    </option>
                </select>

                <button @click="toggleFilter('ongoing')"
                    :class="activeFilter === 'ongoing' ? 'bg-[#0073e6] border-[#0073e6] text-[#fffbf1]' : 'bg-transparent border-[#0073e6] text-[#0073e6]'"
                    class="border px-4 py-2  font-inter text-sm transition-colors w-full md:w-auto">
                    En cours
                </button>
                <button @click="toggleFilter('to_come')"
                    :class="activeFilter === 'to_come' ? 'bg-[#0073e6] border-[#0073e6] text-[#fffbf1]' : 'bg-transparent border-[#0073e6] text-[#0073e6]'"
                    class="border px-4 py-2  font-inter text-sm transition-colors w-full md:w-auto">
                    À venir
                </button>
                <button @click="toggleFilter('past')"
                    :class="activeFilter === 'past' ? 'bg-[#0073e6] border-[#0073e6] text-[#fffbf1]' : 'bg-transparent border-[#0073e6] text-[#0073e6]'"
                    class="border px-4 py-2  font-inter text-sm transition-colors w-full md:w-auto">
                    Terminées
                </button>
                <button @click="toggleFilter('to_close')"
                    :class="activeFilter === 'to_close' ? 'bg-[#0073e6] border-[#0073e6] text-[#fffbf1]' : 'bg-transparent border-[#0073e6] text-[#0073e6]'"
                    class="border px-4 py-2  font-inter text-sm transition-colors w-full md:w-auto">
                    À clore
                </button>
                <button @click="resetFilters"
                    class="bg-[#0073e6] text-[#fffbf1] flex items-center px-4 py-2 border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:bg-[#0073e6]/90 transition-all w-full md:w-auto justify-center">
                    <span class="font-['Jersey_20'] tracking-wide text-lg">Réinitialiser</span>
                </button>
            </div>

            <!-- Title -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-0 mt-4">
                <h1 class="font-inter font-bold text-2xl md:text-3xl text-black">Collectes</h1>
                <button @click="openNewModal"
                    class="bg-[#0073e6] text-[#fffbf1] flex items-center px-4 py-2 border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:bg-[#0073e6]/90 transition-all w-full md:w-auto justify-center">
                    <div class="h-4 w-4 mr-2 bg-[#fffbf1]"
                        style="mask-image: url('/images/Cross.svg'); mask-size: contain; mask-repeat: no-repeat; mask-position: center; -webkit-mask-image: url('/images/Cross.svg'); -webkit-mask-size: contain; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center;">
                    </div>
                    <span class="font-['Jersey_20'] tracking-wide text-lg">Organiser une collecte</span>
                </button>
            </div>

            <!-- Collections Table -->
            <div class="w-full mt-4 overflow-x-auto pb-4">
                <div class="border border-blue-200 overflow-hidden md:min-w-[1000px]">
                    <!-- Table Header -->
                    <div
                        class="hidden md:grid grid-cols-[minmax(160px,2fr)_minmax(80px,1fr)_minmax(90px,1fr)_minmax(80px,1fr)_minmax(80px,1fr)_minmax(80px,1fr)_minmax(60px,1fr)_minmax(60px,1fr)_minmax(120px,1fr)_minmax(100px,1fr)] items-center bg-[#ffeaa7] py-3 px-2 border-b border-blue-200">
                        <!-- Entreprise -->
                        <div class="flex items-center cursor-pointer group" @click="sortBy('companyName')">
                            <span class="font-inter text-sm text-[#393939] mr-2">Entreprise</span>
                            <img src="/images/BlueChevron%20Down.svg" alt="Sort" class="h-4 w-4 transition-transform"
                                :class="{ 'rotate-180': sortOrder === 'asc' }" />
                        </div>

                        <!-- Nouvelles colonnes -->
                        <div class="flex items-center"><span class="font-inter text-sm text-[#393939]">Date</span></div>
                        <div class="flex items-center"><span class="font-inter text-sm text-[#393939]">Total
                                employés</span></div>
                        <div class="flex items-center"><span class="font-inter text-sm text-[#393939]">Capacité</span>
                        </div>
                        <div class="flex items-center"><span class="font-inter text-sm text-[#393939]">Inscrits</span>
                        </div>
                        <div class="flex items-center"><span class="font-inter text-sm text-[#393939]">Poches</span>
                        </div>
                        <div class="flex items-center"><span class="font-inter text-sm text-[#393939]">One-Doc</span>
                        </div>
                        <div class="flex items-center"><span class="font-inter text-sm text-[#393939]">Co-Brand</span>
                        </div>

                        <!-- Statut -->
                        <div class="flex items-center justify-center">
                            <span class="font-inter text-sm text-[#393939] mx-auto">Statut</span>
                        </div>
                    </div>

                    <!-- Table Body -->
                    <div class="border border-blue-200   md:rounded-t-none bg-[#fffbf1]">
                        <template v-if="filteredAndSortedCollections.length > 0">
                            <div v-for="(collection, index) in filteredAndSortedCollections" :key="collection.id"
                                :class="Math.floor(index / 3) !== mobilePage ? 'hidden md:grid' : 'flex flex-col md:grid'"
                                class="md:grid-cols-[minmax(160px,2fr)_minmax(80px,1fr)_minmax(90px,1fr)_minmax(80px,1fr)_minmax(80px,1fr)_minmax(80px,1fr)_minmax(60px,1fr)_minmax(60px,1fr)_minmax(120px,1fr)_minmax(100px,1fr)] items-start md:items-center py-4 px-2 border-b border-blue-200 last:border-0 gap-4 md:gap-0">
                                <!-- Entreprise -->
                                <div class="flex items-center space-x-3 w-full">
                                    <div class="h-8 w-16 flex items-center justify-start shrink-0">
                                        <img :src="collection.company?.logo ? '/' + collection.company.logo : '/images/BCGE.png'"
                                            alt="Logo" class="max-h-full max-w-full object-contain" />
                                    </div>
                                    <span class="font-inter font-bold text-lg md:text-sm text-[#393939]">{{
                                        collection.company?.name || 'Inconnu' }}</span>
                                </div>

                                <div class="flex items-center justify-between md:justify-start w-full md:w-auto">
                                    <span class="md:hidden font-bold text-sm text-[#393939]">Date :</span>
                                    <span class="font-inter text-sm text-[#393939]">{{ formatDate(collection.day_start)
                                        }}</span>
                                </div>
                                <div class="flex items-center justify-between md:justify-start w-full md:w-auto">
                                    <span class="md:hidden font-bold text-sm text-[#393939]">Total employés :</span>
                                    <span class="font-inter text-sm text-[#393939]">{{ collection.nb_employee || '-'
                                        }}</span>
                                </div>
                                <div class="flex items-center justify-between md:justify-start w-full md:w-auto">
                                    <span class="md:hidden font-bold text-sm text-[#393939]">Capacité :</span>
                                    <span class="font-inter text-sm text-[#393939]">{{ collection.capacity || '-'
                                        }}</span>
                                </div>
                                <div class="flex items-center justify-between md:justify-start w-full md:w-auto">
                                    <span class="md:hidden font-bold text-sm text-[#393939]">Inscrits :</span>
                                    <span class="font-inter text-sm text-[#393939]">{{ collection.nb_registered ?? '-'
                                        }}</span>
                                </div>
                                <div class="flex items-center justify-between md:justify-start w-full md:w-auto">
                                    <span class="md:hidden font-bold text-sm text-[#393939]">Poches :</span>
                                    <span class="font-inter text-sm text-[#393939]">{{ collection.nb_blood_pouch ?? '-'
                                        }}</span>
                                </div>

                                <!-- One Doc Link -->
                                <div class="flex items-center justify-between md:justify-start w-full md:w-auto">
                                    <span class="md:hidden font-bold text-sm text-[#393939]">One-Doc :</span>
                                    <a v-if="collection.onedoc_link" :href="collection.onedoc_link" target="_blank"
                                        class="border border-[#0073e6] p-1.5 hover:bg-blue-50 transition-colors bg-white w-8 h-8 flex items-center justify-center"
                                        title="Lien One-Doc">
                                        <img src="/images/Copy.svg" alt="Lien One-Doc" class="w-4 h-4 object-contain" />
                                    </a>
                                    <span v-else class="text-gray-400 font-inter text-sm">-</span>
                                </div>

                                <!-- Co-Brand Link -->
                                <div class="flex items-center justify-between md:justify-start w-full md:w-auto">
                                    <span class="md:hidden font-bold text-sm text-[#393939]">Co-Brand :</span>
                                    <a v-if="collection.statusKey !== 'past' && collection.company?.slug"
                                        :href="'/collection/' + collection.company.slug + '/' + collection.id"
                                        target="_blank"
                                        class="border border-[#0073e6] p-1.5 hover:bg-blue-50 transition-colors bg-white w-8 h-8 flex items-center justify-center"
                                        title="Lien Co-Brand">
                                        <img src="/images/Copy.svg" alt="Lien Co-Brand"
                                            class="w-4 h-4 object-contain" />
                                    </a>
                                    <span v-else class="text-gray-400 font-inter text-sm italic">-</span>
                                </div>

                                <!-- Statut -->
                                <div class="flex items-center justify-start md:justify-center w-full mt-2 md:mt-0">
                                    <div class="px-6 py-1.5  text-white font-inter text-sm text-center min-w-[120px]"
                                        :class="getStatusColor(collection.statusKey)">
                                        {{ getStatusLabel(collection.statusKey) }}
                                    </div>
                                </div>

                                <!-- Détails -->
                                <div
                                    class="flex items-center justify-start md:justify-end w-full pt-2 md:pt-0 border-t md:border-0 border-gray-100 mt-2 md:mt-0 gap-2">
                                    <button v-if="collection.statusKey === 'to_close'"
                                        @click="openClotureModal(collection)"
                                        class="bg-[#22c55e] text-white p-2 md:p-1.5  hover:bg-opacity-90 transition-colors w-full md:w-auto flex justify-center">
                                        <span class="text-sm font-inter">Clore</span>
                                    </button>
                                    <button @click="openEditModal(collection)"
                                        class="border border-[#0073e6] p-2 md:p-1.5  hover:bg-blue-50 transition-colors w-full md:w-auto flex justify-center">
                                        <img src="/images/Edit.svg" alt="Edit" class="h-4 w-4" />
                                        <span class="md:hidden ml-2 text-[#0073e6] text-sm">Modifier</span>
                                    </button>
                                </div>
                            </div>
                            <div
                                class="flex justify-between items-center py-3 px-4 md:hidden border-t border-blue-200 bg-[#ffeeab] sticky bottom-0">
                                <button @click="prevMobilePage" :disabled="mobilePage === 0"
                                    class="h-10 w-10 disabled:opacity-50 flex items-center justify-center bg-white border border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] rounded-none">
                                    <span class="font-bold">&lt;</span>
                                </button>
                                <span class="font-inter text-sm font-bold">{{ mobilePage + 1 }} / {{
                                    Math.ceil(filteredAndSortedCollections.length / 3) || 1 }}</span>
                                <button @click="nextMobilePage"
                                    :disabled="(mobilePage + 1) * 3 >= filteredAndSortedCollections.length"
                                    class="h-10 w-10 disabled:opacity-50 flex items-center justify-center bg-white border border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] rounded-none">
                                    <span class="font-bold">&gt;</span>
                                </button>
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
    <!-- Options Modal -->
    <div v-if="activeModal === 'options'" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
        @click.self="closeModal">
        <div
            :class="['bg-[#fffbf1] border-[10px] w-full max-w-[750px] p-8 relative flex flex-col max-h-[90vh]', getModalBorderClass]">
            <button @click="closeModal"
                class="absolute top-6 right-6 flex items-center justify-center cursor-pointer transition-transform hover:scale-105">
                <img src="/images/X.svg" alt="Close" class="w-10 h-10" />
            </button>
            <h2 class="font-['Jersey_20'] text-5xl text-black leading-none mb-1">{{ selectedCollecte ?
                (selectedCollecte.company?.name || 'Inconnu') : 'Nouvelle collecte' }}</h2>
            <p class="font-['Jersey_20'] text-2xl text-black mb-6 tracking-wide" v-if="selectedCollecte">Collecte du
                {{
                    formatDate(selectedCollecte?.day_start) }}</p>

            <!-- Tabs -->
            <div class="flex space-x-4 border-b border-gray-300 mb-6 shrink-0" v-if="selectedCollecte">
                <button @click="activeTab = 'modifier'"
                    :class="{ 'border-b-2 border-[#0073e6] text-[#0073e6] font-bold': activeTab === 'modifier', 'text-gray-500': activeTab !== 'modifier' }"
                    class="pb-2 px-4 font-inter text-lg">Modifier</button>
                <button @click="canCloseCollection && (activeTab = 'cloturer')" :disabled="!canCloseCollection"
                    :class="{ 'border-b-2 border-[#5C629E] text-[#5C629E] font-bold': activeTab === 'cloturer', 'text-gray-500': activeTab !== 'cloturer', 'opacity-50 cursor-not-allowed': !canCloseCollection }"
                    class="pb-2 px-4 font-inter text-lg">Clôturer</button>
                <button @click="activeTab = 'supprimer'"
                    :class="{ 'border-b-2 border-[#E4534B] text-[#E4534B] font-bold': activeTab === 'supprimer', 'text-gray-500': activeTab !== 'supprimer' }"
                    class="pb-2 px-4 font-inter text-lg">Supprimer</button>
            </div>

            <div class="overflow-y-auto overflow-x-hidden flex-grow px-1">
                <!-- Tab Content: Modifier ou Créer -->
                <div v-if="activeTab === 'modifier' || activeTab === 'creer'" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
                        <div v-if="activeTab === 'creer'" class="col-span-1 md:col-span-2">
                            <label class="block font-inter text-base mb-2">Entreprise</label>
                            <div class="relative">
                                <select v-model="detailForm.company_id"
                                    class="w-full border border-black p-3 font-inter text-sm bg-transparent">
                                    <option disabled value="">Sélectionnez une entreprise</option>
                                    <option v-for="company in companies" :key="company.id" :value="company.id">
                                        {{ company.name }}
                                    </option>
                                </select>
                            </div>
                            <p v-if="errors.company_id" class="text-red-500 text-xs mt-1">{{ errors.company_id[0] }}
                            </p>
                        </div>
                        <div>
                            <label class="block font-inter text-base mb-2">Nombre d'employés</label>
                            <div class="relative">
                                <input type="number" v-model="detailForm.nb_employee" placeholder="Ex: 5000"
                                    class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            </div>
                            <p v-if="errors.nb_employee" class="text-red-500 text-xs mt-1">{{ errors.nb_employee[0]
                            }}</p>
                        </div>
                        <div>
                            <label class="block font-inter text-base mb-2">Capacité de la collecte</label>
                            <div class="relative">
                                <input type="number" v-model="detailForm.capacity" placeholder="Ex: 500"
                                    class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            </div>
                            <p v-if="errors.capacity" class="text-red-500 text-xs mt-1">{{ errors.capacity[0] }}</p>
                        </div>
                        <div>
                            <label class="block font-inter text-base mb-2">Date de la collecte (Début)</label>
                            <div class="relative">
                                <input type="date" v-model="detailForm.day_start"
                                    class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            </div>
                            <p v-if="errors.day_start" class="text-red-500 text-xs mt-1">{{ errors.day_start[0] }}
                            </p>
                        </div>
                        <div>
                            <label class="block font-inter text-base mb-2">Date de la collecte (Fin)</label>
                            <div class="relative">
                                <input type="date" v-model="detailForm.day_end"
                                    class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            </div>
                            <p v-if="errors.day_end" class="text-red-500 text-xs mt-1">{{ errors.day_end[0] }}</p>
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block font-inter text-base mb-2">Lieu</label>
                            <div class="relative">
                                <input type="text" v-model="detailForm.location"
                                    placeholder="Ex: Rue de l'entreprise 12"
                                    class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            </div>
                            <p v-if="errors.location" class="text-red-500 text-xs mt-1">{{ errors.location[0] }}</p>
                        </div>
                        <div>
                            <label class="block font-inter text-base mb-2">Heure de début</label>
                            <div class="relative">
                                <input type="time" step="1" v-model="detailForm.hour_start"
                                    class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            </div>
                            <p v-if="errors.hour_start" class="text-red-500 text-xs mt-1">{{ errors.hour_start[0] }}
                            </p>
                        </div>
                        <div>
                            <label class="block font-inter text-base mb-2">Heure de fin</label>
                            <div class="relative">
                                <input type="time" step="1" v-model="detailForm.hour_end"
                                    class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            </div>
                            <p v-if="errors.hour_end" class="text-red-500 text-xs mt-1">{{ errors.hour_end[0] }}</p>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-stretch md:items-end gap-4 md:gap-6 mb-8">
                        <div
                            class="bg-[#f2faf2] px-6 py-3 flex justify-center items-center space-x-3 w-full md:w-[160px] h-[46px]">
                            <span class="text-[#3b803b] font-inter font-medium">One-doc</span>
                            <img src="/images/Edit.svg" alt="Edit" class="h-4" />
                        </div>
                        <div class="flex-grow relative h-[46px]">
                            <input type="url" v-model="detailForm.onedoc_link" placeholder="Lien OneDoc"
                                class="w-full h-full border border-black p-3 font-inter text-sm bg-transparent" />
                            <p v-if="errors.onedoc_link" class="text-red-500 text-xs mt-1">{{ errors.onedoc_link[0]
                            }}</p>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row justify-end gap-4 md:space-x-4 pt-4">
                        <button @click="closeModal"
                            class="border-[2px] border-[#0073e6] text-[#0073e6] bg-white px-8 py-3 font-inter font-medium hover:bg-gray-50 transition-colors w-full md:w-auto">Annuler</button>
                        <button @click="activeTab === 'creer' ? submitCreation() : submitDetail()"
                            class="bg-[#0073e6] text-white px-8 py-2.5 border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:bg-[#0073e6]/90 transition-all font-['Jersey_20'] tracking-wide text-xl flex items-center justify-center w-full md:w-auto">
                            <span v-if="isSaving" class="mr-2">...</span>
                            {{ activeTab === 'creer' ? 'Créer' : 'Enregistrer' }}
                        </button>
                    </div>
                </div>

                <!-- Tab Content: Clôturer -->
                <div v-if="activeTab === 'cloturer'" class="space-y-6">
                    <div class="space-y-6 mb-8">
                        <div>
                            <label class="block font-inter text-base mb-2">Nombre d'inscrits</label>
                            <div class="relative">
                                <input type="number" v-model="clotureForm.nb_registered" placeholder="Ex: 50"
                                    class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            </div>
                            <p v-if="errors.nb_registered" class="text-red-500 text-xs mt-1">{{ errors.nb_registered[0]
                            }}
                            </p>
                        </div>
                        <div>
                            <label class="block font-inter text-base mb-2">Nombre de poches collectées</label>
                            <div class="relative">
                                <input type="number" v-model="clotureForm.nb_blood_pouch" placeholder="Ex: 45"
                                    class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                            </div>
                            <p v-if="errors.nb_blood_pouch" class="text-red-500 text-xs mt-1">{{
                                errors.nb_blood_pouch[0] }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-4 md:space-x-4 pt-4">
                        <button @click="closeModal"
                            class="border-[2px] border-[#0073e6] text-[#0073e6] bg-white px-6 py-2.5 font-inter font-medium w-full md:w-32 hover:bg-gray-50">Annuler</button>
                        <button @click="submitCloture"
                            class="bg-[#5bb124] text-white px-6 py-2.5 flex items-center justify-center font-inter font-medium w-full md:w-32 hover:bg-green-600">
                            <span v-if="isSaving" class="mr-2">...</span>
                            <img v-else src="/images/whiteCheck.svg" alt="Check" class="h-5 mr-2" /> Clore
                        </button>
                    </div>
                </div>

                <!-- Tab Content: Supprimer -->
                <div v-if="activeTab === 'supprimer'" class="space-y-6">
                    <h2 class="font-['Jersey_20'] text-5xl text-[#E4534B] leading-none mb-6 tracking-wide">Attention
                    </h2>
                    <p class="font-inter text-lg text-black mb-8 leading-relaxed">
                        Vous êtes sur le point de supprimer la collecte de {{ selectedCollecte?.company?.name ||
                            'Inconnu'
                        }} du {{ formatDate(selectedCollecte?.day_start) }}.<br />
                        Êtes-vous sûr de vouloir procéder ?
                    </p>

                    <div class="mb-10">
                        <label class="block font-inter text-lg mb-2">Inscrire "supprimer" pour procéder</label>
                        <div class="relative">
                            <input type="text" v-model="suppressionInput" placeholder="supprimer"
                                class="w-full border border-black p-3 font-inter text-sm bg-transparent" />
                        </div>
                    </div>

                    <div v-if="errors.general" class="mb-6">
                        <p class="text-red-500 text-sm">{{ errors.general[0] }}</p>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button @click="submitSuppression"
                            class="bg-[#E4534B] text-white px-8 py-3 font-inter text-lg font-medium hover:bg-red-600 transition-colors flex items-center">
                            <span v-if="isSaving" class="mr-2">...</span>
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
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
    // FUSION ET NETTOYAGE DES DEUX BLOCS DATA() EN UN SEUL
    data() {
        return {
            searchQuery: '',
            activeFilter: null, // null signifie "tout afficher"
            sortKey: 'statusPriority',
            sortOrder: 'asc',
            allCollections: [],
            activeModal: null,
            activeTab: 'modifier',
            selectedCollecte: null,
            isSaving: false,
            suppressionInput: '',
            mobilePage: 0,
            companies: [],
            errors: {},
            selectedYear: new Date().getFullYear(),
            loadingYear: false,
            clotureForm: {
                nb_registered: '',
                nb_blood_pouch: ''
            },
            detailForm: {
                company_id: '',
                nb_employee: '',
                capacity: '',
                day_start: '',
                day_end: '',
                onedoc_link: '',
                location: '',
                hour_start: '',
                hour_end: ''
            }
        }
    },
    created() {
        if (this.initialData) {
            if (this.initialData.companies) {
                this.companies = this.initialData.companies;
            }

            if (this.initialData.collections) {
                this.parseAndSetCollections(this.initialData.collections, false);
            }
        }
    },
    mounted() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('action') === 'new') {
            this.openNewModal();
        }
    },
    computed: {
        filteredAndSortedCollections() {
            let result = this.allCollections;

            // Filtrer par année sélectionnée
            result = result.filter(c => {
                const collectionYear = new Date(c.day_start).getFullYear();
                return collectionYear === this.selectedYear;
            });

            // Filtrer par statut (En cours, À venir, etc.)
            if (this.activeFilter) {
                result = result.filter(c => c.statusKey === this.activeFilter);
            }

            // Filtrer par barre de recherche
            if (this.searchQuery) {
                const query = this.searchQuery.toLowerCase();
                result = result.filter(c => c.company?.name && c.company.name.toLowerCase().includes(query));
            }

            // Tri par nom d'entreprise ou par priorité de statut
            result = result.sort((a, b) => {
                if (this.sortKey === 'companyName') {
                    let valA = (a.company?.name || '').toLowerCase();
                    let valB = (b.company?.name || '').toLowerCase();

                    if (valA < valB) return this.sortOrder === 'asc' ? -1 : 1;
                    if (valA > valB) return this.sortOrder === 'asc' ? 1 : -1;
                    return 0;
                } else {
                    const statusOrder = { 'to_close': 1, 'ongoing': 2, 'to_come': 3, 'past': 4 };
                    let sA = statusOrder[a.statusKey] || 99;
                    let sB = statusOrder[b.statusKey] || 99;
                    return sA - sB;
                }
            });

            return result;
        },
        availableYears() {
            const fromData = this.initialData?.availableYears;
            if (Array.isArray(fromData) && fromData.length > 0) {
                return [...fromData].sort((a, b) => b - a);
            }
            const y = new Date().getFullYear();
            return [y, y - 1, y - 2, y - 3];
        },
        getModalBorderClass() {
            if (this.activeTab === 'modifier') return 'border-[#0073e6]';
            if (this.activeTab === 'cloturer') return 'border-[#5C629E]';
            if (this.activeTab === 'supprimer') return 'border-[#E4534B]';
            return 'border-[#0073e6]';
        },
        canCloseCollection() {
            if (!this.selectedCollecte?.day_end) return false;
            if (this.selectedCollecte.statusKey === 'past' || this.selectedCollecte.statusKey === 'to_come') {
                return false;
            } else {
                return true;
            }
        }
    },
    methods: {
        // Méthode centralisée pour transformer les groupes de statuts de l'API en tableau plat réactif
        parseAndSetCollections(collectionsGroups, isUpdateFromApi = false) {
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

            if (isUpdateFromApi) {
                // Remplace les collectes de l'année concernée pour éviter les doublons ou données obsolètes
                this.allCollections = [
                    ...this.allCollections.filter(c => new Date(c.day_start).getFullYear() !== this.selectedYear),
                    ...all
                ];
            } else {
                this.allCollections = all;
            }
        },
        toggleFilter(filter) {
            if (this.activeFilter === filter) {
                this.activeFilter = null;
            } else {
                this.activeFilter = filter;
            }
        },
        resetFilters() {
            this.activeFilter = null;
            this.searchQuery = '';
            this.selectedYear = new Date().getFullYear();
            this.mobilePage = 0;
        },
        async changeYear() {
            this.mobilePage = 0;
            this.loadingYear = true;

            try {
                const response = await fetch(`/api/collections/${this.selectedYear}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to fetch collections');
                }
                const data = {
                    collections: await response.json(),
                };

                if (data.collections) {
                    // Utilisation de la fonction centralisée pour rafraîchir l'affichage
                    this.parseAndSetCollections(data.collections, true);
                }
            } catch (err) {
                console.error('Error loading collections for year:', this.selectedYear, err);
            } finally {
                this.loadingYear = false;
            }
        },
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
        sortBy(key) {
            if (key === 'companyName') {
                if (this.sortKey === 'companyName') {
                    this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
                } else {
                    this.sortKey = 'companyName';
                    this.sortOrder = 'asc';
                }
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
                'ongoing': 'bg-[#5b6bb9]',
                'to_come': 'bg-[#87CEEB]',
                'past': 'bg-black',
                'to_close': 'bg-[#f87171]'
            };
            return colors[key] || 'bg-gray-500';
        },
        openNewModal() {
            this.selectedCollecte = null;
            this.activeTab = 'creer';
            this.activeModal = 'options';

            this.errors = {};
            this.detailForm.company_id = '';
            this.detailForm.nb_employee = '';
            this.detailForm.capacity = '';
            this.detailForm.day_start = '';
            this.detailForm.day_end = '';
            this.detailForm.onedoc_link = '';
            this.detailForm.location = '';
            this.detailForm.hour_start = '';
            this.detailForm.hour_end = '';
        },
        openEditModal(collection) {
            this.selectedCollecte = collection;
            this.activeTab = 'modifier';
            this.activeModal = 'options';

            this.errors = {};
            this.clotureForm.nb_registered = collection?.nb_registered || '';
            this.clotureForm.nb_blood_pouch = collection?.nb_blood_pouch || '';

            this.detailForm.company_id = collection?.company_id || '';
            this.detailForm.nb_employee = collection?.nb_employee || '';
            this.detailForm.capacity = collection?.capacity || '';
            this.detailForm.day_start = collection?.day_start ? collection.day_start.split('T')[0].split(' ')[0] : '';
            this.detailForm.day_end = collection?.day_end ? collection.day_end.split('T')[0].split(' ')[0] : '';
            this.detailForm.onedoc_link = collection?.onedoc_link || '';
            this.detailForm.location = collection?.location || '';
            this.detailForm.hour_start = collection?.hour_start || '';
            this.detailForm.hour_end = collection?.hour_end || '';

            this.suppressionInput = '';
        },
        openClotureModal(collection) {
            this.openEditModal(collection);
            this.activeTab = 'cloturer';
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
        async submitCreation() {
            if (this.isSaving) return;
            this.isSaving = true;
            this.errors = {};
            try {
                const response = await fetch(`/api/collection`, {
                    method: 'POST',
                    headers: this.getCsrfHeaders(),
                    body: JSON.stringify(this.detailForm)
                });

                if (!response.ok) {
                    const data = await response.json();
                    if (response.status === 422) {
                        this.errors = data.errors || {};
                        return;
                    }
                    throw new Error("API Error");
                }
                const url = new URL(window.location);
                url.searchParams.delete('action');
                window.location.replace(url);
            } catch (err) {
                console.error(err);
                alert("Erreur lors de la création.");
            } finally {
                this.isSaving = false;
            }
        },
        async submitDetail() {
            if (this.isSaving) return;
            this.isSaving = true;
            this.errors = {};
            try {
                const response = await fetch(`/api/collection/${this.selectedCollecte.id}`, {
                    method: 'PUT',
                    headers: this.getCsrfHeaders(),
                    body: JSON.stringify(this.detailForm)
                });

                if (!response.ok) {
                    const data = await response.json();
                    if (response.status === 422) {
                        this.errors = data.errors || {};
                        return;
                    }
                    throw new Error("API Error");
                }
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
            this.errors = {};
            try {
                const response = await fetch(`/api/collection/${this.selectedCollecte.id}/close`, {
                    method: 'PATCH',
                    headers: this.getCsrfHeaders(),
                    body: JSON.stringify(this.clotureForm)
                });
                if (!response.ok) {
                    const data = await response.json();
                    if (response.status === 422) {
                        this.errors = data.errors || {};
                        return;
                    }
                    throw new Error("API Error");
                }
                window.location.reload();
            } catch (err) {
                console.error(err);
            } finally {
                this.isSaving = false;
            }
        },
        async submitSuppression() {
            if (this.suppressionInput.toLowerCase() !== 'supprimer') return;
            if (this.isSaving) return;
            this.isSaving = true;
            this.errors = {};
            try {
                const response = await fetch(`/api/collection/${this.selectedCollecte.id}`, {
                    method: 'DELETE',
                    headers: this.getCsrfHeaders()
                });
                if (!response.ok) {
                    const data = await response.json();
                    this.errors = { general: [data.message || 'Erreur lors de la suppression.'] };
                    return;
                }
                window.location.reload();
            } catch (err) {
                console.error("Erreur de suppression:", err);
            } finally {
                this.isSaving = false;
            }
        },
        nextMobilePage() {
            if ((this.mobilePage + 1) * 3 < this.filteredAndSortedCollections.length) {
                this.mobilePage++;
            }
        },
        prevMobilePage() {
            if (this.mobilePage > 0) {
                this.mobilePage--;
            }
        }
    },
    watch: {
        searchQuery() {
            this.mobilePage = 0;
        },
        activeFilter() {
            this.mobilePage = 0;
        }
    }
}
</script>
