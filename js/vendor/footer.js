

// フッターを下部に固定
$(function () {
  var $ftr = $('#footer');
  if (window.innerHeight > $ftr.offset().top + $ftr.outerHeight()) {
    $ftr.attr({ 'style': 'position:fixed; top:' + (window.innerHeight - $ftr.outerHeight()) + 'px;' });
  }
});

