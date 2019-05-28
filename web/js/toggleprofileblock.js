$('.profile-edit').hide();
$("#show-edit").click(function () {
    $('.profile-view').slideUp(500, function () {
        $('.profile-edit').slideDown(500);
    });

    $(this).blur()
});
$("#show-view").click(function () {
    $('.profile-edit').slideUp(500, function () {
        $('.profile-view').slideDown(500);
    });

    $(this).blur()
});