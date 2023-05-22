jQuery(document).ready(function($) {
    $.ajax({
        url: ajax_post_list_params.ajaxurl,
        type: 'POST',
        data: {
            action: 'getPosts'
        },
        success: function(response) {
            if (response.success) {
                //remove existing content
                $('.wp-site-blocks').remove();
                //add custom post list content
                $('#post-list').html(response.data);
            } else {
                throw new Error('Could not fetch posts...')
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
});

