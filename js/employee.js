loademploye();

btnAction = "Insert";
filltype();

function filltype() {


    let sendingData = {
        "action": "read_all_employe_type"
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/employee.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';

            if (status) {
                response.forEach(res => {
                    html += `<option value="${res['id']}">${res['Title']}</option>`;

                })

                $("#type").append(html);


            } else {
                displaymessage("error", response);
            }

        },
        error: function (data) {

        }

    })
}

$("#employeeform").on("submit", function (event) {

    event.preventDefault();


    let full_name = $("#full_name").val();
    let phone = $("#phone").val();
    let type = $("#type").val();
    let id = $("#update_id").val();

    let sendingData = {}

    if (btnAction == "Insert") {
        sendingData = {
            "full_name": full_name,
            "phone": phone,
            "type": type,
            "action": "register_employee"
        }

    } else {
        sendingData = {
            "emp_id": id,
            "full_name": full_name,
            "phone": phone,
            "type": type,
            "action": "update_employe"
        }
    }



    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/employee.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;

            if (status) {
                swal("Good job!", response, "success");
                btnAction = "Insert";
                loademploye();

                loademployee();
                $("#employeeform")[0].reset();
                loademploye();



            } else {
                employemessage("error", response);
            }

        },
        error: function (data) {
            employemessage("error", data.responseText);

        }

    })

})




function loademploye() {
    $("#employeeTable tbody").html('');
    $("#employeeTable thead").html('');

    let sendingData = {
        "action": "read_all_employe"
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/employee.php",
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

                    tr += `<td> <a class="btn btn-info update_info"  update_id=${res['emp_id']}><i class="fas fa-edit" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id=${res['emp_id']}><i class="fas fa-trash"style="color: #fff"></i></a> </td>`
                    tr += "</tr>"

                })
                $("#employeeTable thead").append(th);
                $("#employeeTable tbody").append(tr);
            }

        },
        error: function (data) {

        }

    })
}

function get_employe_info(emp_id) {

    let sendingData = {
        "action": "get_employe_info",
        "emp_id": emp_id
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/employee.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;


            if (status) {

                btnAction = "update";

                loademploye();

                $("#update_id").val(response['emp_id']);
                $("#full_name").val(response['fullname']);
                $("#phone").val(response['phone']);
                $("#type").val(response['emp_type_id']);
                $("#employeemodal").modal('show');






            } else {
                employemessage("error", response);
            }

        },
        error: function (data) {

        }

    })
}


function Delete_employe(emp_id) {

    let sendingData = {
        "action": "Delete_employe",
        "emp_id": emp_id
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/employee.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;


            if (status) {

                swal("Good job!", response, "success");
                loademploye();


            } else {
                swal(response);
            }

        },
        error: function (data) {

        }

    })
}


$("#employeeTable").on('click', "a.update_info", function () {
    let id = $(this).attr("update_id");
    get_employe_info(id)
})


$("#employeeTable").on('click', "a.delete_info", function () {
    let id = $(this).attr("delete_id");
    if (confirm("Are you sure To Delete")) {
        Delete_employe(id)

    }

})