$(document).ready(function () {
    $(".roleStatus").change(function () {
        $checkStatus = $(this).val();
        $parentNode = $(this).parents('tr');
        $adminId = $parentNode.find('#adminId').val();
        $data = {
            'admin_id' : $adminId,
            'roleSatus' : $checkStatus
        };
        $.ajax({
            type: "get",
            url: "/admin/role/change",
            data: $data,
            dataType: "json",
            success: function (response) {

            }
        });
    });
});
