
let menuIcons = document.querySelectorAll('.menu-icon');
let navMenu = document.querySelector('header nav ul');
let header = document.querySelector('header');

//toggle nav Icon between burger and X
function toggleNav(event){
	navMenu.classList.toggle('hidden');
	menuIcons[0].classList.toggle('hidden-icon');
	menuIcons[1].classList.toggle('hidden-icon');
}

for(i = 0; i < menuIcons.length; i++) {
	menuIcons[i].addEventListener('click', (event) =>{
		toggleNav();
	});
}

//close nav when nav item clicked
navMenu.addEventListener('click',(event)=>{
	if(event.target.tagName.toLowerCase() === 'a'){
		toggleNav();
	}
});

//appearing nav menu background  when scroll down
window.addEventListener('scroll', (event) =>{
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        header.classList.add("header-colored");
        header.classList.remove("header-transparent");
    } 
    else {
        header.classList.add("header-transparent");
        header.classList.remove("header-colored");
    }
});

// for adding web card for dynamic max-height
let webCardContainer = document.querySelector(".web-cards-container");

function snugFitWebCards(element){
	let i = 0;
	let maxHeight = 0;
	element.style.maxHeight = "2rem";
	while(i != 1){
		if (element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth) {
			element.style.maxHeight = maxHeight + "rem";
			maxHeight += 5;
		} else{
			element.style.maxHeight = maxHeight + 2 + "rem";
			i = 1;
		}
	}
}

snugFitWebCards(webCardContainer);

window.onresize = function(){
	snugFitWebCards(webCardContainer)
}