
$(document).ready(function(){

$('#landwrong').on('click',function(){
           
         var text = $(this).text();
         if(text=="Expand"){
           $(this).html('Collaps'); 
           $('.lwrong').hide();
         }else{
             $(this).html('Expand'); 
             $('.lwrong').show(); 
         }
        
	});
$('#registrationWrong').on('click',function(){
           
         var text = $(this).text();
         if(text=="Expand"){
           $(this).html('Collaps'); 
           $('.regwrong').hide();
         }else{
             $(this).html('Expand'); 
             $('.regwrong').show(); 
         }
        
	});
$('#activeuser').on('click',function(){
           
         var text = $(this).text();
         if(text=="Expand"){
           $(this).html('Collaps'); 
           $('.actuser').hide();
         }else{
             $(this).html('Expand'); 
             $('.actuser').show(); 
         }
        
	});
$('#inactiveuser').on('click',function(){
           
         var text = $(this).text();
         if(text=="Expand"){
           $(this).html('Collaps'); 
           $('.inactuser').hide();
         }else{
             $(this).html('Expand'); 
             $('.inactuser').show(); 
         }
        
	});


})


