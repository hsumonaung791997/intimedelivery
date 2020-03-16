@extends("layouts.tables")
@section('content')
          <div class="panel panel-headline">
            <div class="panel-heading">
              <h3 class="panel-title">Product Register</h3>
            </div>
            <div class="panel-body"  >
               <div class="col-md-12 col-sm-12 col-lg-12 mb-4">
                <div class="row">
                  <div class="form-inline d-flex justify-content-between">
                    <div class="col-sm-4 col-lg-4 col-md-4 pull-left">
  <button type="submit" class="btn btn-primary mb-2 add_button">Add</button>
  </div>
  <div class="form-group mx-sm-3 col-sm-4 col-lg-4 col-md-4 mb-2 pull-right">
    <label for="inputPassword2" class="sr-only">Password</label>
    <input type="text" class="form-control" id="inputPassword2" placeholder="Voucher Number">
     <input type="submit" class="form-control" id="inputPassword2" value="save">
  </div>

</div>
                  </div>  
                  </div>
              <form>
                <div class="row field_wrapper" id="field_wrapper">
                  <div>
              
              <div class="col-sm-2 col-lg-2 col-md-2">
                
              
                      <label>Product ID</label>
                      
                  </div>
              <div class="col-sm-2 col-lg-2 col-md-2">
                
              
                     <label>Product Name</label>
                      
              </div>
              <div class="col-sm-2 col-lg-2 col-md-2">
                
              
                      <label>Product Size</label>
                     
      
              </div>
              <div class="col-sm-2 col-lg-2 col-md-2">
                
              
                     
                      <label>Product Type</label>
                  
            
      
              </div>
                          <div class="col-sm-2 col-lg-2 col-md-2">
                
              
                     
                      <label>Product Vendor Name</label>
                  
            
      
              </div>
              <div class="col-sm-2 col-lg-2 col-md-2">
                  <label>Action</label>
              </div>
            </div>

                 
                </div>
                
              </form>
              
            </div>

          </div>
            <script src="{{URL::to('assets/vendor/jquery/jquery.min.js')}}"></script>
          <script type="text/javascript">
$(document).ready(function(){
    var maxField = 20; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div style="margin-top: 10px;"><div class="col-sm-2 col-lg-2 col-md-2" id="fuck"><input type="text" name="field_name[]" class="form-control" value=""/></div><div class="col-sm-2 col-lg-2 col-md-2" id="fuck"><input type="text" name="field_name[]" class="form-control" value=""/></div><div class="col-sm-2 col-lg-2 col-md-2"><input type="text" name="field_name[]" class="form-control" value=""/></div><div class="col-sm-2 col-lg-2 col-md-2"><input type="text" name="field_name[]" class="form-control" value=""/></div><div class="col-sm-2 col-lg-2 col-md-2"><input type="text" name="field_name[]" class="form-control" value=""/></div><a href="#" class="btn btn-danger remove_button">Sub</a></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
@endsection