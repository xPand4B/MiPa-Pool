@section('javascript')
    <script>
        $(document).ready(function(){
            // Input is not empty on page load
            if($("#searchbar-management").val()){
                var value = $("#searchbar-management").val().toLowerCase().trim();

                $("#table-management tr").each(function (index) {
                    if (!index)
                        return;

                    $(this).find("td").each(function () {
                        var id = $(this).text().toLowerCase().trim();
                        var not_found = (id.indexOf(value) == -1);
                        $(this).closest('tr').toggle(!not_found);
                        return not_found;
                    });
                });
            }                

            // Input is empty on page load
            $("#searchbar-management").keyup(function () {
                var value = this.value.toLowerCase().trim();

                $("#table-management tr").each(function (index) {
                    if (!index)
                        return;

                    $(this).find("td").each(function () {
                        var id = $(this).text().toLowerCase().trim();
                        var not_found = (id.indexOf(value) == -1);
                        $(this).closest('tr').toggle(!not_found);
                        return not_found;
                    });
                });
            });
        });
    </script>
@endsection
