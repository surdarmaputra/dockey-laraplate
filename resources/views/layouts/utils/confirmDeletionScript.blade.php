<script>
    function confirmDeletion(event) {
        event.preventDefault();
        swal({
            title: 'Are you sure?',
            text: 'Once deleted, you will not be able to recover the data.',
            buttons: true,
            icon: 'warning',
            dangerMode: true
        }).then(function(willDelete) {
            if (willDelete) event.target.form.submit();
        })
    }
</script>