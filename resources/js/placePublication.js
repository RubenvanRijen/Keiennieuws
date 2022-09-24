$(document).ready(function() {
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