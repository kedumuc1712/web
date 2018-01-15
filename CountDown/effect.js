var today = new Date();
var thisHours = today.getHours() * (3600*1000);
var thisMinutes = today.getMinutes() * (1000*60);
var thisSeconds = today.getSeconds() * (1000);

//Tinh thoi gian tu hien tai den 23h59m hom nay ( tinh theo ms) 
var countHours = (23*3600*1000 + 59*60*1000) - thisHours - thisMinutes - thisSeconds;

var tempDays = Math.floor(countHours / (1000 * 60 * 60 * 24));
var tempHours = Math.floor((countHours % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var tempMinutes = Math.floor((countHours % (1000 * 60 * 60)) / (1000 * 60));
var tempSeconds = Math.floor((countHours % (1000 * 60)) / 1000);


if ( tempDays < 10) 
    tempDays = "0" + tempDays;
if ( tempHours < 10)
    tempHours = "0" + tempHours;
if ( tempMinutes < 10)
    tempMinutes = "0" + tempMinutes;
if ( tempSeconds < 10)
    tempSeconds = "0" + tempSeconds;

window.onload = function() {
    document.getElementById("days").innerHTML = tempDays;
    document.getElementById("hours").innerHTML = tempHours;
    document.getElementById("minutes").innerHTML = tempMinutes;
    document.getElementById("seconds").innerHTML = tempSeconds;
}



// Cu sau 1s update thoi gian con lai
var x = setInterval(function countDays() {

    countHours -= 1000;
    // Neu qua gio, reset ve 0
    if (countHours < 0) {
        clearInterval(x);
        document.getElementById("days").innerHTML = "00";
        document.getElementById("hours").innerHTML = "00";
        document.getElementById("minutes").innerHTML = "00";
        document.getElementById("seconds").innerHTML = "00";
    
    }

    console.log("countHours" + " " + countHours + "\n");
    
    // Quy doi ms ra gio, phut, giay
    var days = Math.floor(countHours / (1000 * 60 * 60 * 24));
    var hours = Math.floor((countHours % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((countHours % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((countHours % (1000 * 60)) / 1000);
    
    // Xuat ra dong ho

    if ( days < 10) 
        days = "0" + days;
    if ( hours < 10)
        hours = "0" + hours;
    if ( minutes < 10)
        minutes = "0" + minutes;
    if ( seconds < 10)
        seconds = "0" + seconds;

    document.getElementById("days").innerHTML = days;
    document.getElementById("hours").innerHTML = hours;
    document.getElementById("minutes").innerHTML = minutes;
    document.getElementById("seconds").innerHTML = seconds;

    /*countHours -= 1000;*/
}, 1000);


