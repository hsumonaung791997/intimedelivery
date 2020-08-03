	
<?php $__env->startSection('content'); ?>

<div class="row">

<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Order List Table</h3>
								</div>
								<div class="panel-body">
									<div class="row no-gutters">
										<form action="<?php echo e(URL::to('admin/order/list/search')); ?>" method="get">
										<?php echo csrf_field(); ?> 
									<div class="col-md-3 col-lg-3 col-sm-3">
										<input type="date" class="form-control" name="date" >
									</div>
									
									<div class="col-md-3 col-lg-3 col-sm-3">
										<input type="text" name="name" placeholder="Search Order ID" class="form-control">										
									</div>
									<div class="col-md-2 col-sm-2 col-lg-2">
										<input type="submit" name="submit" value="Filter" class="btn btn-primary">
									</div>
									</form>
									</div>
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Order ID</th>
												<th>Order Date</th>
												<th>Description</th>
												<th>Total Amount</th>
												<th>Order Request</th>
												<th>Status</th>
												<th>Action</th>


											</tr>
										</thead>
										<?php if(isset($result_data)): ?>
										<?php $i=1; ?>
											<?php $__currentLoopData = $result_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php 
											$oid=$res->o_id;
											$o_id=DB::select("SELECT * FROM order_table where o_id='$oid'"); 
											?>
											<?php $__currentLoopData = $o_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo e($row->o_id); ?></td>
												<td><?php echo e($row->o_register_date); ?></td>
												<td><?php echo e($row->o_description); ?></td>
												<td><?php echo e($row->o_amount_total); ?></td>
												<td><?php $user_id=$row->user_id;
												$res=DB::select("SELECT name FROM users where id='$user_id'");
													echo $res[0]->name; 	
												 ?></td>
												<td>
													<?php if($row->status==0): ?>
													<?php echo "Pending"; ?>
													<?php elseif($row->status==1): ?>
													<?php echo "Verified"; ?>
													<?php elseif($row->status==2): ?>)
													<?php echo "Reject"; ?>
													<?php elseif($row->status==3): ?>
													<?php echo "Still Editing"; ?>
													<?php endif; ?>
												</td>
												<td>
   													<div class="dropdown">
  														<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    														Modify
  														</button>
  														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

  															<div class="text-center"><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $row->o_id; ?>" class="dropdown-item" id="click_link" >Preview</a></div>
  															<?php if($row->status==1 || $row->status==2): ?>
  															<?php else: ?>
  																<div class="text-center"><a class="dropdown-item" href="<?php echo e(URL::to('admin/order/verify/'.$row->o_id)); ?>">Verify</a></div>
  											

    														<div class="text-center"><a class="dropdown-item" href="<?php echo e(URL::to('admin/order/decline/'.$row->o_id)); ?>">Reject</a></div>
  															<?php endif; ?>
    													
   														</div>
													</div>   	
												</td>

												</div>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
										<?php else: ?>
										<tbody>
											<?php $i=1; ?>
											<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php 
											$oid=$res->o_id;
											$o_id=DB::select("SELECT * FROM order_table where o_id='$oid'"); 
											?>
											<?php $__currentLoopData = $o_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo e($row->o_id); ?></td>
												<td><?php echo e($row->o_register_date); ?></td>
												<td><?php echo e($row->o_description); ?></td>
												<td><?php echo e($row->o_amount_total); ?></td>
												<td><?php $user_id=$row->user_id;
												$res=DB::select("SELECT name FROM users where id='$user_id'");
													echo $res[0]->name; 	
												 ?></td>
												<td>
													<?php if($row->status==0): ?>
													<?php echo "Pending"; ?>
													<?php elseif($row->status==1): ?>
													<?php echo "Verified"; ?>
													<?php elseif($row->status==2): ?>
													<?php echo "Reject"; ?>
													<?php elseif($row->status==3): ?>
													<?php echo "Still Editing"; ?>
													<?php endif; ?>
												</td>
												<td>
   													<div class="dropdown">
  														<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    														Modify
  														</button>
  														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

  															<div class="text-center"><a data-toggle="modal" href="" data-target=".bd-example-modal-lg<?php echo $row->o_id; ?>" class="dropdown-item" id="click_link" >Preview</a></div>
    														<?php if($row->status==1 || $row->status==2): ?>
  															<?php else: ?>
  																<div class="text-center"><a class="dropdown-item" href="<?php echo e(URL::to('admin/order/verify/'.$row->o_id)); ?>">Verify</a></div>
  											

    														<div class="text-center"><a class="dropdown-item" href="<?php echo e(URL::to('admin/order/decline/'.$row->o_id)); ?>">Reject</a></div>
  															<?php endif; ?>
   														</div>
													</div>   	
												</td>

												</div>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
										<?php endif; ?>
										
									</table>
									<?php if(isset($result_data)): ?>
									 <?php echo e($result_data->appends(Request::except('admin/ledger/qty'))->setPath('/admin/order/list')); ?>


									<?php else: ?>
									 <?php echo e($result->appends(Request::except('admin/ledger/qty'))->setPath('/admin/order/list')); ?>

									 <?php endif; ?>
								</div>
							</div>
							<!-- END BASIC TABLE -->
						</div>
					</div>
<?php if(isset($result_data)): ?>
<?php $__currentLoopData = $result_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade bd-example-modal-lg<?php echo $keys->o_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Product List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div class="modal-body">
     	<table class="table">
     		<thead>
     			<tr>
     			<td>Product ID</td>
      			<td>Weight</td>
      			<td>Expired Date</td>
      			<td>Quantity</td>
      			<td>Price Per Item</td>
      			<td>Amount</td>
     			</tr>
     		</thead>
     		<?php $oder_detail=DB::select("SELECT * FROM order_detail where o_id='$keys->o_id'"); ?>
     			<tbody>
     				<?php $__currentLoopData = $oder_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     				<tr>
     					<td><?php echo e($i->p_id); ?></td>
     					<td><?php echo e($i->p_weight); ?></td>
     					<td><?php echo e($i->p_expired_date); ?></td>
     					<td><?php echo e($i->p_quantity); ?></td>
     					<td><?php echo e($i->p_price_per_item); ?></td>
     					<td><?php echo e($i->p_amount); ?></td>
     				</tr>
     				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     			</tbody>
     	</table>
     </div>
    </div>
  </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade bd-example-modal-lg<?php echo $keys->o_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Product List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div class="modal-body">
     	<table class="table">
     		<thead>
     			<tr>
     			<td>Product ID</td>
      			<td>Weight</td>
      			<td>Expired Date</td>
      			<td>Quantity</td>
      			<td>Price Per Item</td>
      			<td>Amount</td>
     			</tr>
     		</thead>
     		<?php $oder_detail=DB::select("SELECT * FROM order_detail where o_id='$keys->o_id'"); ?>
     			<tbody>
     				<?php $__currentLoopData = $oder_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     				<tr>
     					<td><?php echo e($i->p_id); ?></td>
     					<td><?php echo e($i->p_weight); ?></td>
     					<td><?php echo e($i->p_expired_date); ?></td>
     					<td><?php echo e($i->p_quantity); ?></td>
     					<td><?php echo e($i->p_price_per_item); ?></td>
     					<td><?php echo e($i->p_amount); ?></td>
     				</tr>
     				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     			</tbody>
     	</table>
     </div>
    </div>
  </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>



<script type="text/javascript">

    $(function () {
          $("#click_link").on('click',function (e) {

          	e.preventDefault();
  
        });

    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thiri/yoonhanthar/intime-delivery/resources/views/admin/order/order_list.blade.php ENDPATH**/ ?>