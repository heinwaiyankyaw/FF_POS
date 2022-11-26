$(document).ready(function () {
    $('.statusChange').change(function(){
        $currentStatus = $(this).val();
        $parentNode = $(this).parents('tr');
        $userId = $parentNode.find('#userId').val();

        $data = {
            'userId' : $userId,
            'status' : $currentStatus
        };
        $.ajax({
            type: "get",
            url: "/users/change/userRole",
            data: $data,
            dataType: "json",
        });
        location.reload();
    });
});
