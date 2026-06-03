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

// Importation des composants Vue du co-branding
import HeaderCobrand from './components/HeaderCobrand.vue';
import HomeCobrand from './components/HomeCobrand.vue';
import InfosCobrand from './components/InfosCobrand.vue';
import QuizzCobrand from './components/QuizzCobrand.vue';

// Importation des composants Vue de l'admin
import LoginAdmin from './components/LoginAdmin.vue';

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

// Enregistrement global des composants co-branding
app.component('header-cobrand', HeaderCobrand);
app.component('home-cobrand', HomeCobrand);
app.component('infos-cobrand', InfosCobrand);
app.component('quizz-cobrand', QuizzCobrand);

// Enregistrement global des composants admin
app.component('login-admin', LoginAdmin);

// Montage de l'application sur l'élément avec l'ID 'app'
app.mount('#app');
