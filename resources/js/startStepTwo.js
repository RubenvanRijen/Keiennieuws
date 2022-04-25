$(document).ready(function() {

    const male = document.getElementById("male-gender");
    const female = document.getElementById("female-gender");
    const other = document.getElementById("other-gender");

    if (male && female && other) {
        male.onclick = function() {
            male.checked = true;
            female.checked = false;
            other.checked = false;
        }
        female.onclick = function() {
            male.checked = false;
            female.checked = true;
            other.checked = false;
        }
        other.onclick = function() {
            male.checked = false;
            female.checked = false;
            other.checked = true;
        }
    }
});