// Configuration de Tailwind CSS
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Couleurs de la marque HUG
        hugDark: '#322947',
        hugPurple: '#4B5BAB',
        hugBlue: '#4DA6FF',
        hugCream: '#FFE478',
      },
      fontFamily: {
        // Polices personnalisées
        jersey: ['"Jersey 20"', 'sans'],
        inter: ['"Inter"', 'sans'],
      },
      maxWidth: {
        // Largeur maximale pour le conteneur principal
        desktop: '1536px',
      }
    },
  },
  plugins: [],
}
