let buttonClicked = null;
function btnClicked(btn) {
    buttonClicked = btn.value;
    console.log(buttonClicked);

    $.ajax({
        type: 'POST',
        url: `../GET-CONTENTS/content${buttonClicked}.php`,
        data: {
            my: false
        },
        success: function (response) {
            $('.get-contents').html(response);
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error: ", error);
        }
    });
}