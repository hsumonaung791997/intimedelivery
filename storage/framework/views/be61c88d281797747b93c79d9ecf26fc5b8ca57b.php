<?php $__env->startSection('content'); ?>

<div class="row">

			<div class="col-md-6">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Issue Create</h3>
								</div>
								<div class="panel-body">
									<?php if(isset($edit)): ?>
										<form action="<?php echo e(URL::to('admin/issue/update/')); ?>" method="post">
											<?php echo csrf_field(); ?>
										<div class="col-md-12 col-lg-12 col-sm-12">
						                    <div class="col-md-8	 col-lg-8 col-sm-8">
						                    	<input type="hidden" name="id" value="<?php $__currentLoopData = $edit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($res->id); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
							                    <input type="text" class="form-control" name="name" value="<?php $__currentLoopData = $edit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($res->name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>" placeholder="Enter Issue">
							                  </div>
							                  <div class="col-md-2 col-sm-2 col-lg-2">
							                    <input type="submit" name="filter" value="Submit" class="btn btn-primary">
						                  </div>
					                  </div>
					                  </form>
					                  <?php else: ?>
					                  <form action="<?php echo e(URL::to('admin/issue/store')); ?>" method="POST">
					                  	<?php echo csrf_field(); ?>
										<div class="col-md-12 col-lg-12 col-sm-12">
						                    <div class="col-md-8	 col-lg-8 col-sm-8">
							                    <input type="text" class="form-control" name="name" value="" placeholder="Enter Issue">
							                  </div>
							                  <div class="col-md-2 col-sm-2 col-lg-2">
							                    <input type="submit" name="filter" value="Submit" class="btn btn-primary">
						                  </div>
					                  </div>
					                  </form>
					                  <?php endif; ?>

									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Issue Type</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; ?>
											<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo e($i++); ?></td>
												<td><?php echo e($row->name); ?></td>
												<td>
													<a href="<?php echo e(URL::to('admin/issue/edit/'.$row->id)); ?>" class="btn btn-primary btn-sm">
													Edit
													</a>
													<a href="<?php echo e(URL::to('admin/issue/delete/'.$row->id)); ?>" class="btn btn-danger btn-sm">Delete
													</a>
													
												</td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
									</table>
							
								</div>
							</div>
							<!-- END BASIC TABLE -->
			</div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/admin/issue.blade.php ENDPATH**/ ?>