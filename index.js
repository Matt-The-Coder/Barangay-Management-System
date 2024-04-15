function menuShow() {
    document.getElementById("menu").classList.toggle("show");
}

function menuClose() {
    document.getElementById("menu").classList.remove("show");
}

window.addEventListener('scroll', reveal);

function reveal() {
    var reveals = document.querySelectorAll('.reveal');

    for(var i = 0; i < reveals.length; i++) {

        var windowheight = window.innerHeight;
        var revealtop = reveals[i].getBoundingClientRect().top;
        var revealpoint = 150;

        if(revealtop < windowheight - revealpoint){
            reveals[i].classList.add('active');
        }
        else{
            reveals[i].classList.remove('active');
        }
}
}

window.addEventListener('scroll', slide);

function slide() {
    var reveals = document.querySelectorAll('.slide');

    for(var i = 0; i < reveals.length; i++) {

        var windowheight = window.innerHeight;
        var revealtop = reveals[i].getBoundingClientRect().top;
        var revealpoint = 150;

        if(revealtop < windowheight - revealpoint){
            reveals[i].classList.add('active');
        }
        else{
            reveals[i].classList.remove('active');
        }
}
}

window.addEventListener('scroll', slide2);

function slide2() {
    var reveals = document.querySelectorAll('.slide2');

    for(var i = 0; i < reveals.length; i++) {

        var windowheight = window.innerHeight;
        var revealtop = reveals[i].getBoundingClientRect().top;
        var revealpoint = 150;

        if(revealtop < windowheight - revealpoint){
            reveals[i].classList.add('active');
        }
        else{
            reveals[i].classList.remove('active');
        }
}
}



// scroll navbar color change
function scrollValue() {
    var navbar = document.getElementById('container');
    var scroll = window.scrollY;
    if (scroll < 200) {
        navbar.classList.remove('BgColour');
    } else {
        navbar.classList.add('BgColour');
    }
}

window.addEventListener('scroll', scrollValue);




