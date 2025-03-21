document.addEventListener("DOMContentLoaded", function () {
    const navMenu = document.getElementById("nav-menu"),
          navToggle = document.getElementById("nav-toggle"),
          navClose = document.getElementById("nav-close");

    /* Show Menu */
    if (navToggle) {
        navToggle.addEventListener("click", function () {
            console.log("✅ Toggle button clicked");
            navMenu.classList.add("show-menu");
        });
    }

    /* Hide Menu */
    if (navClose) {
        navClose.addEventListener("click", function () {
            console.log("❌ Close button clicked");
            navMenu.classList.remove("show-menu");
        });
    }
});


/*=============== REMOVE MENU MOBILE ===============*/
const navLink = document.querySelectorAll('.nav__link')

const linkAction = () =>{
    const navMenu = document.getElementById('nav-menu')
    //When we click on each nav__link, we remove the show-menu class
    navMenu.classList.remove('show-menu')
}

navLink.forEach(n => n.addEventListener('click', linkAction))

/*=============== ADD BLUR HEADER ===============*/
const blurHeader = () =>{
    const header = document.getElementById('header')
    //Add a class if the button offset is greater than 50 of the viewport
    this.scrollY >= 50 ? header.classList.add('blur-header')
                       : header.classList.remove('blur-header')
}
window.addEventListener('scroll', blurHeader)
