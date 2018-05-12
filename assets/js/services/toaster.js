function tostAlert(allData){
	//console.log(allData);
	$('#toaster-box').show(0).delay(2000).fadeOut(2000);
	var obj = jQuery.parseJSON(allData);
	if(obj.success){
    	$('.toaster').addClass('toaster-success');
    }else{
		$('.toaster').addClass('toaster-error');    	
    }
	$('.toaster-title').html(obj.message.title);
	$('.toaster-details').html(obj.message.description);
}