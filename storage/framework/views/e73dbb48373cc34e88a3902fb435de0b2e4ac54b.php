<?php $__env->startSection('content'); ?>

<style type="text/css">
	.table > tbody > tr > td {
		vertical-align: middle;
	}
</style>

<div class="row">

	<div class="col-md-12">
		<!-- BASIC TABLE -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Account Head List</h3>
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>Account ID</th>
							<th>Name</th>
							<th>Type</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td>
								<?php echo e($row->account_id); ?>

							</td>
							<td>
								<?php echo e($row->name); ?>

							</td>
							<td>
								<?php echo e($row->type); ?>

							</td>
							<td>
								<div class="dropdown">
									<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Modify
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<div class="text-center">
											<a class="dropdown-item" href="<?php echo e(route('account.head.edit', $row->account_id)); ?>">Edit</a>
										</div>
										<div class="text-center">
											<a class="dropdown-item" href="<?php echo e(route('account.head.destroy', $row->account_id)); ?>">Delete</a>
										</div>
									</div>
								</div>  
							</td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END BASIC TABLE -->
	</div>

</div>
<?php echo e($result->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/intime_delivery/resources/views/admin/account-head/index.blade.php ENDPATH**/ ?>