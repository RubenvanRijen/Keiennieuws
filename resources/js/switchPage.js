function startTimer(duration, display) {
    let timer = duration,
        minutes, seconds;
    setInterval(function() {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? seconds : seconds;

        display.textContent = " " + seconds;
        // display.textContent = seconds + "";

        if (--timer < 0) {
            timer = duration;
        }
        if (seconds === 0) {
            timer = 0;
        }
    }, 1000);
}

$(document).ready(function() {
    const myEle = document.getElementById("timer");
    if (myEle) {
        let time = document.querySelector('#timer').getAttribute('data-time');
        let display = document.querySelector('#timer');
        startTimer(time, display);
    }
});