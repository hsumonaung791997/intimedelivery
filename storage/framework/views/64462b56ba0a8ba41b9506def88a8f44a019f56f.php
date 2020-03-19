<?php $__env->startSection('content'); ?>
  <link rel="stylesheet" href="<?php echo e(URL::to('/wickedpicker.min.css')); ?>">
<script src="<?php echo e(URL::to('assets/vendor/jquery/jquery.min.js')); ?>"></script>
            <div class="col-sm-12 col-lg-12 col-md-12">
              <div class="row">
               
                  <div class="col-md-3 col-lg-3 col-sm-3">
                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Today Usage </h3>
                </div>
                <br>
                <div class="panel-body">
                     <div class="row">

            <div class="col-md-12 mt-4 table-responsive">
              
             <table class="table">
              <tr>
                <td> Date</td>
                <td><?php  echo date("d / m / yy"); ?></td>
                        <td></td>

              </tr>
               <tr>
                 <td> Budget</td>
                 <td><?php  
                        $bud=$budget[0]->amount; 
                        echo number_format($bud);
                        ?></td>
                        <td>
                          <a href="#" data-toggle="modal" data-target="#exampleModal">
                          <span class="lnr lnr-pencil"></span>
                          </a>
                        </td>
               </tr>
               <tr>
                <td> Purchase</td>
                 <td><?php  
                        $purchase=$today_purchase[0]->today_purchase; 
                        echo number_format($purchase);
                        ?></td>
                        <td></td>
               </tr>
               <tr>
                <td> Expense</td>
                 <td><?php  
                        $expense=$today_expense[0]->today_expense; 
                        echo number_format($expense);
                        ?></td>
                        <td></td>

               </tr>
               <tr style="background-color: #8de6f0;font-size: 20px;font-weight: bold;">
                <td>Daily Gross</td>
                 <td><?php  
                        $balance=$bud-($purchase+$expense);
                        echo number_format($balance);
                        ?></td>
                        <td></td>

               </tr>
             </table>
                  
          
            
            </div>

          </div>
                </div>

              </div>
                      </div>
                      <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Purchase Info </h3>
                </div>
                <input type="hidden" name="reload" value="<?php echo time(); ?>">
                <?php $__currentLoopData = $budget; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="b_id" value="<?php echo e($row->b_id); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="panel-body">
                     <div class="row">
<form action="<?php echo e(URL::to('admin/purchase/store')); ?>" method="get" >

            <div class="col-md-12 mt-4">
              <div class="col-md-12 mt-2">
              <div class="form-group">
                <label for="form_name">Select Online Shop</label>
               <select class="form-control" name="online_shop">
                 <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $online_shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($online_shop->name); ?>"><?php echo e($online_shop->name); ?></option>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </select>
                <div class="help-block with-errors"></div>
              </div>
            </div>
             <div class="col-md-6 mt-2">
              <div class="form-group">
                <label for="form_name">Purchase Date</label>
                <?php if(isset($_GET['purchase_date'])){
                  $purchase_date=$_GET['purchase_date'];
                  
               }else{
                $purchase_date=date("Y-m-d");
               }
               
                  ?>
                  <?php $__currentLoopData = $budget; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="b_id" value="<?php echo e($row->b_id); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <input id="form_name" type="date" name="purchase_date" class="form-control" value="<?php echo e($purchase_date); ?>"  required="required">
                <div class="help-block with-errors"></div>
              </div>
            </div>
                  <div class="col-md-6">
              <div class="form-group">
                <label for="form_lastname">Amount (MMK)</label>
                <input id="form_lastname" type="number" name="amount" autofocus="" class="form-control mt-1" style="margin-top: 2%;" placeholder="Purchase Amount" required="required" data-error="Amount is required.">
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
<div class="col-md-3 col-lg-3 col-sm-3">
                      <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Expense Info </h3>
                </div>
                <input type="hidden" name="reload" value="<?php echo time(); ?>">
                <div class="panel-body">
                     <div class="row">
<form action="<?php echo e(URL::to('admin/expense/store')); ?>" method="get" >
              <?php $__currentLoopData = $budget; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="b_id" value="<?php echo e($row->b_id); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12 mt-4">
              <div class="col-md-12 mt-2">
              <div class="form-group">
                <label for="form_name">Expense Below (20 K)</label>
             <input type="text" name="under_20_k" class="form-control" value="0">
                <div class="help-block with-errors"></div>
              </div>
            </div>
              <div class="col-md-12 mt-2">
              <div class="form-group">
                <label for="form_name">Expense Above (20 K)</label>
             <input type="text" name="above_20_k" class="form-control" value="0">
                <div class="help-block with-errors"></div>
              </div>
            </div>
          
            <div class="col-md-12">
              <div class="form-group">
                <label for="form_lastname">Reason Of expense</label>
                <input class="form-control" name="remark"  required="required" value="-">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="form_lastname">Advance pay</label>
                <input class="form-control" name="advance"  required="required" value="0">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="form_lastname">Salary</label>
                <input class="form-control" name="salary"  required="required" value="0">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="form_lastname">Rent</label>
                <input class="form-control" name="rent"  required="required" value="0">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="form_lastname">Meter Bill</label>
                <input class="form-control" name="meter_bill"  required="required" value="0">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="form_lastname">Expense Date</label>
                <input class="form-control" name="expense_date"  required="required" value="<?php echo date('Y-m-d'); ?>">
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
                  <div class="col-md-6 col-lg-6 col-sm-6">
                      <div class="panel">
            
                <div class="panel-body">
                     <div class="row">
                   <div class="table">
                      <table class="table">
                      <thead>
                        <tr>
                          <td>No.</td>
                          <td>Title</td>
                          <td>Amount</td>
                          <td>Remark</td>
                          <td></td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; ?>
                        <?php $__currentLoopData = $today_use; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $use): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($i++); ?></td>
                          <td><?php echo e($use->title); ?></td>
                          <td><?php echo e($use->amount); ?></td>
                          <td><?php echo e($use->remark); ?></td>
                          <td>
                            <a class="close" aria-label="Close" href="<?php echo e(URL::to('useage/delete/'.$use->id)); ?>">
                                <span aria-hidden="true" style="color: solid red;">&times;</span>
                              </a>
                              </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="2">Total Expense</td>
                          <td><?php echo $total_usage[0]->total; ?></td>
                        </tr>
                      </tfoot>
                      </table>
                    </div>
                  </div>
          
                </div>
                
              </div>
                  </div>
              </div>
            </div>
           </form>

<!-- Modal -->
<form action="<?php echo e(URL::to('set/budget')); ?>" method="POST">
  <?php echo csrf_field(); ?>
<div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Budget Amount</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="text" name="budget" value="<?php echo e($bud); ?>" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Update">
      </div>
    </div>
  </div>
</div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/blake/Downloads/intime_delivery/resources/views/admin/expense/purchase.blade.php ENDPATH**/ ?>