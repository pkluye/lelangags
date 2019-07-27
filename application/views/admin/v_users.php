<!DOCTYPE html>
<html lang="en">
<body id="page-top">
<div id="wrapper">

	<?php $this->load->view("admin/includes/sidebar.php") ?>

	<div id="content-wrapper">
	    
	<?php $this->load->view("admin/includes/breadcrumb.php") ?>
	    
		<div class="card mb-3">
		<!--<div class="card-header">-->
		<!--	<a href="<?//php echo site_url('admin/products/add') ?>"><i class="fas fa-plus"></i> Add New</a>-->
		<!--</div>-->
		<div class="card-body">

			<div class="table-responsive">
				<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Foto</th>
							<th>Nama</th>
							<th>Email</th>
							<th>Telepon</th>
							<th>Alamat</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user): ?>
						<tr>
							<td>
								<img src="<?php echo base_url('assets/images/foto/'.$user->user_imgurl) ?>" width="64" />
							</td>
							<td width="150">
								<?php echo $user->user_nama ?>
							</td>
							<td>
								<?php echo $user->user_email ?>
							</td>							
							<td>
								<?php echo $user->user_telpon ?>
							</td>
							<td>
								<?php echo $user->user_alamat ?>
							</td>
							<td width="250">
								<a href="<?php echo site_url('admin/users/form/edit/'.$user->user_id) ?>"
								 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
								<a onclick="deleteConfirm('<?php echo site_url('admin/products/delete/'.$user->user_id) ?>')"
								 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
							</td>
						</tr>
						<?php endforeach; ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>

		<!-- Sticky Footer -->
		<?php $this->load->view("admin/includes/footer.php") ?>

	</div>
	<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->


<?//php $this->load->view("admin/_partials/scrolltop.php") ?>
<?//php $this->load->view("admin/_partials/modal.php") ?>
<?//php $this->load->view("admin/includes/js.php") ?>
    
</body>
</html>
