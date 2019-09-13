let current = new Date();

// Set the date we're counting down to
let countDownDate = new Date();

if (current.getHours() <= 18 && current.getHours() >= 13) {
    countDownDate.setHours(18);
}
else if (current.getHours() <= 13 && current.getHours() >= 9) {
    countDownDate.setHours(13);
}

countDownDate.setMinutes(0);
countDownDate.setSeconds(0);
countDownDate.getTime();

// Update the count down every 1 second
let x = setInterval(function() {

    // Get today's date and time
    let now = new Date().getTime();

    // Find the distance between now and the count down date
    let distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById("countDownTimer").innerHTML = hours + "h "
        + minutes + "m " + seconds + "s ";

    // If the count down is over, write some text
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("countDownTimer").innerHTML = "EXPIRED";

        if (current.getHours() <= 18 && current.getHours() >= 9) {
            document.getElementById('logout-form').submit();
        }
    }
}, 1000);