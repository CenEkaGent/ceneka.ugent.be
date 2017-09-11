var nav_menus = document.getElementsByClassName('nav-menu');
var nav_menu = nav_menus[0];
var nav_toggles = document.getElementsByClassName('nav-toggle');
var nav_toggle = nav_toggles[0];

function toggle_nav() {
    nav_menu.classList.toggle('is-active');
    nav_toggle.classList.toggle('is-active');
}