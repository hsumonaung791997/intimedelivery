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
<form action="<?php echo e(URL::to('account/income/store')); ?>" method="get" >
            <div class="col-sm-12 col-lg-12 col-md-12">
              <div class="row">

                  
                  <div class="col-md-8 col-lg-8 col-sm-8">
                       <!-- TIMELINE -->
              <div class="panel panel-scrolling" >
                <div class="panel-heading">
                  <h3 class="panel-title">Select Online Shop</h3>
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
                      <th scope="col">Online Shop Name</th>
                      <th scope="col">Address</th>
                      <th scope="col">Phone One</th>
                      <th scope="col">Phone Two</th>
                      <th scope="col">Check</th>
                    </tr>
                  </thead>
                  <tbody  id="myTable">
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                      
                     <td><?php echo e($row->name); ?></td>
                      <td><?php echo e($row->address); ?></td>
                      <td><?php echo e($row->ph_one); ?></td>
                      <td><?php echo e($row->ph_two); ?></td>
                      <th scope="row">
                       <label class="control-inline fancy-checkbox">
                        <input type="checkbox" value="<?php echo e($row->id); ?>" name="vendor_id" class="test"><span></span>
                      </label>
                      </th>
                    </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
    
                </div>
              </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4">
                      <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Income Info </h3>
           
                </div>
                <input type="hidden" name="reload" value="<?php echo time(); ?>">
                <div class="panel-body">
                     <div class="row">

            <div class="col-md-12 mt-4">
               <div class="col-md-6">
              <div class="form-group">
                <label for="form_lastname">Staff Name</label>
                <select class="form-control" name="staff_id">
                  <?php
                  if(isset($_GET['staff_id'])){
                      $staff_id=$_GET['staff_id'];
                  $staffid=DB::select("SELECT * FROM office_staff where id='$staff_id'");
                   ?>
                   <?php $__currentLoopData = $staffid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($staid->id); ?>"><?php echo e($staid->user_name); ?></option>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 <?php }; ?>
                <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($sta->id); ?>"><?php echo e($sta->user_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="help-block with-errors"></div>
              </div>
            </div>
          
     

             <div class="col-md-6 mt-2">
              <div class="form-group">
                <label for="form_name">Income Date</label>
                <?php if(isset($_GET['income_date'])){
                  $incomedate=$_GET['income_date'];
                  
               }else{
                $incomedate=date("Y-m-d");
               }
               
                  ?>
                <input id="form_name" type="date" name="income_date" class="form-control" value="<?php echo e($incomedate); ?>"  required="required">
                <div class="help-block with-errors"></div>
              </div>
            </div>
                  <div class="col-md-6">
              <div class="form-group">
                <label for="form_lastname">Amount (MMK)</label>
                <input id="form_lastname" type="number" name="amount" autofocus="" class="form-control mt-1" style="margin-top: 2%;" placeholder="Income Amount" required="required" data-error="Amount is required.">
                <div id="fieldList2">
              
                </div>
                <div class="help-block with-errors"></div>
              </div>
            </div>
          
            <div class="col-md-12">
              <div class="form-group">
                <label for="form_lastname">Remark</label>
                <input class="form-control" name="remark"  required="required" value="-">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            </div>

          </div>
          <div style="margin-top: 4%;">
                  <input type="submit" class="btn btn-primary btn-bottom center-block">
                  </div>
                </div>
              </div>
                  </div>
              </div>
            </div>
            </form>
           <div class="col-md-12">
              <!-- BASIC TABLE -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Incoming List</h3>
                </div>
                <div class="panel-body">

                  <table class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Online Shop Name</th>
                        <th>Staff Name</th>
                        <th>Income Date</th>
                        <th>Amount</th>
                        <th>Reg: Date</th>
                        <th>Remark</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; ?>
                     <?php if(isset($result)): ?>
                     <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo e($res->os_name); ?></td>
                        <td><?php echo e($res->of_name); ?></td>
                        <td>
                          <?php  $in_date=$res->income_date; 
                          echo date("Y-m-d",strtotime($in_date));
                          ?>
                        </td>
                        <td><?php echo e($res->amount); ?></td>
                        <td><?php echo e($res->created_at); ?></td>
                        <td><?php echo e($res->remark); ?></td>
                        <td><a href="<?php echo e(URL::to('account/income/delete/'.$res->id)); ?>" class="btn btn-danger btn-sm">Delete</a></td>
                      </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php endif; ?>
                      
                    </tbody>
                  </table>
                    <?php if(isset($result)): ?>
                  <?php echo e($result->appends(Request::except('/account/income'))->setPath('/account/income')); ?>

                  <?php endif; ?>
                </div>
              </div>
              <!-- END BASIC TABLE -->
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/admin/account/income.blade.php ENDPATH**/ ?>