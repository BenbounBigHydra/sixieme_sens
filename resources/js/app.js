import '../css/app.css';
// Importation de la fonction createApp depuis Vue
import { createApp } from 'vue';

// Importation des composants Vue de la vitrine
import HeaderVitrine from './components/HeaderVitrine.vue';
import HomeVitrine from './components/HomeVitrine.vue';
import FooterVitrine from './components/FooterVitrine.vue';
import TropheesVitrine from './components/TropheesVitrine.vue';
import LabelVitrine from './components/LabelVitrine.vue';
import CompaniesVitrine from './components/CompaniesVitrine.vue';
import CollecteVitrine from './components/CollecteVitrine.vue';

// Initialisation de l'application Vue
const app = createApp({});

// Enregistrement global des composants pour pouvoir les utiliser dans les vues Blade
app.component('HeaderVitrine', HeaderVitrine);
app.component('HomeVitrine', HomeVitrine);
app.component('FooterVitrine', FooterVitrine);
app.component('trophees-vitrine', TropheesVitrine);
app.component('label-vitrine', LabelVitrine);
app.component('companies-vitrine', CompaniesVitrine);
app.component('collecte-vitrine', CollecteVitrine);

// Montage de l'application sur l'élément avec l'ID 'app'
app.mount('#app');
