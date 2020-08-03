<?php $__env->startSection('content'); ?>
<?php $total_income=0;
      $total_expense=0;
 ?>

<script src="<?php echo e(URL::to('assets/vendor/jquery/jquery.min.js')); ?>"></script>

            <div class="col-sm-12 col-lg-12 col-md-12">
              <div class="row">

                  <form action="<?php echo e(URL::to('account/report/show')); ?>" method="get">
                  
                  <div class="col-md-12 col-lg-12 col-sm-12">
                      <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Expense and Income </h3>
           
                </div>
                <input type="hidden" name="reload" value="<?php echo time(); ?>">
                <div class="panel-body">
                     <div class="row">

            <div class="col-md-3 mt-4">
               <div class="col-md-12">
              <div class="form-group">
                <label for="form_lastname">Staff Name</label>
                <select class="form-control" name="staff_id" required>
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
             
   

            </div>
<div class="col-md-3 mt-2">
              <div class="form-group">
                <label for="form_name">Register Date</label>
                <?php if(isset($_GET['income_date'])){
                  $incomedate=$_GET['income_date'];
                  
               }else{
                $incomedate=date("Y-m-d");
               }
               
                  ?>
                <input id="form_name" type="date" name="date" class="form-control" value="<?php echo e($incomedate); ?>"  required="required">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-3 mt-2" style="margin-top: 1.5%;">
              <div class="form-group">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                <!-- <a href="#" class="btn btn-info" id="btnExport">Export Pdf</a> -->
                <input type="submit" name="export" value="Print" class="btn btn-info">
              </div>
            </div>

            </form>

          </div>
       
                </div>
              </div>
                  </div>
                  <?php if(isset($result) || isset($response)): ?>
                  <div class="col-md-12" id="tblCustomers">
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
                      <?php $total_income+=$res->amount; ?>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php endif; ?>
                      <tr>
                        <td></td>
                        <td colspan="3">Total Incoming</td>
                        <td><?php echo $total_income; ?></td>
                        <td colspan="3"></td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="panel-heading">
                  <h3 class="panel-title">Expense List</h3>
                </div>
                    <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th>No</th>
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
                    <?php $i=1; ?>
                    <?php if(isset($response)): ?>
                   <?php $__currentLoopData = $response; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $re): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <tr>
                    <td><?php echo e($i++); ?></td>
                     <td><?php echo e($re->of_name); ?></td>
                     <td><?php echo e($re->expense_date); ?></td>
                     <td><?php echo e($re->reason); ?></td>
                     <td><?php echo e($re->remark); ?></td>
                     <td><?php echo e($re->amount); ?></td>
                     <td><?php echo e($re->created_at); ?></td>
                     <td><a href="<?php echo e(URL::to('account/expense/delete/'.$re->id)); ?>" class="btn btn-danger btn-sm">Delete</a></td>
                   </tr>
                    <?php $total_expense+=$re->amount; ?>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <?php endif; ?>
                   <tr>
                        <td></td>
                        <td colspan="3">Total Expense</td>
                        <td><?php echo $total_expense; ?></td>
                        <td colspan="3"></td>
                      </tr>
                      
                  </tbody>
                </table>
                <div class="col-sm-4 pull-right">
            <table class="table" style="color: black;font-weight: ">
              <tr>
                <td>Total Incoming</td>
                <td><?php echo e($total_income); ?></td>
              </tr>
              <tr>
                <td>Total Expense</td>
                <td><?php echo e($total_expense); ?></td>
              </tr>
              <tr>
                <td>Balance</td>
                <td><?php echo e($total_income-$total_expense); ?></td>
              </tr>
            </table>
                </div>
              </div>
              <!-- END BASIC TABLE -->
</div>
<?php endif; ?>
              </div>
            </div>
            </div>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", "#btnExport", function () {
            html2canvas($('#tblCustomers')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Table.pdf");
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/admin/account/report.blade.php ENDPATH**/ ?>