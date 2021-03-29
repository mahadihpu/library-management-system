<?php include('../include/header.php') ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
		<?php include('../include/sidebar.php') ?>
		<!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
				<!-- Topbar -->
					<?php include('../include/topbar.php') ?>
				<!-- End of Topbar -->
				
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">User List</h1>
					
					<!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All User</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
										<?php
											$crud=new crud();
											$q="SELECT user.*,user_info.contact_no,user_info.address FROM user join user_info on user_info.user_id=user.id where user.status=1";
											$rs=$crud->common_select_query($q);
											if($rs['success']==1){
												foreach($rs['msg'] as $i=>$r){
										?>
		<tr>
			<td><?= ++$i ?></td>
			<td><?= $r->name ?></td>
			<td><?= $r->email ?></td>
			<td><?= $r->contact_no ?></td>
			<td><?= $r->address ?></td>
			<td>
	<?php
		$active=$inactive="";
		if($r->active_status!=1) 
			$active='d-none';
		else
			$inactive='d-none';
		?>
		<a class="btn btn-success <?= $active ?>" id="0<?= $r->id ?>" href="javascript:void(0)" onclick="active_user(<?= $r->id ?>,0)">Active</a>
		
		<a class="btn btn-danger <?= $inactive ?>" id="1<?= $r->id ?>" href="javascript:void(0)" onclick="active_user(<?= $r->id ?>,1)"> Inactive </a>
												
			</td>
			<td>
		<a class="btn btn-danger" onclick="delete_users(<?= $r->id ?>,this);" href="javascript:void(0)"> Delete </a>
			</td>
		</tr>
											<?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
				<?php include('../include/footer.php') ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= $base_url ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= $base_url ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= $base_url ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= $base_url ?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= $base_url ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= $base_url ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= $base_url ?>js/demo/datatables-demo.js"></script>
	<script>
		function active_user(ids,statuss){
			$.post( "update_user.php",{id:ids,status:statuss}, function(data) {
			  if( data != 'error' ){
				  $('#0'+ids).toggleClass('d-none');
				  $('#1'+ids).toggleClass('d-none');
			  }
			}).fail(function() {
				alert( "error" );
			});
		}
		
		function delete_users(id,t){
			$.post( "update_user.php",{id:id}, function(data) {
			  if( data != 'error' ){
				  $(t).parents('tr').hide();
			  }
			}).fail(function() {
				alert( "error" );
			});
			
		}

	</script>
</body>

</html>