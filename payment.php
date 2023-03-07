<style>
  #show {
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
            <div class="col-sm-12">
              <div class="card">
                <div class="text-end">
                  <button type="button" class="btn btn-success  m-2" data-bs-toggle="modal" data-bs-target="#paymentmodal">
                    Add payment
                  </button>
                </div>
                <table class="table" id="paymenttable">

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










        <div class="modal fade" id="paymentmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">payments</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="paymentform">
                  <form id="paymentform" enctype="multipart/form-data">
                    <input type="hidden" name="update_id" id="update_id">
                    <div class="row">


                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="">customer_name</label>
                          <select name="customer_id" id="customer_id" class="form-control">

                          </select>
                        </div>
                      </div>


                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="">food</label>
                          <select name="food_id" id="food_id" class="form-control">

                          </select>
                        </div>
                      </div>



                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="">account_name</label>
                          <select name="account_id" id="account_id" class="form-control">

                          </select>
                        </div>
                      </div>



                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="">Amount</label>
                          <input type="text" name="amount" id="amount" class="form-control">
                        </div>

                      </div>



                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="insert" class="btn btn-primary">Save Info</button>
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