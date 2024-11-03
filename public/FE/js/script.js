// index
// slider
let timeoutID;
let slideIndex = 0;

showSlides();

function showSlides() {
    let i;
    let slides = document.getElementsByClassName("slide-item");
    let dots = document.getElementsByClassName("slide-btn-dot");
    
    slideIndex++;
    
    if (slideIndex > slides.length) {slideIndex = 1}
    if (slideIndex < 1) {slideIndex = slides.length}
    for (i = 0; i<slides.length; i++) {
        slides[i].style.display = "none";
        dots[i].className = dots[i].className.replace(" active", "");
    }
    
    if (slides[slideIndex - 1] && dots[slideIndex - 1]){
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        timeoutID = setTimeout(showSlides, 5000);
    }
}

function plusSlides(n) {
    slideIndex += n - 1;
    clearTimeout(timeoutID);
    showSlides();
}

function currentSlides(n) {
    slideIndex = n - 1;
    clearTimeout(timeoutID);
    showSlides();
}

// Product-carousel
var owl = $('.owl-carousel');
owl.owlCarousel({
    nav: true,
    loop: true,
    margin: 10,
    dots: false,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause:true,
    autoplaySpeed: 1500,
    navSpeed: 1500,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});
$('.play').on('click',function(){
    owl.trigger('play.owl.autoplay',[1000])
})
$('.stop').on('click',function(){
    owl.trigger('stop.owl.autoplay')
})

