<script>
    function TogglePayed(identifier, menu_id)
    {
        var my_url = "{{ url('/') }}" + '/orders/togglePayed/'+menu_id
        var tr      = document.getElementById('row-menu-'+menu_id)
        var checked = identifier.checked

        if(checked){
            tr.style.textDecoration='line-through'
            tr.classList.toggle('text-muted')

        }else{
            tr.style.textDecoration='none'
            tr.classList.toggle('text-muted')
        }

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $.ajax({
            type: 'PUT',
            url: my_url,
            data: { 
                menu_id: menu_id,
                checked: checked
            },
            dataType: 'json',
            success: function (data) {
                // alert('Record updated successfully');
            },
            error: function (data) {
                // console.log('Error:', data);
                // var obj = {
                // };
            }
        });
    }
</script>
