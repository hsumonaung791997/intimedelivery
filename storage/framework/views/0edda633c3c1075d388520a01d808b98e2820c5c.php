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
									<h3 class="panel-title">Staff List</h3>
								</div>
								<div class="panel-body">
									<form action="<?php echo e(URL::to('admin/staff/search')); ?>" method="get"> 
										<?php echo csrf_field(); ?>
									<div class="col-md-12 col-lg-12 col-sm-12">
						                    <div class="col-md-3 col-lg-3 col-sm-3">
							                    <input type="text" class="form-control" name="search" placeholder="Search ID,Phone No,N.R.C No">
							                  </div>
							             
							                  <div class="col-md-2 col-sm-2 col-lg-2">
							                    <input type="submit" name="submit" value="Filter" class="btn btn-primary">
						                  </div>
					                  </div>
									</form>
					                  
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Username</th>
												<th>Delivery Name</th>
												<th>Phone No.1</th>
												<th>Phone No.2</th>
												<th>N.R.C No.</th>
												<th>Employment Date</th>
												<th>Image</th>
												<th>Action</th>


											</tr>
										</thead>
										<tbody>
											<?php if(isset($result)): ?>
										<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											
											<tr>
												<td>
													<?php echo e($row->id); ?>

												</td>
												<td>
													<?php echo e($row->user_name); ?>

												</td>
												<td>
													<?php echo e($row->delivery_name); ?>

												</td>
												<td>
													<?php echo e($row->ph_one); ?>

												</td>
												<td>
													<?php echo e($row->ph_two); ?>

												</td>
												<td>
													<?php echo e($row->delivery_nrc); ?>

												</td>
												<td>
													<?php echo e($row->employment_date); ?>

												</td>
												<td>
													<img src="<?php echo e(URL::to('/file/photo/'.$row->photo)); ?>" style="height: 80px;">
												</td>
												<td>
   													<div class="dropdown">
  														<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    														Modify
  														</button>
  														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    														<div class="text-center"><a class="dropdown-item" href="<?php echo e(URL::to('admin/staff/edit/'.$row->id)); ?>">Edit</a></div>
    														<div class="text-center"><a class="dropdown-item" href="<?php echo e(URL::to('admin/staff/delete/'.$row->id)); ?>">Delete</a></div>
   														</div>
													</div>   
                      												
												</td>

										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
										<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											
											<tr>
												<td>
													<?php echo e($row->id); ?>

												</td>
												<td>
													<?php echo e($row->user_name); ?>

												</td>
												<td>
													<?php echo e($row->delivery_name); ?>

												</td>
												<td>
													<?php echo e($row->ph_one); ?>

												</td>
												<td>
													<?php echo e($row->ph_two); ?>

												</td>
												<td>
													<?php echo e($row->delivery_nrc); ?>

												</td>
												<td>
													<?php echo e($row->employment_date); ?>

												</td>
												<td>
													<img src="<?php echo e(URL::to('/file/photo/'.$row->photo)); ?>" style="height: 80px;">
												</td>
												<td>
   													<div class="dropdown">
  														<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    														Modify
  														</button>
  														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    														<div class="text-center"><a class="dropdown-item" href="<?php echo e(URL::to('admin/staff/edit/'.$row->id)); ?>">Edit</a></div>
    														<div class="text-center"><a class="dropdown-item" href="<?php echo e(URL::to('admin/staff/delete/'.$row->id)); ?>">Delete</a></div>
   														</div>
													</div>   
                      												
												</td>

										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- END BASIC TABLE -->
						</div>
						
</div>
<?php if(isset($data)): ?>
<?php echo e($data->render("pagination::bootstrap-4")); ?>

<?php else: ?>
<?php echo e($result->appends(Request::except('/admin/postman/search'))->setPath('/admin/postman/search')); ?>

<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/admin/staff/index.blade.php ENDPATH**/ ?>