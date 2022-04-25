import Alpine from 'alpinejs';
window.$ = require('jquery');

require('./bootstrap/bootstrap.bundle');
require('./main');
require('./sectionFive');
require('./sectionSeven');
require('./switchPage');
require('./startStepTwo');
require('./placePublication');


window.onload = () => {
    if (window.location.pathname === '/information') {
        if (window.matchMedia("(max-width: 1200px)").matches || window.matchMedia("(max-height: 870px)").matches) {
            document.body.style.height = 'unset';
        } else {
            document.body.style.height = '100%';
        }
    }
}

window.Alpine = Alpine;

Alpine.start();