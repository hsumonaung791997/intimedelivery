<?php $__env->startSection('content'); ?>

<div class="row">

			<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Export Vendor Data</h3>
								</div>
							
								<div class="panel-body">
				<form action="<?php echo e(URL::to('admin/route/list/vendor/export')); ?>" method="get">
					<div class="col-md-12 col-lg-12 col-sm-12">
	                    <div class="col-md-3 col-lg-3 col-sm-3">
	                    	<input type="text" class="form-control" name="vendor_name" placeholder="Search Vendor Name">
	                    	<?php if($errors->has('vendor_name')): ?>
                                <span class="alert text-danger"><?php echo e($errors->first('vendor_name')); ?></span>
                            <?php endif; ?>
	                  	</div>
		                <div class="col-md-3 col-lg-3 col-sm-3">
		                    <input type="date" class="form-control" name="start_date">
		                    <?php if($errors->has('start_date')): ?>
                                <span class="alert text-danger"><?php echo e($errors->first('start_date')); ?></span>
                            <?php endif; ?>
		                </div>
		                <div class="col-md-3 col-lg-3 col-sm-3">
		                    <input type="date" class="form-control" name="end_date">
		                    <?php if($errors->has('end_date')): ?>
                                <span class="alert text-danger"><?php echo e($errors->first('end_date')); ?></span>
                            <?php endif; ?>
		                </div>
		                <div class="col-md-2 col-sm-2 col-lg-2">
		                    <input type="submit" name="submit" value="Export" class="btn btn-primary">
		                </div>
                  	</div>
                  	 
                  	<br><br>
             
									<table class="table">
										<thead>
											<tr>
											
												<th>No</th>
												<th>Address</th>
												<th>Phone</th>
												<th>Product ID</th>
												<th>Product Name</th>
												<th>Qty</th>
												<th>Price per Item</th>
												<th>Total Amount</th>
												<th>Vendor Name</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; ?>
											<?php $__currentLoopData = $select; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo e($row->address); ?>,<?php echo e($row->s_name); ?>,<?php echo e($row->t_name); ?></td>
												<td><?php echo e($row->phone); ?></td>
												<td><?php echo e($row->p_id); ?></td>
												<td><?php echo e($row->product_name); ?></td>
												<td><?php echo e($row->qty); ?></td>
												<td><?php echo e($row->amount); ?></td>
												<?php 
													$fqty = $row->qty;
													$famount = $row->amount;
													$ftotal = $fqty* $famount;
												?>
												<td><?php echo e($ftotal); ?></td>
												<td><?php echo e($row->product_vendor_name); ?></td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
											 
										</tbody>
									</table>

									   </form>
									 
									 <?php echo e($select->appends(Request::except('/admin/route/list/vendor'))->setPath('/admin/route/list/vendor')); ?>

									 
								</div>

							</div>
							<!-- END BASIC TABLE -->
		</div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/admin/route/vendor-export.blade.php ENDPATH**/ ?>