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
						Writer List
						<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">
							Add New
						</button>
					</h1>
					
					<!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Writer</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Name</th>
                                            <th>DOB</th>
                                            <th>DOD</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Name</th>
                                            <th>DOB</th>
                                            <th>DOD</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
										<?php
											$crud=new crud();
											$con['status']=1;
											$rs=$crud->common_select('writer','*',$con);
											if($rs['success']==1){
												foreach($rs['msg'] as $i=>$r){
										?>
												<tr>
													<td><?= ++$i ?></td>
													<td id="name<?= $r->id ?>"><?= $r->name ?></td>
													<td id="dob<?= $r->id ?>"><?= $r->dob ?></td>
													<td id="dod<?= $r->id ?>"><?= $r->dod ?></td>
													<td>
														<a class="btn btn-info" onclick="set_data('<?= $r->id ?>')" href="javascript:void(0)" data-toggle="modal" data-target="#updateModal"> Edit </a>
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
				<h4 class="modal-title">Add Writer</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<div class="form-input">
					<label> Name </label>
					<input type="text" id="name" class="form-control">
				</div>
				<div class="form-input">
					<label> DOB </label>
					<input type="date" id="dob" class="form-control">
				</div>
				<div class="form-input">
					<label> DOD </label>
					<input type="date" id="dod" class="form-control">
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
				<h4 class="modal-title">Update Writer</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<div class="form-input">
					<label> name </label>
					<input type="text" id="upname" class="form-control">
					<input type="hidden" id="upid">
				</div>
				<div class="form-input">
					<label> DOB </label>
					<input type="date" id="updob" class="form-control">
				</div>
				<div class="form-input">
					<label> DOD </label>
					<input type="date" id="updod" class="form-control">
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
			var w_name=$('#name').val();
			var w_dod=$('#dod').val();
			var w_dob=$('#dob').val();
			
			$.post( "create.php",{name:w_name,dod:w_dod,dob:w_dob}, function(data) {
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
			var w_name=$('#upname').val();
			var id=$('#upid').val();
			var w_dod=$('#updod').val();
			var w_dob=$('#updob').val();
			
			$.post( "update.php",{name:w_name,id:id,dob:w_dob,dod:w_dod}, function(data) {
			  if( data == 'success' ){
				  $('#updateModal').modal('hide');
				  $('#name'+id).html(w_name);
				  $('#dod'+id).html(w_dod);
				  $('#dob'+id).html(w_dob);
			  }else{
				  alert(data);
			  }
			}).fail(function() {
				alert( "error" );
			});
		}
		
		function set_data(ids){
			var data = <?= json_encode($rs['msg']) ?>;
			for(i=0; i<=data.length; i++){
				if(data[i].id == ids){
					$('#upname').val(data[i].name);
					$('#upid').val(data[i].id);
					$('#updob').val(data[i].dob);
					$('#updod').val(data[i].dod);
				}
			}
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