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
                if (response.success) {
                    // Append the new posts to the grid
                    $('.ebfp-podcast-grid').append(response.data.html);

                    // Hide the button if no more posts
                    if (!response.data.more) {
                        $('.ebfp-podcast-load-more').hide();
                    } else {
                        $('.ebfp-podcast-load-more').text('Load More');
                    }
                } else {
                    $('.ebfp-podcast-load-more').hide(); // Hide button on error or no posts
                }
            },
            error: function () {
                $('.ebfp-podcast-load-more').text('Error! Try again');
            },
        });
    });
});