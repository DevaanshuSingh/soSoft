// document.querySelector('.menu').backgroundColor = "GOLD";

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
} function toggleSettings(isOpen) {
  if (isOpen) {
    $(".all-settings").css("display", "none");
  }
  else {
    $(".all-settings").css("display", "flex");
  }
}

var color = localStorage.getItem('bcg');
document.body.style.backgroundColor = color;
function updateBcg(colorBox) {
  var selectedValue = $(colorBox).attr('value');
  var backgroundColor = $(colorBox).css('background-color');
  $('#theme-name').html(selectedValue);
  $('#theme-name').css("color", backgroundColor);
  var toast = new bootstrap.Toast($('#liveToast')[0]);
  toast.show();

  localStorage.setItem('bcg', backgroundColor);
  color = localStorage.getItem('bcg');
  document.body.style.backgroundColor = color;
}

let aalu = 0;
let expanded = false;
function showSelfSection() {
  let apiArray =
  {
    "id": 1,
    "sbsr": "SBSR",
    "email": "sbsr@gmail.com"
  };

  $.ajax({
    // url: 'http://127.0.0.1:8000/sbsrMail/SBSR_SBSR_SBSR_SBSR_SBSR_SBSR_SBSR_SBSR_SBSR_SBSR',
    url: `http://127.0.0.1:8000/api/getPlaces/${apiArray}`,
    type: 'POST',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
      console.log(data);
    },
    error: function (xhr, status, error) {
      console.error('त्रुटि:', error);
    }
  });
}

function logout() {
  location.href = "../index.php";
}



document.addEventListener("keydown", function (event) {
  if (event.altKey && event.key.toLowerCase() === "p") {
    location.href = '../MY-PROFILE/';
  }
});