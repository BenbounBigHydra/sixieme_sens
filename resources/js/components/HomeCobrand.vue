<template>
    <div class="w-full bg-[#fffbf1] min-h-screen relative overflow-x-clip">

        <!-- Part 1 -->
        <section class="relative w-full -mt-24 pt-[144px] md:pt-[224px] pb-24 md:pb-32">
            <!-- Background Union.svg -->
            <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
                <div class="w-full h-full transform scale-100 md:scale-[0.85] origin-right responsive-mask" :style="{
                    backgroundColor: computedCompanyColor
                }">
                </div>
            </div>

            <div class="max-w-desktop mx-auto px-8 md:px-20 lg:px-32 xl:px-40 relative z-10 flex flex-col md:flex-row">
                <div
                    class="w-fit max-w-full bg-[#fffbf1] border-[3px] border-[#0073e6] p-6 md:p-10 relative z-20 flex flex-row items-center justify-start gap-8 md:gap-16 min-h-min md:min-h-[350px]">

                    <!-- Text Content -->
                    <div class="flex flex-col w-full h-full flex-1">
                        <!-- Mobile Layout: Two columns -->
                        <div class="flex md:hidden flex-row justify-between items-start gap-2 mb-6">
                            <!-- Left Col: Title & Date -->
                            <div class="flex flex-col w-1/2 pr-2">
                                <h1
                                    class="font-['Jersey_20'] text-[24px] sm:text-[32px] text-black leading-none mb-1 tracking-wide">
                                    Collecte<br> {{ company?.name || 'HEIG-VD' }}
                                </h1>
                                <p
                                    class="font-['Jersey_20'] text-[24px] sm:text-[32px] text-[#0073e6] leading-none tracking-wide">
                                    {{ formattedDate }}
                                </p>
                            </div>
                            <!-- Right Col: Location & Button -->
                            <div class="flex flex-col w-1/2 items-end text-right">
                                <div class="flex items-center justify-end gap-1 mb-2">
                                    <span
                                        class="font-['Inter'] text-[12px] text-black font-medium leading-tight text-right">
                                        {{ collection?.location || 'Av. des Sports 20, 1401 Yverdon-les-Bains' }}
                                    </span>
                                    <img src="/images/locationBlack.svg" alt="Location" class="w-4 h-4 object-contain"
                                        onerror="this.style.display='none'" />
                                </div>
                                <a :href="quizzUrl"
                                    class="bg-[#0073e6] text-white px-3 py-2 font-['Inter'] text-[12px] font-bold border-[2px] border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[0px_0px_0px_0px_rgba(0,0,0,1)] hover:bg-[#0073e6]/90 transition-all text-center">
                                    Je souhaite donner
                                </a>
                            </div>
                        </div>

                        <!-- Desktop Layout: Single column -->
                        <div class="hidden md:flex flex-col justify-center h-full">
                            <h1
                                class="font-['Jersey_20'] text-[40px] md:text-[56px] text-black leading-none mb-2 tracking-wide">
                                Collecte {{ company?.name || 'HEIG-VD' }}
                            </h1>
                            <p
                                class="font-['Jersey_20'] text-[40px] md:text-[56px] text-[#0073e6] mb-8 leading-none tracking-wide">
                                {{ formattedDate }}
                            </p>
                            <div class="flex items-center gap-3 mb-10">
                                <img src="/images/locationBlack.svg" alt="Location" class="w-5 h-5 object-contain"
                                    onerror="this.style.display='none'" />
                                <span class="font-['Inter'] text-base text-black font-medium leading-tight">
                                    {{ collection?.location || 'Av. des Sports 20, 1401 Yverdon-les-Bains' }}
                                </span>
                            </div>
                            <div class="flex mt-auto">
                                <a :href="quizzUrl"
                                    class="bg-[#0073e6] text-white px-6 py-3 font-['Inter'] text-base font-bold border-[2px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:bg-[#0073e6]/90 transition-all text-center">
                                    Je souhaite donner
                                </a>
                            </div>
                        </div>

                        <!-- Roby Mascot & Bubble (Mobile Only) -->
                        <a :href="quizzUrl"
                            class="md:hidden flex flex-row items-center justify-start w-full h-auto group hover:scale-105 transition-transform origin-bottom mt-2">
                            <img src="/images/dono_smiling.png" alt="Roby"
                                class="w-20 sm:w-24 h-auto object-contain shrink-0" />

                            <!-- Speech Bubble -->
                            <div
                                class="relative ml-4 bg-[#1a81e7] text-white p-2 border-[2px] border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] w-full max-w-[200px] z-50">
                                <p
                                    class="font-['Jersey_20'] tracking-wide text-[14px] leading-tight text-left break-words">
                                    Salut ! Je suis Roby, bienvenue sur le site {{ company?.name || 'HEIG-VD' }}.
                                    J'essaye de donner mon sang, tout comme toi. On part en voyage ?
                                </p>

                                <!-- Arrow pointing left -->
                                <div
                                    class="absolute top-4 -left-[10px] w-0 h-0 border-y-[8px] border-y-transparent border-r-[10px] border-r-black">
                                </div>
                                <div
                                    class="absolute top-[16px] -left-[7px] w-0 h-0 border-y-[6px] border-y-transparent border-r-[8px] border-r-[#1a81e7] z-10">
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Roby Mascot & Bubble (Desktop Only) -->
                    <a :href="quizzUrl"
                        class="hidden md:flex relative items-center justify-center shrink-0 h-full group hover:scale-105 transition-transform origin-bottom mt-0 md:pr-0">
                        <img src="/images/dono_smiling.png" alt="Roby" class="md:h-64 object-contain" />

                        <!-- Speech Bubble -->
                        <div
                            class="absolute bottom-auto top-1/4 left-[90%] ml-6 bg-[#1a81e7] text-white p-4 border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] w-max max-w-[280px] z-50">
                            <p class="font-['Jersey_20'] tracking-wide text-xl leading-tight text-left">
                                Salut ! Je suis Roby, bienvenue sur le site {{ company?.name || 'HEIG-VD' }}. J'essaye
                                de donner mon sang, tout comme toi. On part en voyage ?
                            </p>

                            <!-- Arrow pointing left -->
                            <div
                                class="absolute top-6 -left-[15px] w-0 h-0 border-y-[12px] border-y-transparent border-r-[15px] border-r-black">
                            </div>
                            <div
                                class="absolute top-[27px] -left-[10px] w-0 h-0 border-y-[9px] border-y-transparent border-r-[12px] border-r-[#1a81e7] z-10">
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </section>

        <!-- Part 2: Pourquoi donner son sang -->
        <section class="max-w-desktop mx-auto px-8 md:px-20 lg:px-32 xl:px-40 py-16 relative z-10">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-20 items-center lg:items-start">

                <!-- Left Column -->
                <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start">
                    <img src="/images/YellowSquares.png" alt="Squares"
                        class="h-5 md:h-6 w-auto object-contain mb-4 md:mb-6 origin-center lg:origin-left self-center lg:self-start"
                        onerror="this.style.display='none'" />
                    <h2
                        class="font-['Jersey_20'] text-[36px] md:text-[56px] text-black mb-6 md:mb-8 leading-none tracking-wide text-center lg:text-left">
                        Pourquoi donner son sang ?
                    </h2>
                    <div
                        class="font-['Inter'] text-sm md:text-lg text-black space-y-4 md:space-y-6 mb-8 md:mb-10 leading-relaxed text-left max-w-[500px] lg:max-w-none">
                        <p>Chaque don de sang peut sauver jusqu'à trois vies. Pas trois fois de suite, trois personnes
                            différentes, le même jour, grâce à toi.</p>
                        <p>Ton sang est séparé en plusieurs composants : globules rouges, plaquettes, plasma. Chacun
                            part là où il est le plus nécessaire : un enfant en chimiothérapie, une femme qui vient
                            d'accoucher, un accidenté en salle d'opération.</p>
                        <p>Les besoins sont constants, c'est pourquoi chaque collecte compte, et chaque donneur aussi.
                        </p>
                    </div>

                    <!-- Stats Replacement -->
                    <div
                        class="flex flex-row items-center justify-center lg:justify-start gap-2 md:gap-3 mb-8 md:mb-10 w-full relative">
                        <div
                            class="font-['Jersey_20'] text-[40px] md:text-[64px] text-[#0073e6] leading-none tracking-wide -mt-1">
                            {{ participationRate }}%
                        </div>
                        <div class="flex flex-col justify-center text-left mt-1">
                            <span
                                class="font-['Jersey_20'] text-[20px] md:text-[32px] font-normal text-black leading-tight tracking-wide">de
                                participation,</span>
                            <span
                                class="font-['Jersey_20'] text-[20px] md:text-[32px] font-normal text-black leading-tight tracking-wide flex items-center">
                                <span><span class="text-[#0073e6]">{{ livesSaved }}</span> vies sauvées.</span>
                                <div class="relative group inline-flex ml-1 -mt-3">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 cursor-pointer">
                                        <path
                                            d="M21 8V6H20V4H19V3H18V2H16V1H14V0H8V1H6V2H4V3H3V4H2V6H1V8H0V14H1V16H2V18H3V19H4V20H6V21H8V22H14V21H16V20H18V19H19V18H20V16H21V14H22V8H21ZM10 5H12V7H10V5ZM9 14H10V9H9V8H12V14H13V16H9V14Z"
                                            fill="#1980e7" />
                                    </svg>
                                    <div v-if="previousCollection"
                                        class="absolute bottom-full right-[-20px] md:right-auto md:left-1/2 md:-translate-x-1/2 mb-2 w-[250px] bg-white border-2 border-black p-3 text-sm text-black font-['Inter'] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                                        Chiffres renseignés sur la base de la dernière collecte de votre entreprise
                                    </div>
                                    <div v-else
                                        class="absolute bottom-full right-[-20px] md:right-auto md:left-1/2 md:-translate-x-1/2 mb-2 w-[250px] bg-white border-2 border-black p-3 text-sm text-black font-['Inter'] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                                        Chiffres renseignés sur la base d'une entreprise fictive
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>

                    <div class="flex justify-center lg:justify-start w-full">
                        <a :href="quizzUrl"
                            class="bg-[#0073e6] text-white px-6 md:px-8 py-2 md:py-3 font-['Inter'] text-sm md:text-lg font-bold border-[2px] md:border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:bg-[#0073e6]/90 transition-all text-center">
                            Donner mon sang
                        </a>
                    </div>
                </div>

                <!-- Right Column: Gauge -->
                <div class="w-full lg:w-1/2 flex flex-col pt-8 lg:pt-0 lg:mt-[52px]">
                    <!-- Desktop Grid Container -->
                    <div class="hidden lg:block relative w-full mb-4">
                        <!-- Background Grid (Icons) -->
                        <div
                            style="display: grid; grid-template-columns: repeat(15, minmax(0, 1fr)); grid-auto-rows: 1fr; gap: 6px 2px;">
                            <template v-for="i in 150" :key="i">
                                <a :href="quizzUrl" v-if="i === desktopRobyIndex"
                                    class="relative w-full h-full flex items-center justify-center cursor-pointer"
                                    :class="(isHovered || isClicked) ? 'z-40' : 'z-0'"
                                    @mouseenter="handleRobotHover(true)" @mouseleave="handleRobotHover(false)"
                                    @click="handleRobotClick">
                                    <img src="/images/dono_default.png" alt="Robot"
                                        class="w-full h-full object-contain scale-[0.8]" />
                                    <div v-show="isHovered || isClicked"
                                        class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-[#0073e6] text-white font-['Jersey_20'] tracking-wide text-2xl px-4 py-2 border-2 border-black whitespace-nowrap shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] pointer-events-none z-[100]">
                                        Viens faire le quiz !
                                    </div>
                                </a>
                                <img v-else-if="i <= blueCountDesktop" src="/images/littleman_blue.png"
                                    alt="Blue Person" class="w-full h-auto object-contain scale-[2]" />
                                <img v-else src="/images/littleman_grey.png" alt="Grey Person"
                                    class="w-full h-auto object-contain scale-[2]" />
                            </template>
                        </div>

                        <!-- Foreground Overlay Grid (Center White Square) -->
                        <div class="absolute inset-0 pointer-events-none"
                            style="display: grid; grid-template-columns: repeat(15, minmax(0, 1fr)); grid-template-rows: repeat(10, minmax(0, 1fr)); gap: 6px 2px;">
                            <div class="bg-[#fffbf1] flex flex-col items-center justify-center relative z-10 pointer-events-auto"
                                style="grid-column: 5 / 12; grid-row: 4 / 7;">
                                <span
                                    class="text-[#0073e6] font-['Jersey_20'] text-[48px] lg:text-[48px] leading-[0.8] mb-0">{{
                                    livesSaved
                                    }}</span>
                                <span
                                    class="text-[#0073e6] font-['Jersey_20'] text-base leading-tight text-center tracking-wide -mt-1 lg:-mt-1">
                                    Potentielles vies<br />sauvées
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Grid Container -->
                    <div class="block lg:hidden relative w-full max-w-[320px] mx-auto mb-4 mt-4">
                        <!-- Background Grid (Icons) -->
                        <div
                            style="display: grid; grid-template-columns: repeat(8, minmax(0, 1fr)); grid-auto-rows: 1fr; gap: 0px 0px;">
                            <template v-for="i in 32" :key="'mobile-' + i">
                                <a :href="quizzUrl" v-if="i === mobileRobyIndex"
                                    class="relative w-full h-full flex items-center justify-center cursor-pointer"
                                    :class="(isHovered || isClicked) ? 'z-40' : 'z-0'"
                                    @mouseenter="handleRobotHover(true)" @mouseleave="handleRobotHover(false)"
                                    @click="handleRobotClickMobile($event)">
                                    <img src="/images/dono_default.png" alt="Robot"
                                        class="w-full h-full object-contain scale-[0.6]" />
                                    <div v-show="isHovered || isClicked"
                                        class="absolute bottom-full mb-2 bg-[#0073e6] text-white font-['Jersey_20'] tracking-wide text-xl md:text-2xl px-2 py-1 md:px-4 md:py-2 border-2 border-black whitespace-nowrap shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] pointer-events-none z-[100]"
                                        :class="[
                                            // Mobile: align left if on left edge, right if on right edge, otherwise center
                                            (i - 1) % 8 < 3 ? 'max-md:left-0 max-md:translate-x-0' : '',
                                            (i - 1) % 8 > 4 ? 'max-md:right-0 max-md:translate-x-0' : '',
                                            (i - 1) % 8 >= 3 && (i - 1) % 8 <= 4 ? 'max-md:left-1/2 max-md:-translate-x-1/2' : ''
                                        ]">
                                        Viens faire le quiz !
                                    </div>
                                </a>
                                <img v-else-if="i <= blueCountMobile" src="/images/littleman_blue.png" alt="Blue Person"
                                    class="w-full h-auto object-contain scale-[1.5]" />
                                <img v-else src="/images/littleman_grey.png" alt="Grey Person"
                                    class="w-full h-auto object-contain scale-[1.5]" />
                            </template>
                        </div>

                        <!-- Foreground Overlay Grid Mobile -->
                        <div class="absolute inset-0 pointer-events-none"
                            style="display: grid; grid-template-columns: repeat(8, minmax(0, 1fr)); grid-template-rows: repeat(4, minmax(0, 1fr)); gap: 0px 0px;">
                            <div class="bg-[#fffbf1] flex flex-col items-center justify-center relative z-10 pointer-events-auto"
                                style="grid-column: 3 / 7; grid-row: 2 / 4;">
                                <span class="text-[#0073e6] font-['Jersey_20'] text-[36px] leading-[0.8] mb-0 mt-1">{{
                                    livesSaved }}</span>
                                <span
                                    class="text-[#0073e6] font-['Jersey_20'] text-[12px] leading-tight text-center tracking-wide mt-1">
                                    Potentielles vies<br />sauvées
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    <!-- Part 3: Ils témoignent -->
    <section class="max-w-desktop mx-auto px-8 md:px-20 lg:px-32 xl:px-40 py-12 md:py-16 relative z-10">
      <div class="mb-8 md:mb-10 flex flex-col items-center md:items-start text-center md:text-left">
        <img src="/images/YellowSquares.png" alt="Squares" class="h-5 md:h-6 w-auto object-contain mb-4 md:mb-6 origin-center md:origin-left" onerror="this.style.display='none'" />
        <h2 class="font-['Jersey_20'] text-[36px] md:text-[48px] text-black leading-none tracking-wide">
          Ils témoignent
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Block 1 -->
        <div class="flex flex-row xl:flex-row border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] bg-[#fffbf1]">
          <div class="w-1/3 xl:w-1/3 p-2 md:p-4 flex items-center justify-center shrink-0">
             <img :src="marieClaireImage || '/images/dono_smiling.png'" alt="Marie-Claire" class="w-20 h-20 md:w-32 md:h-32 xl:w-48 xl:h-48 object-contain" onerror="this.style.display='none'" />
          </div>
          <div class="w-2/3 xl:w-2/3 bg-[#ffd012] p-4 md:p-6 border-l-[3px] border-black flex flex-col justify-center">
             <img src="/images/quoteBlack.svg" alt="Quote" class="w-4 h-4 md:w-6 md:h-6 mb-2 md:mb-4" onerror="this.style.display='none'" />
             <p class="font-['Inter'] text-[13px] md:text-[15px] leading-relaxed text-black font-bold mb-2 md:mb-4 flex-grow">J'avais toujours repoussé. Là, c'était dans les locaux, pendant la pause, j'ai sauté le pas.</p>
             <p class="font-['Inter'] text-[11px] md:text-sm text-black mt-auto">— Marie-Claire, assistante RH</p>
          </div>
        </div>

        <!-- Block 2 -->
        <div class="flex flex-row xl:flex-row border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] bg-[#fffbf1]">
          <div class="w-1/3 xl:w-1/3 p-2 md:p-4 flex items-center justify-center shrink-0">
             <img :src="thomasImage || '/images/dono_smiling.png'" alt="Thomas" class="w-20 h-20 md:w-32 md:h-32 xl:w-48 xl:h-48 object-contain" onerror="this.style.display='none'" />
          </div>
          <div class="w-2/3 xl:w-2/3 bg-[#ffd012] p-4 md:p-6 border-l-[3px] border-black flex flex-col justify-center">
             <img src="/images/quoteBlack.svg" alt="Quote" class="w-4 h-4 md:w-6 md:h-6 mb-2 md:mb-4" onerror="this.style.display='none'" />
             <p class="font-['Inter'] text-[13px] md:text-[15px] leading-relaxed text-black font-bold mb-2 md:mb-4 flex-grow">Vingt minutes, un peu de jus d'orange, et potentiellement une vie sauvée. Ça remet les choses en perspective.</p>
             <p class="font-['Inter'] text-[11px] md:text-sm text-black mt-auto">— Thomas, développeur</p>
          </div>
        </div>

        <!-- Block 3 -->
        <div class="flex flex-row xl:flex-row border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] bg-[#fffbf1]">
          <div class="w-1/3 xl:w-1/3 p-2 md:p-4 flex items-center justify-center shrink-0">
             <img :src="anonymeImage || '/images/littleman_blue.png'" alt="Anonyme" class="w-16 h-16 md:w-24 md:h-24 xl:w-40 xl:h-40 object-contain" onerror="this.style.display='none'" />
          </div>
          <div class="w-2/3 xl:w-2/3 bg-[#ffd012] p-4 md:p-6 border-l-[3px] border-black flex flex-col justify-center">
             <img src="/images/quoteBlack.svg" alt="Quote" class="w-4 h-4 md:w-6 md:h-6 mb-2 md:mb-4" onerror="this.style.display='none'" />
             <p class="font-['Inter'] text-[13px] md:text-[15px] leading-relaxed text-black font-bold mb-2 md:mb-4 flex-grow">Je ne savais pas si j'étais éligible. Le quiz m'a rassuré en deux minutes.</p>
             <p class="font-['Inter'] text-[11px] md:text-sm text-black mt-auto">— Collaborateur anonyme</p>
          </div>
        </div>

      </div>
    </section>

        <!-- Part 4: Questions fréquentes -->
        <section
            class="max-w-desktop mx-auto px-8 md:px-20 lg:px-32 xl:px-40 py-12 md:py-16 mb-12 md:mb-20 relative z-10">
            <div class="mb-8 md:mb-10 flex flex-col items-center md:items-start text-center md:text-left">
                <img src="/images/YellowSquares.png" alt="Squares"
                    class="h-5 md:h-6 w-auto object-contain mb-4 md:mb-6 origin-center md:origin-left"
                    onerror="this.style.display='none'" />
                <h2 class="font-['Jersey_20'] text-[36px] md:text-[48px] text-black leading-none tracking-wide">
                    Questions fréquentes
                </h2>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 lg:gap-8 items-start">
                <!-- FAQ List (Left) -->
                <div class="w-full lg:w-7/12">
                    <div v-for="(item, index) in faqList" :key="index" class="border-b-[1px] border-[#0073e6]">
                        <button @click="toggleFaq(index)"
                            class="w-full flex items-center justify-between py-3 md:py-6 text-left hover:bg-black/5 transition-colors focus:outline-none">
                            <span class="font-['Inter'] text-sm md:text-lg pr-4"
                                :class="openFaq === index ? 'font-bold text-[#0073e6]' : 'text-black'">{{ item.q
                                }}</span>
                        </button>

                        <!-- Mobile Inline Roby & Answer (Phones only < 768px) -->
                        <div v-if="openFaq === index"
                            class="block md:hidden w-full flex flex-col items-center justify-center gap-3 py-4 relative">
                            <!-- Speech Bubble -->
                            <div
                                class="relative bg-[#1a81e7] text-white p-3 border-[2px] border-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] w-full max-w-sm z-20">
                                <div class="font-['Inter'] text-xs leading-relaxed">
                                    <p>{{ faqList[openFaq].a }}</p>
                                    <div v-if="faqList[openFaq].button" class="mt-4">
                                        <a :href="quizzUrl"
                                            class="inline-block bg-white text-[#0073e6] px-4 py-2 font-bold text-sm border-[2px] border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:bg-gray-100 transition-colors">
                                            {{ faqList[openFaq].button }}
                                        </a>
                                    </div>
                                </div>
                                <!-- Arrow for mobile (pointing down towards Roby) -->
                                <div
                                    class="absolute -bottom-[15px] left-1/2 -translate-x-1/2 w-0 h-0 border-x-[12px] border-x-transparent border-t-[15px] border-t-black">
                                </div>
                                <div
                                    class="absolute -bottom-[10px] left-1/2 -translate-x-1/2 w-0 h-0 border-x-[9px] border-x-transparent border-t-[12px] border-t-[#1a81e7] z-10">
                                </div>
                            </div>
                            <!-- Roby -->
                            <img src="/images/roby_smiling_left.png" alt="Roby"
                                class="h-32 object-contain shrink-0 mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Roby & Speech Bubble (Right - Desktop & Tablet only) -->
                <div class="hidden md:flex w-full lg:w-5/12 flex-col md:flex-row items-center md:items-start justify-center lg:justify-end gap-6 relative mt-8 lg:mt-0 lg:sticky lg:top-32"
                    ref="robyFaqContainer">
                    <!-- Speech Bubble -->
                    <div
                        class="relative bg-[#1a81e7] text-white p-6 border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] w-full md:w-[300px] z-20">
                        <div v-if="openFaq === null"
                            class="font-['Jersey_20'] tracking-wide text-[28px] leading-tight text-left">
                            Qu'aimerais-tu savoir ?
                        </div>
                        <div v-else class="font-['Inter'] text-sm md:text-base leading-relaxed">
                            <p>{{ faqList[openFaq].a }}</p>
                            <div v-if="faqList[openFaq].button" class="mt-4">
                                <a :href="quizzUrl"
                                    class="inline-block bg-white text-[#0073e6] px-4 py-2 font-bold text-sm border-[2px] border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:bg-gray-100 transition-colors">
                                    {{ faqList[openFaq].button }}
                                </a>
                            </div>
                        </div>

                        <!-- Arrow for desktop (pointing right towards Roby) -->
                        <div
                            class="hidden md:block absolute top-10 -right-[15px] w-0 h-0 border-y-[12px] border-y-transparent border-l-[15px] border-l-black">
                        </div>
                        <div
                            class="hidden md:block absolute top-[43px] -right-[10px] w-0 h-0 border-y-[9px] border-y-transparent border-l-[12px] border-l-[#1a81e7] z-10">
                        </div>

                        <!-- Arrow for mobile (pointing down towards Roby) -->
                        <div
                            class="block md:hidden absolute -bottom-[15px] left-1/2 -translate-x-1/2 w-0 h-0 border-x-[12px] border-x-transparent border-t-[15px] border-t-black">
                        </div>
                        <div
                            class="block md:hidden absolute -bottom-[10px] left-1/2 -translate-x-1/2 w-0 h-0 border-x-[9px] border-x-transparent border-t-[12px] border-t-[#1a81e7] z-10">
                        </div>
                    </div>

                    <!-- Roby -->
                    <img src="/images/roby_smiling_left.png" alt="Roby" class="h-40 md:h-48 object-contain shrink-0" />
                </div>
            </div>
        </section>

    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    initialData: {
        type: [Object, String],
        default: () => ({})
    }
});

