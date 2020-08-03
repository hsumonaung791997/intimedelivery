$(function() {
	$('#account_head_id').on('change', function() {
		var type = $("option:selected" , $(this)).data('type');
		$('#accountType').html(type);

	})


});


$(function() {
	$('#account_head_id').on('change', function(){
		var account_id = $("option:selected", $(this)).data('account_id');
		return account_id;
		$('#account_id').html(account_id);
	});

});








 