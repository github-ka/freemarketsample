$(function () {


  //画像の切り替え処理
   var mainimg = $('.img-main img').attr('src');
  $('.img-sub img').on( {
    'mouseover': function() {
      var img = $(this).attr('src');
      $('.img-main img').attr('src', img);
    },
    'mouseleave': function() {
      $('.img-main img').attr('src', mainimg);
    }
  });




});
