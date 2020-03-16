@extends("layouts.tables")
@section('content')
     <div class="panel">
  
      <div class="panel-body">
 
  <!-- Start Body -->
   <div style="margin-top: 1%;">
            <div class="row field_wrapper" id="field_wrapper">
              <form action="{{URL::to('order/list/search')}}" method="get">
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
                    <input type="text" name="name" placeholder="Search" class="form-control" value="{{$name}}">                   
                  </div>  
                  <div class="col-sm-3 col-md-3 col-log-3">
                    <select class="form-control" name="status">
                      @if($status==0)
                      <option value="0">Pending</option>
                      @elseif($status==2)
                      <option value="2">Reject</option>
                      @elseif($status==1)
                      <option value="1">Verify</option>
                      @elseif($status==3)
                     <option value="3">Still Edit</option>
                      @endif
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
                    @if(isset($result))
                    <?php $i=1; ?>
                    @foreach($result as $row)
                    <?php 
                          $user_id=Auth::user()->id;
                      $oid=$row->o_id;
                      $o_id=DB::select("SELECT * FROM order_table where o_id='$oid' AND user_id='$user_id'"); 
                      ?>
                      @foreach($o_id as $row)
                   <tr>
                    <td><label><?php echo $i++; ?></label></td>
                    <td><label>{{$row->o_id}}</label></td>
                    <td>  {{$row->o_description}}</td>
                    <td><label><?php $date=$row->o_register_date; 
                              $dates=strtotime($date);
                              echo date('d/m/Y',$dates);
                    ?></label></td>
                    <td><label>{{$row->o_amount_total}}</label></td>
                    <td>@if($row->status==0)
                        <label><?php echo "Pending"; ?></label>
                                @elseif($row->status==1)
                        <label><?php echo "Verified"; ?></label>
                                @elseif($row->status==2)
                                <label><?php echo "Rejected"; ?></label>
                                @elseif($row->status==3)
                                <label><?php echo "Still Edit"; ?></label>

                                @endif
                    </td>

                    <td> 
                      @if($row->status==3)
                       <a href="{{URL::to('order/edit/'.$row->id.'/'.$row->o_id)}}" class="btn btn-primary btn-sm"><span class="lnr lnr-pencil"></span> </a>
                      @endif
                      @if($row->status==0)
                        <a href="{{URL::to('order/edit/'.$row->id.'/'.$row->o_id)}}" class="btn btn-primary btn-sm"><span class="lnr lnr-pencil"></span> </a>
                      @else
                      @endif
                      @if($row->status==1)
                   
                    @else
                     <a href="{{URL::to('order/delete/'.$row->id.'/'.$row->o_id)}}" class="btn btn-danger btn-sm"><span class="lnr lnr-trash"></span> </a>
                    @endif
                    </td>
                    <td> <a href="{{URL::to('order/preview/'.$row->id.'/'.$row->o_id)}}" class="btn btn-danger btn-sm">Preview</a></td>
                  </tr>
                  @endforeach
                  
                  @endforeach
                  @else
                  <?php $i=1; ?>
                    @foreach($select_data as $row)
                    <?php 
                          $user_id=Auth::user()->id;
                      $oid=$row->o_id;
                      $o_id=DB::select("SELECT * FROM order_table where o_id='$oid' AND user_id='$user_id'"); 
                      ?>
                      @foreach($o_id as $row)
                   <tr>
                    <td><label><?php echo $i++; ?></label></td>
                    <td><label>{{$row->o_id}}</label></td>
                    <td>  {{$row->o_description}}</td>
                    <td><label><?php $date=$row->o_register_date; 
                              $dates=strtotime($date);
                              echo date('d/m/Y',$dates);
                    ?></label></td>
                    <td><label>{{$row->o_amount_total}}</label></td>
                    <td>@if($row->status==0)
                        <label><?php echo "Pending"; ?></label>
                                @elseif($row->status==1)
                        <label><?php echo "Verified"; ?></label>
                                @elseif($row->status==2)
                                <label><?php echo "Rejected"; ?></label>
                                @elseif($row->status==3)
                                <label><?php echo "Still Edit"; ?></label>

                                @endif
                    </td>

                    <td> 
                      @if($row->status==3)
                       <a href="{{URL::to('order/edit/'.$row->id.'/'.$row->o_id)}}" class="btn btn-primary btn-sm"><span class="lnr lnr-pencil"></span> </a>
                      @endif
                      @if($row->status==0)
                        <a href="{{URL::to('order/edit/'.$row->id.'/'.$row->o_id)}}" class="btn btn-primary btn-sm"><span class="lnr lnr-pencil"></span> </a>
                      @else
                      @endif
                      @if($row->status==1)
                   
                    @else
                     <a href="{{URL::to('order/delete/'.$row->id.'/'.$row->o_id)}}" class="btn btn-danger btn-sm"><span class="lnr lnr-trash"></span> </a>
                    @endif
                    </td>
                    <td> <a href="{{URL::to('order/preview/'.$row->id.'/'.$row->o_id)}}" class="btn btn-danger btn-sm">Preview</a></td>
                  </tr>
                  @endforeach
                  
                  @endforeach
                  @endif

                  </tbody>
                </thead>
              </table>
              @if(isset($result))
             {{ $result->appends(Request::except('/order/list'))->setPath('/order/list') }}
             @else
             {{ $select_data->appends(Request::except('/order/list/search'))->setPath('/order/list/search') }}
             @endif
            </div>

                </div>
                
              </div>

      </div>
      </form>
     </div>

@endsection