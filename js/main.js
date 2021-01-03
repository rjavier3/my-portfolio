let menuIcon = document.querySelector(".menu-icon");
let navMenus = document.querySelector("header nav");

menuIcon.addEventListener("click", (event) => {
	navMenus.classList.toggle("hidden");
});