const parsedData = computed(() => {
    if (typeof props.initialData === 'string') {
        try { return JSON.parse(props.initialData); } catch (e) { return {}; }
    }
    return props.initialData || {};
});

const collection = computed(() => parsedData.value.collection);
const company = computed(() => parsedData.value.company);
const previousCollection = computed(() => parsedData.value.previousCollection);

const computedCompanyColor = computed(() => {
    if (!company.value?.color) return '#0073e6';
    return company.value.color.startsWith('#') ? company.value.color : `#${company.value.color}`;
});

const formattedDate = computed(() => {
    if (collection.value?.day_start) {
        const d = new Date(collection.value.day_start);
        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        return d.toLocaleDateString('fr-CH', options);
    }
    return '15 juin 2026';
});

const companySlug = ref('');
const collectionId = ref('');

const desktopRobyIndex = ref(73);
const mobileRobyIndex = ref(23);
let robyInterval = null;

const littleMenImages = [
    '1_dark_bun_red.png',
    '1_dark_bun_yellow.png',
    '1_mid_bun_green.png',
    '1_mid_bun_purple.png',
    '1_pale_bun_blue.png',
    '1_pale_bun_yellow.png',
    'dark_nobun_purple.png',
    'dark_nobun_red.png',
    'mid_nobun_green.png',
    'mid_nobun_yellow.png',
    'pale_nobun_blue.png',
    'pale_nobun_purple.png'
];

