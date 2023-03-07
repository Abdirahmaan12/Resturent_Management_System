loadeorders();
fillcustomer();
fillfoodname();
btnAction = "Insert";

function fillcustomer() {


    let sendingData = {
        "action": "read_all_customers"
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/order.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';

            if (status) {
                response.forEach(res => {
                    html += `<option value="${res['customer_id']}">${res['frist_name']}</option>`;

                })

                $("#customer_id").append(html);


            } else {
                displaymessage("error", response);
            }

        },
        error: function (data) {

        }

    })
}

function fillfoodname() {


    let sendingData = {
        "action": "read_all_food"
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/order.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';

            if (status) {
                response.forEach(res => {
                    html += `<option value="${res['food_id']}">${res['name']}</option>`;

                })

                $("#food_id").append(html);


            } else {
                displaymessage("error", response);
            }

        },
        error: function (data) {

        }

    })
}



$("#orderform").on("submit", function (event) {


    event.preventDefault();


    let customer_id = $("#customer_id").val();
    let food_id = $("#food_id").val();
    let quantity = $("#quantity").val();
    let unit_price = $("#unit_price").val();
    let order_id = $("#update_id").val();

    let sendingData = {}

    if (btnAction == "Insert") {
        sendingData = {
            "customer_id": customer_id,
            "food_id": food_id,
            "quantity": quantity,
            "unit_price": unit_price,
            "action": "register_orders"
        }

    } else {
        sendingData = {
            "order_id": order_id,
            "customer_id": customer_id,
            "food_id": food_id,
            "quantity": quantity,
            "unit_price": unit_price,
            "action": "update_orders"
        }
    }



    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/order.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;

            if (status) {
                swal("good job!", response, "success");
                btnAction = "Insert";
                loadeorders();
                $("#orderform")[0].reset();

            } else {
                ordemessage("error", response);
            }

        },
        error: function (data) {
            ordersmessage("error", data.responseText);

        }

    })

})




function loadeorders() {

    $("#ordersTable tbody").html('');
    $("#ordersTable thead").html('');

    let sendingData = {
        "action": "read_all_orders"
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/order.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';
            let th = '';

            if (status) {
                response.forEach(res => {
                    th = "<tr>";
                    for (let r in res) {
                        th += `<th>${r}</th>`;
                    }

                    th += "<td>Action</td></tr>";




                    tr += "<tr>";
                    for (let r in res) {


                        tr += `<td>${res[r]}</td>`;


                    }

                    tr += `<td> <a class="btn btn-info update_info"  update_id=${res['order_id']}><i class="fas fa-edit" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id=${res['order_id']}><i class="fas fa-trash"style="color: #fff"></i></a> </td>`
                    tr += "</tr>"

                })
                $("#ordersTable tbody").append(tr);
                $("#ordersTable thead").append(th);
            }

        },
        error: function (data) {

        }

    })
}

function get_order_info(order_id) {

    let sendingData = {
        "action": "get_orders_info",
        "order_id": order_id
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/order.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;


            if (status) {

                btnAction = "update";

                $("#update_id").val(response['emp_id']);
                $("#customer_id").val(response['customer_id']);
                $("#food_id").val(response['food_id']);
                $("#quantity").val(response['quantity']);
                $("#unit_price").val(response['unit_price']);
                $("#ordersmodal").modal('show');


            } else {
                ordermessage("error", response);
            }

        },
        error: function (data) {

        }

    })
}


function Delete_orders(order_id) {



    let sendingData = {
        "action": "Delete_orders",
        "order_id": order_id
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/order.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;


            if (status) {

                swal("Good job!", response, "success");


            } else {
                swal(response);
            }

        },
        error: function (data) {

        }

    })
}


$("#ordersTable").on('click', "a.update_info", function () {
    let order_id = $(this).attr("update_id");
    get_order_info(order_id)
})


$("#ordersTable").on('click', "a.delete_info", function () {
    let id = $(this).attr("delete_id");
    if (confirm("Are you sure To Delete")) {
        Delete_orders(id)

    }

})  