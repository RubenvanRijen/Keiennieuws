import Alpine from 'alpinejs';
window.$ = require('jquery');

require('./bootstrap/bootstrap.bundle');
require('./main');
require('./sectionFive');
require('./sectionSeven');
require('./switchPage');

window.Alpine = Alpine;

Alpine.start();