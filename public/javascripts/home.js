$(function () {
    $('#supersize').supersized();
});
$(document).ready(function () {
    Cufon.replace('a', {
        hover: true
    })('li', {
        hover: true
    })('h2')('h3')('h4')('h5')('h6');

});


$(function () {
    function launch() {
        $('#teaser_4').lightbox_me({
            centered: true, 
			
            onLoad: function () {
                $('#presentations').find('input:first').focus()
            }
        });
    }
    $('#button_teaser_4').click(function () {
        $("#loader").lightbox_me({
            centered: true
        });
        setTimeout(launch, 300);
        return false;
    });
});