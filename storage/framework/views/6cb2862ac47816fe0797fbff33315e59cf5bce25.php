<?php $__env->startSection('content'); ?>
  <link rel="stylesheet" href="<?php echo e(URL::to('bootstrap-select.css')); ?>">
    <div class="panel">
      <form action="<?php echo e(URL::to('order/store')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="panel-body">
    
          <div class="form-inline" style="margin-top: 1%;">
            <label>Order Date : </label>
            <div class="form-group mx-sm-3 mb-2">
              <?php if(count($result)>0): ?>
              <?php $date=$result[0]->reg; ?>
              <input type="date" name="order_date" class="form-control" value="<?php echo $date; ?>" required>
              <?php else: ?>
               <input type="date" name="order_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
              <?php endif; ?>
            </div>
          </div>
          <div class="form-inline col-12" style="margin-top: 1%;">
            <label>Description : </label>
            <div class="form-group mx-sm-3 mb-2">
              <?php if(count($result)>0): ?>
              <textarea class="form-control" name="description"  rows="1" cols="120" required><?php echo $result[0]->description;?></textarea>
              <div>
                  <?php if($errors->has('description')): ?>
                  <span class="alert text-danger"><?php echo e($errors->first('description')); ?></span>
                  <?php endif; ?>
              </div>
              <?php else: ?>
              <textarea class="form-control" name="description"  rows="1" cols="120" required></textarea>
              <?php endif; ?>
            </div>
          </div>
          <div class="form-inline col-12" style="margin-top: 1%;">
            <div class="form-group">
              <label for="form_lastname">Receive Name: </label>
              <input id="form_lastname" type="text" name="r_name" class="form-control" placeholder="Eg Mg Mg, Ko Ko">
              <div>
                   <?php if($errors->has('r_name')): ?>
                  <span class="alert text-danger"><?php echo e($errors->first('r_name')); ?></span>
                  <?php endif; ?>
              </div>
            </div>
            <div class="form-group">
              <label for="form_name">Address :</label>
              <input id="form_name" type="text" name="address" class="form-control" placeholder="Ex(N0.72,Road,Street)"  >
                             <div>
                   <?php if($errors->has('address')): ?>
                  <span class="alert text-danger"><?php echo e($errors->first('address')); ?></span>
                  <?php endif; ?>
              </div>
            </div>
            <div class="form-group">
              <label for="form_lastname">Phone :</label>
              <input id="form_lastname" type="text" name="phone" class="form-control" placeholder="eg 09123456789"   >
                             <div>
                   <?php if($errors->has('phone')): ?>
                  <span class="alert text-danger"><?php echo e($errors->first('phone')); ?></span>
                  <?php endif; ?>
              </div>
            </div>
            <div class="form-group">
              <label for="form_name">State :</label>
              <select class="form-control" name="state" id="state">
                                  <option>SELECT STATE</option>
                <?php $__currentLoopData = $state; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
                              <div>
                   <?php if($errors->has('state')): ?>
                  <span class="alert text-danger"><?php echo e($errors->first('state')); ?></span>
                  <?php endif; ?>
              </div>
            </div><br><br>
            <div class="form-group">
              <label for="form_lastname">Township :</label>
              <select class="form-control" name="township" id="township">
                <option>SELECT TOWNSHIP</option>
                 <?php $__currentLoopData = $township; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <div>
                <?php if($errors->has('township')): ?>
                <span class="alert text-danger"><?php echo e($errors->first('township')); ?></span>
                <?php endif; ?>
              </div>
            </div>
            <div class="form-group">
              <label for="form_name">Target Date :</label>
              <input id="form_name" type="date" name="target_date" class="form-control" placeholder="Product Quantity"  >
                              <div>
                   <?php if($errors->has('target_date')): ?>
                  <span class="alert text-danger"><?php echo e($errors->first('target_date')); ?></span>
                  <?php endif; ?>
              </div>
            </div>
            <!-- <div class="form-group">
              <label for="form_lastname">Target Time : </label>
              <input class="form-control timepicker-24-hr" name="target_time" id="timepicker-24-hr" required="required">
              <div class="help-block with-errors"></div>
            </div>
             <div class="form-group">
              <label for="form_lastname">Remark : </label>
              <input class="form-control" name="remark"  required="required" value="-">
              <div class="help-block with-errors"></div>
            </div> -->
            <div class="pull-right">
              <input type="submit" name="add" class="btn btn-primary btn-sm" value="Add">
            </div>
          </div>
          <!-- Start Body -->
          <div style="margin-top: 1%;">
            <div class="row field_wrapper" id="field_wrapper">
              <div>
                <table class="table">
                  <thead>
                    <tr>
                      <td><label>Product ID</label></td>
                      <td> <label> Weight</label></td>
                      <td><label>Product Expire Date</label></td>
                      <td><label>Qty</label></td>
                      <td><label>Price Per Item</label></td>
                      <td><label>Total Amount</label></td>
                      <td><label> Action</label></td>
                    </tr>
                    <tbody>
                      <tr>
                        <td>
                          <select id="basic" class="selectpicker show-tick form-control" name="product_id[]" data-live-search="true">
                              <option value="">SELECT Product ID</option>
                              <?php 
                              $user_id=Auth::user()->id;
                              $results=DB::select("SELECT * FROM product where user_id='$user_id'"); ?>
                              <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($res->product_id); ?>"><?php echo e($res->p_id); ?></option>    
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </td>
                        <td> <input type="text" name="weight[]" class="form-control form-control-sm"  placeholder="Weight" ></td>
                        <td> <input type="date" name="product_expire_date[]" class="form-control form-control-sm" ></td>
                        <td><input type="number" name="qty[]" class="form-control form-control-sm" id="qty" ></td>
                        <td><input type="text" name="price_per_item[]" class="form-control form-control-sm" id="price" placeholder="Price of Each Item" ></td>
                        <td> <input type="text" name="total_amount[]" class="form-control form-control-sm" id="total" readonly="readonly" ></td>
                      </tr>
                      <?php if(isset($result)): ?>
                        <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><input type="text" name="product_id[]" class="form-control form-control-sm" value="<?php echo e($row->p_id); ?>"  placeholder="Product ID" readonly="readonly"></td>
                          <td> <input type="text" name="weight[]" class="form-control form-control-sm" value="<?php echo e($row->p_weight); ?>"  placeholder="Weight" readonly="readonly"></td>
                          <td> <input type="date" name="product_expire_date[]" value="<?php echo e($row->reg); ?>" class="form-control form-control-sm" readonly="readonly"></td>
                          <td><input type="number" name="qty[]" value="<?php echo e($row->qty); ?>" class="form-control form-control-sm" id="qty" readonly="readonly"></td>
                          <td><input type="text" name="price_per_item[]" value="<?php echo e($row->price_per_item); ?>" class="form-control form-control-sm" id="price" placeholder="Price of Each Item" readonly="readonly"></td>
                          <td> <input type="text" name="total_amount[]" value="<?php echo e($row->total_amount); ?>" class="form-control form-control-sm" id="total" readonly="readonly" ></td>
                          <td>
                            <a href="<?php echo e(URL::to('order/delete/'.$row->id.'/'.$row->o_id)); ?>" class="btn btn-danger btn-sm"><span class="lnr lnr-trash"></span></a>
                          </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </tbody>
                  </thead>
                </table>
                <?php if(isset($result)): ?>
                <input type="submit" name="save" value="Save" class="btn btn-success btn-sm">
                <?php endif; ?>
              </div>
            </div>
          </div>

        </div>
      </form>
    </div>
