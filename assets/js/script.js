$('.none').css('display', 'none');

$('.btn-comment').on('click', function() {
  $('.comment-div').css('display', 'block');
  $('.btn-comment').val(this.name);
  var val = this.name;
  $('.parent').attr('value', val);
});

$('.btn-close').on('click', function() {
	$('.comment-div').css('display', 'none');
});	

$('.btn-plus-minus').on('click', function() {
	var val = '.' + this.name;

	$(val).slideToggle();
});	

$('.text-more').click(function(){
	if ($(this).text() == '... show full') {
		$(this).text('return')
	}
	else {
		$(this).text('... show full')
	}
	var $prevText = $(this).prev();
	$prevText.slideToggle(0);
	return false;
});

$('.btn-edit').on('click', function() {
  $('.comment-div').css('display', 'block');
  $('.btn-edit').val(this.name);
  var val = this.name;
  $('.edit').attr('value', val);
});