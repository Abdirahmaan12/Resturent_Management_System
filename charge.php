

   
<?php
include 'include/header.php';
?>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
  <?php

  

include 'include/sidebar.php';
  ?>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
   
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                 
                <div class="container">
  <div class="row justify-content-center mt-4">
    <div class="col-sm-12">
      <div class="card">
      <div class="text-end">
        <button type="button" class="btn btn-success  m-2" data-bs-toggle="modal" data-bs-target="#chargemodal">
       Add charge
         </button>
         </div>
        <table class="table" id="chargeTable">

        <thead>
       

            
        </thead>

        <tbody>
   
        <!-- <tr>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          
        </tr>
        <tr>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          
        </tr>
        <tr>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          
        </tr>
        <tr>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          
        </tr> -->
        
     
        </tbody>
        </table>
        </div>
       </div>
    </div>
  </div>










  <div class="modal fade" id="chargemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">charge Info</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="chargeform">
      <form id="empform" enctype="multipart/form-data">
        <input type="hidden" name="update_id" id="update_id">
        <div class="row">
            

        
        <div class="col-sm-6">
         <div class="form-group">
                <label for="">month</label>
                <select name="month" id="month" class="form-control" required>
                <option value="">Select month</option>
                <option value="Jan">Jan</option>
                <option value="Feb">Feb</option>
                <option value="">Mar</option>
                <option value="Mar">Apr</option>
                <option value="May">May</option>
                <option value="Jun">Jun</option>
                <option value="July">July</option>
                <option value="Aug">Aug</option>
                <option value="Sep">Sep</option>
                <option value="Oct">Oct</option>
                <option value="Nov">Nov</option>
                <option value="Dec">Dec</option>

                </select>
                </div>

            </div>


          

         


            <div class="col-sm-6">
                <div class="form-group">
                <label for="">year</label>
                <input type="text" name="year" id="year" class="form-control" required>
                </div>

            </div>

            <div class="col-sm-6 mt-3">
                <div class="form-group">
                <label for="">description</label>
                <input type="text" name="description" id="description" class="form-control" required>
                </div>

            </div>

           

            
            <div class="col-sm-6 mt-3">
                <div class="form-group">
                <label for="">user</label>
                <select name="user" id="user" class="form-control" required>
                
                </select>                </div>

            </div>



            <div class="col-sm-6 mt-3">
                <div class="form-group">
                <label for="">Account</label>
                <select name="account_id" id="account_id" class="form-control" required>
                
                </select>                </div>

            </div>



          





      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  name="insert" class="btn btn-primary">Save Info</button>
      </div>
     </form>
    </div>
  </div>
</div>

                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->


    <!-- Required Js -->
<?php
include 'include/footer.php';
?>
