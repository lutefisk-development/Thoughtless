(function ($) {
  'use strict';
  $(document).ready(function () {
    $('.widget_instagram').each(function (i, widget) {
      const instagram = document.querySelector('.instagram');
      var token = instagram.dataset.token;
      var image_size = instagram.dataset.image_size;
      var nr_of_images = instagram.dataset.nr_of_images;
      $.ajax({
        type: "GET",
        url: 'https://graph.instagram.com/me?fields=account_type,username,media&access_token=' + token,
        crossDomain: true,
        success: function (instagram) {
          var images  = instagram.media.data;
          var all_images = "";
          var i = 0;

          images.forEach(image => {
            if(nr_of_images <= i) {
              return;
            }
            i++;
            $.ajax({
              type: "GET",
              url: 'https://graph.instagram.com/' + image.id + '?fields=media_url,permalink&access_token=' + token,
              crossDomain: true,
              success: function (response) {

                all_images += '<a href="' + response.permalink + '" target="_blank">';
                all_images += '<img src="' + response.media_url + '" alt="instagram image" height="' + image_size + '" width="' + image_size + '">';
                all_images += '</a>';

                $(widget).find('.content').html(all_images);
              },
              dataType: "jsonp" //set to JSONP, is a callback
            });
          });
        }
      });
    });
  });

})(jQuery);