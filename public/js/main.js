$( document ).ready(function() {
    
    $( ".delete-category" ).click(function(e) {
       var id = $(e.target).attr("data-id");
        if (confirm("Are you sure you want to delete this Group?")) {
        $.ajax({
        type: "POST",
        url: "category/delete",
        data: {id:id} ,
        success: function(data) {
        //$('.center').html(data)
	  if(data == 'Saved'){
	    window.location.reload(true);
	   } 
        }
       });
      }else{
       return false;
      }
    });

    $( ".delete-user" ).click(function(e) {
       var id = $(e.target).attr("data-id");
        if (confirm("Are you sure you want to delete this User?")) {
        $.ajax({
        type: "POST",
        url: "/user/delete",
        data: {id:id} ,
        success: function(data) {
        
          if(data == 'Saved'){
            window.location.reload(true);
           }
           else if(data == 'Exists'){
             
            $("#result").empty().append('Group cannot be deleted');
             window.location.reload(true);
           }
        }
       });
      }else{
       return false;
      }
    });

});


