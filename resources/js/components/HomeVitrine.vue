<template>
  <!-- Composant principal pour la page d'accueil -->
  <div class="w-full bg-[#FCFBF6] min-h-screen">
    
    <!-- Section principale (Hero) -->
    <section class="max-w-desktop mx-auto px-4 md:px-[80px] pt-12 pb-20">
      <!-- Avertissement de projet académique -->
      <div class="bg-red-200 text-red-800 font-inter font-bold text-center py-2 mb-12">
        Ceci est projet réalisé dans un cadre académique. Ne prenez pas rendez-vous ;)
      </div>

      <div class="flex flex-col md:flex-row justify-between gap-12">
        <div class="w-full md:w-1/2">
          <!-- Petits carrés décoratifs -->
          <div class="flex gap-2 mb-6">
            <span class="w-3 h-3 bg-hugCream"></span>
            <span class="w-3 h-3 bg-hugCream"></span>
            <span class="w-3 h-3 bg-hugCream"></span>
            <span class="w-3 h-3 bg-hugCream"></span>
            <span class="w-3 h-3 bg-hugCream"></span>
          </div>
          
          <!-- Titre principal -->
          <h1 class="font-jersey text-[56px] leading-[105%] text-black mb-10">
            Mobilisez votre équipe <br /> pour le don du sang !
          </h1>
          
          <!-- Statistiques -->
          <div class="flex gap-8 mb-10">
            <div>
              <p class="font-jersey text-[48px] text-hugBlue leading-none">1500</p>
              <p class="font-inter text-xs font-bold uppercase">Collectes<br/>organisées</p>
            </div>
            <div>
              <p class="font-jersey text-[48px] text-hugBlue leading-none">142</p>
              <p class="font-inter text-xs font-bold uppercase">Entreprises<br/>mobilisées</p>
            </div>
          </div>

          <!-- Bouton d'action -->
          <a href="/contact" class="inline-block bg-hugBlue text-white font-bold px-6 py-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] border-2 border-transparent hover:border-black transition">
            Organiser une collecte
          </a>
          
          <div class="mt-8">
            <span class="text-hugBlue text-4xl font-bold">↓</span>
          </div>
        </div>

        <div class="w-full md:w-1/2 flex justify-center">
           <!-- Image en pixel art (personnes) -->
           <img src="/images/pixel_art.png" alt="Personnes" class="w-full max-w-[400px] h-auto object-contain">
        </div>
      </div>
    </section>

    <!-- Section Classement 2025 -->
    <section class="max-w-desktop mx-auto px-4 md:px-[80px] py-16">
      
      <!-- Conteneur style fenêtre rétro -->
      <div class="border-[4px] border-black bg-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
        <!-- Barre de titre de la fenêtre -->
        <div class="bg-[#322947] h-8 flex items-center justify-end px-4 gap-2 border-b-[4px] border-black">
          <span class="w-3 h-3 bg-green-500"></span>
          <span class="w-3 h-3 bg-hugCream"></span>
          <span class="w-3 h-3 bg-red-500"></span>
        </div>
        
        <!-- Contenu du classement -->
        <div class="p-8 md:p-12">
          <div class="flex gap-2 mb-4">
            <span class="w-3 h-3 bg-hugCream"></span>
            <span class="w-3 h-3 bg-hugCream"></span>
            <span class="w-3 h-3 bg-hugCream"></span>
            <span class="w-3 h-3 bg-hugCream"></span>
          </div>
          <h2 class="font-jersey text-[48px] text-black mb-12">Classement 2025</h2>
          
          <!-- Conteneur flexible pour aligner les trophées avec un effet de podium -->
          <div class="flex flex-col md:flex-row justify-center items-center md:items-end gap-12 md:gap-16">
            
            <!-- Trophée 2 : Rolex -->
            <div class="flex flex-col items-center">
              <p class="font-inter font-bold text-[18px] mb-4">Rolex</p>
              <img src="/images/trophy_conviction (1).png" alt="Trophée Ambassadeur" class="w-[120px] h-[120px] object-contain mb-4">
            </div>

            <!-- Trophée 1 : Pictet & Cie (Au centre et plus grand) -->
            <div class="flex flex-col items-center mb-8 md:mb-12">
              <p class="font-inter font-bold text-[22px] mb-4">Pictet & Cie</p>
              <img src="/images/trophy_gold.png" alt="Trophée Or" class="w-[160px] h-[160px] object-contain mb-4">
            </div>

            <!-- Trophée 3 : BCGE -->
            <div class="flex flex-col items-center">
              <p class="font-inter font-bold text-[16px] mb-4">BCGE</p>
              <img src="/images/trophy_conviction.png" alt="Trophée Conviction" class="w-[100px] h-[100px] object-contain mb-4">
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- Section Avantages du Label -->
    <section class="max-w-desktop mx-auto px-4 md:px-[80px] py-20">
      <div class="flex gap-2 mb-4">
        <span class="w-3 h-3 bg-hugCream"></span>
        <span class="w-3 h-3 bg-hugCream"></span>
        <span class="w-3 h-3 bg-hugCream"></span>
        <span class="w-3 h-3 bg-hugCream"></span>
      </div>
      <h2 class="font-jersey text-[48px] text-black mb-12">Les avantages du Label<br>Partenaire du Don.</h2>
      
      <!-- Grille responsive : 1 colonne sur mobile, 2 sur bureau -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <!-- Carte Avantage 1 -->
        <div class="bg-hugCream border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-white p-4">
            <h3 class="font-inter font-bold text-[18px] text-black">Une reconnaissance officielle</h3>
          </div>
          <div class="p-6">
            <p class="font-inter text-sm text-black">Votre démarche est certifiée par les Hôpitaux Universitaires de Genève — l'institution de référence en matière de santé publique dans le canton.</p>
          </div>
        </div>
        
        <!-- Carte Avantage 2 -->
        <div class="bg-hugCream border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-white p-4">
            <h3 class="font-inter font-bold text-[18px] text-black">Un actif RSE concret</h3>
          </div>
          <div class="p-6">
            <p class="font-inter text-sm text-black">Le label s'intègre directement dans vos rapports et communications de responsabilité sociale. Pas une promesse — une preuve.</p>
          </div>
        </div>

        <!-- Carte Avantage 3 -->
        <div class="bg-hugCream border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-white p-4">
            <h3 class="font-inter font-bold text-[18px] text-black">De la visibilité</h3>
          </div>
          <div class="p-6">
            <p class="font-inter text-sm text-black">Votre entreprise apparaît dans la liste des Partenaires du Don sur ce site, consultée par d'autres entreprises, par les médias et par le grand public.</p>
          </div>
        </div>

        <!-- Carte Avantage 4 -->
        <div class="bg-hugCream border-[4px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
          <div class="border-b-[4px] border-black bg-white p-4">
            <h3 class="font-inter font-bold text-[18px] text-black">Un kit de comm' prêt à l'emploi</h3>
          </div>
          <div class="p-6">
            <p class="font-inter text-sm text-black">Dès l'obtention du label, vous recevez un kit de communication complet — visuels pour LinkedIn et vos réseaux internes, modèle de newsletter, affiche pour vos locaux — tout adapté à votre identité.</p>
          </div>
        </div>

      </div>
    </section>

  </div>
</template>

<script setup>
// Logique du composant de la page d'accueil (actuellement vide)
</script>
