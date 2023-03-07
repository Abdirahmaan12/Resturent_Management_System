loadepayment();
fillcustomer();
fillorder();
fillaccount();
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

function fillorder() {


    let sendingData = {
        "action": "read_all_orders"
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/payment.php",
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
function fillaccount() {


    let sendingData = {
        "action": "read_all_account"
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/account.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';

            if (status) {
                response.forEach(res => {
                    html += `<option value="${res['id']}">${res['bank']}</option>`;

                })

                $("#account_id").append(html);


            } else {
                displaymessage("error", response);
            }

        },
        error: function (data) {

        }

    })
}

 $("#paymentform").on("submit", function (event) {


    event.preventDefault();


    let customer_id = $("#customer_id").val();
    let food_id = $("#food_id").val();
    let account_id = $("#account_id").val();
    let amount = $("#amount").val();
    let paymant_id = $("#update_id").val();

    let sendingData = {}

    if (btnAction == "Insert") {
        sendingData = {
            "customer_id": customer_id,
            "food_id": food_id,
            "account_id": account_id,
            "amount": amount,
            "action": "register_payment"
        }

    } else {
        sendingData = {
            "paymant_id": paymant_id,
            "customer_id": customer_id,
            "food_id": food_id,
            "account_id": account_id,
            "amount": amount,
            "action": "update_payment"
        }
    }



    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/payment.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;

            if (status) {
                swal("Good job!", response, "success");
                btnAction = "Insert";
                loadepayment();
                $("#paymentform")[0].reset();
                



            } else {
                payment("error", response);
            }

        },
        error: function (data) {
            paymentmessage("error", data.responseText);

        }

    })

})

function loadepayment() {

    $("#paymenttable tbody").html('');
    $("#paymenttable thead").html('');

    let sendingData = {
        "action": "read_all_payment"
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/payment.php",
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

                    tr += `<td> <a class="btn btn-info update_info"  update_id=${res['paymant_id']}><i class="fas fa-edit" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id=${res['paymant_id']}><i class="fas fa-trash"style="color: #fff"></i></a> </td>`
                    tr += "</tr>"

                })
                $("#paymenttable thead").append(th);
                $("#paymenttable tbody").append(tr);
            }

        },
        error: function (data) {

        }

    })
}

function get_payment(paymant_id) {

    let sendingData = {
        "action": "get_payment",
        "paymant_id": paymant_id 
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/payment.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;


            if (status) {

                btnAction = "update";

                loademploye();
                
                $("#update_id").val(response['paymant_id']);
                $("#customer_id").val(response['customer_id']);
                $("#food_id").val(response['food_id']);
                $("#account_id").val(response['account_id']);
                $("#amount").val(response['amount']);
                $("#paymentmodal").modal('show');



                


            } else {
                ordermessage("error", response);
            }

        },
        error: function (data) {

        }

    })
}


function Delete_payment(paymant_id) {



    let sendingData = {
        "action": "Delete_payments",
        "paymant_id": paymant_id
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/payment.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;


            if (status) {
                loadepayment();
                swal("Good job!", response, "success");
                loadeorders();


            } else {
                swal(response);
            }

        },
        error: function (data) {

        }

    })
}


$("#paymenttable").on('click', "a.update_info", function () {
    let paymant_id = $(this).attr("update_id");
    get_payment(paymant_id)
})


$("#paymenttable").on('click', "a.delete_info", function () {
    let paymant_id = $(this).attr("delete_id");
    if (confirm("Are you sure To Delete")) {
        Delete_payment(paymant_id)

    }

})  