import './bootstrap';

const body = document.querySelector('#app-layout');
const themeSwitcher = document.querySelector('#theme_switcher');

themeSwitcher.addEventListener('change', (event) => {
    // Modifier la valeur de 'data-theme' à la valeur actuelle du selecteur
    body.setAttribute('data-theme', event.target.value);
});

