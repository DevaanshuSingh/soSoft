$(".first-col img").on("click", function () {
    let imageSrc = $(this).attr("src");
    $(".full-image img").attr("src", imageSrc);
    $(".full-image").css("display", "flex").hide().fadeIn(500);
});

$(".cross-part").on("click", function () {
    $(".full-image").fadeOut(500, function () {
        $(this).css("display", "none");
        $(".full-image img").attr("src", "");
    });
});

$(document).on("click", ".goToMain", function () {
    var userId = $(this).data("user-id");
    window.location.href = "../MAIN?userId=" + userId;

    // $.ajax({
    //     type: "POST",
    //     url: "../MAIN",
    //     data: { userId: userId },
    //     success: function (response) {
    //         console.log("सफलता:", response);
    //         // window.location.href = "../MAIN";
    //     },
    //     error: function (xhr, status, error) {
    //         console.error("त्रुटि:", error);
    //         alert("कुछ समस्या आई, कृपया पुनः प्रयास करें!");
    //     }
    // });
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
    $(".left-bar").on("click", function () {
        let currentWidth = $(this).width();
        
        if (currentWidth <= 20) { 
            $(this).css("width", "20vw");
            console.log("Left++");
        } else {
            $(this).css("width", "2vw");
            console.log("Left--");
        }
    });
    $(".right-bar").on("click", function () {
        let currentWidth = $(this).width();
        
        if (currentWidth <= 20) { 
            $(this).css("width", "20vw");
            console.log("right++");
        } else {
            $(this).css("width", "2vw");
            console.log("right--");
        }
    });
});

