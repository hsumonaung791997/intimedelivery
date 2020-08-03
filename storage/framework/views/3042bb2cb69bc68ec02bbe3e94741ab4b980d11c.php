<?php $__env->startSection('content'); ?>
<style type="text/css">
	#image-preview {
  width: 60%;
  height: 275px;
  position: relative;
  overflow: hidden;
  background-color: #ffffff;
  color: #ecf0f1;
}
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
#image-preview input {
  line-height: 200px;
  font-size: 200px;
  position: absolute;
   cursor: pointer;
  opacity: 0;
  z-index: 10;
}
#image-preview label {
  position: absolute;
  z-index: 5;
  opacity: 0.8;
  cursor: pointer;
  background-color: #bdc3c7;
  width: 200px;
  height: 50px;
  font-size: 20px;
  line-height: 50px;
  text-transform: uppercase;
  top: 0;
  left: 0;
  right: 0;
  cursor: pointer;
  bottom: 0;
  margin: auto;
  text-align: center;
}

</style>
<div class="row">
						<div class="col-md-12">
							<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Postman Create</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-4" style="margin-top: 5%;">
											
				<?php $__currentLoopData = $edit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<form method="post" action="<?php echo e(asset('admin/postman/update/'.$row->id)); ?>" class="form-signin" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>
				<?php echo method_field('get'); ?>
				<div class="form-group">
				<div id="image-preview">
                <label for="image-upload" id="image-label image-preview label" style="color: white;cursor: pointer;">Choose  Photo</label>
                <input type="file" name="front_image" id="profile-img">
                <img src="<?php echo e(URL::to('file/photo/'.$row->photo)); ?>" class="mt-2" id="profile-img-tag" width="100%;">
                  
              </div>
          	</div>
										</div>
										<div class="col-md-4">
											<input type="hidden" name="images" value="<?php echo e($row->photo); ?>">
							  <div class="form-group">
							    <label for="exampleInputEmail1"><?php echo e(__('Username')); ?></label>
						
							    <input type="text" name="username" class="form-control" value="<?php echo e($row->user_name); ?>">
							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1"><?php echo e(__('Delivery Name')); ?></label>
							  

							    <input type="text" name="delivery_name" class="form-control" value="<?php echo e($row->delivery_name); ?>">
							   

							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1"><?php echo e(__('Delivery N.R.C')); ?></label>
							   

							    <input type="text" name="delivery_nrc" class="form-control" value="<?php echo e($row->delivery_nrc); ?>">
							   
							    
							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1"><?php echo e(__('Res: Date')); ?></label>
							  
							    <input type="date" name="registration_date" class="form-control" value="<?php  $date=$row->registration_date; 
							    $dates=strtotime($date);
							    echo date("Y-m-d", $dates); 
							    ?>">
							   
							    
							  </div>
							  <div class="form-group">
							    <label for="exampleInputPassword1"><?php echo e(__('Reg: Date')); ?></label>
								
							    <input type="date" name="register_date" class="form-control" value="<?php  $date=$row->register_date; 
							    $dates=strtotime($date);
							    echo date("Y-m-d", $dates); 
							    ?>">
							 

							  </div>
							  <div class="form-group">
							    <label for="exampleInputPassword1"><?php echo e(__('D.O.B')); ?></label>

							    <input type="date" name="date_of_birth" class="form-control" value="<?php echo e($row->date_of_birth); ?>">
							  </div>
							  <div class="form-check">
							    
							    
							  </div>
							  <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
							
							</div>
							<div class="col-md-4">
											
						
								
							  <div class="form-group">
							    <label for="exampleInputEmail1"><?php echo e(__('Phone No.1')); ?></label>

							    <input type="text" name="ph_one" class="form-control" value="<?php echo e($row->ph_one); ?>">
							    
							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1"><?php echo e(__('Phone No.2')); ?></label>
				

							    <input type="text" name="ph_two" class="form-control" value="<?php echo e($row->ph_two); ?>">
							    
							    
							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1"><?php echo e(__('Address')); ?></label>
						

							    <input type="text" name="address" class="form-control" value="<?php echo e($row->address); ?>">
							   
							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1"><?php echo e(__('Employment Date')); ?></label>
						

							    <input type="date" name="employment_date" class="form-control" value="<?php  $date=$row->employment_date; 
							    $dates=strtotime($date);
							    echo date("Y-m-d", $dates); 
							    ?>">
							  </div>
							   <a  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
							    Change Password
							  </a>
							  <div class="collapse" id="collapseExample">
							  <div class="form-group">
							    <label for="exampleInputPassword1"><?php echo e(__('Password')); ?></label>
						

							    <input type="password" name="password" class="form-control" placeholder="Enter Delivery Passowrd">
							 

							  </div>
							  <div class="form-group">
							    <label for="exampleInputPassword1"><?php echo e(__('Confirm Passowrd')); ?></label>

							    <input type="password" name="confirm_password" class="form-control" placeholder="Enter Delivery Confirm Passowrd">
							   
							  </div>
							</div>
							</form>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
							</div>
							</div>
							</div>
							<!-- END BASIC TABLE -->
</div>
</div>

	<script src="<?php echo e(URL::to('assets/vendor/jquery/jquery.min.js')); ?>"></script>
       <script type="text/javascript">

            function readURL(input) {

                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    

                    reader.onload = function (e) {

                        $('#profile-img-tag').attr('src', e.target.result);

                    }

                    reader.readAsDataURL(input.files[0]);

                }

            }

            $("#profile-img").change(function(){

                readURL(this);

            });

        </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/admin/postman/edit.blade.php ENDPATH**/ ?>