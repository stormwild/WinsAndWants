$(function() {
	$('.checkall').click(function() {
		$('#winsform').find(':checkbox').attr('checked', this.checked);
	});
	// Datepicker
	$('#created').datepicker( {
		inline : true,
		dateFormat : 'yy-mm-dd'
	});
	$("input").blur(function() {
		doValidation($(this).attr('id'));
	});
});

function doValidation(id) {
	//var url = 'http://winsandwants.com/service/validate/';
	var url = 'http://localhost/winsandwants/service/validate/';
	var data = {};
	$("input").each(function() {
		data[$(this).attr('name')] = $(this).val();
	});
	$.post(url, data, function(resp) {
		$("#" + id).parent().find('.errors').remove();
		$("#" + id).parent().append(getErrorHtml(resp[id], id));
	}, 'json');
}

function getErrorHtml(formErrors, id) {
	if (formErrors != null) {
		var o = '<ul id="errors-' + id + '" class="errors">';
		for (errorKey in formErrors) {
			o += '<li>' + formErrors[errorKey] + '</li>';
		}
		o += '</ul>';
		return o;
	} else {
		return;
	}
}