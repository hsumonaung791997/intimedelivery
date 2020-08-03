<?php $__env->startSection('content'); ?>
     <div class="panel">
  
      <div class="panel-body">
 
  <!-- Start Body -->
   <div style="margin-top: 1%;">
            <div class="row field_wrapper" id="field_wrapper">
              <form action="<?php echo e(URL::to('order/list/search')); ?>" method="get">
                    <?php 
                                  if(isset($_GET['name'])){
                            $name=$_GET['name'];                                    
                                  }else{
                                    $name="";
                                  }
                                  if(isset($_GET['date'])){
                            $date=$_GET['date'];                                    
                                  }else{
                                    $date=date("Y-m-d");
                                  }
                                     if(isset($_GET['status'])){
                            $status=$_GET['status'];                                    
                                  }else{
                                    $status="";
                                  }
                                   ?>
                  
                  <div class="row">
                    <div class="col-md-3 col-lg-3 col-sm-3">
                    <input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d',strtotime($date)); ?>">
                  </div>
                  
                  <div class="col-md-3 col-lg-3 col-sm-3">
                    <input type="text" name="name" placeholder="Search" class="form-control" value="<?php echo e($name); ?>">                   
                  </div>  
                  <div class="col-sm-3 col-md-3 col-log-3">
                    <select class="form-control" name="status">
                      <?php if($status==0): ?>
                      <option value="0">Pending</option>
                      <?php elseif($status==2): ?>
                      <option value="2">Reject</option>
                      <?php elseif($status==1): ?>
                      <option value="1">Verify</option>
                      <?php elseif($status==3): ?>
                     <option value="3">Still Edit</option>
                      <?php endif; ?>
                      <option value="">SELECT STATUS</option>
                      <option value="0">Pending</option>
                      <option value="2">Reject</option>
                      <option value="1">Verify</option>
                      <option value="3">Still Edit</option>

                    </select>
                  </div>
                  <div class="col-md-2 col-sm-2 col-lg-2">
                    <input type="submit" name="submit" value="Filter" class="btn btn-primary">
                  </div>
                  </form>
                  <div>
              <table class="table">
                <thead>
                  <tr>
                        <th><label>No.</label></th>
                    <th><label>Order ID</label></th>
                    <th> <label> Order Description</label></th>
                    <th><label>Order Register Date</label></th>
                    <th><label>Total Amount</label></th>
                    <th><label>Status</label></th>
                    <th><label> Action</label></th>
                    <th>Preview</th>
                  </tr>
                  <tbody>
                    <?php if(isset($result)): ?>
                    <?php $i=1; ?>
                    <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                          $user_id=Auth::user()->id;
                      $oid=$row->o_id;
                      $o_id=DB::select("SELECT * FROM order_table where o_id='$oid' AND user_id='$user_id'"); 
                      ?>
                      <?php $__currentLoopData = $o_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <tr>
                    <td><label><?php echo $i++; ?></label></td>
                    <td><label><?php echo e($row->o_id); ?></label></td>
                    <td>  <?php echo e($row->o_description); ?></td>
                    <td><label><?php $date=$row->o_register_date; 
                              $dates=strtotime($date);
                              echo date('d/m/Y',$dates);
                    ?></label></td>
                    <td><label><?php echo e($row->o_amount_total); ?></label></td>
                    <td><?php if($row->status==0): ?>
                        <label><?php echo "Pending"; ?></label>
                                <?php elseif($row->status==1): ?>
                        <label><?php echo "Verified"; ?></label>
                                <?php elseif($row->status==2): ?>
                                <label><?php echo "Rejected"; ?></label>
                                <?php elseif($row->status==3): ?>
                                <label><?php echo "Still Edit"; ?></label>

                                <?php endif; ?>
                    </td>

                    <td> 
                      <?php if($row->status==3): ?>
                       <a href="<?php echo e(URL::to('order/edit/'.$row->id.'/'.$row->o_id)); ?>" class="btn btn-primary btn-sm"><span class="lnr lnr-pencil"></span> </a>
                      <?php endif; ?>
                      <?php if($row->status==0): ?>
                        <a href="<?php echo e(URL::to('order/edit/'.$row->id.'/'.$row->o_id)); ?>" class="btn btn-primary btn-sm"><span class="lnr lnr-pencil"></span> </a>
                      <?php else: ?>
                      <?php endif; ?>
                      <?php if($row->status==1): ?>
                   
                    <?php else: ?>
                     <a href="<?php echo e(URL::to('order/delete/'.$row->id.'/'.$row->o_id)); ?>" class="btn btn-danger btn-sm"><span class="lnr lnr-trash"></span> </a>
                    <?php endif; ?>
                    </td>
                    <td> <a href="<?php echo e(URL::to('order/preview/'.$row->id.'/'.$row->o_id)); ?>" class="btn btn-danger btn-sm">Preview</a></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                  <?php $i=1; ?>
                    <?php $__currentLoopData = $select_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                          $user_id=Auth::user()->id;
                      $oid=$row->o_id;
                      $o_id=DB::select("SELECT * FROM order_table where o_id='$oid' AND user_id='$user_id'"); 
                      ?>
                      <?php $__currentLoopData = $o_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <tr>
                    <td><label><?php echo $i++; ?></label></td>
                    <td><label><?php echo e($row->o_id); ?></label></td>
                    <td>  <?php echo e($row->o_description); ?></td>
                    <td><label><?php $date=$row->o_register_date; 
                              $dates=strtotime($date);
                              echo date('d/m/Y',$dates);
                    ?></label></td>
                    <td><label><?php echo e($row->o_amount_total); ?></label></td>
                    <td><?php if($row->status==0): ?>
                        <label><?php echo "Pending"; ?></label>
                                <?php elseif($row->status==1): ?>
                        <label><?php echo "Verified"; ?></label>
                                <?php elseif($row->status==2): ?>
                                <label><?php echo "Rejected"; ?></label>
                                <?php elseif($row->status==3): ?>
                                <label><?php echo "Still Edit"; ?></label>

                                <?php endif; ?>
                    </td>

                    <td> 
                      <?php if($row->status==3): ?>
                       <a href="<?php echo e(URL::to('order/edit/'.$row->id.'/'.$row->o_id)); ?>" class="btn btn-primary btn-sm"><span class="lnr lnr-pencil"></span> </a>
                      <?php endif; ?>
                      <?php if($row->status==0): ?>
                        <a href="<?php echo e(URL::to('order/edit/'.$row->id.'/'.$row->o_id)); ?>" class="btn btn-primary btn-sm"><span class="lnr lnr-pencil"></span> </a>
                      <?php else: ?>
                      <?php endif; ?>
                      <?php if($row->status==1): ?>
                   
                    <?php else: ?>
                     <a href="<?php echo e(URL::to('order/delete/'.$row->id.'/'.$row->o_id)); ?>" class="btn btn-danger btn-sm"><span class="lnr lnr-trash"></span> </a>
                    <?php endif; ?>
                    </td>
                    <td> <a href="<?php echo e(URL::to('order/preview/'.$row->id.'/'.$row->o_id)); ?>" class="btn btn-danger btn-sm">Preview</a></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>

                  </tbody>
                </thead>
              </table>
              <?php if(isset($result)): ?>
             <?php echo e($result->appends(Request::except('/order/list'))->setPath('/order/list')); ?>

             <?php else: ?>
             <?php echo e($select_data->appends(Request::except('/order/list/search'))->setPath('/order/list/search')); ?>

             <?php endif; ?>
            </div>

                </div>
                
              </div>

      </div>
      </form>
     </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.tables", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/order/order_list.blade.php ENDPATH**/ ?>