<script src="<?php echo e(URL::to('assets/vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('bootstrap-select.js')); ?>"></script>

<script type="text/javascript">

  $(document).ready(function(){
    $("#price").keyup(function(){
          var val1 = +$("#price").val();
          var val2 = +$("#qty").val();
          $("#total").val(val1*val2);

   });
    $("#qty").click(function(){
          var val1 = +$("#price").val();
          var val2 = +$("#qty").val();
          $("#total").val(val1*val2);
   });
});
</script>

<script>
function createOptions(number) {
  var options = [], _options;

  for (var i = 0; i < number; i++) {
    var option = '<option value="' + i + '">Option ' + i + '</option>';
    options.push(option);
  }

  _options = options.join('');
  
  $('#number')[0].innerHTML = _options;
  $('#number-multiple')[0].innerHTML = _options;

  $('#number2')[0].innerHTML = _options;
  $('#number2-multiple')[0].innerHTML = _options;
}

var mySelect = $('#first-disabled2');

createOptions(4000);

$('#special').on('click', function () {
  mySelect.find('option:selected').prop('disabled', true);
  mySelect.selectpicker('refresh');
});

$('#special2').on('click', function () {
  mySelect.find('option:disabled').prop('disabled', false);
  mySelect.selectpicker('refresh');
});

$('#basic2').selectpicker({
  liveSearch: true,
  maxOptions: 1
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
<?php echo $__env->make("layouts.tables", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/order/create.blade.php ENDPATH**/ ?>