<template>
  <div class="w-full bg-[#fffbf1] min-h-screen">
    
    <!-- Part 1: Hero Section -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 pt-12 pb-20">
      <div class="flex flex-col lg:flex-row justify-between items-center gap-2 lg:gap-20">
        
        <!-- Left Column -->
        <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start text-center lg:text-left order-1 lg:order-1 mt-6 lg:mt-0">
          <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-8 origin-center lg:origin-left" />
          
          <h1 class="font-['Jersey_20'] text-[48px] md:text-[64px] font-bold text-black mb-6 leading-[1.1] tracking-wide">
            Trois trophées pour une<br class="hidden md:block" /> mission commune.
          </h1>
          
          <p class="font-['Inter'] text-lg text-black mb-0 lg:mb-10 max-w-lg">
            Chaque année, les Trophées HUG récompensent les entreprises genevoises selon trois critères distincts : mobilisation, fidélité et rigueur.
          </p>
          
          <a href="/collecte" class="hidden lg:inline-block bg-[#0073e6] text-white font-['Inter'] text-base md:text-xl font-bold tracking-wide px-8 py-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] border-2 border-black hover:bg-[#0073e6]/90 transition-colors">
            Rejoindre le mouvement
          </a>
        </div>

        <!-- Right Column -->
        <div class="w-full lg:w-1/2 flex justify-center order-2 lg:order-2 mt-2 lg:mt-0">
          <div class="relative w-[380px] h-[380px] md:w-[400px] md:h-[400px] group cursor-pointer">
            <img src="/images/trophy_gold.png" alt="Trophée" class="absolute inset-0 w-full h-full object-contain group-hover:opacity-0 transition-opacity duration-300">
            <img src="/images/trophy_gold_sparks.png" alt="Trophée Étincelles" class="absolute inset-0 w-full h-full object-contain opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          </div>
        </div>

        <!-- Mobile Button & Arrow -->
        <div class="w-full flex flex-col items-center justify-center order-3 lg:hidden mt-2">
          <a href="/collecte" class="inline-block bg-[#0073e6] text-white font-['Inter'] text-base md:text-xl font-bold tracking-wide px-8 py-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] border-2 border-black hover:bg-[#0073e6]/90 transition-colors">
            Rejoindre le mouvement
          </a>
          <div class="mt-8 text-black text-4xl font-bold font-['Inter']">
            ↓
          </div>
        </div>

      </div>
    </section>

    <!-- Part 2: 3 Trophies -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 py-16">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Or -->
        <div class="bg-[#fffbf1] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="bg-[#ffd012] p-4 border-b-[4px] border-black">
            <h2 class="font-['Jersey_20'] font-bold text-[32px] text-black">Or</h2>
          </div>
          <div class="p-6 flex flex-row items-center gap-6 flex-1">
            <div class="w-24 shrink-0">
              <img src="/images/trophy_gold.png" alt="Trophée Or" class="w-full h-auto object-contain">
            </div>
            <div class="font-['Inter'] text-sm md:text-base text-black">
              La meilleure mobilisation de l'année. Calculé sur le ratio poches collectées / collaborateurs.
            </div>
          </div>
        </div>

        <!-- Ambassadeur -->
        <div class="bg-[#fffbf1] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="bg-[#ffd012] p-4 border-b-[4px] border-black">
            <h2 class="font-['Jersey_20'] font-bold text-[32px] text-black">Ambassadeur</h2>
          </div>
          <div class="p-6 flex flex-row items-center gap-6 flex-1">
            <div class="w-24 shrink-0">
              <img src="/images/trophy_conviction (1).png" alt="Trophée Ambassadeur" class="w-full h-auto object-contain">
            </div>
            <div class="font-['Inter'] text-sm md:text-base text-black">
              La fidélité récompensée dans la durée. Une absence remet le compteur à zéro.
            </div>
          </div>
        </div>

        <!-- Conviction -->
        <div class="bg-[#fffbf1] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="bg-[#ffd012] p-4 border-b-[4px] border-black">
            <h2 class="font-['Jersey_20'] font-bold text-[32px] text-black">Conviction</h2>
          </div>
          <div class="p-6 flex flex-row items-center gap-6 flex-1">
            <div class="w-24 shrink-0">
              <img src="/images/trophy_conviction.png" alt="Trophée Conviction" class="w-full h-auto object-contain">
            </div>
            <div class="font-['Inter'] text-sm md:text-base text-black">
              La rigueur du suivi interne. Calculé sur le taux de présence le jour J.
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- Part 3: Palmarès 2025 -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 py-16">
      <div class="flex flex-col items-center md:items-start mb-10">
        <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
        <h2 class="font-['Jersey_20'] font-bold text-[48px] md:text-[56px] text-black leading-none">Palmarès 2025</h2>
        
        <!-- Mobile Filter Button -->
        <div class="mt-6 md:hidden">
          <button class="bg-[#0073e6] text-white font-['Inter'] px-6 py-2 flex items-center gap-2">
            Filtres
            <img src="/images/WhiteChevronDown.svg" alt="Chevron Down" class="w-4 h-4" />
          </button>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full min-w-[320px] md:min-w-[700px] text-left border-collapse">
          <thead class="hidden md:table-header-group">
            <tr class="border-b-[3px] border-[#B3D9FF]">
              <th class="py-4 px-2"></th>
              <th class="py-4 px-2 font-['Jersey_20'] text-[24px] text-black font-normal">Gagnant</th>
              <th class="py-4 px-2 font-['Jersey_20'] text-[24px] text-black font-normal text-center">Nbr employé total</th>
              <th class="py-4 px-2 font-['Jersey_20'] text-[24px] text-black font-normal text-center">Nbr de poches récoltées</th>
              <th class="py-4 px-2 font-['Jersey_20'] text-[24px] text-black font-normal text-center">Score</th>
            </tr>
          </thead>
          <tbody>
            <!-- Or -->
            <tr class="border-b-[3px] border-[#B3D9FF]">
              <td class="py-4 px-2 w-20">
                <img src="/images/trophy_gold.png" alt="Or" class="w-12 h-12 object-contain">
              </td>
              <td class="py-4 px-2 font-['Jersey_20'] text-[28px] text-black">Pictet & Cie</td>
              <td class="py-4 px-2 font-['Jersey_20'] text-[28px] text-black text-center">8'000</td>
              <td class="py-4 px-2 font-['Jersey_20'] text-[28px] text-black text-center">1'722</td>
              <td class="py-4 px-2 font-['Jersey_20'] text-[28px] text-black text-center">?</td>
            </tr>
            <!-- Ambassadeur -->
            <tr class="border-b-[3px] border-[#B3D9FF]">
              <td class="py-4 px-2 w-20">
                <img src="/images/trophy_conviction (1).png" alt="Ambassadeur" class="w-12 h-12 object-contain">
              </td>
              <td class="py-4 px-2 font-['Jersey_20'] text-[28px] text-black">Rolex SA</td>
              <td class="py-4 px-2 font-['Jersey_20'] text-[28px] text-black text-center">10'000</td>
              <td class="py-4 px-2 font-['Jersey_20'] text-[28px] text-black text-center">2'212</td>
              <td class="py-4 px-2 font-['Jersey_20'] text-[28px] text-black text-center">?</td>
            </tr>
            <!-- Conviction -->
            <tr class="border-b-[3px] border-[#B3D9FF]">
              <td class="py-4 px-2 w-20">
                <img src="/images/trophy_conviction.png" alt="Conviction" class="w-12 h-12 object-contain">
              </td>
              <td class="py-4 px-2 font-['Jersey_20'] text-[28px] text-black">BCG</td>
              <td class="py-4 px-2 font-['Jersey_20'] text-[28px] text-black text-center">6'000</td>
              <td class="py-4 px-2 font-['Jersey_20'] text-[28px] text-black text-center">1'783</td>
              <td class="py-4 px-2 font-['Jersey_20'] text-[28px] text-black text-center">?</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Part 4: Section avantages -->
    <section class="max-w-desktop mx-auto px-4 md:px-8 py-16 pb-32">
      <div class="flex flex-col items-center md:items-start mb-12">
        <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-6 origin-center md:origin-left" />
        <h2 class="font-['Jersey_20'] font-bold text-[48px] md:text-[56px] text-black leading-none">Ce que le Trophée distingue.</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Block 1 -->
        <div class="bg-[#80c0ff] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4">
            <h3 class="font-['Jersey_20'] font-bold text-[28px] text-black leading-tight text-center md:text-left">La distinction publique</h3>
          </div>
          <div class="p-6 text-center md:text-left">
            <p class="font-inter text-sm text-black">Vos collaborateurs, vos partenaires et les médias genevois voient votre nom en tête du palmarès.</p>
          </div>
        </div>

        <!-- Block 2 -->
        <div class="bg-[#80c0ff] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4">
            <h3 class="font-['Jersey_20'] font-bold text-[28px] text-black leading-tight text-center md:text-left">Un symbole fort</h3>
          </div>
          <div class="p-6 text-center md:text-left">
            <p class="font-inter text-sm text-black">Un trophée physique remis par le Directeur Général des HUG lors d'une cérémonie officielle.</p>
          </div>
        </div>

        <!-- Block 3 -->
        <div class="bg-[#80c0ff] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4">
            <h3 class="font-['Jersey_20'] font-bold text-[28px] text-black leading-tight text-center md:text-left">Une caisse de résonance</h3>
          </div>
          <div class="p-6 text-center md:text-left">
            <p class="font-inter text-sm text-black">Un communiqué de presse co-signé HUG diffusé auprès des médias genevois.</p>
          </div>
        </div>

        <!-- Block 4 -->
        <div class="bg-[#80c0ff] border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-[#fffbf1] p-4">
            <h3 class="font-['Jersey_20'] font-bold text-[28px] text-black leading-tight text-center md:text-left">Une présence permanente</h3>
          </div>
          <div class="p-6 text-center md:text-left">
            <p class="font-inter text-sm text-black">Votre entreprise en première page du site pendant un an.</p>
          </div>
        </div>

      </div>
    </section>

  </div>
</template>

<script setup>
</script>
