$(document).ready(function () {
    // $("#orderStatus").change(function () {
    //     $status = $("#orderStatus").val();
    //     $.ajax({
    //         type: "get",
    //         url: "http://localhost:8000/orders/ajax/status",
    //         data: { status: $status },
    //         dataType: "json",
    //         success: function (response) {
    //             // append
    //             $list = "";
    //             for ($i = 0; $i < response.length; $i++) {
    //                 $months = [
    //                     "Jan",
    //                     "Feb",
    //                     "Mar",
    //                     "Apr",
    //                     "May",
    //                     "Jun",
    //                     "Jul",
    //                     "Aug",
    //                     "Sept",
    //                     "Oct",
    //                     "Nov",
    //                     "Dec",
    //                 ];
    //                 $dbDate = new Date(response[$i].created_at);
    //                 $finalDate =
    //                     $months[$dbDate.getMonth()] +
    //                     "-" +
    //                     $dbDate.getDate() +
    //                     "-" +
    //                     $dbDate.getFullYear();

    //                 if (response[$i].status == 0) {
    //                     $statusMessage = `
    //                 <select class="form-control" name="status">
    //                     <option value="0" selected>Pending</option>
    //                     <option value="1">Confirm</option>
    //                     <option value="2">Reject</option>
    //                 </select>
    //                 `;
    //                 } else if (response[$i].status == 1) {
    //                     $statusMessage = `
    //                 <select class="form-control" name="status">
    //                     <option value="0">Pending</option>
    //                     <option value="1" selected>Confirm</option>
    //                     <option value="2">Reject</option>
    //                 </select>
    //                 `;
    //                 } else {
    //                     $statusMessage = `
    //                 <select class="form-control" name="status">
    //                     <option value="0">Pending</option>
    //                     <option value="1">Confirm</option>
    //                     <option value="2" selected>Reject</option>
    //                 </select>
    //                 `;
    //                 }

    //                 $list += `
    //              <tr class="tr-shadow">
    //              <td>${response[$i].user_id}</td>
    //              <td>${response[$i].user_name}</td>
    //              <td>${response[$i].order_code}</td>
    //              <td>${$finalDate}</td>
    //              <td>${response[$i].total_price} kyats</td>
    //              <td>${$statusMessage}</td>
    //          </tr>
    //          <tr class="spacer"></tr>
    //              `;
    //             }
    //             $("#dataList").html($list);
    //         },
    //     });
    // });

    // status change

    $('.statusChange').change(function(){
        $currentStatus = $(this).val();
        $parentNode = $(this).parents('tr');
        $orderId = $parentNode.find('.orderId').val();

        $data = {'status': $currentStatus,'orderId': $orderId};
        $.ajax({
            type: "get",
            url: "/orders/ajax/change/status",
            data: $data,
            dataType: "json",
        });
    });
});
