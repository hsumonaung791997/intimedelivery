<?php $__env->startSection('content'); ?>

<div class="col-sm-12 col-lg-12 col-md-12">
  <div class="row">
         <div class="row">

      <div class="col-md-12">
              <!-- BASIC TABLE -->
              <div class="row">
                   <div class="col-md-7">
  
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Daily Use List</h3>
                </div>
                                 
                <div class="panel-body">
                  <div class="row">
                    <form action="<?php echo e(URL::to('budget/search')); ?>" method="get">
                    <?php echo csrf_field(); ?> 
                  
                    <div class="col-md-5 col-lg-5 col-sm-5">
                  <label>From Date</label>
                  <input type="date" name="from_date" class="form-control form-control-sm">
                  </div>
                          <div class="col-md-5 col-lg-5 col-sm-5">
                  <label>To Date</label>
                  <input type="date" name="to_date" class="form-control form-control-sm">
                  </div>
                  <div class="col-md-2 col-sm-2 col-lg-2" style="margin-top: 3%;">
                    <input type="submit"  value="Filter" name="filter" class="btn btn-primary" style="margin-top: 2%;">

                  </div>
                  </form>
                  </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Budget</th>
                        <th>Use Amount</th>
                        <th>Balance</th>
                        <th>Use Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(isset($result)): ?>
                      <?php $i=1; ?>
                      <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo number_format($row->budget); ?></td>
                        <td><?php echo number_format($row->expense); ?></td>
                        <td><?php echo number_format($row->budget-$row->expense); ?></td>
                        <td><?php echo e($row->budget_date); ?></td>
                        <td><button class="btn btn-outline-primary btn-sm" value="<?php echo e($row->b_id); ?>">View</button></td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- END BASIC TABLE -->
                    </div>
                    <!-- Right Panel -->
                    <div class="col-md-5">
  <div class="row">
      <div class="col-md-12"> 
        <div class="panel">
                  <div class="panel-heading">
                    <h3 class="panel-title">Purchase</h3>
                  </div>
                                   
                  <div class="panel-body">
                    <div class="row">
                    </div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Use Amount</th>
                          <th>remark</th>
                        </tr>
                      </thead>
                      <tbody id="demo">
                       
                      </tbody>
                    </table>
                  </div>
                </div>
      </div>
      <div class="col-md-12"> 
      <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Expense</h3>
                </div>
                                 
                <div class="panel-body">
                  <div class="row">
                  </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Use Amount</th>
                        <th>Remark</th>
                      </tr>
                    </thead>
                    <tbody id="demo1">

                    </tbody>
                  </table>
                </div>
              </div>
    </div>
  </div>
              
              <!-- END BASIC TABLE -->
                    </div>
                    <div>
                    </div>
              </div>
      </div>
</div>      
                  
  </div>
</div>
<script src="<?php echo e(URL::to('assets/vendor/jquery/jquery.min.js')); ?>"></script>

<script type="text/javascript">

    $(function () {
          $("button").on('click',function (response) {
            var tables="";
            var table1="";
            $b_id=$(this).val();

            $.ajax({

            type : 'get',

            url : '<?php echo e(URL::to('/expense/detail')); ?>',

            data:{'b_id':$b_id},

            success:function(data){

            var purchase_list=data.purchase;
            var expense_list=data.expense;
            var list_total_expenses=data.total_expenses;
            var list_total_purchases=data.total_purchases;

            tables+="<table border='1'>"
            for(var i = 0; i < purchase_list.length; i++) {
                var obj = purchase_list[i];
                 tables +="<tr>";
                 tables += "<td>" + purchase_list[i].title + "</td>";
                 tables += "<td>" + purchase_list[i].amount + "</td>";
                 tables += "<td>" + purchase_list[i].remark + "</td>";
                 tables +="</tr>";
            }
            tables+="<tr>";
            tables+="<td>Total Purchase</td>";
            tables+="<td>"+parseInt(list_total_purchases[0].total_purchases)+"</td>";
            tables+="<td></td>";
            tables+="</tr>";
            tables+="</table>";
            document.getElementById("demo").innerHTML = tables;


            // table 2 
            table1+="<table border='1'>"
            for(var i = 0; i < expense_list.length; i++) {
                 table1 +="<tr>";
                 table1 += "<td>" + expense_list[i].title + "</td>";
                 table1 += "<td>" + expense_list[i].amount + "</td>";
                 table1 += "<td>" + expense_list[i].remark + "</td>";
                 table1 +="</tr>";
            }
            table1+="<tr>";
            table1+="<td>Total Purchase</td>";
            table1+="<td>"+parseInt(list_total_expenses[0].total_expenses)+"</td>";
            table1+="<td></td>";
            table1+="</tr>";
            table1+="</table>";
            document.getElementById("demo1").innerHTML = table1;
            //
            }

            });
        });

    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/blake/Downloads/intime_delivery/resources/views/admin/expense/list.blade.php ENDPATH**/ ?>