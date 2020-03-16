<?php $__env->startSection('content'); ?>
<style type="text/css">
  li{
    list-style: none;
  }
</style>
<script src="<?php echo e(URL::to('assets/vendor/jquery/jquery.min.js')); ?>"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<div class="col-sm-12 col-lg-12 col-md-12">
  <div class="row no-gutter">
<!-- Start register box -->
    <div class="col-sm-3 col-lg-3 col-md-3">
    <div class="panel panel-headline">
      <?php if(!isset($edit)): ?>
      <form action="<?php echo e(URL::to('admin/online_shop/save')); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="panel-heading">
                  <h3 class="panel-title">Online Shop Register</h3>
                </div>
                 <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
                <div class="panel-body">
                <div class="form-group">
                  <label><?php echo e(__('Online Shop Name')); ?></label>
            
                  <input type="text" name="online_shop_name" class="form-control"  autocomplete="off" placeholder="Enter Online Shop Name" required value="<?php echo e(old('online_shop_name')); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Address')); ?></label>
            
                  <textarea  name="address" class="form-control" autocomplete="off" value="<?php echo e(old('address')); ?>"></textarea> 
                </div>
                <div class="form-group">
                   <label><?php echo e(__('Phone Number')); ?></label>
            
                  <input type="text" name="phone_one" class="form-control" autocomplete="off" placeholder="Enter Phone Number" required value="<?php echo e(old('phone_one')); ?>">
                </div>
                
                <div class="form-group">
                  <label><?php echo e(__('Phone Number')); ?></label>
            
                  <input type="text" name="phone_two" class="form-control"  autocomplete="off" placeholder="Enter Phone Number" required  onClick="this.select();">
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary btn-sm"  autocomplete="off" placeholder="Enter Product Vendor Name" required>
                </div>
         </div>

</form>

<?php else: ?>
<?php $__currentLoopData = $edit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <form action="<?php echo e(URL::to('admin/online_shop/update')); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="panel-heading">
                  <h3 class="panel-title">Online Shop Register</h3>
                </div>
                 <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
                <div class="panel-body">
                <div class="form-group">
                  <label><?php echo e(__('Online Shop Name')); ?></label>
            <input type="hidden" name="id" value="<?php echo e($rows->id); ?>">
                  <input type="text" name="online_shop_name" class="form-control"  autocomplete="off" placeholder="Enter Online Shop Name" required value="<?php echo e($rows->name); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Address')); ?></label>
            
                  <textarea  name="address" class="form-control" autocomplete="off" value="<?php echo e(old('address')); ?>"><?php echo e($rows->address); ?></textarea> 
                </div>
                <div class="form-group">
                   <label><?php echo e(__('Phone Number')); ?></label>
            
                  <input type="text" name="phone_one" class="form-control" autocomplete="off" placeholder="Enter Phone Number" required value="<?php echo e($rows->ph_one); ?>">
                </div>
                
                <div class="form-group">
                  <label><?php echo e(__('Phone Number')); ?></label>
            
                  <input type="text" name="phone_two" class="form-control"  autocomplete="off" placeholder="Enter Phone Number" required  onClick="this.select();" value="<?php echo e($rows->ph_two); ?>">
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary btn-sm"  autocomplete="off" placeholder="Enter Product Vendor Name" required>
                </div>
         </div>

</form>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
      </div>
    </div>
    <!-- End register box -->
    <!-- Start Table box -->
    <div class="col-sm-9 col-lg-9 col-md-9">
      <div class="panel panel-scrolling">
    <div class="panel panel-headline">
          <div class="panel-heading">
                  <h3 class="panel-title">Online Shop List </h3>
                </div>
                <div class="panel-body">
                  <div class="col-sm-3 col-lg-3 col-md-3">
                    <input type="text" id="myInput" class="form-control" placeholder="Search ....">
                  </div>
              <div class="table">
                <table class="table">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Online Shop Name</th>
                    <th>Address</th>
                    <th>Phone No,</th>
                    <th>Phone No,</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="myTable">
                    <?php $i=1; ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo e($row->name); ?></td>
                      <td><?php echo e($row->address); ?></td>
                      <td><?php echo e($row->ph_one); ?></td>
                      <td><?php echo e($row->ph_two); ?></td>
                      <td>
                        <div class="dropdown">
                              <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Modify
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="text-center"><a class="dropdown-item" href="<?php echo e(URL::to('/admin/online_shop/edit/'.$row->id)); ?>" >Edit</a></div>
                                <div class="text-center"><a class="dropdown-item" href="<?php echo e(URL::to('/admin/online_shop/delete/'.$row->id)); ?>" >Delete</a></div>
                              </div>
                          </div>   
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
    <!-- End register box -->
   </div> 
</div>
<div class="col-sm-12 col-lg-12 col-md-12">
           <p id="result" style="color: red;"></p>
  
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/blake/Downloads/intime_delivery/resources/views/admin/online_shop/index.blade.php ENDPATH**/ ?>