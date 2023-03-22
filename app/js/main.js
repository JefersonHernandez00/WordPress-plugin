(function ($) {
    // Attach an event handler to '.open-close__icon' element
    $('.open-close__icon').on('click', function () {
        // Get the parent '.single__product-tab' element
        var singleTab = $(this).parents().parents('.single__product-tab');
        if ($(singleTab).hasClass('active')) {
            // If it does, slide up its sibling '.single__product-details' element and remove class 'active'
            $(singleTab).siblings('.single__product-details').slideUp();
            $(singleTab).removeClass('active');
        } else {
            $('.single__product-details').slideUp();
            $('.single__product-tab').removeClass('active');
            $(singleTab).siblings('.single__product-details').slideToggle();
            $(singleTab).toggleClass('active');
        }
    });
})(jQuery);

$(document).ready(function () {
    // Attach an event handler to '.thumb-image' element
    $(".thumb-image").click(function () {
        var videoUrl = $(this).data("video");
        $("#videoModal").modal("show");
        $("#videoModal iframe").attr("src", videoUrl);
    });

    // Attach an event handler to the modal with ID 'videoModal' for the 'hidden.bs.modal' event
    $('#videoModal').on('hidden.bs.modal', function (e) {
        var video = document.getElementsByTagName("iframe")[0];
        // Store the src attribute of the video in a variable
        var videoSrc = video.src;
        // Set the src attribute of the video to an empty string
        video.src = "";
        // Set the src attribute of the video back to its original value
        video.src = videoSrc;
    });
});