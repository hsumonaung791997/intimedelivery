@extends('layouts.admin')
@section('content')

<div class="row">

			<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Contact Issue</h3>
								</div>
								<div class="panel-body">
									<form action="{{URL::to('admin/contact/issue/search')}}" method="get">
                                        
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
                             @if(isset($is_type))
                               @foreach($is_type as $it)
                               <option value="{{$it->id}}">{{$it->name}}</option>
                               @endforeach
                          @endif
                    	<?php $issue=DB::select("SELECT * FROM issue"); ?>
                    	<option value=>All</option>
                    	@foreach($issue as $iss)
                    	<option value="{{$iss->id}}">{{$iss->name}}</option>
                    	@endforeach
                    </select>
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-3">
                   <input placeholder="Choose Issue Date" name="date" class="textbox-n form-control" value="{{$date}}" type="text" onfocus="(this.type='date')" value=""  id="date"> 
                  </div>
                
                  <div class="col-md-3 col-lg-3 col-sm-3">
                   <input name="filter" class="btn btn-primary" type="submit"  value="Filter" class="btn btn-primary"> 

                   <input name="print" type="submit" class="btn btn-success" value="Print"> 
                  </div>
              
                  </div>
                                    </form>
									<div class="row">
							
									<div class="tabele-responsive">	
										<!-- <a href="{{URL::to('admin/contact/issue/export')}}" class="btn btn-danger btn-sm">Export</a> -->
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
											@if(isset($result))
											@foreach($result as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->r_name}}</td>
												<td>{{$row->phone}}</td>
												<td>{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
												<td>{{$row->p_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->product_type}}</td>
												<td>{{$row->quantity}}</td>
												<td>{{$row->amount}}</td>
												<td>{{$row->target_date}}</td>
												<td><?php $date=$row->reg_date;
												echo date("Y-m-d",strtotime($date));
												 ?></td>
												<td>{{$row->remark}}</td>
												<td>{{$row->name}}</td>
												<td><a href="{{URL::to('admin/delete/route/plan/'.$row->rp_id)}}" class="btn btn-danger btn-sm">Delete</a></td>
											</tr>
											@endforeach
											@endif
											@if(isset($res))
											@foreach($res as $row)
											<tr>
												<td><?php echo $i++; ?></td>
												<td>{{$row->r_name}}</td>
												<td>{{$row->phone}}</td>
												<td>{{$row->address}},{{$row->t_name}},{{$row->s_name}}</td>
												<td>{{$row->p_id}}</td>
												<td>{{$row->product_name}}</td>
												<td>{{$row->product_type}}</td>
												<td>{{$row->quantity}}</td>
												<td>{{$row->amount}}</td>
												<td>{{$row->target_date}}</td>
												<td><?php $date=$row->reg_date;
												echo date("Y-m-d",strtotime($date));
												 ?></td>
												<td>{{$row->remark}}</td>
												<td>{{$row->name}}</td>
												<td><a href="{{URL::to('admin/delete/route/plan/'.$row->rp_id)}}" class="btn btn-danger btn-sm">Delete</a></td>
											</tr>
											@endforeach
											@endif
										</tbody>
									</table>
									@if(isset($result))
									 {{ $result->appends(Request::except('/admin/contact/issue'))->setPath('/admin/contact/issue') }}
									 @endif
									</div>
								</div>
							</div>
							<!-- END BASIC TABLE -->
			</div>
</div>

@endsection
