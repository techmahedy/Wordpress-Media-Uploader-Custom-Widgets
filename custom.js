(function($){

  $(document).ready(function(){
    $('button#author_info_image').on("click",function(object){

       object.preventDefault(); 

       var imageUploader;

       imageUploader = wp.media({
           'title' : 'Upload author image',
           'button' : {
               'text' : 'Set the image'
           },
           'multiple' : true
       }); // wp javascript object
       imageUploader.open(); // For opening image box

       imageUploader.on("select" , function(){
          var image = imageUploader.state().get("selection").first().toJSON();
          var link = image.url;

          $("input.image_er_link").val(link);
          $(".image_show img").attr('src' , link);
       }); 

    });
  });

}(jQuery));