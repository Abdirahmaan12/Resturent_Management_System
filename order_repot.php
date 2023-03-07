

   
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
                 
    

                <div class="cl-xl-12">
        <div class="card">
            <div class="card-header">
                <h5>order Table</h5>
                <span class="d-block m-t-5"> <code></code>   </span>
                <form id="paymentiform">

                <div class="row">
                    <div class="col-sm-4">
                    <select name="Type" id="Type" class="form-control">
                            <option value="0">All</option>
                            <option value="custom">custom</option>
                        </select>
                    </div>

                  

                    <div class="col-sm-5">
                        <input type="text" name="order_id" id="order_id" class="form-control">
                    </div>


                    <div class="col-sm-4">
                    <button type="submit" id="Adddnew" class="btn btn-info m-3">Add new transaction</button>
                    </div>
                </div>
                </form>

                <div class="row">
                    <div class="table-responsive" id="print_area">
                    <img width="100%";  height="270px" src="res2.jpg" class="mb-4">

                    <table class="table" id="paymenttTable">
                              <thead>
                              
                              </thead>
                              <tbody>
                                       
  
                              </tbody>

                    </table>

                    </div>
                    <div class="col-sm-4">
                    <button id="printstatement" class="btn btn-success ml-1"><i class="fa fa-print"></i>print</button>
                    <button id="exportstatement" class="btn btn-info mr-4"><i class="fa fa-file"></i>Export</button>
                    </div>
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
