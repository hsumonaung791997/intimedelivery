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
				<h3 class="panel-title">Ledger List</h3>
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>Account Id</th>
							<th>Account Name</th>
							<th>Cr</th>
							<th>Dr</th>
							<th>Date</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td>
								<?php echo e($row->accounthead->account_id); ?>

							</td>
							<td>
								<?php echo e($row->accounthead->name); ?>

							</td>
							<td>
								<?php echo e($row->cr_amount); ?>

							</td>
							<td>
								<?php echo e($row->dr_amount); ?>

							</td>
							<td>
								<?php echo e($row->date); ?>

							</td>
							<td>
								<div class="dropdown">
									<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Modify
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<div class="text-center">
											<a class="dropdown-item" href="<?php echo e(route('account.head.ledger.edit', $row->id)); ?>">Edit</a>
										</div>
										<div class="text-center">
											<a class="dropdown-item" href="<?php echo e(route('account.head.ledger.destroy', $row->id)); ?>">Delete</a>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td colspan="2">
								<b>Total</b>
							</td>
							<td>
								<?php echo e($result->sum('cr_amount')); ?>

							</td>
							<td>
								<?php echo e($result->sum('dr_amount')); ?>

							</td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
		<!-- END BASIC TABLE -->



	</div>

</div>
<?php echo e($result->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thiri/yoonhanthar/intime-delivery/resources/views/admin/account-head-ledger/index.blade.php ENDPATH**/ ?>