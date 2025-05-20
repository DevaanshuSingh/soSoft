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
      $('#txt').val('');
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

function openCommentSection() {
  $('.contact-section').toggle('fast');
}

let sendData = {};
let clickedInteractionIcon;
function interaction(interactionIdentifier, myId, postOwnerId, postId, clickedElement) {
  $(clickedElement).css("transform", "scale(2)");
  clickedInteractionIcon = clickedElement;
  sendData['myId'] = myId;
  sendData['postOwnerId'] = postOwnerId;
  sendData['postId'] = postId;
  console.log("sendData:", sendData);

  if (interactionIdentifier === "like") {
    $.ajax({
      url: `../INTERACTIONS/post-like.php`,
      type: 'POST',
      data: {
        myId: myId,
        postOwnerId: postOwnerId,
        postId: postId
      },
      success: function (response) {
        response = JSON.parse(response);
        if (response.status === "true") {
          setTimeout(() => {
            $(clickedElement).addClass("icon-green");
            $(clickedElement).removeClass("icon-red");
            $(clickedElement).css("transform", "scale(1)");
          }, 1000);
        }
        else if (response.status === "false") {
          console.log("Like Removed");
          setTimeout(() => {
            $(clickedElement).css("transform", "scale(1)");
          }, 1000);
        }
      },
      error: function (xhr, status, error) {
        alert("Like Not Sent");
        console.error('त्रुटि:', error);
      }
    });
  }
  else if (interactionIdentifier === "comment") {
    sendComment(false);
  }
}

function sendComment(isCheck) {
  JSON.stringify(sendData, null, 2);
  $('.comment-section').toggle('slow');
  if (isCheck) {
    let commentTxt = $('.comment-txt').val();
    if (commentTxt == '') {
      alert("Please Write, What You Want To Comment On This Post,");
    }
    else {
      myId = sendData.myId;
      postOwnerId = sendData.postOwnerId;
      postId = sendData.postId;
      $.ajax({
        url: `../INTERACTIONS/post-comment.php`,
        type: 'POST',
        data: {
          myId: myId,
          postOwnerId: postOwnerId,
          postId: postId,
          commentVal: commentTxt
        },
        success: function (response) {
          console.log(response);
          response = JSON.parse(response);
          if (response.status === "true") {
            setTimeout(() => {
              $(clickedInteractionIcon).addClass("icon-green");
              $(clickedInteractionIcon).removeClass("icon-blue");
              $(clickedInteractionIcon).css("transform", "scale(1)");
            }, 1000);
          }
          else if (response.status === "false") {
            console.log("Commente Removed");
            setTimeout(() => {
              $(clickedElement).css("transform", "scale(1)");
            }, 1000);
          }
        },
        error: function (xhr, status, error) {
          alert("Comment Not Sent");
          console.error('त्रुटि:', error);
        }
      });
    }
  }
}

function commentSectionToggler() {
  $('.comment-section').toggle('slow');
  $(clickedInteractionIcon).css("transform", "none");
}

function getInteractionsList(myId, getListOf) {
  if (getListOf == '') {
    alert('Please Provide Value');
  }
  else if (getListOf == 'like') {
    $.ajax({
      url: `GET-POST-INTERACTIONS-LIST`,
      type: 'get',
      data: {
        myId: myId,
        getListOf: getListOf,
      },
      success: function (response) {
        response = JSON.parse(response);
        console.log(response);
        if (response.status === 'true') {
          $('.review-list').html(response.data);
        } else if (response.status === 'false') {
          $('.review-list').html(`<strong>${response.message.toUpperCase()} In Your Post</strong>`);
        }
      },
      error: function (xhr, status, error) {
        console.error('त्रुटि:', error);
      }
    });
  }
  else if (getListOf == 'comment') {
    $.ajax({
      url: `GET-POST-INTERACTIONS-LIST`,
      type: 'get',
      data: {
        myId: myId,
        getListOf: getListOf,
      },
      success: function (response) {
        response = JSON.parse(response);
        console.log(response);
        if (response.status === 'true') {
          $('.review-list').html(response.data);
        } else if (response.status === 'false') {
          $('.review-list').html(`<strong>${response.message.toUpperCase()} In Your Post</strong>`);
        }
      },
      error: function (xhr, status, error) {
        console.error('त्रुटि:', error);
      }
    });
  }
}

function PostReviewToggler() {
  $('.my-post-interaction-view').toggle('2000');
}
function showInteractedUser(interactedUser) {
  selecteduser(interactedUser);
}

function startHelping(){
  $('.help-box').toggle('slow');
}