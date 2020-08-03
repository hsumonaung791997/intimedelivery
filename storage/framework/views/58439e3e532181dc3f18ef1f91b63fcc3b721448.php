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
				<h3 class="panel-title">Gross Profit</h3>
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>Account ID</th>
							<th>Account Name</th>
							<th>Cr</th>
							<th>Dr</th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td>
								<?php echo e($account->account_id); ?>

							</td>
							<td>
								<?php echo e($account->name); ?>

							</td>
							<td>
								<?php echo e($account->accountheadledgers->sum('cr_amount')); ?>

							</td>
							<td>
								<?php echo e($account->accountheadledgers->sum('dr_amount')); ?>

							</td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td colspan="2">
								<b>Total</b>
							</td>
							<td>
								<?php echo e($result->sum('cr_total')); ?>

							</td>
							<td>
								<?php echo e($result->sum('dr_total')); ?>

							</td>
						</tr>
					</tbody>
				</table>
				<?php echo e($result->links()); ?>

			</div>

		</div>
		<!-- END BASIC TABLE -->



	</div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/admin/account-head-ledger/summary.blade.php ENDPATH**/ ?>