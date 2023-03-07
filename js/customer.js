loadecustomer();
btnAction = "Insert";



$("#cusform").on("submit", function (event) {


    event.preventDefault();


    let fname = $("#fname").val();
    let lname = $("#lname").val();
    let phone = $("#phone").val();
    let adress = $("#adress").val();
    let city = $("#city").val();
    let id = $("#update_id").val();


    let sendingData = {}

    if (btnAction == "Insert") {
        sendingData = {
            "fname": fname,
            "lname": lname,
            "phone": phone,
            "adress": adress,
            "city": city,
            "action": "register_customer"
        }

    } else {
        sendingData = {
            "customer_id": id,
            "fname": fname,
            "lname": lname,
            "phone": phone,
            "adress": adress,
            "city": city,
            "action": "update_cusomer"
        }
    }



    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/customer.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;

            if (status) {
                swal("Good job!", response, "success");
                btnAction = "Insert";
                $("#cusform")[0].reset();
                loadecustomer();

               



            } else {
                customeremessage("error", response);
            }

        },
        error: function (data) {
            customermessage("error", data.responseText);

        }

    })

})
 function loadecustomer() {
  $("#custable tbody").html('');
   $("#custable thead").html('');

     let sendingData = {
        "action": "read_all_customers"
    }

     $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/customer.php",
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

                    tr += `<td> <a class="btn btn-info update_info"  update_id=${res['customer_id']}><i class="fas fa-edit" style="color: #fff"></i></a>&nbsp;&nbsp <a class="btn btn-danger delete_info" delete_id=${res['customer_id']}><i class="fas fa-trash"style="color: #fff"></i></a> </td>`
                    tr += "</tr>"

                })
                $("#custable thead").append(th);
                $("#custable tbody").append(tr);
            }

        },
        error: function (data) {

        }

    })
}

function get_customer_info(customer_id) {

    


    let sendingData = {
        "action": "get_customer_info",
        "customer_id": customer_id 
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/customer.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;


            if (status) {

                btnAction = "update";

                loadecustomer();
                
                $("#update_id").val(response['customer_id']);
                $("#fname").val(response['frist_name']);
                $("#lname").val(response['last_name']);
                $("#phone").val(response['phone']);
                $("#adress").val(response['address']);
                $("#city").val(response['city']);
                $("#cusmodal").modal('show');



                


            } else {
                customermessage("error", response);
            }

        },
        error: function (data) {

        }

    })
}


function Delete_customer(customer_id) {
    

    let sendingData = {
        "action": "Delete_customer",
        "customer_id": customer_id
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "Api/customer.php",
        data: sendingData,

        success: function (data) {
            let status = data.status;
            let response = data.data;


            if (status) {

                swal("Good job!", response, "success");
                loadecustomer();


            } else {
                swal(response);
            }

        },
        error: function (data) {

        }

    })
 }


 $("#custable").on('click', "a.update_info", function () {
    let id = $(this).attr("update_id");
    get_customer_info(id)
 })


$("#custable").on('click', "a.delete_info", function () {
    let id = $(this).attr("delete_id");
     if (confirm("Are you sure To Delete")) {
        Delete_customer(id)

     }

})