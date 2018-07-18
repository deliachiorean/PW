// init modal 
$('.doc-item').on('click', function(){
  var $target = $(this)
    .next('.doc-modal-item');
  $('.mask, .doc-modal').fadeIn();
  cloneAppend($target);
});
// close
$('.close').on('click', function(){
  // remove the cloned element when closed  
  $(this).siblings('.doc-modal-item').remove();
  $('.mask, .doc-modal').fadeOut();
});
// next
$('.next, .prev').on('click', function(){
  // get number only of currently active 
  var id = parseInt($(this).siblings('.doc-modal-item').attr('id')[0]);
  var nextNum;
  if($(this).hasClass('next')) {
    nextNum = id + 1;
  } else if($(this).hasClass('prev')){
    nextNum = id - 1;
  }
  var nextTargetSearch = nextNum.toString() + '-doc';
  var $nextTarget = $('#' + nextTargetSearch);
  // remove current  
  $(this).siblings('.doc-modal-item').remove();
  if($nextTarget.length > 0) { 
    cloneAppend($nextTarget);
  } else {
    $('.mask, .doc-modal').fadeOut();
  }
});
// helper
function cloneAppend(el){
  var $clone = $(el).clone();
  $('.doc-modal').append($clone);
  $clone.children().wrapAll('<div class="flex"></div>');
  $clone.fadeIn();
}