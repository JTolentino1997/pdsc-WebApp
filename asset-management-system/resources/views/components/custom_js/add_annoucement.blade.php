<script>
    function showModal()
    {
        $('#add').modal('show');
    }

    function add()
    {
        var formData = $('#add-form').serializeArray();
        console.log(formData);
        $('#overlay').show();
        $('#loaderContainer').show();

        var fieldLabels = {
            'lastName': 'lastName',
            'firstName': 'firstName',
            'middleName': 'middleName',
            'email': 'email',
        };

        $.ajax(){
            url: ""
        }
    }
</script>