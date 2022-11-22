$(document).ready(function () {
    // $.ajax({
    //     type: "get",
    //     url: "http://localhost:8000/user/ajax/pizza/list",
    //     dataType: "json",
    //     success: function(response) {
    //         console.log(response);
    //     }
    // });
    $("#sortingOption").change(function () {
        $eventOption = $("#sortingOption").val();
        // console.log($eventOption);

        if ($eventOption == "desc") {
            $.ajax({
                type: "get",
                url: "http://localhost:8000/user/ajax/pizza/list",
                data: {
                    status: "desc",
                },
                dataType: "json",
                success: function (response) {
                    $list = "";
                    for ($i = 0; $i < response.length; $i++) {
                        // console.log(`${response[$i].name }`);
                        $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="../storage/${response[$i].image}" alt="" style="height: 260px;">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="pizza/details/${response[$i].id}" title="View Info"><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                                </div>
                        <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>${response[$i].price} kyats</h5>

                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-warning mr-1"></small>
                            <small class="fa fa-star text-warning mr-1"></small>
                            <small class="fa fa-star text-warning mr-1"></small>
                            <small class="fa fa-star text-warning mr-1"></small>
                            <small class="fa fa-star text-warning mr-1"></small>
                        </div>
                    </div>
                    </div>
                    </div>
                        `;
                    }
                    // console.log($list);
                    $("#dataList").html($list);
                },
            });
        } else if ($eventOption == "asc") {
            $.ajax({
                type: "get",
                url: "http://localhost:8000/user/ajax/pizza/list",
                data: {
                    status: "asc",
                },
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    $list = "";
                    for ($i = 0; $i < response.length; $i++) {
                        // console.log(`${response[$i].name }`);
                        $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="../storage/${response[$i].image}" alt="" style="height: 260px;">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="pizza/details/${response[$i].id}" title="View Info"><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                                </div>
                        <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>${response[$i].price} kyats</h5>

                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-warning mr-1"></small>
                            <small class="fa fa-star text-warning mr-1"></small>
                            <small class="fa fa-star text-warning mr-1"></small>
                            <small class="fa fa-star text-warning mr-1"></small>
                            <small class="fa fa-star text-warning mr-1"></small>
                        </div>
                    </div>
                    </div>
                    </div>
                        `;
                    }
                    // console.log($list);
                    $("#dataList").html($list);
                },
            });
        }
    });
});
