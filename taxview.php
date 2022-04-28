<?php 
session_start();
include_once("inc/Functions.php");
$username = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
if ($username == NULL) {
    header('location:index.php');
}
include 'templates/header.php';
 ?>
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="table-responsive p-3">
            <table id="example" class="bangla display table align-items-center table-flush" cellspacing="0"
                width="100%">
                <thead>
                    <tr>
                        <th>ছবি</th>
                        <th>এসেসমেন্ট নং</th>
                        <th>নাম</th>
                        <th>এন.আইডি.ডি</th>
                        <th>ওয়ার্ড নং</th>
                        <th>হোল্ডিং নং</th>
                        <th>পূর্বের বকেয়া</th>
                        <th>ডাউনলোড রশিদ</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ছবি</th>
                        <th>এসেসমেন্ট নং</th>
                        <th>নাম</th>
                        <th>এন.আইডি.ডি</th>
                        <th>ওয়ার্ড নং</th>
                        <th>হোল্ডিং নং</th>
                        <th>পূর্বের বকেয়া</th>
                        <th>ডাউনলোড রশিদ</th>
                    </tr>
                </tfoot>
            </table>
            <!--create modal dialog for display detail info for edit on button cell click-->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div id="content-data"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!---Container Fluid-->
</div>
<!-- Footer -->
<!-- <footer class="sticky-footer bg-white">
              <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                      <p>Developed By <a href="https://facebook.com/towfiq1997" class="btn btn-primary btn-sm"
                              target="_blank"><i class="fab fa-fw fa-github"></i>Towfiq</a></p>
                  </div>
              </div>
          </footer> -->
<!-- Footer -->
</div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/script.js"></script>
<script>
$(document).ready(function() {
    var dataTable = $('#example').DataTable({
        "searching": true,
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "inc/fetch_tax.php",
            type: "post"
        }
    });
});
</script>
</body>

</html>