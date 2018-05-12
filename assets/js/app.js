// A $( document ).ready() block.
$( document ).ready(function() {
    
    var qualifyURL = function(pathOrURL) {
       if (!(new RegExp('^(http(s)?[:]//)','i')).test(pathOrURL)) {
         return $(document.body).data('base') + pathOrURL;
       }

       return pathOrURL;
    };

    $('#toaster-box').hide();
    $('#overlay').hide();
    $('#loader').hide();
    
    $( ".toaster-cross" ).click(function() {
	  $('#toaster-box').hide();
	});

    $( ".log-out" ).click(function() {       
        console.log("Logout");
        $.ajax
        ({ 
            url: qualifyURL('login/logout'),
            data : { 'logout' : true},
            type: 'post',
            success: function(response)
            {
                console.log(response)
                var obj = jQuery.parseJSON(response);    
                if(obj.message.title!=''){
                   tostAlert(response);
                }                
                window.setTimeout(function() {
                    window.location.replace(qualifyURL(''));
                }, 2000);
            }
        });

    });
});

function loader(time){
	$( "#overlay" ).show(0).delay(time).hide(0);
    $( "#loader" ).show(0).delay(time).hide( 0, function() {
    	
  	});
}



