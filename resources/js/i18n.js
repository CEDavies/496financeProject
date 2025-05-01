import { createI18n } from 'vue-i18n';
import { useI18n } from 'vue-i18n';

// Define translations for each language
const messages = {
  en: {
    home: 'Home',
    investmentOptions: 'Investment Options',
    addInvestment: 'Add New Investment',
    manageStudent: 'Manage Student',
    manageInvestment: 'Manage Investment Options',
    projects: 'Projects',
    reports: 'Reports',
    welcome: 'Welcome to the Teacher Dashboard',
    signout: 'Signout',
  },
  es: {
    home: 'Inicio',
    investmentOptions: 'Opciones de Inversión',
    addInvestment: 'Agregar Nueva Inversión',
    manageStudent: 'Gestionar Estudiantes',
    manageInvestment: 'Gestionar Opciones de Inversión',
    projects: 'Proyectos',
    reports: 'Informes',
    welcome: 'Bienvenido al Panel del Profesor',
    signout: 'Cerrar sesión',
  },
  fr: {
    home: 'Accueil',
    investmentOptions: 'Options d\'Investissement',
    addInvestment: 'Ajouter un Nouvel Investissement',
    manageStudent: 'Gérer les Étudiants',
    manageInvestment: 'Gérer les Options d\'Investissement',
    projects: 'Projets',
    reports: 'Rapports',
    welcome: 'Bienvenue sur le Tableau de Bord Enseignant',
    signout: 'Déconnexion',
  },
};

const changeLanguage = (language) => {
  locale.value = language; // Update the i18n locale
  localStorage.setItem('selectedLanguage', language); // Save to localStorage
  console.log(`Language changed to: ${language}`);
};

// Create the Vue I18n instance
const i18n = createI18n({
  legacy:false,
  locale: 'en', // Default language
  fallbackLocale: 'en', // Fallback language
  messages,
});

onMounted(() => {
  const savedLanguage = localStorage.getItem('selectedLanguage');
  if (savedLanguage) {
    locale.value = savedLanguage; // Update the i18n locale
  }
});

export default i18n;