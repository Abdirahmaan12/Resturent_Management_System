

   
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
        <button type="button" class="btn btn-success  m-2" data-bs-toggle="modal" data-bs-target="#accountmodal">
       Add account
         </button>
         </div>
        <table class="table" id="accounttable">

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










  <div class="modal fade" id="accountmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">account info</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="accountfrom">
        <input type="hidden" name="update_id" id="update_id">
        <div class="row">
            

    

            <div class="col-sm-12">
                <div class="form-group">
                <label for="">account_number</label>
                <input type="text" name="account_number" id="account_number" class="form-control" >
                </div>

            </div>

            <div class="col-sm-12">
                <div class="form-group">
                <label for="">bank</label>
                <input type="text" name="bank" id="bank" class="form-control" >
                </div>

            </div>
            
            <div class="col-sm-12">
                <div class="form-group">
                <label for="">blance</label>
                <input type="text" name="balance" id="balance" class="form-control" >
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
