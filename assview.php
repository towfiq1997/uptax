<?php 
session_start();
include_once("inc/Functions.php");
$username = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
if ($username == NULL) {
    header('location:index.php');
}
include 'templates/header.php';
$uni_code = $_SESSION['code'];
$show_data = new Survey();
$sql = "SELECT * FROM assesment_input WHERE union_code='$uni_code' LIMIT 60";
$res = $show_data->con->query($sql);
 ?>
<div class="col-lg-12">
    <div class="card mb-4">
        <div id="testing" class="search-section m-4 d-flex justify-content-end">
            <input data-code="<?php echo $_SESSION['code']; ?>" type="text" id="assesment_search" placeholder="">
        </div>
        <div class="table-responsive p-3">
            <table id="assestable" class="bangla display table align-items-center table-flush" cellspacing="0"
                width="100%">
                <thead>
                    <tr>
                        <th>ছবি</th>
                        <th>এসেসমেন্ট নং</th>
                        <th>নাম</th>
                        <th>পিতার নাম</th>
                        <th>মাতার নাম</th>
                        <th>গ্রাম</th>
                        <th>এন.আইডি.ডি</th>
                        <th>ওয়ার্ড নং</th>
                        <th>হোল্ডিং নং</th>
                        <th>ধার্যকৃত ট্যাক্স</th>
                        <th>পূর্বের বকেয়া</th>
                        <th>ভিউ/এডিট</th>
                    </tr>
                </thead>
                <tbody id="tr_container">
                    <?php 
                    while($row=$res->fetch_assoc()){  ?>
                    <tr>
                        <td>
                            <img height="80px" width="80px" src="uploads/<?php echo $row['profile_pic']; ?>" alt="">
                        </td>
                        <td>
                            <?php echo $row['id']; ?></td>
                        <td><?php echo $row['owner_name']; ?></td>
                        <td><?php echo $row['father_name']; ?></td>
                        <td><?php echo $row['mother_name']; ?></td>
                        <td><?php echo $row['village']; ?></td>
                        <td><?php echo $row['nid']; ?></td>
                        <td><?php echo $row['ward_no']; ?></td>
                        <td><?php echo $row['holding_no']; ?></td>
                        <td><?php echo $row['imopsed_tax']; ?></td>
                        <td><?php echo $row['previous_due']; ?></td>
                        <td>
                            <div class="action-section">
                                <a style="margin-right:10px !important; text-decoration:none"
                                    href="view_single.php?id=<?php echo $row['id']; ?>">ভিউ</a>
                                <a style="margin-right:10px !important; text-decoration:none"
                                    href="edit_single.php?id=<?php echo $row['id']; ?>">এডিট</a>
                                <a style="margin-right:10px !important; text-decoration:none"
                                    href="delete_single.php?id=<?php echo $row['id']; ?>">ডিলিট</a>
                            </div>
                        </td>
                    </tr>
                    <?php  }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ছবি</th>
                        <th>এসেসমেন্ট নং</th>
                        <th>নাম</th>
                        <th>পিতার নাম</th>
                        <th>মাতার নাম</th>
                        <th>গ্রাম</th>
                        <th>এন.আইডি.ডি</th>
                        <th>ওয়ার্ড নং</th>
                        <th>হোল্ডিং নং</th>
                        <th>ধার্যকৃত ট্যাক্স</th>
                        <th>পূর্বের বকেয়া</th>
                        <th>ভিউ/এডিট</th>
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
<script src="js/script.js" defer></script>
</body>

</html>