$(function () {
    $("[data-toggle=tooltip]").tooltip();
    //Display success/error flash messages
    if (s_msg != '') {
        console.log('message' + s_msg);
        showSuccessMSg(s_msg);
    } else if (e_msg != '') {
        showErrorMSg(e_msg);
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
//            styling:'bootstrap3',
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
        //            styling:'bootstrap3',
        type: 'error'
    });
}