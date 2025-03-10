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