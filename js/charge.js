filluser();
loadcharge();
function filluser() {

    let sendingData = {
        "action": "get_allusers"
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/charge.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';

            if (status) {
                response.forEach(res => {
                    html += `<option value="${res['user_id']}">${res['username']}</option>`;

                })

                $("#user").append(html);


            } else {
                displaymessage("error", response);
            }

        },
        error: function (data) {

        }

    })
}


btnAction = "Insert";


$("#chargeform").on("submit", function (event) {

    event.preventDefault();


    let month = $("#month").val();
    let year = $("#year").val();
    let description = $("#description").val();
    let user = $("#user").val();
    let account_id = $("#account_id").val();
    let id = $("#update_id").val();

    let sendingData = {}

    if (btnAction == "Insert") {
        sendingData = {
            "month": month,
            "year": year,
            "description": description,
            "user": user,
            "account_id": account_id,
            "action": "register_charge"
        }

    } else {
        sendingData = {
            "booking_id": id,
            "month": month,
            "year": year,
            "description": description,
            "user": user,
            "account_id": account_id,
            "action": "update_booking"
        }
    }



    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/charge.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;

            if (status) {
                swal("Good job!", response, "success");
                btnAction = "Insert";
                $("#chargeform")[0].reset();
                loadcharge();





            } else {
                swal("NOW", response, "error");
            }

        },
        error: function (data) {
            swal("Good job!", response, "error");

        }

    })

})

function loadcharge() {
    $("#chargeTable tbody").html('');
    $("#chargeTable thead").html('');

    let sendingData = {
        "action": "read_all_charge"
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/charge.php",
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





                    tr += "<tr>";
                    for (let r in res) {


                        tr += `<td>${res[r]}</td>`;


                    }



                })
                $("#chargeTable thead").append(th);
                $("#chargeTable tbody").append(tr);
            }




        },
        error: function (data) {

        }

    })
}