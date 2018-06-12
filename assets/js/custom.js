$(function () {
    $("[data-toggle=tooltip]").tooltip();
    //Display success/error flash messages
    if (s_msg != '') {
        setTimeout(function () {
            showSuccessMSg(s_msg);
        }, 100);
    } else if (e_msg != '') {
        setTimeout(function () {
            showErrorMSg(e_msg);
        }, 100);
    }
});

function showSuccessMSg(msg) {
    PNotify.removeAll();
    new PNotify({
        title: 'Success!',
        text: msg,
        buttons: {
            sticker: false
        },
//        styling: 'bootstrap3',
        type: 'success'
    });
}

function showErrorMSg(msg) {
    PNotify.removeAll();
    new PNotify({
        title: 'Error!',
        text: msg,
        buttons: {
            sticker: false
        },
//        styling: 'bootstrap3',
        type: 'error'
    });
}