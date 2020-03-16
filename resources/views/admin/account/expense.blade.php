@extends("layouts.admin")
@section('content')
  <link rel="stylesheet" href="{{URL::to('/wickedpicker.min.css')}}">
<script src="{{URL::to('assets/vendor/jquery/jquery.min.js')}}"></script>
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
<form action="{{URL::to('account/expense/store')}}" method="get" >
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
                   @foreach($staffid as $staid)
                     <option value="{{$staid->id}}">{{$staid->user_name}}</option>
                   @endforeach
                 <?php }; ?>
                @foreach($staff as $sta)
                  <option value="{{$sta->id}}">{{$sta->user_name}}</option>
                  @endforeach
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
                <input id="form_name" type="date" name="income_date" class="form-control" value="{{$incomedate}}"  required="required">
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
                  @if($errors->any())
                <span class="label label-success" style="font-size: 25px;">{{$errors->first()}}</span>
                @endif
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
                   @foreach($result as $re)
                   <tr>
                     <td>{{$re->of_name}}</td>
                     <td>{{$re->expense_date}}</td>
                     <td>{{$re->reason}}</td>
                     <td>{{$re->remark}}</td>
                     <td>{{$re->amount}}</td>
                     <td>{{$re->created_at}}</td>
                     <td><a href="{{URL::to('account/expense/delete/'.$re->id)}}" class="btn btn-danger btn-sm">Delete</a></td>
                   </tr>
                   @endforeach
                  </tbody>
                </table>
    
                </div>
              </div>
                  </div>
              </div>
            </div>
            </form>
@endsection