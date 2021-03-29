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
                    <h1 class="h3 mb-4 text-gray-800">
						Category List
						<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">
							Add New
						</button>
					</h1>
					
					<!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Category</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
										<?php
											$crud=new crud();
											$con['status']=1;
											$rs=$crud->common_select('category','*',$con);
											if($rs['success']==1){
												foreach($rs['msg'] as $i=>$r){
										?>
												<tr>
													<td><?= ++$i ?></td>
													<td id="name<?= $r->id ?>"><?= $r->name ?></td>
													<td>
														<a class="btn btn-info" onclick="set_data(<?= $r->id ?>,'<?= $r->name ?>');" href="javascript:void(0)" data-toggle="modal" data-target="#updateModal"> Edit </a>
														<a class="btn btn-danger" onclick="delete_data(<?= $r->id ?>,this);" href="javascript:void(0)"> Delete </a>
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

<!-- The Modal -->
<div class="modal" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Add Category</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<div class="form-input">
					<label> Category </label>
					<input type="text" id="name" class="form-control">
				</div>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" onclick="save_data()" class="btn btn-success">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- The Modal -->
<div class="modal" id="updateModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Update Category</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<div class="form-input">
					<label> Category </label>
					<input type="text" id="upname" class="form-control">
					<input type="hidden" id="upid">
				</div>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" onclick="update_data()" class="btn btn-success">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
			
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
		function save_data(){
			var c_name=$('#name').val();
			
			$.post( "create.php",{name:c_name}, function(data) {
			  if( data == 'success' ){
				  $('#myModal').modal('hide');
				  alert(data);
			  }else{
				  alert(data);
			  }
			}).fail(function() {
				alert( "error" );
			});
		}
		function update_data(){
			var c_name=$('#upname').val();
			var id=$('#upid').val();
			
			$.post( "update.php",{name:c_name,id:id}, function(data) {
			  if( data == 'success' ){
				  $('#updateModal').modal('hide');
				  $('#name'+id).html(c_name);
			  }else{
				  alert(data);
			  }
			}).fail(function() {
				alert( "error" );
			});
		}
		
		function set_data(id,name){
			$('#upname').val(name);
			$('#upid').val(id);
		}
		
		
		function delete_data(id,e){
			
			$.post( "update.php",{id:id}, function(data) {
			  if( data == 'success' ){
				  $(e).parents('tr').hide();
			  }else{
				  alert(data);
			  }
			}).fail(function() {
				alert( "error" );
			});
		}

	</script>
</body>

</html>