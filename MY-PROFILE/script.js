$(document).ready(function () {
    $(".first-col img").on("click", function () {
        let imageSrc = $(this).attr("src");
        $(".full-image img").attr("src", imageSrc);
        $(".full-image").css("display", "flex").hide().fadeIn(500);
    })
});

$(".cross-part").on("click", function () {
    $(".full-image").fadeOut(500, function () {
        $(this).css("display", "none");
        $(".full-image img").attr("src", "");
    });
});

$(document).on("click", ".goToMain", function () {
    location.href = "../MAIN";
});

$(document).ready(function () {
    $("#goSocialBtn").on("click", function () {
        $(".post-section").css("visibility", "visible");
    });

    $(".closePostSection").on("click", () => {
        $(".post-section").css("visibility", "hidden");
    });
});

$(document).ready(function () {
    $(".side-bars").on("click", function (elem) {
        let viewportWidth = window.innerWidth;
        let currentWidthVW = ($(this).width() / viewportWidth) * 100;
        $(this).find("*").css("transition", "1s ease");

        if (currentWidthVW < 19) {
            $(this).css("width", "20vw");
            $(this).find("*").css("display", "flex");
            // console.log(elem.currentTarget.className + "++");
        } else {
            $(this).css("width", "2vw");
            $(this).find("*").css("display", "none");
            // console.log(elem.currentTarget.className + "--");
        }
    });
});

let buttonClicked = null;
function btnClicked(btn) {
    buttonClicked = btn.value;
    console.log(buttonClicked);

    $.ajax({
        type: 'POST',
        url: `../GET-CONTENTS/content${buttonClicked}.php`,
        success: function(response) {
            $('.get-contents').html(response);
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: ", error);
        }
    });
}