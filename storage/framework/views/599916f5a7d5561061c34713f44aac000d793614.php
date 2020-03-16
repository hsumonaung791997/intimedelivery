<?php $__env->startSection('content'); ?>
  <link rel="stylesheet" href="<?php echo e(URL::to('/wickedpicker.min.css')); ?>">
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
<form action="<?php echo e(URL::to('admin/route/plan/edit/store')); ?>" method="post" >
  <?php echo csrf_field(); ?>
            <div class="col-sm-12 col-lg-12 col-md-12">
              <div class="row">

                  <div class="col-md-4 col-lg-4 col-sm-4">
                      <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Route Plan </h3>
           
                </div>
                <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="panel-body">
                     <div class="row">
          <input type="hidden" name="route_plan_id" value="<?php echo e($res->route_plan_id); ?>">
          <input type="hidden" name="user_id" value="<?php echo e($res->user_id); ?>">

            <div class="col-md-12 mt-4">
               <div class="col-md-6">
              <div class="form-group">
                <label for="form_lastname">Phone</label>
                <input id="form_lastname" type="text" name="phone" class="form-control" placeholder="eg 09123456789" required="required" data-error="phone number is required." value="<?php echo e($res->phone); ?>">
                <div class="help-block with-errors"></div>
              </div>
            </div>
             <div class="col-md-6">
              <div class="form-group">
                <label for="form_lastname">Receive Name</label>
                <input id="form_lastname" type="text" name="r_name" class="form-control" placeholder="Eg Mg Mg, Ko Ko" required="required" data-error="Receiver Name is required." value="<?php echo e($res->r_name); ?>">
                <div class="help-block with-errors"></div>
              </div>
            </div>
              <div class="form-group" style="margin-top: 4%;">
                <label for="form_name">Address</label>
                <input id="form_name" type="text" name="address" class="form-control" placeholder="Ex(N0.72,Road,Street)" required="required" value="<?php echo e($res->address); ?>">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <div class="col-md-6">
              <div class="form-group">
                <label for="form_name">State</label>
                <select class="form-control" name="state" id="state">
                  <option value="<?php echo e($res->s_id); ?>"><?php echo e($res->s_name); ?></option>
                                    <option>SELECT STATE</option>
                  <?php $__currentLoopData = $state; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  <option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="form_lastname">Township</label>
                <select class="form-control" name="township" id="township">
                  <option value="<?php echo e($res->t_id); ?>"><?php echo e($res->t_name); ?></option>
                  <option>SELECT TOWNSHIP</option>
                </select>
                <div class="help-block with-errors"></div>
              </div>
            </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                <label for="form_name">Quantity</label>
                <input id="form_name" type="number" name="quantity" class="form-control" placeholder="Product Quantity" required="required" value="<?php echo e($res->quantity); ?>">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="form_lastname">Amount (MMK)</label>
                <input id="form_lastname" type="number" name="amount" class="form-control" placeholder="Price Per Item" required="required" data-error="Lastname is required." value="<?php echo e($res->amount); ?>">
                <div class="help-block with-errors"></div>
              </div>
            </div>


             <div class="col-md-6 mt-2">
              <div class="form-group">
                <label for="form_name">Target Date</label>
                <input id="form_name" type="date" name="target_date" class="form-control" placeholder="Product Quantity" required="required" value="<?php echo e($res->target_date); ?>">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6 mt-2">
              <div class="form-group">
                <label for="form_lastname">Target Time</label>
                <input class="form-control timepicker-24-hr" name="target_time" id="timepicker-24-hr" required="required" value="<?php echo e($res->target_time); ?>">
                <div class="help-block with-errors"></div>
              </div>
            </div>
          <div class="col-md-12 mt-2">
              <div class="form-group">
                <label for="form_lastname">Remark</label>
                <input class="form-control" name="remark"  required="required" value="<?php echo e('-'); ?><?php echo e($res->remark); ?>">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            </div>

          </div>
          <div style="margin-top: 4%;">
                  <input type="submit" class="btn btn-primary btn-bottom center-block">
                  </div>
                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
                  </div>
                  <div class="col-md-8 col-lg-8 col-sm-8">
                       <!-- TIMELINE -->
              <div class="panel panel-scrolling">
                <div class="panel-heading">
                  <h3 class="panel-title">Select Product</h3>
                </div>

                <div class="panel-body">
                  <div class="col-sm-3 col-lg-3 col-md-3">
              <input id="myInput" type="text" placeholder="Search.." class="form-control">
                    
                  </div>
                  <?php if($errors->any()): ?>
                <span class="label label-success" style="font-size: 25px;"><?php echo e($errors->first()); ?></span>
                <?php endif; ?>
                  <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Product ID</th>
                      <th scope="col">Product Name</th>
                      <th scope="col">Product Size</th>
                      <th scope="col">Product Type</th>
                      <th scope="col">Product Vendor Name</th>
                    </tr>
                  </thead>
                  <tbody  id="myTable">
                     <tr>
                      <th scope="row">
                       <label class="control-inline fancy-checkbox">
                        <input type="checkbox" value="<?php echo e($res->product_id); ?>" name="product_id" class="test" checked><span></span>
                      </label>
                      </th>
                      <td><?php echo e($res->p_id); ?></td>
                      <td><?php echo e($res->product_name); ?></td>
                      <td><?php echo e($res->product_size); ?></td>
                      <td><?php echo e($res->product_type); ?></td>
                      <td><?php echo e($res->product_vendor_name); ?></td>
                    </tr>
                    <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                      <th scope="row">
                       <label class="control-inline fancy-checkbox">
                        <input type="checkbox" value="<?php echo e($row->product_id); ?>" name="product_id" class="test"><span></span>
                      </label>
                      </th>
                      <td><?php echo e($row->p_id); ?></td>
                      <td><?php echo e($row->product_name); ?></td>
                      <td><?php echo e($row->product_size); ?></td>
                      <td><?php echo e($row->product_type); ?></td>
                      <td><?php echo e($row->product_vendor_name); ?></td>
                    </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
    
                </div>
              </div>
                  </div>
              </div>
            </div>
            </form>
       
<script src="<?php echo e(URL::to('assets/vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('/wickedpicker.min.js')); ?>"></script>

<script>
  var twelveHour = $('.timepicker-12-hr').wickedpicker();
            $('.time').text('//JS Console: ' + twelveHour.wickedpicker('time'));
            $('.timepicker-24-hr').wickedpicker({twentyFour: true});
            $('.timepicker-12-hr-clearable').wickedpicker({clearable: true});
</script>
<script type="text/javascript">
  $('input.test').on('change', function() {
    $('input.test').not(this).prop('checked', false);  
});
</script>
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
<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/blake/Downloads/intime_delivery/resources/views/admin/route/edit_route.blade.php ENDPATH**/ ?>