


$("#newGallery").click(function(event) {

	event.preventDefault();
	$(".blackout").fadeToggle(500);
	$("#new-gallery").fadeToggle(500);

});

$("#newYear").click(function(event) {

	event.preventDefault();
	$(".blackout").fadeToggle(500);
	$("#new-year").fadeToggle(500);

});

$("#delete-gallery").click(function(event) {

	event.preventDefault();
	$(".blackout").fadeToggle(500);
	$("#check-delete").fadeToggle(500);

});

$("#delete-year").click(function(event) {

	event.preventDefault();
	$(".blackout").fadeToggle(500);
	$("#check-delete-year").fadeToggle(500);

});

$("#upload").click(function(event) {

	event.preventDefault();
	$(".blackout").fadeToggle(500);
	$("#upload-form").fadeToggle(500);

});

$("#delete-selected").click(function(event) {

	event.preventDefault();
	$(".blackout").fadeToggle(500);
	$("#delete-selected-form").fadeToggle(500);

});

$(".delete-box").click(function(event) {	

	if ($(".delete-box").is(":checked")) {
		$("#delete-selected-container").slideDown(500);
	} else {
		$("#delete-selected-container").slideUp(500);
	}

});

$(".blackout,#no").click(function(event) {

	event.preventDefault();
	$(".blackout").fadeOut(500);
	$(".new-gallery").fadeOut(500);

});

$("#gallery").change(function(event) {

	$("#form").submit();

});

$("#year").change(function(event) {

	$("#gallery").remove();
	$("#form").submit();


});
