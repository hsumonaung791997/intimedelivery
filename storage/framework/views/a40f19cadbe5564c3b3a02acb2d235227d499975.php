<?php $__env->startSection('content'); ?>

<div class="row">

			<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Stock Incoming Product</h3>
								</div>
								<div class="panel-body">
						<form action="<?php echo e(URL::to('admin/stock/incoming/search')); ?>" method="get">
							<?php echo csrf_field(); ?>
							<?php 
						                    	if(isset($_GET['search'])){
														$name=$_GET['search'];						                    		
						                    	}else{
						                    		$name="";
						                    	}
						                    	if(isset($_GET['date'])){
														$date=$_GET['date'];						                    		
						                    	}else{
						                    		$date="";
						                    	}
						                    	 ?>
									<div class="col-md-12 col-lg-12 col-sm-12">
						                    <div class="col-md-3 col-lg-3 col-sm-3">
							                    <input type="text" class="form-control" name="search" placeholder="Search Product ID,Name,Type and Size" value="<?php echo e($name); ?>">
							                  </div>
							                  <div class="col-md-3 col-lg-3 col-sm-3">
							                    <input type="date" class="form-control" name="date" value="<?php echo e($date); ?>">
							                  </div>
							                  <div class="col-md-2 col-sm-2 col-lg-2">
							                    <input type="submit" name="filter" value="Filter" class="btn btn-primary">
							                    <input type="submit" name="print" value="Print" class="btn btn-success">

						                  </div>
					                  </div>
							        </form>          

									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Order ID</th>
												<th>Product ID</th>
												<th>Product Name</th>
												<th>Product Type</th>
												<th>Product Size</th>
												<th>Price Per Item</th>
												<th>Date</th>
												<th>In Qty</th>
											</tr>
										</thead>
										<tbody>
											<?php if(isset($result)): ?>
											<?php $i=1; ?>
											<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo e($row->o_id); ?></td>
												<td><?php echo e($row->product_id); ?></td>
												<td><?php echo e($row->product_name); ?></td>
												<td><?php echo e($row->product_type); ?></td>
												<td><?php echo e($row->product_size); ?></td>
												<td><?php echo e($row->price_per_item); ?></td>
												<td><?php $dates=$row->incoming_date;
													echo date('d/m/Y H:i:s',strtotime($dates));
												 ?></td>
												<td><?php echo e($row->in_qty); ?></td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php else: ?>
											<?php $i=1; ?>
											<?php $__currentLoopData = $result_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo e($row->o_id); ?></td>
												<td><?php echo e($row->product_id); ?></td>
												<td><?php echo e($row->product_name); ?></td>
												<td><?php echo e($row->product_type); ?></td>
												<td><?php echo e($row->product_size); ?></td>
												<td><?php echo e($row->price_per_item); ?></td>
												<td><?php $dates=$row->incoming_date;
													echo date('d/m/Y H:i:s',strtotime($dates));
												 ?></td>
												<td><?php echo e($row->in_qty); ?></td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

											<?php endif; ?>
										</tbody>
									</table>
									<?php if(isset($result_data)): ?>
									<?php echo e($result_data->appends(Request::except('/admin/stock/incoming/search'))->setPath('/admin/stock/incoming/search')); ?>

									<?php else: ?>
									<?php echo e($result->appends(Request::except('/admin/stock/in'))->setPath('/admin/stock/in')); ?>

									<?php endif; ?>
								</div>
							</div>
							<!-- END BASIC TABLE -->
			</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thiri/yoonhanthar/intime-delivery/resources/views/admin/stock/stock_in.blade.php ENDPATH**/ ?>