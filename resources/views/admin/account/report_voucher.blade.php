<!doctype html>
<html lang="en">

<head>
	<title>In-Time Delivery Service</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{URL::to('/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
</head>
<?php $total_income=0;
      $total_expense=0;
 ?>
<?php $staff_name=$result[0]->of_name; ?>
<?php $date=$result[0]->income_date; ?>
<body>
	@if(isset($result) || isset($response))
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
                        <th>Amount</th>
                        <th>Reg: Date</th>
                        <th>Remark</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; ?>
                     @if(isset($result))
                     @foreach($result as $res)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$res->os_name}}</td>
                        
                        <td>{{$res->amount}}</td>
                        <td>{{$res->created_at}}</td>
                        <td>{{$res->remark}}</td>
                      </tr>
                      <?php $total_income+=$res->amount; ?>
                     @endforeach
                     @endif
                      <tr>
                        <td></td>
                        <td colspan="">Total Incoming</td>
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
                      <th scope="col">Reason of Expense</th>
                      <th scope="col">Remark</th>
                      <th scope="col">Amount</th>
                      <th scope="col">Reg: Date</th>
                    </tr>
                  </thead>
                  <tbody  id="myTable">
                    <?php $i=1; ?>
                    @if(isset($response))
                   @foreach($response as $re)
                   <tr>
                    <td>{{$i++}}</td>
                     <td>{{$re->reason}}</td>
                     <td>{{$re->remark}}</td>
                     <td>{{$re->amount}}</td>
                     <td>{{$re->created_at}}</td>
                   </tr>
                    <?php $total_expense+=$re->amount; ?>
                   @endforeach
                   @endif
                   <tr>
                        <td></td>
                        <td colspan="2">Total Expense</td>
                        <td><?php echo $total_expense; ?></td>
                        <td colspan="3"></td>
                      </tr>
                      
                  </tbody>
                </table>
                <div class="col-sm-4 pull-right">
            <table class="table" style="color: black;font-weight: ">
              <tr>
                <td>Total Incoming</td>
                <td>{{$total_income}}</td>
              </tr>
              <tr>
                <td>Total Expense</td>
                <td>{{$total_expense}}</td>
              </tr>
              <tr>
                <td>Balance</td>
                <td>{{$total_income-$total_expense}}</td>
              </tr>
            </table>
                </div>
                 <div class="col-sm-4 pull-left">
            <table class="table" style="color: black;font-weight: ">
              <tr>
                <td>Staff Name</td>
                <td>{{$staff_name}}</td>
              </tr>
              <tr>
                <td>Date</td>
                <td>{{$date}}</td>
              </tr>
            </table>
                </div>
              </div>
              <!-- END BASIC TABLE -->
</div>
@endif
              </div>
            </div>
</body>
</html>