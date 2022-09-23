$(document).ready(function() {


    const placedBooking = document.getElementById("placedBooking");
    const placedNoBooking = document.getElementById("placedNoBooking");
    const placeBooking = document.getElementById("placeBooking");
    const placeNoBooking = document.getElementById("placeNoBooking");
    const page = document.getElementsByClassName('.place-publication-page');
    const placePublicationPage = document.getElementsByClassName('place-publication-page')[0];


    if (placeBooking.checked == false) {
        placePublicationPage.style.height = "inherit";
    }


    if (placedBooking && placedNoBooking) {
        placedBooking.onclick = function() {
            placedBooking.checked = true;
            placedNoBooking.checked = false;
            placePublicationPage.style.height = "max-content";
            placeBooking.checked = false;
            placeNoBooking.checked = false;
        }
        placedNoBooking.onclick = function() {
            placedBooking.checked = false;
            placedNoBooking.checked = true;
            placePublicationPage.style.height = "inherit";
            page[0].style.height = "unset";
            placeBooking.checked = false;
            placeNoBooking.checked = false;

        }
    }

    $('#formFileMultiple').change(function() {
        let input = $('#formFileMultiple')[0].files;
        let output = document.getElementById('fileList');
        let maxFilesMessage = document.getElementById('maxFilesMessage');
        let uploadedFilesMessage = document.getElementById('uploadedFilesMessage');
        if (maxFilesMessage) {
            if (input.length > 5) {
                maxFilesMessage.classList.remove('d-none');
                maxFilesMessage.style.display = 'block';
                output.innerHTML = '<div>'
                '</div>';
            } else {
                maxFilesMessage.classList.add('d-none');
                uploadedFilesMessage.classList.remove('d-none')
                let children = "";
                for (let i = 0; i < input.length; ++i) {
                    children += '<div class="ml-1">' + (i + 1) + ': ' + input[i].name + '</div>';
                }
                output.innerHTML = '<div>' + children + '</div>';
                $(this).next('#file-Label').html('Aantal bestanden gekozen:' + input.length);
            }
        } else {
            let file = $('#file')[0].files[0].name;
            $(this).next('#file-Label').html(file);
        }
    });
});