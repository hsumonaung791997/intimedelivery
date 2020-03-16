<?php $__env->startSection('content'); ?>

<div class="row">

			<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Stock Balance</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<form action="<?php echo e(URL::to('warehouse/stock/list/search')); ?>" method="get">
										<?php echo csrf_field(); ?> 
										<?php 
						                    	if(isset($_GET['search'])){
														$name=$_GET['search'];						                    		
						                    	}else{
						                    		$name="";
						                    	}
						                    	
						                    	 ?>
										<div class="col-md-3 col-lg-3 col-sm-3">
										<input type="text" class="form-control" name="search" placeholder="Search by Product ID,Name,Type, and Size" value="<?php echo e($name); ?>">
									</div>
									
									<div class="col-md-2 col-sm-2 col-lg-2">
										<input type="submit" name="filter" value="Filter" class="btn btn-primary">
										<input type="submit" name="print" value="Print" class="btn btn-success">
									</div>
									</form>
									</div>
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Product ID</th>
												<th>Product Name</th>
												<th>Product Type</th>
												<th>Product Size</th>
												<th>Price Per Item</th>
												<th>In Qty</th>
												<th>Out Qty</th>
												<th>Balance</th>
												<th>Show QR</th>
											</tr>
										</thead>
										<tbody>
											<?php if(isset($result_data)): ?>
											<?php $i=1; ?>
											<?php $__currentLoopData = $result_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo e($row->product_id); ?></td>
												<td><?php echo e($row->product_name); ?></td>
												<td><?php echo e($row->product_type); ?></td>
												<td><?php echo e($row->product_size); ?></td>
												<td><?php echo e($row->price_per_item); ?></td>
												
												<td><?php echo e($row->total_stock_in); ?></td>
												<td><?php echo e($row->total_stock_out); ?></td>
												<td><?php echo e($row->total_stock_in-$row->total_stock_out); ?></td>
												<td><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalLong<?php echo $row->product_id; ?>">
													  Show QR
													</a> </td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php else: ?>
											<?php $i=1; ?>
											<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo e($row->product_id); ?></td>
												<td><?php echo e($row->product_name); ?></td>
												<td><?php echo e($row->product_type); ?></td>
												<td><?php echo e($row->product_size); ?></td>
												<td><?php echo e($row->price_per_item); ?></td>
												
												<td><?php echo e($row->total_stock_in); ?></td>
												<td><?php echo e($row->total_stock_out); ?></td>
												<td><?php echo e($row->total_stock_in-$row->total_stock_out); ?></td>
												<td><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalLong<?php echo $row->product_id; ?>">
													  Show QR
													</a> </td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php endif; ?>
										</tbody>
									</table>
									<?php if(isset($result_data)): ?>
									 <?php echo e($result_data->appends(Request::except('/warehouse/stock/list/search'))->setPath('/warehouse/stock/list/search')); ?>


									<?php else: ?>
									 <?php echo e($result->appends(Request::except('/warehouse/stock/list'))->setPath('/warehouse/stock/list')); ?>

									 <?php endif; ?>
								</div>
							</div>
							<!-- END BASIC TABLE -->
			</div>
</div>
<?php if(isset($result_data)): ?>
<?php $__currentLoopData = $result_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="exampleModalLong<?php echo $row->product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered  modal-sm" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLongTitle">QR Code</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						       <?php echo QrCode::size(280)->generate("$row->product_id"); ?>
						      </div>
						      <div class="modal-footer">
						      	<input type="button" value="Print this page" onClick="window.print()">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      
						      </div>
						    </div>
						  </div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php else: ?>
<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="exampleModalLong<?php echo $row->product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered  modal-sm" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLongTitle">QR Code</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						       <?php echo QrCode::size(280)->generate("$row->product_id"); ?>
						      </div>
						      <div class="modal-footer">
						      	<a class="btn btn-default" href="<?php echo e(URL::to('qr/print/?qr_code_no='.$row->product_id)); ?>">Print</a>
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      
						      </div>
						    </div>
						  </div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/blake/Downloads/intime_delivery/resources/views/warehouse/stock/stock_list.blade.php ENDPATH**/ ?>