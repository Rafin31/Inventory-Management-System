<script>
    $.ajaxSetup({
            headers:{
                "x-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        })
</script>