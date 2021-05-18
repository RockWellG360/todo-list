// JavaScript for deleting todo
$(document).on('click', '.delete-object', function(){
   
    var id = $(this).attr('delete-id');
    
    bootbox.confirm({
        message: "<h4>Are you sure?</h4>",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-danger'
            },
            cancel: {
                label: 'No',
                className: 'btn-primary'
            }
        },
        callback: function (result) {
  
            if(result==true){
                $.post('delete_todo.php', {
                    object_id: id
                }, function(data){
                    location.reload();
                }).fail(function() {
                    alert('Unable to delete.');
                });
            }
        }
    });
  
    return false;
});

// JavaScript for deleting todo
$(document).on('click', '.edit-object', function(){
   
    var id = $(this).attr('edit-data');
    var title = $(this).attr('edit-title');
    var description = $(this).attr('edit-description');
    var current_url = window.location.href;

    var frm_str = '<div>'
        +'<h1>Update Todo</h1>'
        + '</div>' 
        + '<form id="formId" action="">'
        + '<table class="table">'
        + '<tr>'
        + '<td>Title</td>'
        + '<td><input type="text" name="title" id="title" value='+ title +' /></td>'
        + '</tr>'
        + '<tr>'
        + '<td>Description</td>'
        + '<td><textarea name="description" id="description">'+ description +'</textarea></td>'
        + '</tr>'
        + '</table>'
        + '</form>';
    
    bootbox.confirm(frm_str, function(result) {
        
       
        if(result==true){
            $('#formId').submit();
            $.post('update_todo.php', {
                id: id,
                title: document.getElementById("title").value,
                description: document.getElementById("description").value
            }, function(data){
                window.location.reload();
            }).fail(function() {
                alert('Unable to update.');
            });
        }
});
    return false;
});

// Get the container element
var btnContainer = document.getElementById("pagination");

// Get all buttons with class="btn" inside the container
var btns = btnContainer.getElementsByClassName("btn");

// Loop through the buttons and add the active class to the current/clicked button
for (var i = 0; i < btns.length; i++) {
btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    
    // If there's no active class
    if (current.length > 0) {
    current[0].className = current[0].className.replace(" active", "");
    }

    // Add the active class to the current/clicked button
    this.className += " active";
});
}

