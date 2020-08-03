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
      <?php if(!isset($result)): ?>
      <form action="<?php echo e(URL::to('product/save')); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="panel-heading">
                  <h3 class="panel-title">Product Register</h3>
                </div>
                 <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
                <div class="panel-body">
                  <div class="form-group">
                  <label for="prroduct_id"><?php echo e(__('Product ID')); ?></label>
            
                  <input type="text" name="p_id" class="form-control p_id" id="p_id"  autocomplete="off" placeholder="Enter Product ID" value="<?php echo e(old('p_id')); ?>" required>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Product Name')); ?></label>
            
                  <input type="text" name="p_name" class="form-control"  autocomplete="off" placeholder="Enter Product  Name" required value="<?php echo e(old('p_name')); ?>">
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Product Type')); ?></label>
            
                  <input type="text" name="p_type" class="form-control" autocomplete="off" placeholder="Enter Product Type" required value="<?php echo e(old('p_type')); ?>">
                </div>
                <div class="form-group">
                   <label><?php echo e(__('Product Size')); ?></label>
            
                  <input type="text" name="p_size" class="form-control" autocomplete="off" placeholder="Enter Product Size" required value="<?php echo e(old('p_size')); ?>">
                </div>
                
                <div class="form-group">
                  <label><?php echo e(__('Product Vendor Name')); ?></label>
            
                  <input type="text" name="p_vendor_name" class="form-control"  autocomplete="off" placeholder="Enter Product Vendor Name" required value="<?php echo e(Auth::user()->name); ?>" onClick="this.select();">
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary btn-sm"  autocomplete="off" placeholder="Enter Product Vendor Name" required>
                </div>
         </div>

</form>
<?php else: ?>
<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<form action="<?php echo e(URL::to('parcel/update')); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="panel-heading">
                  <h3 class="panel-title">Product Edit</h3>
                </div>
                <div class="panel-body">
                  <input type="hidden" name="product_id" value="<?php echo e($key->product_id); ?>">
                   
                  <div class="form-group">
                  <label for="prroduct_id"><?php echo e(__('Product ID')); ?></label>
            
                  <input type="text" name="p_id" class="form-control"  autocomplete="off" placeholder="Enter Product ID" value="<?php echo e($key->p_id); ?>"  required>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Product Name')); ?></label>
            
                  <input type="text" name="p_name" class="form-control"  autocomplete="off" placeholder="Enter Product  Name" value="<?php echo e($key->product_name); ?>" required>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Product Type')); ?></label>
            
                  <input type="text" name="p_type" class="form-control" autocomplete="off" placeholder="Enter Product Type" value="<?php echo e($key->product_type); ?>" required>
                </div>
                <div class="form-group">
                   <label><?php echo e(__('Product Size')); ?></label>
            
                  <input type="text" name="p_size" class="form-control" autocomplete="off" placeholder="Enter Product Size" value="<?php echo e($key->product_size); ?>" required>
                </div>
                
                <div class="form-group">
                  <label><?php echo e(__('Product Vendor Name')); ?></label>
            
                  <input type="text" name="p_vendor_name" class="form-control"  autocomplete="off" placeholder="Enter Product Vendor Name" value="<?php echo e($key->product_vendor_name); ?>" required>
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
                  <h3 class="panel-title">Product List </h3>
                  <a href="<?php echo e(URL::to('export/all')); ?>" class="btn btn-primary btn-sm">Export</a>

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
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Type</th>
                    <th>Product Size</th>
                    <th>Product Vendor Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="myTable">
                    <?php $i=1; ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo e($row->p_id); ?></td>
                      <td><?php echo e($row->product_name); ?></td>
                      <td><?php echo e($row->product_type); ?></td>
                      <td><?php echo e($row->product_size); ?></td>
                      <td><?php echo e($row->product_vendor_name); ?></td>
                      <td>
                        <div class="dropdown">
                              <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Modify
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="text-center"><a class="dropdown-item" href="<?php echo e(URL::to('/parcel/edit/'.$row->product_id)); ?>" >Edit</a></div>
                                <div class="text-center"><a class="dropdown-item" href="<?php echo e(URL::to('/parcel/delete/'.$row->product_id)); ?>" >Delete</a></div>
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
     <div class="col-md-8 col-lg-8 col-sm-8">
                       <!-- TIMELINE -->
           <!--    <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Convert Route </h3>
                </div>
<form method="post" enctype="multipart/form-data" action="<?php echo e(url('/convert/route')); ?>">
                    <?php echo csrf_field(); ?>
                <div class="panel-body">
                  <div class="col-sm-12 col-lg-12 col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                   
                    <div class="form-group">
                      <input id="form_lastname" type="file" name="file" class="form-control" >
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                   <div class="col-md-6">
                    <div class="form-group">
                      <input  type="submit" class="btn btn-primary">
                    </div>
                  </div>
                  </form>
                  
                    </div> -->
                    
                  </div>
<script src="<?php echo e(URL::to('assets/vendor/jquery/jquery.min.js')); ?>"></script>

<script type="text/javascript">

    $(function () {
          $("#p_id").on('keyup',function () {

            $state=$('#p_id').val();

            $.ajax({

            type : 'get',

            url : '<?php echo e(URL::to('/auto/suggest')); ?>',

            data:{'p_id':$state},

            success:function(data){

            $('#result').html(data);
            }

            });
        });

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.tables", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views//parcel/create.blade.php ENDPATH**/ ?>