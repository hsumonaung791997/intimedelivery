<?php $__env->startSection('content'); ?>
<?php $i=0; ?>
<div class="row">

<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Route List</h3>
								</div>
								<div class="panel-body">
									<form action="<?php echo e(URL::to('route/list/search')); ?>" method="get">
										<?php 
						                    	if(isset($_GET['name'])){
														$name=$_GET['name'];						                    		
						                    	}else{
						                    		$name="";
						                    	}
						                    	if(isset($_GET['date'])){
														$date=$_GET['date'];						                    		
						                    	}else{
						                    		$date=date("Y-m-d");
						                    	}

						                    	 ?>
									
									<div class="row">
										<div class="col-md-3 col-lg-3 col-sm-3">
										<input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d',strtotime($date)); ?>">
									</div>
									
									<div class="col-md-3 col-lg-3 col-sm-3">
										<input type="text" name="name" placeholder="Search" class="form-control" value="<?php echo e($name); ?>">										
									</div>	
									<div class="col-sm-3 col-md-3 col-log-3">
										<select class="form-control" name="status">
											<option value="">SELECT STATUS</option>
											<option value="2">Assign</option>
											<option value="3">Drop</option>
											<option value="5">Return</option>

										</select>
									</div>
									<div class="col-md-2 col-sm-2 col-lg-2">
										<input type="submit" name="submit" value="Filter" class="btn btn-primary">
									</div>
									</form>
									</div>
									<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Customer Name</th>
												<th>Item Code</th>
												<th>Item Name</th>
												<th>Address</th>
												<th>Phone No.</th>
												<th>Deliver Name</th>
												<th>Qty</th>
												<th>Price Per Item</th>
												<th>Total Amount</th>
												<th>Route Reg Date</th>
												<th>Assign Date</th>
												<th>Status</th>
												<th>Remark</th>
												<th>Action</th>
											</tr>
										</thead>

										<tbody>
											<?php if(!isset($select_data)): ?>
											
											<?php $__currentLoopData = $select; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php $i++; ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo e($row->r_name); ?></td>
												<td><?php echo e($row->product_id); ?></td>
												<td><?php echo e($row->product_name); ?></td>
												<td><?php echo e($row->address); ?>,<?php echo e($row->t_name); ?>,<?php echo e($row->s_name); ?></td>
												<td><?php echo e($row->phone); ?></td>
												<td><?php echo e($row->delivery_name); ?></td>
												<td><?php echo e($row->qty); ?></td>
												<td><?php echo e($row->amount); ?></td>
												<?php 
													$qty = $row->qty;
													$amount = $row->amount;
													$total = $qty * $amount;
												?>
												<td><?php echo e($total); ?></td>
												<td><?php echo e($row->route_register_date); ?></td>
												<td>
													<?php $date=$row->assign_date; 
													echo date("Y-m-d",strtotime($date));

													?>
												</td>
												<td><?php if($row->status==2): ?>
													<?php  echo "Assign"; ?>
													<?php elseif($row->status==3): ?>
													<?php echo "Drop"; ?>
													<?php elseif($row->status==5): ?>
													<?php echo "Return"; ?>
													<?php endif; ?>
												</td>
												<td><?php echo e($row->remark); ?></td>
												<td><?php if($row->status==5): ?>
													<a href="<?php echo e(URL::to('re/scheldue/'.$row->rp_id.'/'.$row->r_pid)); ?>">
													<span class="lnr lnr-undo"></span>
													</a>
													<?php endif; ?>
												</td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php else: ?>
											
											<?php $__currentLoopData = $select_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php $i++; ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo e($row->r_name); ?></td>
												<td><?php echo e($row->product_id); ?></td>
												<td><?php echo e($row->product_name); ?></td>
												<td><?php echo e($row->address); ?>,<?php echo e($row->t_name); ?>,<?php echo e($row->s_name); ?></td>
												<td><?php echo e($row->phone); ?></td>
												<td><?php echo e($row->delivery_name); ?></td>
												<td><?php echo e($row->qty); ?></td>
												<td><?php echo e($row->amount); ?></td>
												<td><?php echo e($row->route_register_date); ?></td>
												<td>
													<?php $date=$row->assign_date; 
													echo date("Y-m-d",strtotime($date));

													?>
												</td>
												<td><?php if($row->status==2): ?>
													<?php  echo "Assign"; ?>
													<?php elseif($row->status==3): ?>
													<?php echo "Drop"; ?>
													<?php elseif($row->status==5): ?>
													<?php echo "Return"; ?>
													<?php endif; ?>
												</td>
												<td><?php echo e($row->remark); ?></td>
												<td><?php if($row->status==5): ?>
													<a href="<?php echo e(URL::to('re/scheldue/'.$row->rp_id.'/'.$row->r_pid)); ?>">
													<span class="lnr lnr-undo"></span>
													</a>
													<?php endif; ?>
												</td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php endif; ?>
										</tbody>
									</table>
									</div>
									<?php if(!isset($select_data)): ?>
									<?php echo e($select->appends(Request::except('/route/list'))->setPath('/route/list')); ?>

									<?php else: ?>
									<?php echo e($select_data->appends(Request::except('/route/list'))->setPath('/route/list')); ?>

									<?php endif; ?>
								</div>
							</div>
							<!-- END BASIC TABLE -->
</div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.tables", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/route/route_list.blade.php ENDPATH**/ ?>