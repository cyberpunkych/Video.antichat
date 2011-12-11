//Скрываем все группы категорий кроме текущей (.category-group)
$('.category-group').not(".current").addClass('hide');
$(function() {
	
	
 	$('.category-group-head').click( function () {
		$(this).next('ul').slideToggle(200,
		function () {$(this).parent().toggleClass('hide');} //Нижние закругление к заголовку группы
		);
		
		
		})
		
		
//hold-place		
$('.afill').hint('nice-edit-focus');		
		
		
});