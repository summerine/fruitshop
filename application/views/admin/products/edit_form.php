<html>
<head>
<?php $this->load->view("admin/_partials/head.php") ?>	
</head>
<body id="page-top">
	<?php $this->load->view("admin/_partials/navbar.php") ?>

	<div id="wrapper">
		<?php $this->load->view("admin/_partials/sidebar.php") ?>

	<div id="content-wrapper">
		<div class="container-fluid">
			<?php $this->load->view("admin/_partials/breadcrumbs.php") ?>

			<?php if($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php endif; ?>

			<div class="card mb-3">
				<div class="card-header">
					<a href="<?php echo site_url('admin/products/') ?>"><i class="fas fa-arrow-left"></i>Back</a>
				</div>

				<div class="card-body">
					
					<form action="<?php base_url('admin/products/edit') ?>" method="POST" enctype="multipart/form-data">

						<input type="hidden" name="id" value="<?php echo $products->product_id; ?>">

						<div class="form-group">
							<label for="name">Name*</label>
							<input class="form-control <?php echo form_error('name') ? 'is-invalid':'' ?>"  type="text" name="name" placeholder="Product Name" value="<?php echo $products->name; ?>">
							<div class="invalid-feedback">
								<?php echo form_error('name') ?>
							</div>
						</div>

						<div class="form-group">
							<label for="price">Price</label>
							<input class="form-control <?php echo form_error('price') ? 'is_invalid':'' ?>" type="number" name="price" min="0" placeholder="Price" value="<?php echo $products->price; ?>">
							<div class="invalid-feedback">
								<?php echo form_error('price') ?>
							</div>
						</div>

						<div class="form-group">
							<label for="image">Image</label>
							<input class="form-control-file <?php echo form_error('image') ? 'is_invalid':'' ?>" type="file" name="image" placeholder="Image" value="<?php echo $products->image ?>">
							<div class="invalid-feedback">
								<?php echo form_error('image') ?>
							</div>
						</div>

						<div class="form-group">
							<label for="description">Description</label>
							<input class="form-control <?php echo form_error('description') ? 'is_invalid':'' ?>" type="text" name="description" placeholder="Write description..." value="<?php echo $products->description; ?>">
							<div class="invalid-feedback">
								<?php echo form_error('description') ?>
							</div>
						</div>

						<input class="btn btn-success" type="submit" name="btn" value="Save">
					</form>
				</div>

				<div class="card-footer small text-muted ">
					*required fields
				</div>

			</div>
			<!-- /.container-fluid -->

			<!-- Sticky footer -->
		</div>
			<!-- /.content-wrapper -->
	</div>
			<!-- /#wrapper -->
			<?php $this->load->view("admin/_partials/scrolltop.php") ?>
			<?php $this->load->view("admin/_partials/js.php") ?>
</body>
</html>