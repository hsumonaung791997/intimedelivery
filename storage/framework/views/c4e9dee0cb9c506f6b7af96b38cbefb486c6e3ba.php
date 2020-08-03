<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <style type="text/css">
    .form-control{
  border: 0;
  border-bottom: 2px solid black;
  border-style: dashed;
}
.form-group {
   margin-bottom: 0px!important;
}
form{
  color: black;
}
p{
  /*font-weight: bold;*/
  font-size: 18px;
}
label{
  /*font-weight: bold;*/
  font-size: 20px;
}
  </style>
  <div class="col-sm-12 mt-4">
<form class="needs-validation" novalidate>
  <div class="alert alert-default"><h4 style="font-weight: bold;">In Time Delivery Service</h4></div>
<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="form-group row no-gutters">
    <label for="exampleInputName" class="col-sm-3 col-form-label">Customer Name</label>
    <div class="col-sm-9">
      <!-- <input type="text" class="form-control" id="exampleInputName" placeholder="Your name" required> -->
          <label class="form-control col-form-label"  ><p style="color: black;"><?php echo e($row->r_name); ?> </p></label>
     
    </div>
  </div>

  <div class="form-group row no-gutters">
    <label for="exampleInputEmail" class="col-sm-3 col-form-label">Address</label>
    <div class="col-sm-9">
      <label class="form-control col-form-label"  ><p style="color: black;"><?php echo e($row->address); ?></p></label>
    </div>
  </div>
  <div class="form-group row no-gutters">
    <label for="exampleInputEmail" class="col-sm-3 col-form-label"></label>
    <div class="col-sm-9">
      <label class="form-control col-form-label"  ><p style="color: black;"><?php echo e($row->t_name); ?> , <?php echo e($row->s_name); ?></p></label>
    </div>
  </div>
  <div class="form-group row no-gutters">
    <label for="exampleInputPassword" class="col-sm-3 col-form-label">Phone Number</label>
    <div class="col-sm-9">
      <label class="form-control col-form-label" ><p style="color: black;"><?php echo e($row->phone); ?></p></label>
    </div>
  </div>
<div class="form-group row no-gutters">
    <label for="exampleInputPassword" class="col-sm-3 col-form-label">Product ID</label>
    <div class="col-sm-9">
      <label class="form-control col-form-label" ><p style="color: black;"><?php echo e($row->productid); ?></p></label>
    </div>
  </div>
  <div class="form-group row no-gutters">
    <label for="exampleInputPassword" class="col-sm-3 col-form-label">Product Type</label>
    <div class="col-sm-9">
      <label class="form-control col-form-label" ><p style="color: black;"><?php echo e($row->product_size); ?> / <?php echo e($row->product_type); ?></p></label>
    </div>
  </div>
    <div class="form-group row no-gutters">
    <label for="exampleInputPassword" class="col-sm-3 col-form-label">Product Price</label>
    <div class="col-sm-9">
      <label class="form-control col-form-label" ><p style="color: black;"><?php echo e($row->amount*$row->qty); ?></p></label>
    </div>
  </div>
  <div class="form-group row no-gutters">
    <label for="exampleInputPassword" class="col-sm-3 col-form-label">Delivery Fees</label>
    <div class="col-sm-9">
      <label class="form-control col-form-label" ><p style="color: black;"><?php echo e($row->delivery_charges); ?></p></label>
    </div>
  </div>
    <div class="form-group row no-gutters">
    <label for="exampleInputPassword" class="col-sm-3 col-form-label">F.O.C / Discount</label>
    <div class="col-sm-9">
      <label class="form-control col-form-label" ><p style="color: black;"><?php echo e($row->foc); ?></p></label>
    </div>
  </div>
    <div class="form-group row no-gutters">
    <label for="exampleInputPassword" class="col-sm-3 col-form-label">Online Shop </label>
    <div class="col-sm-9">
      <label class="form-control col-form-label" ><p style="color: black;"><?php echo e($row->product_vendor_name); ?></p></label>
    </div>
  </div>
  <div class="form-group row no-gutters">
    <label for="exampleInputPassword" class="col-sm-3 col-form-label">Remark </label>
    <div class="col-sm-9">
      <label class="form-control col-form-label" ><p style="color: black;"><?php echo e($row->remark); ?></p></label>
    </div>
  </div>
   <div class="form-group row no-gutters">
    <label for="exampleInputPassword" class="col-sm-3 col-form-label"></label>

    <div class="col-sm-9">
       <?php 
// $result=$_GET['qr_code_no'];
echo QrCode::size(300)->generate($row->route_plan_id);
?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</form>
</div><?php /**PATH /var/www/html/intime_delivery/resources/views/admin/voucher/print.blade.php ENDPATH**/ ?>