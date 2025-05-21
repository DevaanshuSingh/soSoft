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
        } else {
            $(this).css("width", "2vw");
            $(this).find("*").css("display", "none");
        }
    });
});



//Shortcuts
document.addEventListener("keydown", function (event) {
    if (event.altKey && event.key.toLowerCase() === "s") {
        location.href = '../MAIN/';
    }
});