
let menuIcon = document.querySelectorAll('.menu-icon');
let menuBurger = menuIcon[0];
let menuX = menuIcon[1];
let navMenu = document.querySelector('header nav');
let navItems = document.querySelectorAll('header nav li a');
console.log(navItems);

//toggle nav Icon to burger or X
function toggleNav(event){
	navMenu.classList.toggle('hidden');
	menuBurger.classList.toggle('hidden');
	menuX.classList.toggle('hidden');
}

menuBurger.addEventListener('click', toggleNav)
menuX.addEventListener('click', toggleNav)

//close nav when nav item clicked
navMenu.addEventListener('click',(event)=>{
	if(event.target.tagName.toLowerCase() === 'a'){
		navMenu.classList.toggle('hidden');
	}
	console.log(event.target);
});

//alert under construction
// document.addEventListener("DOMContentLoaded", (event)=>{
// 	alert('HELLO, I am still working on this website and currently optimized for mobile screen only, it will get better soon!');
// });