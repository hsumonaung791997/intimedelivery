@extends('layouts.admin')
@section('content')

 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
<div class="col-sm-12 col-lg-12 col-md-12">
	<div class="panel">
		
			<h4 class="panel-heading">Maps</h4>
			<div class="row">
					<div class="panel-body">
						<div class="form-group">
							<form action="{{URL::to('admin/map/search')}}" method="get">
							<div class="col-md-3 col-lg-3 col-sm-3">
								<?php $postman=DB::select("SELECT * FROM delivery_postman where role_id=0"); ?>
								<select class="form-control" name="postman_id" required>
									<?php if(isset($_GET['postman_id'])){
										$postman_id=$_GET['postman_id'];
										$postmanid=DB::select("SELECT * FROM delivery_postman where id='$postman_id' AND role_id=0");
										?>
										<option value="<?php $postmanid[0]->id; ?>" ><?php echo $postmanid[0]->user_name; ?></option>
										<?php 
									} ?>
									@foreach($postman as $pos)
									<option value="{{$pos->id}}">{{$pos->user_name}}</option>
									@endforeach
								</select>
							</div>
							<input type="submit" name="submit" class="btn btn-default btn-sm">
							</form>
						</div>
					</div>
					
				</div>
			<div class="panel-body">
				
				<div class="col-sm-12 col-lg-12 col-md-12" id="map" style="height: 800px;">
					
				</div>
			</div>
	</div>
</div>


 @if(isset($result))
 <script src='https://api.mapbox.com/mapbox.js/v3.2.0/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v3.2.0/mapbox.css' rel='stylesheet' />
<script>
L.mapbox.accessToken = 'pk.eyJ1IjoiY2hpdGthdW5nMTk5MyIsImEiOiJjamo5aTQ1NWIwMm1zM3BwOWV0c3o3c3V6In0.ct70rpOEdf2fpCXAreI3GA';
    var map = L.mapbox.map('map')
      .setView([16.8988891,96.1453468], 12)
      .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));

<?php foreach($result as $loc){ ?>
    L.marker([  <?php echo $loc->lat ?>, <?php echo $loc->lon ?>]).bindTooltip('{{$loc->user_name}}',{permanent:true,opacity:10}).addTo(map);
   <?php };?>
</script>
@endif
@if(!isset($result))
<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet-src.js"></script>
<script src="{{URL::to('/dist/leaflet-realtime.js')}}"></script>
</body>
</html>
<script type="text/javascript">
    var map = L.map('map').setView([16.734,96.036], 5);
    realtime = L.realtime('http://159.65.137.232/realtime/map/{{ Request::get('postman_id') }}', {
        interval: 3 * 1000
    }).addTo(map);

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

realtime.on('update', function() {
    map.fitBounds(realtime.getBounds(), {maxZoom: 11});
});
</script>
@endif
@endsection