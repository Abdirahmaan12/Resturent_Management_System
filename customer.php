

   
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
        <button type="button" class="btn btn-success  m-2" data-bs-toggle="modal" data-bs-target="#cusmodal">
       Add cus
         </button>
         </div>
        <table class="table" id="custable">

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










  <div class="modal fade" id="cusmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">customers</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="cusform">
        <input type="hidden" name="update_id" id="update_id">
        <div class="row">
            

        
        <div class="col-sm-12">
                <div class="form-group">
                <label for="">first_name</label>
                <input type="text" name="fname" id="fname" class="form-control" >
                </div>
</div>
        

         

            <div class="col-sm-12">
                <div class="form-group">
                <label for="">lastname</label>
                <input type="text" name="lname" id="lname" class="form-control" >
                </div>

            </div>

            <div class="col-sm-12">
                <div class="form-group">
                <label for="">phone</label>
                <input type="text" name="phone" id="phone" class="form-control" >
                </div>

            </div>
        
            <div class="col-sm-12">
                <div class="form-group">
                <label for="">Address</label>
                <input type="text" name="adress" id="adress" class="form-control" >
                </div>

            </div>

            <div class="col-sm-12">
                <div class="form-group">
                <label for="">city</label>
                <input type="text" name="city" id="city" class="form-control" >
                </div>

            </div>
            

          

        
            
        </div>
        

        
       
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
