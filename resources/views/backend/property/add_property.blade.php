@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

			<div class="page-content">
        <div class="row profile-body">
          <!-- middle wrapper start -->
          <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Add Property</h6>
                    <form method="POST" action="{{ route('store.property') }}" id="myForm" enctype="multipart/form-data">
                      @csrf


                      {{-- 1ST ROW --}}
                      <div class="row">

                          <div class="col-sm-4">
                            <div class="form-group mb-3">
                              <label class="form-label">Property Name</label>
                              <input type="text" name="property_name" class="form-control">
                            </div>
                          </div><!-- Col -->

                          <div class="col-sm-4">
                            <div class="form-group mb-3">
                              <label class="form-label">Property Size</label>
                              <input type="text" name="property_size" class="form-control">
                            </div>
                          </div><!-- Col -->

                          <div class="col-sm-4">
                            <div class="form-group mb-3">
                              <label for="exampleFormControlSelect1" class="form-label">Property Status</label>
                              <select name="property_status" class="form-select" id="">
                                <option selected="" disabled="">Select your status</option>
                                <option value="rent">For Rent</option>
                                <option value="buy">For Buy</option>
                              </select>
                            </div>
                          </div><!-- Col -->

                      </div><!-- END FIRST ROW -->

                      {{-- 2ND ROW --}}
                      <div class="row">

                        <div class="col-sm-6">
                          <div class="form-group mb-3">
                            <label class="form-label">Lowest Price</label>
                            <input type="text" name="lowest_price" class="form-control">
                          </div>
                        </div><!-- Col -->


                        <div class="col-sm-6">
                          <div class="form-group mb-3">
                            <label class="form-label">Maximum Price</label>
                            <input type="text" name="max_price" class="form-control">
                          </div>
                        </div><!-- Col -->

                      </div><!-- END ROW -->
                      
                      {{-- 3RD ROW --}}
                      <div class="row">

                        <div class="col-sm-4">
                          <div class="mb-3">
                            <label class="form-label">Main Thumbnail</label>
                            <input type="file" name="property_thumbnail" 
                            class="form-control" onchange="mainThumbUrl(this)">

                            <img src="" id="mainThumb">

                          </div>
                        </div><!-- Col -->


                        <div class="col-sm-4">
                          <div class="form-group mb-3">
                            <label class="form-label">Multiple Image</label>
                            <input type="file" name="multi_img[]" class="form-control" id="multiImg" multiple="">
                          </div>
                          <div class="row" id="preview_img"> </div>
                        </div><!-- Col -->


                        <div class="col-sm-4">
                          <div class="form-group mb-3">
                            <label class="form-label">Property Video</label>
                            <input type="text" class="form-control" name="property_video">
                          </div>
                        </div><!-- Col -->


                      </div><!-- END ROW -->
                      

                      {{-- 4TH ROW --}}
                      <div class="row">
                        
                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">Bedroom</label>
                              <input type="number" class="form-control" name="bedrooms">
                            </div>
                          </div><!-- Col -->


                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">Bathroom</label>
                              <input type="text" class="form-control" name="bathrooms">
                            </div>
                          </div><!-- Col -->

                          
                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">Garage</label>
                              <input type="text" class="form-control" name="garage">
                            </div>
                          </div><!-- Col -->
                      

                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">Garage Size</label>
                              <input type="text" class="form-control" name="garage_size">
                            </div>
                          </div><!-- Col -->

                      </div><!-- END ROW -->

                      {{-- 5TH ROW --}}
                      <div class="row" style="display: flex; justify-content: space-between">
                          
                        <div class="col-sm-2">
                          <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address">
                          </div>
                        </div><!-- Col -->


                        <div class="col-sm-2">
                          <div class="mb-3">
                            <label class="form-label">Neighborhood</label>
                            <input type="text" class="form-control" name="neighborhood">
                          </div>
                        </div><!-- Col -->


                        <div class="col-sm-2">
                          <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" name="city">
                          </div>
                        </div><!-- Col -->

                        
                        <div class="col-sm-2">
                          <div class="mb-3">
                            <label class="form-label">State</label>
                            <select name="state" class="form-select" id="exampleFormControlSelect1">
                              <option selected="" disabled="">Select State</option>
                              @foreach($pstate as $state)
                                <option value="{{ $state->id }}">{{ $state->state_name }}</option>
                              @endforeach
                          </select>
                          </div>
                        </div><!-- Col -->
                    

                        <div class="col-sm-2">
                          <div class="mb-3">
                            <label class="form-label">Postal Code</label>
                            <input type="text" class="form-control" name="postal_code">
                          </div>
                        </div><!-- Col -->

                      </div><!-- END ROW -->
                    
                      {{-- 6TH ROW --}}
                      <div class="row">

                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="text" class="form-control" name="latitude">
                            </div>
                        </div>


                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="text" class="form-control" name="longitude">
                          </div>
                        </div><!-- Col -->

                      </div>{{-- END ROW --}}
                    
                      {{-- 7TH ROW --}}
                      <div class="row" style="text-align: center;">
                        <div class="mb-3">
                          <div class="col-sm-12">
                            <a href="https://www.latlong.net/" target="_blank">Click Here to get Latitude and Longitude coordinate from address</a>
                          </div>  
                        </div>
                      </div>{{-- END ROW --}}                    

                      {{-- 8TH ROW --}}
                      <div class="row">
                        
                        <div class="col-sm-4">
                          <div class="form-group mb-3">
                            <label class="form-label">Property Type</label>
                            <select name="propertyType_id" class="form-select" id="">
                            <option selected="" disabled="">Select Type</option>
                            @foreach ( $propertytype as $ptype )
                            
                            <option value="{{ $ptype->id }}">{{ $ptype->type_name }}</option>
                              
                            @endforeach
                          </select>
                          </div>
                        </div>


                        <div class="col-sm-4">
                          <div class="mb-3">
                            <label class="form-label">Property Amenities</label>
                            <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">
                              @foreach ( $amenities as $ameni )
                              
                              <option value="{{ $ameni->amenities_name }}">{{ $ameni->amenities_name }}</option>
                                
                              @endforeach
                              
                              
                            </select>
                          </div>
                        </div>


                        <div class="col-sm-4">
                          <div class="mb-3">
                            <label class="form-label">Agent</label>
                            <select name="agent_id" class="form-select" id="">
                            <option selected="" disabled="">Select Agent</option>
                            @foreach ( $activeAgent as $agent )
                              <option value="{{ $agent->id }}">{{ $agent->name }}</option>            
                            @endforeach
                          </select>
                          </div>
                        </div>

                      </div>{{-- END ROW --}}

                      {{-- 9TH ROW --}}
                      <div class="row">

                        <div class="col-sm-12">
                          <div class="mb-3">
                            <label class="form-label">Short Description</label>
                            <textarea type="text" name="short_description" class="form-control" name="short_description" rows="3"></textarea>
                            </div>
                          </div>

                      </div>{{-- END ROW --}}

                      {{-- 10TH ROW --}}
                      <div class="row">

                        <div class="col-sm-12">
                          <div class="mb-3">
                            <label class="form-label">Long Description</label>
                            <textarea class="form-control" name="long_description" name="tinymce" id="tinymceExample" rows="10"></textarea>
                          </div>
                        </div>

                      </div>{{-- END ROW --}}

                      {{-- 11TH ROW --}}
                      <div class="row">

                        <div class="mb-3">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" name="featured" value="1" class="form-check-input" id="checkInline1">
                            <label class="form-check-label" for="checkInline1">
                              Featured Property
                            </label>
                          </div>


                          <div class="form-check form-check-inline">
                            <input type="checkbox" name="hot" value="1" class="form-check-input" id="checkInlineChecked">
                            <label class="form-check-label" for="checkInlineChecked">
                              Checked
                            </label>
                          </div>
                        </div>
                      </div>{{-- END ROW --}}

                      {{-- 12TH ROW --}}
                      {{-- FACILITY OPTION --}}
                      <div class="row add_item">

                          <div class="col-md-4">
                                <div class="mb-3">
                                      <label for="facility_name" class="form-label">Facilities </label>
                                      <select name="facility_name[]" id="facility_name" class="form-control">
                                            <option value="">Select Facility</option>
                                            <option value="Hospital">Hospital</option>
                                            <option value="SuperMarket">Super Market</option>
                                            <option value="School">School</option>
                                            <option value="Entertainment">Entertainment</option>
                                            <option value="Pharmacy">Pharmacy</option>
                                            <option value="Airport">Airport</option>
                                            <option value="Railways">Railways</option>
                                            <option value="Bus Stop">Bus Stop</option>
                                            <option value="Beach">Beach</option>
                                            <option value="Mall">Mall</option>
                                            <option value="Bank">Bank</option>
                                      </select>
                                </div>
                          </div>


                          <div class="col-md-4">
                                <div class="mb-3">
                                      <label for="distance" class="form-label"> Distance </label>
                                      <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                                </div>
                          </div>


                          <div class="form-group col-md-4" style="padding-top: 27px;">
                                <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
                          </div>
                        
                      </div> <!---end row-->


                    <button type="submit" class="btn btn-primary submit">Add</button>
                
                    </form>
                    </div>
              </div>
            </div>
          </div>
        </div>
			</div>

      <!--========== Start of add multiple class with ajax ==============-->
  <div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
      <div class="whole_extra_item_delete" id="whole_extra_item_delete">
          <div class="container mt-2">
            <div class="row">
            
                <div class="form-group col-md-4">
                  <label for="facility_name">Facilities</label>
                  <select name="facility_name[]" id="facility_name" class="form-control">
                        <option value="">Select Facility</option>
                        <option value="Hospital">Hospital</option>
                        <option value="SuperMarket">Super Market</option>
                        <option value="School">School</option>
                        <option value="Entertainment">Entertainment</option>
                        <option value="Pharmacy">Pharmacy</option>
                        <option value="Airport">Airport</option>
                        <option value="Railways">Railways</option>
                        <option value="Bus Stop">Bus Stop</option>
                        <option value="Beach">Beach</option>
                        <option value="Mall">Mall</option>
                        <option value="Bank">Bank</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="distance">Distance</label>
                      <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                </div>
                <div class="form-group col-md-4" style="padding-top: 20px">
                  <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                  <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>      



            <!----For Section-------->
  <script type="text/javascript">
    $(document).ready(function(){
      var counter = 0;
      $(document).on("click",".addeventmore",function(){
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
      });
      $(document).on("click",".removeeventmore",function(event){
            $(this).closest("#whole_extra_item_delete").remove();
            counter -= 1
      });
    });
  </script>
  <!--========== End of add multiple class with ajax ==============-->




      <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    property_name: {
                        required : true,
                    }, 
                    property_status: {
                        required : true,
                    }, 
                    property_size: {
                        required : true,
                    }, 
                    lowest_price: {
                        required : true,
                    }, 
                    max_price: {
                        required : true,
                    }, 
                    property_thumbnail: {
                        required : true,
                    }, 
                    property_video: {
                      required : true,
                    }, 
                    propertyType_id: {
                        required : true,
                    }, 
                    
                },
                messages :{
                    property_name: {
                        required : 'Please Enter Property Name',
                    }, 
                    property_status: {
                        required : 'Please Select Property Status',
                    }, 
                    property_size: {
                        required : 'Please enter your property size',
                    }, 
                    lowest_price: {
                        required : 'Please enter your lowest price',
                    }, 
                    max_price: {
                        required : 'Please enter your maximum price',
                    }, 
                    property_thumbnail: {
                        required : 'Please select your thumbnail',
                    }, 
                    property_video: {
                        required : 'Please select your property video',
                    }, 
                    propertyType_id: {
                        required : 'Please select your property type',
                    }, 
                },
                errorElement : 'span', 
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
        
    </script>


    <script type="text/javascript">
      function mainThumbUrl(input){
        if(input.files && input.files[0]){
          var reader = new FileReader();
          reader.onload = function(e){
            $('#mainThumb').attr('src',e.target.result).width(80).height(80); 
          };
          reader.readAsDataURL(input.files[0]);
          
        }
      }
    </script>


    <script> 
    
      $(document).ready(function(){
      $('#multiImg').on('change', function(){ //on file input change
          if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
          {
              var data = $(this)[0].files; //this file data
              
              $.each(data, function(index, file){ //loop though each file
                  if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                      var fRead = new FileReader(); //new filereader
                      fRead.onload = (function(file){ //trigger function on successful read
                      return function(e) {
                          var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                      .height(80); //create image element 
                          $('#preview_img').append(img); //append image to output element
                      };
                      })(file);
                      fRead.readAsDataURL(file); //URL representing the file's data.
                  }
              });
              
          }else{
              alert("Your browser doesn't support File API!"); //if File API is absent
          }
      });
      });
      
    </script>

@endsection