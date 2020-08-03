<?php $__env->startSection('content'); ?>
<?php $total=0; 
$sum=0; ?>
<style type="text/css">
	#label_color{
		color: blue;
		font-size: 20px;
	}
</style>
<div class="row">

<div class="col-md-3">
		<!-- BASIC TABLE -->
		<div class="panel">
		<h4>Postman state_list</h4>
			<div class="panel-body">

			<table class="table">
				<?php $i=0; ?>
				<?php $__currentLoopData = $postman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php $i++; ?>	
				<tr>
					<td>
					<a href="<?php echo e(URL::to('admin/choose/postman/?postman='.$row->id)); ?>">
						<?php echo $i; ?></td>
					</a>
					<td>
					<a href="<?php echo e(URL::to('admin/choose/postman/?postman='.$row->id)); ?>">
						<?php echo e($row->user_name); ?>

					</a>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>	
			</div>
		</div>
	</div>
		
		<div class="col-sm-9 col-lg-9 col-md-9">
			<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel">
			<div class="panel-body">
				               
					                    
                  
							<?php if(isset($choose_postman)): ?>
				<?php $__currentLoopData = $choose_postman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cho_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div>
								<div class="form-group">
					      <div class="col-lg-12">
					      	  <label for="basic" id="label_color" class="control-label"><span>ID : <?php echo e($cho_post->id); ?></span></label>
					      	  <label for="basic" id="label_color" class="control-label pull-right">Total Route : <?php echo count($result); ?> </label>
					      	  
						 </div>
						  <div class="col-lg-12">
					      	  <label for="basic" id="label_color" class="control-label">Name : <?php echo e($cho_post->user_name); ?></label>
					      </div>
					 
					       <div class="col-lg-12">
					       	<input type="hidden" name="postman_id" value="<?php echo e($cho_post->id); ?>">
					       	<div class="table-responsive">
					      	  <table class="table"  style="font-size: 13px;">
					      	  	<thead>
					      	  		<th>#</th>
		      	  					<th>No</th>
		      	  					<th>Name</th>
									<th>Address</th>
									<th>Product name</th>
									<th>Deliver Date</th>
									<th>Target Date</th>
									<th>Qty</th>
									<th>Amount</th>
									<th>Action</th>
					      	  	</thead>
					      	  	<form action="<?php echo e(asset('admin/assign/manage')); ?>" method="post">
					      	  		<?php echo csrf_field(); ?>
					      	  		<?php if(isset($choose_postman)): ?>
									<?php $__currentLoopData = $choose_postman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cho_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										       	<input type="hidden" name="postman_id" value="<?php echo e($cho_post->id); ?>">
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
					      	  	 	<tbody>
					      	  		<?php $i=0; ?>
					      	  		<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					      	  		<tr>
					      	  	 <?php	$i++; ?>
					      	  	 	<td>
					      	  	 		<label class="fancy-checkbox">
										<input type="checkbox" value="<?php echo e($res->rp_id); ?>" name="route_plan_id[]">
										<span></span>
									</label>
					      	  	 	</td>
					      	  		<td><?php echo $i; ?></td>
					      	  		<td><?php echo e($res->r_name); ?></td>
					      	  		<td><?php echo e($res->address); ?>,<?php echo e($res->s_name); ?>,<?php echo e($res->t_name); ?></td>
					      	  		<td><?php echo e($res->product_name); ?></td>
					      	  		<td><?php echo e($res->deliver_date); ?></td>
					      	  		<td><?php echo e($res->target_date); ?></td>
					      	  		<td><?php echo e($res->qty); ?></td>
					      	  		<td><?php echo e($res->amount); ?></td>
					      	  		<td>
					      	  			<?php if($res->customer_confirm_status==1): ?>
					      	  			<?php $status='danger'; ?>
					      	  			<?php elseif($res->customer_confirm_status==0): ?>
					      	  			<?php $status='info'; ?>
					      	  			<?php elseif($res->customer_confirm_status==2): ?>
					      	  			<?php $status='default'; ?>
					      	  			<?php endif; ?>
					      	  				<div class="btn-group">
								  <button type="button" class="btn btn-<?php echo $status; ?> dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    Action
								  </button>
								  <div class="dropdown-menu">
								  	<a class="dropdown-item" href="<?php echo e(URL::to('accept/route/'.$res->pr_id.'/'.$res->rp_id)); ?>">Accept</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item" href="<?php echo e(URL::to('cancel/route/'.$res->pr_id.'/'.$res->rp_id)); ?>">Cancel</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item" href="<?php echo e(URL::to('admin/route/print/'.$res->pr_id.'/'.$res->rp_id)); ?>">Print</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item" href="<?php echo e(URL::to('admin/route/drop/'.$res->pr_id.'/'.$res->rp_id)); ?>">Drop</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal<?php echo e($res->pr_id); ?><?php echo e($res->rp_id); ?>">
								    <?php if($res->customer_confirm_status==1): ?>
								    Preview
								    <?php endif; ?>
									</a>
								  </div>
								</div>
							
					      	  		</td>
					      	  		</tr>
					      	  		<?php $total+=$res->amount; ?>
					      	  		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					      	  		
					      	  	</tbody>
					      	  	<tfoot>
					      	  		<tr>
					      	  			<td>Total</td>
					      	  			<td colspan="5"></td>
					      	  			<td>
					      	  				<?php
					      	  				
					      	  				 $sum+=$total;
					      	  				 echo $sum;
					      	  				 ?>
					      	  			</td>
					      	  			<td colspan="2"></td>
					      	  		</tr>
					      	  		<tr>
					      	  			<?php if(isset($result)): ?>
					      	  			<td><input type="submit" name="accept" value="Accept" class="btn btn-link btn-sm"></td>
					      	  			<td><input type="submit" name="cancel" value="Cancel" class="btn btn-link btn-sm"></td>
					      	  			<td><input type="submit" name="drop" value="Drop" class="btn btn-link btn-sm"></td>
					      	  			<?php endif; ?>
					      	  		</tr>
					      	  	</tfoot>
					      	  	</form>

					      	  </table>
					      	  </div>
					      </div>
					    </div>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
				<div class="form-group">
					      <div class="col-lg-12">
					      	  <label for="basic" class="control-label"><span>ID : </span></label>
					      	  <label for="basic" class="control-label pull-right">Total Route : </label>
						 </div>
						  <div class="col-lg-12">
					      	  <label for="basic" class="control-label">Name : </label>
					      </div>
					       <div class="col-lg-12 table-responsive">
					      	  <table class="table"  style="font-size: 13px;">
					      	  	<thead>
		      	  					<th>No</th>
		      	  					<th>Name</th>
									<th>Address</th>
									<th>Product name</th>
									<th>Order Date</th>
									<th>Target Date</th>
									<th>Qty</th>
									<th>Amount</th>
									<th>Action</th>
					      	  	</thead>
					      	 
					      	  </table>
					      </div>
					    </div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<form action="<?php echo e(URL::to('admin/route/assign')); ?>" method="post">
		<?php echo csrf_field(); ?>
			<?php if(isset($choose_postman)): ?>
				<?php $__currentLoopData = $choose_postman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cho_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					       	<input type="hidden" name="postman_id" value="<?php echo e($cho_post->id); ?>">

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
		<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="panel">
			<div class="panel-body">
				<div class="form-group">
				

					      <div class="col-lg-12">
					      	 <div class="row">
					      	
					      <div class="col-lg-3">
					      		      <label for="basic" class="control-label">Select State</label>
					        <select  class="form-control state" name="state" id="state" required="required">
					        	
					        	<?php if(isset($_GET['state'])): ?>
					        		<?php $stateid=$_GET['state'];
					        			$state_list=DB::select("SELECT * FROM state where id='$stateid'");
					        		 ?>
					        		 <?php $__currentLoopData = $state_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					        		 <option value="<?php echo e($state_rows->id); ?>" selected><?php echo e($state_rows->name); ?></option>
					        		 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					        		 <?php $__currentLoopData = $state; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					        		 <option value="<?php echo e($state_row->id); ?>"><?php echo e($state_row->name); ?></option>
					        		 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					        	<?php else: ?>
					        		<?php $__currentLoopData = $state; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					        		 <option value="<?php echo e($state_row->id); ?>"><?php echo e($state_row->name); ?></option>
					        		 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					        	<?php endif; ?>
					        </select>
					      </div>
					
						<div class="col-lg-3">
					      		      <label for="basic" class="control-label">Select Township</label>
					        <select class="form-control" name="township" id="township" required="required">
					        	<?php if(isset($_GET['township'])): ?>
					        	<?php $townshipid=$_GET['township'];
					        			$township_list=DB::select("SELECT * FROM township where id='$townshipid'");
					        			$state_township=DB::select("SELECT * FROM township where state_id='$stateid'");
					        		 ?>
					        		 <?php $__currentLoopData = $township_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $towship_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					        		 <option value="<?php echo e($towship_row->id); ?>" selected><?php echo e($towship_row->name); ?></option>
					        		 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					        		  <?php $__currentLoopData = $state_township; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state_township_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					        		 <option value="<?php echo e($state_township_row->id); ?>"><?php echo e($state_township_row->name); ?></option>
					        		 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					        	<?php else: ?>
					        	 <?php $township_first=DB::select("SELECT * FROM township where state_id=1"); ?>
					        	 <?php $__currentLoopData = $township_first; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $township_firsts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					        	 <option value="<?php echo e($township_firsts->id); ?>"><?php echo e($township_firsts->name); ?></option>
					        	 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					        	<?php endif; ?>
					        	
					        </select>
					      </div>
					      <div class="col-lg-3">
					      		      <label for="basic" class="control-label">Target Date</label>
					        <input type="date" name="target_date" id="target_date" class="form-control">
					      </div>
					      <div class="col-lg-2 mt-4" style="margin-top: 2.5%;">
					        <input type="submit"  class="btn btn-primary" value="Assign">
					      </div>
					  </div>
						 </div>

					       <div class="col-lg-12">
					      	  <table class="table" style="font-size: 13px;">
					      	  	<thead>
					      	  		<th>Name</th>
									<th>Address</th>
									<th>Product name</th>
									<th>Order Date</th>
									<th>Target Date</th>
									<th>Qty</th>
									<th>Total Amount</th>
									<th>Check</th>
					      	  	</thead>
					      	  	<tbody id="tbody">
		
											<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo e($row->r_name); ?></td>
												<td style="word-wrap: break-word;width: 30%;"><?php echo e($row->address); ?>,<?php echo e($row->t_name); ?>,<?php echo e($row->s_name); ?></td>
												<td><?php echo e($row->product_name); ?></td>
												<td><?php echo date('d-m-Y', strtotime($row->reg_date)); ?></td>
												<td><?php echo e($row->target_date); ?></td>
												<td><?php echo e($row->qty); ?></td>
												<td><?php echo e($row->amount); ?></td>
												<td>
													
                      
												</td>
											</tr>
											 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												
										</tbody>
					      	  </table>
					      </div>
					    </div>
			</div>
		</div>
	</div>
</div>
</div>
	</form>
</div>
<?php if(isset($result)): ?>
<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($res->customer_confirm_status==1): ?>
<div class="modal fade" id="exampleModal<?php echo e($res->pr_id); ?><?php echo e($res->rp_id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo e($res->remark); ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<script src="<?php echo e(URL::to('assets/vendor/jquery/jquery.min.js')); ?>"></script>
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
<script type="text/javascript">

    $(function () {
          $("#township,#target_date").on('change',function () {

            $township=$('#township').val();
            $target_date=$('#target_date').val();

            $.ajax({

            type : 'get',

            url : '<?php echo e(URL::to('/admin/township/route')); ?>',

            data:{'township':$township, 'target_date' :$target_date},

            success:function(data){

            $('#tbody').html(data);
            }

            });
        });

    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/intime_delivery/resources/views/admin/route/assign.blade.php ENDPATH**/ ?>