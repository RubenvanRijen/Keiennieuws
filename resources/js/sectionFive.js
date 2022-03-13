window.onload = () => {

    const hideName = document.getElementById("hideName");
    const showName = document.getElementById("showName");
    const authorName = document.getElementById("authorNameBlock");


    if (hideName !== null && hideName !== undefined && showName !== null && showName !== undefined) {
        if (showName.checked === false) {
            authorName.style.display = "none";
        } else {
            authorName.style.display = "block";
        }
    }

    hideName.onclick = function() {
        showName.checked = false;
        authorName.style.display = "none";
    }

    showName.onclick = function() {
        hideName.checked = false;
        showName.checked == true ? authorName.style.display = "block" : authorName.style.display = "none";
    }

};