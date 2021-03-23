
let menuIcons = document.querySelectorAll('.menu-icon');
let navMenu = document.querySelector('header nav ul');

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
	console.log(event.target);
});


// let header = document.querySelector('header');
// window.onscroll = function () { 
//     if (document.body.scrollTop >= 200 ) {
//         header.classList.add("nav-colored");
//         header.classList.remove("nav-transparent");
//     } 
//     else {
//         header.classList.add("nav-transparent");
//         header.classList.remove("nav-colored");
//     }
// };

// window.onscroll = function() {scrollFunction()};

// function scrollFunction() {
//   if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
//     document.getElementById("navbar").style.padding = "30px 10px";
//     document.getElementById("logo").style.fontSize = "25px";
//   } else {
//     document.getElementById("navbar").style.padding = "80px 10px";
//     document.getElementById("logo").style.fontSize = "35px";
//   }
// }
let header = document.querySelector('header');

window.addEventListener('scroll', (event) =>{
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        header.classList.add("nav-colored");
        header.classList.remove("nav-transparent");
    } 
    else {
        header.classList.add("nav-transparent");
        header.classList.remove("nav-colored");
    }
});