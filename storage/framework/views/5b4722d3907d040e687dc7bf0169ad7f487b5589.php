<?php $__env->startSection('content'); ?>
<?php $i=1; ?>

<div class="row">

<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Verify Route List</h3>
								</div>
								<form action="<?php echo e(URL::to('admin/route/list/table/search')); ?>" method="get">
									<?php echo csrf_field(); ?>
								<div class="panel-body">
									<div class="col-md-12 col-lg-12 col-sm-12">
					                    <div class="col-md-3 col-lg-3 col-sm-3">
					                    <input type="text" class="form-control" name="search" placeholder="Vendor Name">
					                  </div>
					                  <div class="col-md-3 col-lg-3 col-sm-3">
					                    <input type="date" class="form-control" name="date">
					                  </div>
					                   <div class="col-md-3 col-lg-3 col-sm-3">
					                    	<?php $state=DB::select("SELECT * FROM state ORDER BY id DESC"); ?>
					                    <select class="form-control" name="state">
					                    	<option value="">SELECT STATE</option>
					                      <?php $__currentLoopData = $state; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					                      <option value="<?php echo e($sta->id); ?>"><?php echo e($sta->name); ?></option>
					                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					                    </select>
					                  </div>
					                  <div class="col-md-2 col-sm-2 col-lg-2">
					                    <input type="submit" name="submit" value="Filter" class="btn btn-primary">
					                  </div>
					                  </div>
					                  <div class="col-md-12 col-lg-12 col-sm-12" style="margin-top: 1%;">
					                   
                  
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Address</th>
												<th>Phone</th>
												<th>Product ID</th>
												<th>Product Name</th>
												<th>Qty</th>
												<th>Total Amount</th>
												<th>Reg: date</th>
												<th>Target Time</th>
												<th>Vendor Name</th>
											</tr>
										</thead>
										<tbody>
									<?php if(isset($data)): ?>
										
												<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo e($row->address); ?>,<?php echo e($row->s_name); ?>,<?php echo e($row->t_name); ?></td>
												<td><?php echo e($row->phone); ?></td>
												<td><?php echo e($row->p_id); ?></td>
												<td><?php echo e($row->product_name); ?></td>
												<td><?php echo e($row->qty); ?></td>
												<?php 
													$qty = $row->qty;
													$amount = $row->amount;
													$total = $qty * $amount;
												?>
												<td><?php echo e($total); ?></td>
												<td><?php echo date("d-m-Y", strtotime($row->reg_date)); ?></td>
												<td><?php echo e($row->target_date); ?>:<?php echo e($row->target_time); ?></td>
												<td><?php echo e($row->product_vendor_name); ?></td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

									<?php endif; ?>
									<?php if(isset($select_date)): ?>
											<?php $__currentLoopData = $select_date; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo e($row->address); ?>,<?php echo e($row->s_name); ?>,<?php echo e($row->t_name); ?></td>
												<td><?php echo e($row->phone); ?></td>
												<td><?php echo e($row->p_id); ?></td>
												<td><?php echo e($row->product_name); ?></td>
												<td><?php echo e($row->qty); ?></td>
												<?php 
													$qty = $row->qty;
													$amount = $row->amount;
													$total = $qty * $amount;
												?>
												<td><?php echo e($total); ?></td>
												<td><?php echo date("d-m-Y", strtotime($row->reg_date)); ?></td>
												<td><?php echo e($row->target_date); ?>:<?php echo e($row->target_time); ?></td>
												<td><?php echo e($row->product_vendor_name); ?></td>
												
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
										</tbody>
									</table>
								</div>
							</form>
							</div>
		</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/admin/route/route_list.blade.php ENDPATH**/ ?>