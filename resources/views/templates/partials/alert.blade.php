
<script>
    @if( notify()->ready() )
    swal({
        title: " {{notify()->message()}}",
        type: "{{notify()->type()}}",
        @if(notify()->option('timer'))
            timer: {{ notify()->option('timer') }},
        @endif
    });
    @endif
</script>

