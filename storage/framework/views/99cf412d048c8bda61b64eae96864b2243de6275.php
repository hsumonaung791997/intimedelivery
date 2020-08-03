<?php $__env->startSection('content'); ?>

<div class="row">

			<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Contact Issue</h3>
								</div>
								<div class="panel-body">
									<form action="<?php echo e(URL::to('admin/contact/issue/search')); ?>" method="get">
                                        
                                        <?php if(isset($_GET['search'])){
                                            $name=$_GET['search'];
                                        }else{
                                            $name='';
                                        }
                                        if(isset($_GET['date'])){
                                            $date=$_GET['date'];
                                        }else{
                                            $date='';
                                        }

                                        ?>
                 <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="col-md-3 col-lg-3 col-sm-3">
                    <select class="form-control" name="issue_type">
                    	 <?php if(isset($_GET['issue_type'])){
                               $issue_type=$_GET['issue_type'];
                               $is_type=DB::select("SELECT * FROM issue where id='$issue_type'"); 
                              } ?>
                             <?php if(isset($is_type)): ?>
                               <?php $__currentLoopData = $is_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <option value="<?php echo e($it->id); ?>"><?php echo e($it->name); ?></option>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>
                    	<?php $issue=DB::select("SELECT * FROM issue"); ?>
                    	<option value=>All</option>
                    	<?php $__currentLoopData = $issue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    	<option value="<?php echo e($iss->id); ?>"><?php echo e($iss->name); ?></option>
                    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-3">
                   <input placeholder="Choose Issue Date" name="date" class="textbox-n form-control" value="<?php echo e($date); ?>" type="text" onfocus="(this.type='date')" value=""  id="date"> 
                  </div>
                
                  <div class="col-md-3 col-lg-3 col-sm-3">
                   <input name="filter" class="btn btn-primary" type="submit"  value="Filter" class="btn btn-primary"> 

                   <input name="print" type="submit" class="btn btn-success" value="Print"> 
                  </div>
              
                  </div>
                                    </form>
									<div class="row">
							
									<div class="tabele-responsive">	
										<!-- <a href="<?php echo e(URL::to('admin/contact/issue/export')); ?>" class="btn btn-danger btn-sm">Export</a> -->
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Customer </th>
												<th>Phone No.</th>
												<th>Address</th>
												<th>Product ID</th>
												<th>Product Name</th>
												<th>Product Type</th>
												<th>Qty</th>
												<th>Amount</th>
												<th>Target Date</th>
												<th>Reg Date</th>
												<th>Remark</th>
												<th>Vendor</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
							
											<?php $i=1; ?>
											<?php if(isset($result)): ?>
											<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo e($row->r_name); ?></td>
												<td><?php echo e($row->phone); ?></td>
												<td><?php echo e($row->address); ?>,<?php echo e($row->t_name); ?>,<?php echo e($row->s_name); ?></td>
												<td><?php echo e($row->p_id); ?></td>
												<td><?php echo e($row->product_name); ?></td>
												<td><?php echo e($row->product_type); ?></td>
												<td><?php echo e($row->quantity); ?></td>
												<td><?php echo e($row->amount); ?></td>
												<td><?php echo e($row->target_date); ?></td>
												<td><?php $date=$row->reg_date;
												echo date("Y-m-d",strtotime($date));
												 ?></td>
												<td><?php echo e($row->remark); ?></td>
												<td><?php echo e($row->name); ?></td>
												<td><a href="<?php echo e(URL::to('admin/delete/route/plan/'.$row->rp_id)); ?>" class="btn btn-danger btn-sm">Delete</a></td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php endif; ?>
											<?php if(isset($res)): ?>
											<?php $__currentLoopData = $res; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo e($row->r_name); ?></td>
												<td><?php echo e($row->phone); ?></td>
												<td><?php echo e($row->address); ?>,<?php echo e($row->t_name); ?>,<?php echo e($row->s_name); ?></td>
												<td><?php echo e($row->p_id); ?></td>
												<td><?php echo e($row->product_name); ?></td>
												<td><?php echo e($row->product_type); ?></td>
												<td><?php echo e($row->quantity); ?></td>
												<td><?php echo e($row->amount); ?></td>
												<td><?php echo e($row->target_date); ?></td>
												<td><?php $date=$row->reg_date;
												echo date("Y-m-d",strtotime($date));
												 ?></td>
												<td><?php echo e($row->remark); ?></td>
												<td><?php echo e($row->name); ?></td>
												<td><a href="<?php echo e(URL::to('admin/delete/route/plan/'.$row->rp_id)); ?>" class="btn btn-danger btn-sm">Delete</a></td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php endif; ?>
										</tbody>
									</table>
									<?php if(isset($result)): ?>
									 <?php echo e($result->appends(Request::except('/admin/contact/issue'))->setPath('/admin/contact/issue')); ?>

									 <?php endif; ?>
									</div>
								</div>
							</div>
							<!-- END BASIC TABLE -->
			</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\intime_delivery\resources\views/admin/contact_issue.blade.php ENDPATH**/ ?>