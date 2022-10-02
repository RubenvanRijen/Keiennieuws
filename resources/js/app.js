import Alpine from 'alpinejs';
window.$ = require('jquery');
//alert message
import swal from 'sweetalert';

require('./bootstrap/bootstrap.bundle');
require('./main');
require('./sectionFive');
require('./sectionSeven');
require('./switchPage');
require('./startStepTwo');
require('./placePublication');
require('./multiselect-dropdown');

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

$('.show_confirm').click(function(event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
});