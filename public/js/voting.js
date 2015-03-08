$(function () {
    function initVoting(type) {
        var userId = $(this).closest('.button-container').data('userId');

        $.ajax({
            url: '/vote/' + type,
            method: 'post',
            data: {
                to: userId,
                _token: $('#csrfToken').val()
            },
            beforeSend: function() {
                $('#main').html('<img class="preloader" src="/media/loading/loadinfo.gif">');
            },
            success: function() {
                $("#main").load(location.href + " #inner", function() {
                    $('.user-button-up').on('click', function () {
                        initVoting.call(this, 'up');
                    });

                    $('.user-button-down').on('click', function () {
                        initVoting.call(this, 'down');
                    });
                });
            }
        });
    }
    $('.user-button-up').on('click', function () {
        initVoting.call(this, 'up');
    });

    $('.user-button-down').on('click', function () {
        initVoting.call(this, 'down');
    });
});