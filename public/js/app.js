$(document).ready(function () {
    var selected_ids = [];

    $(".checkAll").click(function(){
        $('.datatable-checkboxes').not(this).prop('checked', this.checked);
        $('input[name="clients[]"]').each(function(i){
            if ($(this).is(':checked')) {
                // Perform action when checkbox is checked
                selected_ids.push($(this).val())

            } else {
                // Perform action when checkbox is unchecked
                selected_ids.pop($(this).val())
                console.log('Checkbox is unchecked.');
            }
        });
    });

});
