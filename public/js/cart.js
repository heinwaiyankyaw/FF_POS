$(document).ready(function () {
    // when add button click
    $(".btn-plus").click(function () {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find("#price").text().replace("kyats", ""));
        $qty = Number($parentNode.find("#qty").val());

        $total = $price * $qty;

        $parentNode.find("#total").html($total + " kyats");

        summaryCalculation();
    });
    // when minus button click
    $(".btn-minus").click(function () {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find("#price").text().replace("kyats", ""));
        $qty = Number($parentNode.find("#qty").val());

        $total = $price * $qty;
        $parentNode.find("#total").html($total + " kyats");

        summaryCalculation();
    });

    // when remove button click tdbody of data was removed.
    $(".btnRemove").click(function () {
        $parentNode = $(this).parents("tr");
        $productId = $parentNode.find('#productId').val();
        $cartId= $parentNode.find('#cartId').val();
        $.ajax({
            type: "get",
            url: "/user/ajax/clear/current/product",
            data: {'productId' : $productId, 'cartId' : $cartId},
            dataType: "json",
        });
        $parentNode.remove();
        summaryCalculation();
    });

    // calculate final price for orders
    function summaryCalculation() {
        //total summary
        $totalPrice = 0;
        $("#dataTable tbody tr").each(function (index, row) {
            $totalPrice += Number(
                $(row).find("#total").html().replace("kyats", "")
            );
        });

        $("#subTotalPrice").html(`${$totalPrice} kyats`);
        $("#finalPrice").html(`${$totalPrice + 5000} kyats`);
    }

    // order btn session
    $('#orderBtn').click(function(){
        $parent = $(this).parents('tr');
        $orderList = [];
        $random = Math.floor(Math.random()*10000001);
        $("#dataTable tbody tr").each(function(index,row){
            $orderList.push({
                'user_id' :$(row).find('#userId').val(),
                'product_id' : $(row).find('#productId').val(),
                'qty': $(row).find('#qty').val(),
                'total' : Number($(row).find('#total').html().replace('kyats','')),
                'order_code':'POS'+$random,
            });
        });

        $.ajax({
            type: "get",
            url: "/user/ajax/order",
            data: Object.assign({},$orderList),
            dataType: "json",
            success: function (response) {
                if(response.status == 'success'){
                    window.location.href = "http://localhost:8000/user/homePage";
                }
            }
        });
    });

    //when clear Btn was clicked
    $('#clearBtn').click(function(){
        $.ajax({
            type: "get",
            url: "/user/ajax/clear/cart",
            dataType: "json"
        });
        $('#dataTable tbody').remove();
        $('#subTotalPrice').html('0 Kyats');
        $('#finalPrice').html('5000 Kyats')
    });

});
