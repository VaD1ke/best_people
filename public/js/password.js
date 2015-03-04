$(function () {
    $('#showpword').on('change', function() {
        if ($(this).prop('checked')) {
            $('#pword').attr('type', 'text');
        } else {
            $('#pword').attr('type', 'password');
        }
    });
});