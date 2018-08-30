$(document).ready(function()  
{  
	
	//Used for debugging
	var easter_egg = new Konami();
	easter_egg.code = function() { $("#experimental").css("display",""); }
	easter_egg.load();
	
	//$("#edit-submit2").hide();

	//Used to change the which datasets are active
	$('.form-checkbox').click(function() {
		
		var checked = 0;
	
		if(this.checked == true) {
			checked = 1;
		}

	});

	//Determine if checkbox is checked or not
	var checked = $("input#edit-family:checked").length;
	
	if(!checked) {
		$('div#edit-family-name-wrapper').hide();
	}
	
	 
	$('input#edit-family').click(function(){
			var checked = $("input#edit-family:checked").length;
            
            if(checked) {
            	$('div#edit-family-name-wrapper').show();
            } else {
            	$('div#edit-family-name-wrapper').hide();
            }
            
        }); 
        
     $('a.popup').click(function(event){
     	event.preventDefault();
     	window.open ($(this).attr('href'),"mywindow");
     });
     
     $("#edit-select-all-0").click(function() 
            { 
                var checked_status = this.checked; 
                //alert("Select all");
                $('input[class*=form-checkbox]').each(function() 
                { 
                	
                    this.checked = checked_status; 
                   
              
                }); 
            }); 
}); 