 </div>
    <!-- /container -->
  
<!-- jQuery (necessary for JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<script>
// JavaScript for deleting product
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
</script>  

<script>
    $('ul.pagination a').click(function(){
        $('ul.pagination a').removeClass("active");
        $(this).addClass("active");
    });
</script>
</body>
</html>