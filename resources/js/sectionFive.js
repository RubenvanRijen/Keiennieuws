$(document).ready(function() {

    const hideName = document.getElementById("hideName");
    const showName = document.getElementById("showName");
    const authorName = document.getElementById("authorNameBlock");
    const authorNameInput = document.getElementById("authorName");

    if (hideName && showName && authorName) {
        if (hideName !== null && hideName !== undefined && showName !== null && showName !== undefined) {
            console.log(showName.checked);
            if (showName.checked === false) {
                authorName.style.display = "none";
            } else {
                authorName.style.display = "block";
            }
        }

        hideName.onclick = function() {
            showName.checked = false;
            hideName.checked = true;
            authorName.style.display = "none";
            authorNameInput.removeAttribute("required");
        }

        showName.onclick = function() {
            hideName.checked = false;
            showName.checked = true;
            showName.checked == true ? authorName.style.display = "block" : authorName.style.display = "none";
            authorNameInput.setAttribute("required", "");
        }
    }
});