const marieClaireImage = ref('');
const thomasImage = ref('');
const anonymeImage = ref('');

onMounted(() => {
    const parts = window.location.pathname.split('/');
    companySlug.value = parts[2] || '';
    collectionId.value = parts[3] || '';

    robyInterval = setInterval(() => {
        desktopRobyIndex.value = Math.floor(Math.random() * 150) + 1;
        mobileRobyIndex.value = Math.floor(Math.random() * 32) + 1;
    }, 5000);

    const randomEl = (arr) => arr[Math.floor(Math.random() * arr.length)];

    const marieList = littleMenImages.filter(img => img.startsWith('1_'));
    const thomasList = littleMenImages.filter(img => !img.startsWith('1_'));

    const marie = randomEl(marieList);
    const thomas = randomEl(thomasList);

    const remainingList = littleMenImages.filter(img => img !== marie && img !== thomas);
    const anonyme = randomEl(remainingList);

    marieClaireImage.value = `/images/littleMen/${marie}`;
    thomasImage.value = `/images/littleMen/${thomas}`;
    anonymeImage.value = `/images/littleMen/${anonyme}`;
});

onUnmounted(() => {
    if (robyInterval) clearInterval(robyInterval);
});

const participationRate = computed(() => {
    const emp = previousCollection.value?.nb_employee;
    const reg = previousCollection.value?.nb_registered;
    if ((emp && reg !== undefined) && reg !== null) {
        return Math.round((reg / emp) * 100);
    }
    return 50; // fallback
});

