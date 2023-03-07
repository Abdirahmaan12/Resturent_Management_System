
<style>

#show{
  width: 150px;
  height: 150px;
  border: solid 1px #744547;
  border-radius: 50%;
  object-fit: cover;
}

</style>
   
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
    <div class="col-sm-10">
      <div class="card">
      <div class="text-end">
        <button type="button" class="btn btn-success  m-2" data-bs-toggle="modal" data-bs-target="#usermodal">
       Add user
         </button>
         </div>
        <table class="table" id="UserTable">

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










  <div class="modal fade" id="usermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">User Info</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="userform" enctype="multipart/form-data">
        <input type="hidden" name="update_id" id="update_id">
        <div class="row">
            

        

            <div class="col-sm-6 mt-3">
                <div class="form-group">
                <label for="">employe_name</label>
                <select name="emname" id="emname" class="form-control">
                </select>
                </div>
            </div>

            <div class="col-sm-6 mt-3">
                <div class="form-group">
                <label for="">username</label>
                <input type="text" name="username" id="username" class="form-control" >
                </div>

            </div>

            <div class="col-sm-6 mt-3">
                <div class="form-group">
                <label for="">password</label>
                <input type="password" name="password" id="password" class="form-control" >
                </div>

            </div>
            <div class="col-sm-6 mt-3">
                <div class="form-group">
                <label for="">Type</label>
                <select name="usertype" id="usertype" class="form-control">
                  <option value="Admin">Admin</option>
                  <option value="User">User</option>
                </select>
                </div>
            </div>
            

            <div class="col-sm-6 mt-3">
                <div class="form-group">
                <label for="">image</label>
                <input type="file" name="image" id="image" class="form-control" >
                </div>
            </div>

        
            
        </div>
        <div class="row">
          
            <div class="col-sm-2 ml-4"></div>
            <div class="col-sm-2 ml-4">
                <div class="form-group" required>
                <img id="show">
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
