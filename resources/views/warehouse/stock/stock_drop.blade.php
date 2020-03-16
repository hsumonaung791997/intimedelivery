@extends("layouts.admin")
@section('content')

<div class="row">

<div class="col-md-12">
                            <!-- BASIC TABLE -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Parcel Drop List</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                               <th>Product ID</th>
                                               <th>Product Name</th>
                                                <th>Route</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Total Amount</th>
                                                <th>Drop Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach($result as $row)
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                               <td>{{$row->product_id}}</td>
                                               <td>{{$row->product_name}}</td>
                                                <td>{{$row->township}},{{$row->address}}</td>
                                                <td>{{$row->price_per_item}}</td>
                                                <td>{{$row->quantity}}</td>
                                                <td>{{$row->price_per_item*$row->quantity}}</td>
                                              
                                                <td><?php $date=$row->updated_at; 
                                                echo date("d/m/Y", strtotime($date));
                                                ?></td>
                                                <td>
                                                   
                                                        <div class="" aria-labelledby="dropdownMenuButton">
                                                            <div class="text-center"><a class="dropdown-item" data-toggle="modal" data-target="#exampleModalLong<?php echo $row->route_plan_id; ?>" href="#">Preview</a></div>
                                                          
                                                        </div>
                      
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END BASIC TABLE -->
</div>

</div>

<!-- Modal -->


<!-- Modal -->
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
            <td>Total Amount</td>
            <td>{{$row->price_per_item*$row->quantity}}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{$row->division}},{{$row->township}},{{$row->address}}</td>
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
@endsection
