@extends("layouts.admin")
@section('content')

<div class="row">

<div class="col-md-12">
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">HighWay Drop List</h3>
                                </div>
                                <div class="panel-body">
                                    <form action="{{URL::to('admin/parcel/drop/search')}}" method="get">
                                        
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
                    <input type="text" class="form-control" name="search" placeholder="Search Text" value="{{$name}}">
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-3">
                   <input placeholder="Choose Parcel Drop Date" name="date" class="textbox-n form-control" value="{{$date}}" type="text" onfocus="(this.type='date')" value=""  id="date"> 
                  </div>
                
                  <div class="col-md-3 col-lg-3 col-sm-3">
                   <input name="filter" class="btn btn-primary" type="submit"  value="Filter" class="btn btn-primary"> 

                   <input name="print" type="submit" class="btn btn-success" value="Print"> 
                  </div>
              
                  </div>
                                    </form>
                                    <div class="table-responsive-sm">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Customer Name</th>
                                               <th>Product ID</th>
                                               <th>Product Name</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Total Amount</th>
                                                <th>Remark</th>
                                                <th>Drop Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($result))
                                            <?php  $i=1;
                                               $sum=0;
                                              $total=0; 
                                              $sum_total=0;
                                              $total_delivery=0;
                                              $total_product_charges=0;
                                              $total_delivery=0;
                                              $total_foc=0;

                                            ?>
                                            @foreach($result as $row)
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td>{{$row->r_name}}</td>
                                               <td>{{$row->product_id}}</td>
                                               <td>{{$row->product_name}},{{$row->product_type}}</td>
                                                <td>{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
                                                <td>{{$row->phone}}</td>
                                                <td>{{$row->price_per_item}}</td>
                                                <td>{{$row->quantity}}</td>
                                                <td>{{$row->price_per_item*$row->quantity}}</td>
                                                <td>{{$row->remark}}</td>
                                                
                                                <td><?php $date=$row->updated_at; 
                                                echo date("d/m/Y", strtotime($date));
                                                ?></td>
                                                <td>
                                                   
                                                        <div class="" aria-labelledby="dropdownMenuButton">
                                                            <div class="text-center"><a class="dropdown-item" data-toggle="modal" data-target="#exampleModalLong<?php echo $row->route_plan_id; ?>" href="#">Preview</a></div>
                                                          
                                                        </div>
                      
                                                </td>
                                                <?php $total=$row->price_per_item*$row->quantity;
                                                        $total_product_charges+=$total;
                                                        $sum=$row->extra_charges+$row->delivery_charges+$row->over_tender_charges-$row->foc;
                                                        $sum_total+=$sum+$total;
                                                        $total_delivery+=$row->extra_charges+$row->delivery_charges+$row->over_tender_charges;
                                              $total_foc+=$row->foc;
                                                 ?>
                                            </tr>
                                            @endforeach
                                            @elseif(isset($result_data))
                                              <?php $i=1;
                                               $sum=0;
                                              $total=0; 
                                              $sum_total=0;
                                              $total_delivery=0;
                                              $total_product_charges=0;
                                              $total_delivery=0;
                                              $total_foc=0;

                                               ?>
                                            @foreach($result_data as $row)
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td>{{$row->r_name}}</td>
                                               <td>{{$row->product_id}},{{$row->product_type}}</td>
                                               <td>{{$row->product_name}}</td>
                                                <td>{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
                                                <td>{{$row->phone}}</td>
                                                <td>{{$row->price_per_item}}</td>
                                                <td>{{$row->quantity}}</td>
                                                <td>{{$row->price_per_item*$row->quantity}}</td>
                                                <td>{{$row->remark}}</td>
                                              
                                                <td><?php $date=$row->updated_at; 
                                                echo date("d/m/Y", strtotime($date));
                                                ?></td>
                                                <td>
                                                   
                                                        <div class="" aria-labelledby="dropdownMenuButton">
                                                            <div class="text-center"><a class="dropdown-item" data-toggle="modal" data-target="#exampleModalLong<?php echo $row->route_plan_id; ?>" href="#">Preview</a></div>
                                                          
                                                        </div>
                      
                                                </td>
                                                 <?php $total=$row->price_per_item*$row->quantity;
                                                        $total_product_charges+=$total;
                                                        $sum=$row->extra_charges+$row->delivery_charges+$row->over_tender_charges-$row->foc;
                                                        $sum_total+=$sum+$total;
                                                        $total_delivery+=$row->extra_charges+$row->delivery_charges+$row->over_tender_charges;
                                              $total_foc+=$row->foc;
                                                 ?>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                
                                                 @if(isset($result_data))
                                                     <td colspan="3">Total  Charges </td>
                                                   <td style="color: black;font-weight: bold;"><?php echo $sum_total; ?></td>
                                               <td colspan="1"></td>
                                               <td>Total F.O.C </td>

                                                <td><?php echo $total_foc; ?></td>
                                                <td colspan="2">Total Delivery</td>
                                                <td><?php echo $total_delivery; ?></td>
                                                <td>Total Product Charges</td>
                                                <td><?php echo $total_product_charges; ?></td>

                                                  @else
                                                   <td colspan="3">Total  Charges </td>
                                                   <td style="color: black;font-weight: bold;"><?php echo $sum_total; ?></td>
                                               <td colspan="1"></td>
                                               <td>Total F.O.C </td>

                                                <td><?php echo $total_foc; ?></td>
                                                <td colspan="2">Total Delivery</td>
                                                <td><?php echo $total_delivery; ?></td>
                                                <td>Total Product Charges</td>
                                                <td><?php echo $total_product_charges; ?></td>

                                                 @endif
                                            </tr>
                                        </tfoot>
                                    </table>
                                  </div>
                                     @if(isset($result_data))
                  {{ $result_data->appends(Request::except('/admin/parcel/drop/search'))->setPath('/admin/parcel/drop/search') }}
                  @else
                  {{ $result->appends(Request::except('/admin/parcel/drop'))->setPath('/admin/parcel/drop') }}
                  @endif
                                </div>
                            </div>
                            <!-- END BASIC TABLE -->
</div>

</div>

<!-- Modal -->


<!-- Modal -->
@if(isset($result))
@foreach($result as $row)
<div class="modal fade" id="exampleModalLong<?php echo $row->route_plan_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <table class="table">
       
        <tr>
            <td>Product ID</td>
            <td>{{$row->product_id}}</td>
        </tr>
            <tr>
            <td>Product Name</td>
            <td>{{$row->product_name}}</td>
        </tr>
            <tr>
            <td>Quantity</td>
            <td>{{$row->quantity}}</td>
        </tr>
        <tr>
            <td>Price Per Item</td>
            <td>{{$row->price_per_item}}</td>
        </tr>
        <tr>
            <td>F.O.C / Discount</td>
            <td>{{$row->foc}}</td>
        </tr>
            <tr>
            <td>Total Amount</td>
            <td>{{$row->price_per_item*$row->quantity}}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
        </tr>
        <tr>
            <td>Delivery Name</td>
            <td>{{$row->user_name}}</td>
        </tr>
        
        <tr>
            <td>Route Status</td>
            <td>@if($row->status==2)
                <?php echo "Assign"; ?>
                @elseif($row->status=3)
                <?php echo "Drop"; ?>
                @else
                <?php echo "Return"; ?>
                @endif</td>
        </tr>
       
       
        <tr>
            <td>Extra Charge</td>
            <td>{{$row->extra_charges}}</td>
        </tr>
        <tr>
            <td>Over Charges</td>
            <td>{{$row->over_tender_charges}}</td>
        </tr>
            <tr>
            <td>Delivery Charges</td>
            <td>{{$row->delivery_charges}}</td>
        </tr>
        <tr>
            <td>Payment Status</td>
            <td>@if($row->paid_unpaid==0)
                <?php echo "Unpaid"; ?>
            @else
                <?php echo "Paid"; ?>
            @endif</td>
        </tr>
        <tr>
            <td>Registration Date</td>
            <td>{{$row->registration_date}}</td>
        </tr>
        <tr>
            <td>Target Date</td>
            <td>{{$row->target_date}}</td>
        </tr>
        <tfoot>
            <tr>
                <td><h4>Total Charges</h4></td>
                <?php $tot=$row->extra_charges+$row->over_tender_charges+$row->delivery_charges;
                     $p_price=$row->quantity*$row->price_per_item;
                     $net_payment=$p_price+$tot;
                 ?>
                <td><h4>{{$net_payment}}</h4></td>
            </tr>
        </tfoot>
       </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@elseif(isset($result_data))
@foreach($result_data as $row)
<div class="modal fade" id="exampleModalLong<?php echo $row->route_plan_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <table class="table">
       
        <tr>
            <td>Product ID</td>
            <td>{{$row->product_id}}</td>
        </tr>
            <tr>
            <td>Product Name</td>
            <td>{{$row->product_name}}</td>
        </tr>
            <tr>
            <td>Quantity</td>
            <td>{{$row->quantity}}</td>
        </tr>
        <tr>
            <td>Price Per Item</td>
            <td>{{$row->price_per_item}}</td>
        </tr>
         <tr>
            <td>F.O.C / Discount</td>
            <td>{{$row->foc}}</td>
        </tr>
            <tr>
            <td>Total Amount</td>
            <td>{{$row->price_per_item*$row->quantity}}</td>
        </tr>
        <tr>
            <td>Address</td>
           <td>{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
        </tr>
        <tr>
            <td>Delivery Name</td>
            <td>{{$row->user_name}}</td>
        </tr>
        
        <tr>
            <td>Route Status</td>
            <td>@if($row->status==2)
                <?php echo "Assign"; ?>
                @elseif($row->status=3)
                <?php echo "Drop"; ?>
                @else
                <?php echo "Return"; ?>
                @endif</td>
        </tr>
       
       
        <tr>
            <td>Extra Charge</td>
            <td>{{$row->extra_charges}}</td>
        </tr>
        <tr>
            <td>Over Charges</td>
            <td>{{$row->over_tender_charges}}</td>
        </tr>
            <tr>
            <td>Delivery Charges</td>
            <td>{{$row->delivery_charges}}</td>
        </tr>
        <tr>
            <td>Payment Status</td>
            <td>@if($row->paid_unpaid==0)
                <?php echo "Unpaid"; ?>
            @else
                <?php echo "Paid"; ?>
            @endif</td>
        </tr>
        <tr>
            <td>Registration Date</td>
            <td>{{$row->registration_date}}</td>
        </tr>
        <tr>
            <td>Target Date</td>
            <td>{{$row->target_date}}</td>
        </tr>
        <tfoot>
            <tr>
                <td><h4>Total Charges</h4></td>
                <?php $tot=$row->extra_charges+$row->over_tender_charges+$row->delivery_charges;
                     $p_price=$row->quantity*$row->price_per_item;
                     $net_payment=$p_price+$tot;
                 ?>
                <td><h4>{{$net_payment}}</h4></td>
            </tr>
        </tfoot>
       </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@endif
@endsection
