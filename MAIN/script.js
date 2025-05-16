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
}

function selecteduser(user) {
  document.cookie = `selectedUserId = ${user}; path=/`;
  location.href = '../USER-PROFILE';
}

function openContactSection() {
  $('.contact-section').toggle('fast');
}

let isMySectionOpen = false;
function toggleMySection() {
  if (isMySectionOpen) {
    $('.my-section').css('height', 'fit-content');
    isMySectionOpen = false;
  } else {
    $('.my-section').css('height', '10vh');
    isMySectionOpen = true;
  }
}

function toggleSettings(isOpen) {
  if (isOpen) {
    $(".all-settings").css("display", "none");
  }
  else {
    $(".all-settings").css("display", "flex");
  }
}

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

//Using API,
let expanded = false;
function sendFeedback(feedbackData) {
  console.log(feedbackData);
  $.ajax({
    url: `http://127.0.0.1:8000/api/sendEmail`,
    type: 'POST',
    data: {
      feedbackData: feedbackData,
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function () {
      $('#loader').css('display', 'flex');
    },
    success: function (response) {
      console.log(response);
      $('#loader').css('display', 'none');
      // $('#txt').val('');
      alert("Feedback Sent Successfully");

    },
    error: function (xhr, status, error) {
      $('#loader').css('display', 'none');
      alert("Feedback Not Sent");
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