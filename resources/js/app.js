import '../css/app.css';
// Importation de la fonction createApp depuis Vue
import { createApp } from 'vue';

// Importation des composants Vue de la vitrine
import HeaderVitrine from './components/HeaderVitrine.vue';
import HomeVitrine from './components/HomeVitrine.vue';
import FooterVitrine from './components/FooterVitrine.vue';

// Initialisation de l'application Vue
const app = createApp({});

// Enregistrement global des composants pour pouvoir les utiliser dans les vues Blade
app.component('HeaderVitrine', HeaderVitrine);
app.component('HomeVitrine', HomeVitrine);
app.component('FooterVitrine', FooterVitrine);

// Montage de l'application sur l'élément avec l'ID 'app'
app.mount('#app');
