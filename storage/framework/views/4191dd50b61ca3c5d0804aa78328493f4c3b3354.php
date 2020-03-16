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
<form action="<?php echo e(URL::to('account/expense/store')); ?>" method="get" >
            <div class="col-sm-12 col-lg-12 col-md-12">
              <div class="row">

                  
                  
                  <div class="col-md-3 col-lg-3 col-sm-3">
                      <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Expense Info </h3>
           
                </div>
                <input type="hidden" name="reload" value="<?php echo time(); ?>">
                <div class="panel-body">
                     <div class="row">

            <div class="col-md-12 mt-4">
               <div class="col-md-12">
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
          
     

             <div class="col-md-12 mt-2">
              <div class="form-group">
                <label for="form_name">Expense Date</label>
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
                  <div class="col-md-12">
              <div class="form-group">
                <label for="form_lastname">Amount (MMK)</label>
                <input id="form_lastname" type="number" name="amount" autofocus="" class="form-control mt-1" style="margin-top: 2%;" placeholder="Expense Amount" required="required" data-error="Amount is required.">
                <div id="fieldList2">
              
                </div>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="form_lastname">Reason of Expense</label>
                <input class="form-control" name="reason"  required="required" value="-">
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
                  <div class="col-md-9 col-lg-9 col-sm-9">
                       <!-- TIMELINE -->
             <div class="panel panel-scrolling" style="height: 800px !important;">
              
                <div class="panel-heading">
                  <h3 class="panel-title">Expense List</h3>
                </div>

                <div class="panel-body">
                  <div class="col-sm-2 col-lg-2 col-md-2">
              <input id="myInput" type="text" placeholder="Search.." class="form-control">
                    
                  </div>
                  <?php if($errors->any()): ?>
                <span class="label label-success" style="font-size: 25px;"><?php echo e($errors->first()); ?></span>
                <?php endif; ?>
                  <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Staff Name</th>
                      <th scope="col">Expense Date</th>
                      <th scope="col">Reason of Expense</th>
                      <th scope="col">Remark</th>
                      <th scope="col">Amount</th>
                      <th scope="col">Reg: Date</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody  id="myTable">
                   <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $re): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <tr>
                     <td><?php echo e($re->of_name); ?></td>
                     <td><?php echo e($re->expense_date); ?></td>
                     <td><?php echo e($re->reason); ?></td>
                     <td><?php echo e($re->remark); ?></td>
                     <td><?php echo e($re->amount); ?></td>
                     <td><?php echo e($re->created_at); ?></td>
                     <td><a href="<?php echo e(URL::to('account/expense/delete/'.$re->id)); ?>" class="btn btn-danger btn-sm">Delete</a></td>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/blake/Downloads/intime_delivery/resources/views/admin/account/expense.blade.php ENDPATH**/ ?>