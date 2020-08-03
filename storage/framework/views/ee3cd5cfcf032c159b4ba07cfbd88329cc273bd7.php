<?php $__env->startSection('content'); ?>
<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel">
			<div class="panel-body">
				<h4 class="panel-heading">Stock Receive</h4>
					                    
		<form action="<?php echo e(URL::to('warehouse/stock/received')); ?>" method="post">
                  <?php echo csrf_field(); ?>
									<div class="form-group">
					      
					 	 <div class="col-lg-12">
					 	 	<input type="text" name="route_plan_id" autofocus="">
					      	<input type="submit" name="submit" class="btn btn-primary btn-sm" style="margin-top: -0.5%;">
					      </div>
					       <div class="col-lg-6 " style="margin-top: 1%;">
					      <?php if(\Session::has('error')): ?>
					    <div class="alert alert-danger">
					        <ul>
					            <li><?php echo \Session::get('error'); ?></li>
					        </ul>
					    </div>
					<?php endif; ?>
				</div>
					      </form>
					      
					       <div class="col-lg-12 table-responsive">
					      	  <table class="table"  style="font-size: 13px;">
					      	  	<thead>
		      	  					<th>No</th>
									<th>Product ID</th>
									<th>Product Name</th>
									<th>Product Type</th>
									<th>Product Size</th>
									<th>Vendor Name</th>
									<th>Quantity</th>
									<th>Price Per Item</th>
									<th>Date</th>
									<th>Action</th>
					      	  	</thead>
					      	  	<tbody>
					      	  		<?php $i=1; ?>
					      	  		<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					      	  		<tr>
					      	  			<td><?php echo e($i++); ?></td>
					      	  			<td><?php echo e($row->p_id); ?></td>
					      	  			<td><?php echo e($row->product_name); ?></td>
					      	  			<td><?php echo e($row->product_type); ?></td>
					      	  			<td><?php echo e($row->product_size); ?></td>
					      	  			<td><?php echo e($row->product_vendor_name); ?></td>
					      	  			<td><?php echo e($row->quantity); ?></td>
					      	  			<td><?php echo e($row->amount); ?></td>
					      	  			<td><?php $date=$row->created_at;
					      	  				echo date("Y-m-d H:i:s",strtotime($date));
					      	  			 ?></td>
					      	  			 <td><a href="<?php echo e(URL::to('warehouse/stock/received/delete/'.$row->route_plan_id)); ?>" class="btn btn-danger btn-sm">Cancel</a></td>
					      	  		</tr>
					      	  		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					      	  		
					      	  	</tbody>
					      	  </table>
					      	  <?php echo e($result->appends(Request::except('/warehouse/stock/receive'))->setPath('/warehouse/stock/receive')); ?>

					      </div>
					    </div>
		
				
			</div>
		</div>
		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/warehouse/stock/stock_receive.blade.php ENDPATH**/ ?>