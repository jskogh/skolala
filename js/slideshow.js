/*

	a slide show that automatic change pictures 

*/

var slideImg = new Array(
				"img/slideshow/02.png",
				"img/slideshow/01.png"
				);
var imageCount = 0;
	
function slide() {
	document.getElementById("slideshowImg").src =  slideImg[imageCount];
	imageCount++;
	
	if(imageCount >= slideImg.length) {
		imageCount = 0;
	}	
	
}

function autoSlide(){
	setInterval(slide, 4000);
}

window.onload = autoSlide;