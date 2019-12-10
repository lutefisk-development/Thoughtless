(function ($) {
  'use strict';

  $(document).ready(function () {
    $('.widget_instagram').each(function (i, widget) {
      $.post(
        get_instagram.ajax_url, {
          action: 'instagram__get'
        }
      ).done(function (instagram) {
        var images;
        var all_images = "";
        var output = "";
        var img = "";
        images = instagram.data.instagram.data;

        images.forEach(image => {

          // console.log(image.id);
          output += image.id;

          $.ajax({
            type: "GET",
            url: 'https://graph.instagram.com/' + image.id + '?fields=media_url,permalink&access_token=',
            crossDomain: true,
            success: function (response) {
              console.log(response.media_url);
              img = response.media_url;

              all_images += '<img src="' + img + '" alt="test">';

              $(widget).find('.content').html(all_images);

            },
            dataType: "jsonp" //set to JSONP, is a callback
          });


        });

      }).fail(function (error) {
        console.log("something went wrong!", error);
      });
    });
  });

})(jQuery);