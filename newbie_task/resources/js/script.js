$(function() {

    // ハンバーガーmenu
    $('.hamburger').click(function() {
        $(this).toggleClass('active');

        if ($(this).hasClass('active')) {
            $('.globalMenuSp').addClass('active');
        } else {
            $('.globalMenuSp').removeClass('active');
        }
    });

});
$(function() {
    $('#js-task-body')
        .on('input', function() {
            if ($(this).outerHeight() > this.scrollHeight) {
                $(this).height(1)
            }
            while ($(this).outerHeight() < this.scrollHeight) {
                $(this).height($(this).height() + 1)
            }
        });
});