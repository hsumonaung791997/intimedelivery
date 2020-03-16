
<?php $__env->startSection('content'); ?>
<div class="row">
<div class="col-md-3">
		<!-- BASIC TABLE -->
		<div class="panel">
		<h4>Postman List</h4>
			<div class="panel-body">

			<table class="table">
				<?php $i=0; ?>
				<?php $__currentLoopData = $postman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php $i++; ?>	
				<tr>
					<td>
					<a href="<?php echo e(URL::to('warehouse/choose/postman/?postman='.$row->id)); ?>">
						<?php echo $i; ?></td>
					</a>
					<td>
					<a href="<?php echo e(URL::to('warehouse/choose/postman/?postman='.$row->id)); ?>">
						<?php echo e($row->user_name); ?>

					</a>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>	
			</div>
		</div>
	</div>
		<?php echo csrf_field(); ?>
		<div class="col-sm-9 col-lg-9 col-md-9">
			<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel">
			<div class="panel-body">
				               
					                    
		<form action="<?php echo e(URL::to('warehouse/postman/receive')); ?>" method="post">
                  <?php echo csrf_field(); ?>
							<?php if(isset($choose_postman)): ?>
				<?php $__currentLoopData = $choose_postman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cho_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="form-group">
					      <div class="col-lg-12">
					      	  <label for="basic" class="control-label"><span>ID : <?php echo e($cho_post->id); ?></span></label>
					      	  
						 </div>
						  <div class="col-lg-12">
					      	  <label for="basic" class="control-label">Name : <?php echo e($cho_post->user_name); ?></label>
					      </div>
					 	 <div class="col-lg-12">
					 	 	<input type="text" name="plan_id" autofocus="">
					      	<input type="submit" name="submit" class="btn btn-primary btn-sm" style="margin-top: -0.5%;">
					      </div>
					      </form>
					       <div class="col-lg-12">
					       	<input type="hidden" name="postman_id" value="<?php echo e($cho_post->id); ?>">
					      	  <table class="table"  style="font-size: 13px;">
					      	  	<thead>
		      	  					<th>No</th>
									<th>Product ID</th>
									<th>Product Name</th>
									<th>Product Type</th>
									<th>Product Size</th>
									<th>Vendor Name</th>
									<th>Quantity</th>
									<th>Action</th>
					      	  	</thead>
					      	  	<tbody>
					      	  		<?php if(isset($product_list)): ?>
									<?php $i=1; ?>

					      	  		<?php $__currentLoopData = $product_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					      	  		<tr>
					      	  			<td><?php echo $i++ ?></td>
					      	  			<td><?php echo e($p_list->p_id); ?></td>
					      	  			<td><?php echo e($p_list->product_name); ?></td>
					      	  			<td><?php echo e($p_list->product_type); ?></td>
					      	  			<td><?php echo e($p_list->product_size); ?></td>
					      	  			<td><?php echo e($p_list->product_vendor_name); ?></td>
					      	  			<td><?php echo e($p_list->out_qty); ?></td>
					      	  			<td>
					      	  			 <?php $__currentLoopData = $choose_postman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cho_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									    <a class="btn btn-danger btn-sm" href="<?php echo e(URL::to('warehouse/postman/receive/cancel/'.$cho_post->id.'/'.$p_list->so_id.'/'.$p_list->plan_id)); ?>">Cancel</a>
									    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					      	  			</td>
					      	  		</tr>
					      	  		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					      	  		<?php endif; ?>
					      	  	</tbody>
					      	  </table>
					      </div>
					    </div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
				<div class="form-group">
					      <div class="col-lg-12">
					      	  <label for="basic" class="control-label"><span>ID : </span></label>
						 </div>
						  <div class="col-lg-12">
					      	  <label for="basic" class="control-label">Name : </label>
					      </div>
					     
					       <div class="col-lg-12">
					      	  <table class="table"  style="font-size: 13px;">
					      	  	<thead>
		      	  				<th>No</th>
									<th>Product ID</th>
									<th>Product Name</th>
									<th>Product Type</th>
									<th>Product Size</th>
									<th>Vendor Name</th>
									<th>Quantity</th>
									<th>Action</th>
					      	  	</thead>
					      	  	<tbody>
					      	  		<?php if(isset($product_list)): ?>
					      	  		<?php $__currentLoopData = $product_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					      	  		<tr>
					      	  			<td><?php echo $i++ ?></td>
					      	  			<td><?php echo e($p_list->p_id); ?></td>
					      	  			<td><?php echo e($p_list->product_name); ?></td>
					      	  			<td><?php echo e($p_list->product_type); ?></td>
					      	  			<td><?php echo e($p_list->product_size); ?></td>
					      	  			<td><?php echo e($p_list->product_vendor_name); ?></td>
					      	  			<td><?php echo e($p_list->out_qty); ?></td>
					      	  			
					      	  			<td>
									   <?php $__currentLoopData = $postman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									    <a class="btn btn-danger btn-sm" href="<?php echo e(URL::to('warehouse/postman/receive/cancel/'.$row->id.'/'.$p_list->so_id.'/'.$p_list->plan_id)); ?>">Cancel</a>
									    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					      	  			</td>
					      	  		</tr>
					      	  		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					      	  		<?php endif; ?>
					      	  	</tbody>
					      	  </table>
					      </div>
					    </div>
				<?php endif; ?>
			</div>
		</div>
	</div>


</div>
</div>
	
</div>
<!-- <script src="<?php echo e(URL::to('assets/vendor/jquery/jquery.min.js')); ?>"></script> -->
<script type="text/javascript">

    $(function () {
          $("#state").on('click',function () {

            $state=$('#state').val();

            $.ajax({

            type : 'get',

            url : '<?php echo e(URL::to('/order/entry/state')); ?>',

            data:{'state':$state},

            success:function(data){

            $('#township').html(data);
            }

            });
        });

    });
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/blake/Downloads/intime_delivery/resources/views/warehouse/stock/stock_outgoing.blade.php ENDPATH**/ ?>