btnAction = "Insert";
loadeaccount();


$("#accountfrom").on("submit", function (event) {



    event.preventDefault();


    let account_number = $("#account_number").val();
    let bank = $("#bank	").val();
    let balance = $("#balance").val();
    let id = $("#update_id").val();


    let sendingData = {}

    if (btnAction == "Insert") {
        sendingData = {
            "account_number": account_number,
            "bank": bank,
            "balance": balance,
            "action": "register_account"
        }

    } else {
        sendingData = {
            "id": id,
            "account_number": account_number,
            "bank": bank,
            "balance": balance,
            "action": "update_account"
        }
    }



    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/account.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;

            if (status) {
                swal("Good job!", response, "success");
                btnAction = "Insert";
                loadeaccount();

                $("#accountfrom")[0].reset();

            } else {
                message("error", response);
            }

        },
        error: function (data) {
            foodmessage("error", data.responseText);

        }

    })

})


function loadeaccount() {
    $("#accounttable tbody").html('');
    $("#accounttable thead").html('');

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

                    tr += `<td> <a class="btn btn-info update_info"  update_id=${res['id']}><i class="fas fa-edit" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id=${res['id']}><i class="fas fa-trash"style="color: #fff"></i></a> </td>`
                    tr += "</tr>"

                })
                $("#accounttable thead").append(th);
                $("#accounttable tbody").append(tr);
            }

        },
        error: function (data) {

        }

    })
}

function getaccount(id) {



    let sendingData = {
        "action": "get_account_info",
        "id": id
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/account.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;


            if (status) {

                btnAction = "update"

                $("#update_id").val(response['id']);
                $("#account_number").val(response['account_number']);
                $("#bank").val(response['bank']);
                $("#balance").val(response['balance']);
                $("#accountmodal").modal('show');
                loadeaccount();







            } else {
                accountmessage("error", response);
            }

        },
        error: function (data) {

        }

    })
}


function delete_account(id) {


    let sendingData = {
        "action": "Delete_account",
        "id": id
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/account.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;


            if (status) {
                swal("Good job!", response, "success");
                loadeaccount();





            } else {
                swal(response);
            }

        },
        error: function (data) {

        }

    })
}


$("#accounttable").on('click', "a.update_info", function () {
    let id = $(this).attr("update_id");
    getaccount(id)
})


$("#accounttable").on('click', "a.delete_info", function () {
    let id = $(this).attr("delete_id");
    if (confirm("Are you sure To Delete")) {
        delete_account(id)




    }

})