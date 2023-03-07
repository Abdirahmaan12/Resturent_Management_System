btnAction = "Insert";
loadefood();


$("#foodfrom").on("submit", function (event) {



    event.preventDefault();


    let name = $("#name").val();
    let quantity_in_stock = $("#quantity_in_stock	").val();
    let unit_price = $("#unit_price").val();
    let food_id = $("#update_id").val();


    let sendingData = {}

    if (btnAction == "Insert") {
        sendingData = {
            "name": name,
            "quantity_in_stock": quantity_in_stock,
            "unit_price": unit_price,
            "action": "register_food"
        }

    } else {
        sendingData = {
            "food_id": food_id,
            "name": name,
            "quantity_in_stock": quantity_in_stock,
            "unit_price": unit_price,
            "action": "update_food"
        }
    }



    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/food.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;

            if (status) {
                swal("Good job!", response, "success");

                btnAction = "Insert";
                loadefood();
                $("#foodfrom")[0].reset();





            } else {
                message("error", response);
            }

        },
        error: function (data) {
            foodmessage("error", data.responseText);

        }

    })

})





function loadefood() {
    $("#foodTable tbody").html('');
    $("#foodTable thead").html('');

    let sendingData = {
        "action": "read_all_food"
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/food.php",
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

                    tr += `<td> <a class="btn btn-info update_info"  update_id=${res['food_id']}><i class="fas fa-edit" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id=${res['food_id']}><i class="fas fa-trash"style="color: #fff"></i></a> </td>`
                    tr += "</tr>"

                })
                $("#foodTable thead").append(th);
                $("#foodTable tbody").append(tr);
            }

        },
        error: function (data) {

        }

    })
}

function getfood(food_id) {



    let sendingData = {
        "action": "get_foods_info",
        "food_id": food_id
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/food.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;


            if (status) {

                btnAction = "update";


                $("#update_id").val(response['food_id']);
                $("#name").val(response['name']);
                $("#quantity_in_stock").val(response['quantity_in_stock']);
                $("#unit_price").val(response['unit_price']);
                $("#foodmodal").modal('show');






            } else {
                foodmessage("error", response);
            }

        },
        error: function (data) {

        }

    })
}


function delete_food(food_id) {


    let sendingData = {
        "action": "Delete_food",
        "food_id": food_id
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/food.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;


            if (status) {
                swal("Good job!", response, "success");
                loadefood();


            } else {
                swal(response);
            }

        },
        error: function (data) {

        }

    })
}


$("#foodTable").on('click', "a.update_info", function () {
    let food_id = $(this).attr("update_id");
    getfood(food_id)
})


$("#foodTable").on('click', "a.delete_info", function () {
    let food_id = $(this).attr("delete_id");
    if (confirm("Are you sure To Delete")) {
        delete_food(food_id)

    }

})