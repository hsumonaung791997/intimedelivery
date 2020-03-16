@extends("layouts.tables")
@section('content')
     <div class="panel">
      <form action="{{URL::to('order/update')}}" method="post">
        @csrf
      <div class="panel-body">
         <div class="form-inline">
    <label>Order ID : </label>
      <div class="form-group mx-sm-3 mb-2">
        <input type="hidden" name="primary_id" value="">
        <input type="text" class="form-control" name="order_id" readonly="readonly" value="<?php echo $result[0]->o_id; ?>" >
       
      </div>
  </div>
        <div class="form-inline" style="margin-top: 1%;">
    <label>Order Date : </label>
      <div class="form-group mx-sm-3 mb-2">
      
         <input type="date" name="order_date" class="form-control" readonly="readonly" required value="<?php $date=$result[0]->created_at;
          echo $dates=date("Y-m-d",strtotime($date));
          ?>">
      </div>
  </div>
   <div class="form-inline col-12" style="margin-top: 1%;">
    <label>Description : </label>
      <div class="form-group mx-sm-3 mb-2">
       
        <textarea class="form-control" name="description"  rows="1" cols="120" required readonly="readonly">
          <?php
          $i_d=$result[0]->o_id;
           $results=DB::select("SELECT o_description from order_table where o_id='$i_d'");
           echo $results[0]->o_description;
           ?>
        </textarea>

      </div>
      <div class="pull-right">
      </div>
  </div>
  <!-- Start Body -->
   <div style="margin-top: 1%;">
            <div class="row field_wrapper" id="field_wrapper">
                  <div>
              <table class="table">
                <thead>
                  <tr>
                    <td><label>Product ID</label></td>
                    <td> <label> Weight</label></td>
                    <td><label>Product Expire Date</label></td>
                    <td><label>Qty</label></td>
                    <td><label>Price Per Item</label></td>
                    <td><label>Total Amount</label></td>
                  </tr>
                  <tbody>
            
               
              @foreach($result as $row)
                
                <tr>
                  <td><input type="text" name="product_id[]" class="form-control form-control-sm" value="{{$row->p_id}}"  placeholder="Product ID" readonly="readonly"></td>
                  <td> <input type="text" name="weight[]" class="form-control form-control-sm" value="{{$row->p_weight}}"  placeholder="Weight" readonly="readonly"></td>
                  <?php $date=$row->p_expired_date; ?>
                  <td> <input type="date" name="product_expire_date[]" value="<?php echo date('Y-m-d',strtotime($date)); ?>" class="form-control form-control-sm" readonly="readonly"></td>
                  <td><input type="number" name="qty[]" value="{{$row->p_quantity}}" class="form-control form-control-sm" id="qty" readonly="readonly"></td>
                  <td><input type="text" name="price_per_item[]" value="{{$row->p_price_per_item}}" class="form-control form-control-sm" id="price" placeholder="Price of Each Item" readonly="readonly"></td>
                  <td> <input type="text" name="total_amount[]" value="{{$row->p_amount}}" class="form-control form-control-sm" id="total" readonly="readonly" ></td>
                  
                </tr>
                @endforeach
         
                  </tbody>
                </thead>
              </table>
            </div>

                </div>
                
              </div>

      </div>
      </form>
     </div>


@endsection