const blueCountDesktop = computed(() => {
    return Math.round((participationRate.value / 100) * 150);
});

const blueCountMobile = computed(() => {
    return Math.round((participationRate.value / 100) * 32);
});

const livesSaved = computed(() => {
    const reg = previousCollection.value?.nb_registered;
    if (reg !== undefined && reg !== null) {
        return reg * 3;
    }
    return 130; // fallback
});

const quizzUrl = computed(() => {
    if (!companySlug.value) return '#';
    return `/collection/${companySlug.value}/${collectionId.value}/quizz`;
});

// Gauge Logic
const isHovered = ref(false);
const isClicked = ref(false);
let clickTimeout = null;

const handleRobotHover = (state) => {
    isHovered.value = state;
};

const handleRobotClick = () => {
    isClicked.value = true;
    if (robyInterval) {
        clearInterval(robyInterval);
        robyInterval = null;
    }
    if (clickTimeout) clearTimeout(clickTimeout);
    clickTimeout = setTimeout(() => {
        isClicked.value = false;
    }, 3000);
};

const handleRobotClickMobile = (e) => {
    if (window.innerWidth < 768) {
        if (!isClicked.value) {
            e.preventDefault();
            isClicked.value = true;
            if (robyInterval) {
                clearInterval(robyInterval);
                robyInterval = null;
            }
        }
    } else {
        handleRobotClick();
    }
};

