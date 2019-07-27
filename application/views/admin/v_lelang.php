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
							<th>Judul</th>
							<th>Anggaran</th>
							<th>Deskripsi</th>
							<th>Provinsi</th>
							<th>Kota/Kabupaten</th>
							<th>Tgl Mulai</th>
							<th>Tgl Selesai</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($lelangs as $lelang): ?>
						<tr>
							<td width="100">
								<?php echo $lelang->lelang_judul ?>
							</td>
							<td>
								<?php echo "Rp.&nbsp".number_format($lelang->lelang_anggaran) ?>
							</td>	
                            <td class="small">
								<?php echo substr($lelang->lelang_deskripsi, 0, 120) ?></td>
							<td width="100">
								<?php $kabprov = $controller->getKabProv($lelang->lelang_kota); echo "$kabprov->prov ";?>
							</td>
							<td width="150">
								<?php echo "$kabprov->kab ";?>
							</td>							
							<td width="100">
							    <?php echo date_format(new DateTime($lelang->lelang_tglmulai), 'd M Y'); ?>
							</td>
							<td width="100">
							    <?php echo date_format(new DateTime($lelang->lelang_tglselesai), 'd M Y'); ?>
							</td>
							<td width="200">
								<a href="<?php echo site_url('admin/products/edit/'.$lelang->lelang_id) ?>"
								 class="btn btn-small"><i class="fas fa-edit"></i>&nbspEdit</a>
								<a onclick="deleteConfirm('<?php echo site_url('admin/products/delete/'.$lelang->lelang_id) ?>')"
								 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i>&nbspHapus</a>
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
