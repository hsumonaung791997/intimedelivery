<?php $__env->startSection('content'); ?>

<style type="text/css">
	.table > tbody > tr > td {
		vertical-align: middle;
	}
</style>

<div class="row">
	<div class="col-md-12">
		<!-- BASIC TABLE -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Ledger List</h3>
			</div>
			<form action="<?php echo e(route('ledger-list-search')); ?>" method="get">
				<?php echo csrf_field(); ?>
				<?php echo method_field('GET'); ?>
				<?php 
						                    	if(isset($_GET['start_date'])){
														$start_date=$_GET['start_date'];						                    		
						                    	}else{
						                    		$start_date="";
						                    	}
						                    	if(isset($_GET['end_date'])){
														$end_date=$_GET['end_date'];						                    		
						                    	}else{
						                    		$end_date="";
						                    	}
						                    	 ?>
				<div class="col-md-12">
					<label>Start Date: </label>
					<input type="date" name="start_date" id="start_date" value="<?php echo e($start_date); ?>">
					<label>End Date:</label>
					<input type="date" name="end_date" id="end_date" value="<?php echo e($end_date); ?>">
					<input type="submit" name="search" value="Search" class="btn btn-primary">
					<input type="submit" name="print" value="Print" class="btn btn-success">
					
				</div>	


				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>Account Code</th>
								<th>Account Name</th>
								
								<th>Cr</th>
								<th>Dr</th>
								<th>Date</th>
								<th>Remark</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="tbody">
							<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td>
									<?php echo e($row->accounthead->account_id); ?>

								</td>
								<td>
									<?php echo e($row->accounthead->name); ?>

								</td>
								
								<td>
									<?php echo e($row->cr_amount); ?>

								</td>
								<td>
									<?php echo e($row->dr_amount); ?>

								</td>
								<td>
									<?php echo e($row->date); ?>

								</td>
								<td>
									<?php echo e($row->remark); ?>

								</td>
								<td>
									<div class="dropdown">
										<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Modify
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<div class="text-center">
												<a class="dropdown-item" href="<?php echo e(route('account.head.ledger.edit', $row->id)); ?>">Edit</a>
											</div>
											<div class="text-center">
												<a class="dropdown-item" href="<?php echo e(route('account.head.ledger.destroy', $row->id)); ?>">Delete</a>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td colspan="2">
									<b>Total</b>
								</td>
								<td>
									<?php echo e($result->sum('cr_amount')); ?>

								</td>
								<td>
									<?php echo e($result->sum('dr_amount')); ?>

								</td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</form>
		</div>
	</div>
	<!-- END BASIC TABLE -->
</div>

<?php echo e($result->links()); ?>


<!-- <script type="text/javascript">

		$(function () {
			$("#start_date,#end_date").on('change',function () {

				$start_date=$('#start_date').val();
				$end_date=$('#end_date').val();
				 

				$.ajax({

					type : 'get',

					url : '<?php echo e(URL::to('/admin/date/ledger-list')); ?>',

					data:{'start_date':$start_date,'end_date':$end_date},

					success:function(data){

						$('#tbody').html(data);
					}

				});
			});

		});
	</script> -->
	<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/admin/account-head-ledger/index.blade.php ENDPATH**/ ?>