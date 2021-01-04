let menuIcon = document.querySelectorAll('.menu-icon');
let menuBurger = menuIcon[0];
let menuX = menuIcon[1];
let navMenus = document.querySelector('header nav');

function toggleNav(event){
	navMenus.classList.toggle('hidden');
	menuBurger.classList.toggle('hidden');
	menuX.classList.toggle('hidden');
}

menuBurger.addEventListener('click', toggleNav)
menuX.addEventListener('click', toggleNav)
