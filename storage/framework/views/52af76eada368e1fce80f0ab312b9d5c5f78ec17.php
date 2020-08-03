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
                  <h3 class="panel-title">Staff Update</h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-4" style="margin-top: 5%;">
                      

        <form action="<?php echo e(asset('admin/staff/store/')); ?>" class="form-signin" autocomplete="off"  method="post" class="form-horizontal" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('post'); ?>
        <div class="form-group">
        <div id="image-preview">
                <label for="image-upload" id="image-label image-preview label" style="color: white;cursor: pointer;">Choose  Photo</label>
                <input type="file" name="front_image" id="profile-img">
                <img src="<?php echo e(URL::to('images.png')); ?>" class="mt-2" id="profile-img-tag" width="100%;">
                
                  
              </div>
            </div>
                    </div>
                    <div class="col-md-4">
                      <input type="hidden" name="images" value="">
                <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo e(__('Username')); ?></label>
            
                  <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo e(__('Nick Name')); ?></label>
                

                  <input type="text" name="delivery_name" class="form-control">
                 

                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo e(__('Staff N.R.C')); ?></label>
                 

                  <input type="text" name="delivery_nrc" class="form-control">
                 
                  
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo e(__('Res: Date')); ?></label>
                
                  <input type="date" name="registration_date" class="form-control">
                 
                  
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1"><?php echo e(__('Reg: Date')); ?></label>
                
                  <input type="date" name="register_date" class="form-control">
               

                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1"><?php echo e(__('D.O.B')); ?></label>

                  <input type="date" name="date_of_birth" class="form-control">
                </div>
                <div class="form-check">
                  
                  
                </div>
                <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
              
              </div>
              <div class="col-md-4">
                      
            
                
                <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo e(__('Phone No.1')); ?></label>

                  <input type="text" name="ph_one" class="form-control">
                  
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo e(__('Phone No.2')); ?></label>
        

                  <input type="text" name="ph_two" class="form-control">
                  
                  
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo e(__('Address')); ?></label>
            

                  <input type="text" name="address" class="form-control">
                 
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo e(__('Employment Date')); ?></label>
            

                  <input type="date" name="employment_date" class="form-control">
                </div>
                
               
              </form>
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
<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/admin/staff/create.blade.php ENDPATH**/ ?>