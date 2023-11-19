resetAllSlides();
startAllSlidesAnimation();

function nextSlide(ev){
    let slider = ev.parentElement;
    showSlide(slider, +1);
}

function prevSlide(ev){
    let slider = ev.parentElement;
    showSlide(slider, -1);
}

function showSlide(slider, n) {
    let sliderCount = slider.getAttribute("slider-count");
    if(sliderCount == null){
        sliderCount = 1;
        slider.setAttribute("slider-count", sliderCount);
    }
    sliderCount = parseInt(sliderCount);

    sliderCount+=n;

    let slides = slider.getElementsByClassName("slide-frame");
    if (sliderCount > slides.length) {
        sliderCount = 1;
    }
    if (sliderCount < 1) {
        sliderCount = slides.length;
    }
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[sliderCount - 1].style.display = "block";
    slider.setAttribute("slider-count", sliderCount);
}

function resetAllSlides() {
    let sliders = document.getElementsByClassName("slider-container");
    for (let i = 0; i < sliders.length; i++){
        let slider = sliders[i];
        showSlide(slider, 0);
    }
}

var animationTimer;
function startAllSlidesAnimation(){
    if(animationTimer != null){
        clearInterval(animationTimer);
    }
    animationTimer = setInterval(() => {
        let sliders = document.getElementsByClassName("slider-container");
        for (let i = 0; i < sliders.length; i++){
            let slider = sliders[i];
            showSlide(slider, 1);
        }
    }, 10*1000);
}