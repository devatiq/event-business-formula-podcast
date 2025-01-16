jQuery(document).ready(function ($) {
    let currentPage = 1;

    $('.ebfp-podcast-load-more').on('click', function () {
        currentPage++;

        $.ajax({
            url: ebfpAjax.ajaxUrl,
            type: 'POST',
            data: {
                action: 'load_more_podcasts',
                page: currentPage,
                nonce: ebfpAjax.nonce,
            },
            beforeSend: function () {
                $('.ebfp-podcast-load-more').text('Loading...');
            },
            success: function (response) {
                if ($.trim(response) === '') {
                    $('.ebfp-podcast-load-more').hide();
                } else {
                    $('.ebfp-podcast-grid').append(response);
                    $('.ebfp-podcast-load-more').text('Load More');
                }
            },
            error: function () {
                $('.ebfp-podcast-load-more').text('Error! Try again');
            },
        });
    });
});