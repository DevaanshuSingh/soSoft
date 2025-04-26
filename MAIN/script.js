
let isMenuOpen = true;
function toggleMenu() {
  if (isMenuOpen === true) {
    document.querySelector(".menu .menu-button").style.display = "hidden";
    document.querySelector(".menu").style.transition = "2s cubic-bezier(1, 7, 0.5, 5)";
    document.querySelector("body").style.gridTemplateColumns = "0 100%";
    document.querySelector("body").style.transition = "2s ease";
    document.querySelector(".menu-icon").style.transform = "rotate(0deg)";
    document.querySelector(".menu-icon").style.transition = "2s ease-out";
    document.querySelector(".inside-menu").style.opacity = "0";
    document.querySelector(".inside-menu").style.transition = "opacity 1s ease-in-out";
    isMenuOpen = false;
  } else {
    let bodyWidth = document.querySelector('body').offsetWidth;
    if (bodyWidth <= 775)
      document.querySelector("body").style.gridTemplateColumns = "45% 55%";
    else
      document.querySelector("body").style.gridTemplateColumns = "20% 80%";
    document.querySelector(".menu").style.display = "flex";
    document.querySelector(".menu").style.transition = "2s ease-in";
    document.querySelector("body").style.transition = "2s ease";
    document.querySelector(".menu-icon").style.transform = "rotate(180deg)";
    document.querySelector(".menu-icon").style.transition = "2s ease";
    document.querySelector(".inside-menu").style.opacity = "1";
    document.querySelector(".inside-menu").style.transition = "opacity 1.5s ease-in-out";
    isMenuOpen = true;
  }
} let isMySectionOpen = true;
function toggleMySection() {
  if (isMenuOpen === true) {
    document.querySelector(".my-section").style.height = "0";
    document.querySelector(".my-section").style.transition = "all 5s ease";
    isMenuOpen = false;
  } else {
    document.querySelector(".menu").style.display = "flex";
    document.querySelector(".menu").style.transition = "2s ease-in";
    document.querySelector("body").style.gridTemplateColumns = "20% 80%";
    document.querySelector("body").style.transition = "2s ease";
    document.querySelector(".menu-icon").style.transform = "rotate(180deg)";
    document.querySelector(".menu-icon").style.transition = "2s ease";
    isMenuOpen = true;
  }

} function selecteduser(user) {
  document.cookie = `selectedUserId = ${user}; path=/`;
  location.href = '../USER-PROFILE';
} function openContactSection() {
  $('.contact-section').toggle();
}


function showSettings() {
  alert(`SBSR`);
  var offcanvas = new bootstrap.Offcanvas(document.getElementById('#settingsOffcanvas'));
  offcanvas.show();
}