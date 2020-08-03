
<?php $__env->startSection('content'); ?>

<div class="row">

			<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Contact Issue</h3>
								</div>
								<div class="panel-body">
									<div class="row">
							<div><a href="<?php echo e(URL::to('contact/issue/export')); ?>" class="btn btn-danger btn-sm">Export</a></div>
									<div class="tabele-responsive">	
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Customer </th>
												<th>Phone No.</th>
												<th>Address</th>
												<th>Product ID</th>
												<th>Product Name</th>
												<th>Product Type</th>
												<th>Qty</th>
												<th>Amount</th>
												<th>Target Date</th>
												<th>Reg Date</th>
												<th>Remark</th>
												<th>Vendor</th>
											</tr>
										</thead>
										<tbody>
							
											<?php $i=1; ?>
											<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo e($row->r_name); ?></td>
												<td><?php echo e($row->phone); ?></td>
												<td><?php echo e($row->address); ?>,<?php echo e($row->t_name); ?>,<?php echo e($row->s_name); ?></td>
												<td><?php echo e($row->p_id); ?></td>
												<td><?php echo e($row->product_name); ?></td>
												<td><?php echo e($row->product_type); ?></td>
												<td><?php echo e($row->quantity); ?></td>
												<td><?php echo e($row->amount); ?></td>
												<td><?php echo e($row->target_date); ?></td>
												<td><?php $date=$row->reg_date;
												echo date("Y-m-d",strtotime($date));
												 ?></td>
												<td><?php echo e($row->remark); ?></td>
												<td><?php echo e($row->name); ?></td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
									</table>
									</div>
								</div>
							</div>
							<!-- END BASIC TABLE -->
			</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.tables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/intime_delivery/resources/views/contact_issue_vendor.blade.php ENDPATH**/ ?>