// Roby Hero Logic
const isRobyHeroHovered = ref(false);
const isRobyHeroClicked = ref(false);
let robyHeroTimeout = null;

const handleRobyHeroHover = (state) => {
    isRobyHeroHovered.value = state;
};

const handleRobyHeroClick = () => {
    isRobyHeroClicked.value = true;
    if (robyHeroTimeout) clearTimeout(robyHeroTimeout);
    robyHeroTimeout = setTimeout(() => {
        isRobyHeroClicked.value = false;
    }, 4000);
};

// FAQ Logic
const openFaq = ref(null);
const robyFaqContainer = ref(null);

const toggleFaq = (index) => {
    openFaq.value = openFaq.value === index ? null : index;
    if (openFaq.value !== null && window.innerWidth < 1024) {
        setTimeout(() => {
            if (robyFaqContainer.value) {
                robyFaqContainer.value.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }, 100);
    }
};

const faqList = [
    {
        q: "J'ai peur des aiguilles, est-ce que ça fait mal ?",
        a: "La sensation est brève et comparable à une prise de sang. La plupart des donneurs sont surpris par la simplicité du geste."
    },
    {
        q: "Je ne sais pas si je peux donner, comment le savoir ?",
        a: "C'est normal de ne pas savoir. Notre quiz d'éligibilité vous répond en moins de 5 minutes.",
        button: "Faire le quiz"
    },
    {
        q: "Est-ce que ça prend beaucoup de temps ?",
        a: "Le don dure 45 minutes en tout, pause collation comprise. Vous pouvez reprendre vos activités immédiatement après."
    },
    {
        q: "Puis-je donner si je prends des médicaments ?",
        a: "Cela dépend du médicament. Certains traitements sont compatibles avec le don, d'autres non. Le médecin présent le jour de la collecte peut vous renseigner. En cas de doute, contactez le CTS avant."
    },
    {
        q: "Combien de fois par an puis-je donner ?",
        a: "Pour le don de sang total, vous pouvez donner jusqu'à 4 fois par an, avec un intervalle minimum de 8 semaines entre chaque don."
    },
    {
        q: "Est-ce que je peux manger avant de donner ?",
        a: "Oui, et c'est même recommandé. Mangez normalement avant votre don et hydratez-vous bien. Évitez les repas trop gras dans les heures qui précèdent."
    },
    {
        q: "Que se passe-t-il si je ne suis pas éligible le jour J ?",
        a: "Aucun souci. L'éligibilité est évaluée le jour même par un médecin. Si vous ne pouvez pas donner ce jour-là, vous recevrez des informations sur les prochaines opportunités."
    },
    {
        q: "Mes données médicales sont-elles confidentielles ?",
        a: "Oui, entièrement. L'entretien médical est confidentiel et vos données sont traitées selon la législation suisse sur la protection des données."
    }
];
</script>

<style scoped>
.responsive-mask {
    mask-image: url('/images/background_pixel_gradient_radial_square.svg');
    -webkit-mask-image: url('/images/background_pixel_gradient_radial_square.svg');
    mask-size: 100% 100%;
    -webkit-mask-size: 100% 100%;
    mask-position: center;
    -webkit-mask-position: center;
    mask-repeat: no-repeat;
    -webkit-mask-repeat: no-repeat;
}

@media (min-width: 768px) {
    .responsive-mask {
        mask-image: url('/images/Union.svg');
        -webkit-mask-image: url('/images/Union.svg');
        mask-size: cover;
        -webkit-mask-size: cover;
        mask-position: right;
        -webkit-mask-position: right;
    }
}
</style>
