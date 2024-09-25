<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Amenities;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use App\Models\PackagePlan;
use Barryvdh\DomPDF\Facade\Pdf;


class PropertyController extends Controller
{
    public function AllProperty(){
        $property = Property::latest()->get();
        return view("backend.property.all_property",compact("property"));

    }//End Method

    public function AddProperty(){

        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status', 'active')->
            where('role', 'agent')->latest()->get();

        return view("backend.property.add_property",compact('propertytype','amenities','activeAgent'));

    }//End Method

    public function StoreProperty(Request $request){

        $amen = $request->amenities_id;
        $amenities = implode(",", $amen);
        // dd($amen);

        $pcode = IdGenerator::generate(['table' => 'properties','field' => 'property_code','length' => 5,'prefix' => 'PC']);

        $image = $request->file('property_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,250)->save('upload/property/thumbnail/'.$name_gen);
        $save_url = 'upload/property/thumbnail/'.$name_gen;

        $property_id = Property::insertGetId([
            'propertyType_id'=> $request->propertyType_id,
            'amenities_id'=> $amenities,
            'property_name'=> $request->property_name,
            'property_slug'=> strtolower(str_replace(' ','-',$request->property_name)),
            'property_code'=> $pcode,
            'property_size' => $request->property_size,
            'property_status'=> $request->property_status,

            'property_thumbnail'=> $save_url,
            'property_video'=> $request->property_video,

            'lowest_price'=> $request->lowest_price,
            'max_price'=> $request->max_price,
            
            'bedrooms'=> $request->bedrooms,
            'bathrooms'=> $request->bathrooms,
            'garage'=> $request->garage,
            'garage_size'=> $request->garage_size,

            'address'=> $request->address,
            'neighborhood'=> $request->neighborhood,
            'city'=> $request->city,
            'state'=> $request->state,
            'postal_code'=> $request->postal_code,

            'latitude'=> $request->latitude,
            'longitude'=> $request->longitude,

            'agent_id'=> $request->agent_id,
            
            'short_description'=> $request->short_description,
            'long_description'=> $request->long_description,

            'featured'=> $request->featured,
            'hot'=> $request->hot,

            'status'=>1,
            'created_at'=>Carbon::now(),


        ]) ;

        /// Multiple Image Upload From Here ////

        $images = $request->file('multi_img');
        foreach($images as $img){

        $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(770,520)->save('upload/property/multi-image/'.$make_name);
        $uploadPath = 'upload/property/multi-image/'.$make_name;

        MultiImage::insert([

            'property_id' => $property_id,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(), 

        ]); 
        } // End Foreach

         /// Facilities Add From Here ////

        $facilities = Count($request->facility_name);

        if ($facilities != NULL) {
            for ($i=0; $i < $facilities; $i++) { 
                $fcount = new Facility();
                $fcount->property_id = $property_id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->distance = $request->distance[$i];
                $fcount->save();
        }
        }

         /// End Facilities  ////


            $notification = array(
            'message' => 'Property Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.property')->with($notification);


         /// End Multiple Image Upload From Here ////

    }//End Method

    public function EditProperty($id){

        $facilities = Facility::where('property_id',$id)->get();
        $property = Property::findOrFail($id);
        
        $type = $property->amenities_id;
        $property_amenities = explode(",", $type);

        $multiImage = MultiImage::where('property_id',$id)->get();
        
        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();

        return view('backend.property.edit_property',compact('property','propertytype','amenities',
        'activeAgent','property_amenities','multiImage','facilities'));

    }// End Method 

    public function UpdateProperty(Request $request){

        $amen = $request->amenities_id;
        $amenities = implode(",", $amen);
        // dd($amen);

        $property_id = $request->id;

        Property::findOrFail($property_id)->update([

            'propertyType_id' => $request->propertyType_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)), 
            'property_size' => $request->property_size,
            'property_status' => $request->property_status,

            'property_video' => $request->property_video,
            
            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,
            
            'address' => $request->address,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            
            'agent_id' => $request->agent_id, 
            
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            
            'featured' => $request->featured,
            'hot' => $request->hot,
            
            'updated_at' => Carbon::now(), 

        ]);

        $notification = array(
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.property')->with($notification); 

    }// End Method 

    public function UpdatePropertyThumbnail(Request $request){

        $pro_id = $request->id;
        $oldImage = $request->old_img;

        

        $image = $request->file('property_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,250)->save('upload/property/thumbnail/'.$name_gen);
        $save_url = 'upload/property/thumbnail/'.$name_gen;

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        Property::findOrFail($pro_id)->update([

            'property_thumbnail' => $save_url,
            'updated_at' => Carbon::now(), 
        ]);

        $notification = array(
            'message' => 'Property Image Thumbnail Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 

    public function UpdatePropertyMultiimage(Request $request)
    {
        // Retrieve the uploaded multi-images
        $multiImages = $request->file('multi_img');

        // Check if $multiImages is empty
        if (empty($multiImages)) {
            // Image is empty or not provided, return with error message
            $notification = [
                'message' => 'Image cannot be empty',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

        $imgs = $request->multi_img;

        // Iterate over each element in the $imgs array
        foreach ($imgs as $id => $img) {
            // Find the multi-image record by ID
            $imgDel = MultiImage::findOrFail($id);
            
            // Delete the old image file
            unlink($imgDel->photo_name);

            // Generate a unique filename for the image
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();

            // Resize and save the new image
            Image::make($img)->resize(770, 520)->save('upload/property/multi-image/' . $make_name);

            // Define the upload path for the new image
            $uploadPath = 'upload/property/multi-image/' . $make_name;

            // Update the multi-image record with the new image path and timestamp
            MultiImage::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        }

        // Set the success notification
        $notification = [
            'message' => 'Property Multi Image Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }// End Method 

    public function PropertyMultiImageDelete($id){

        $oldImg = MultiImage::findOrFail($id);
        unlink($oldImg->photo_name);

        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Property Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 

    public function StoreNewMultiimage(Request $request){

    // Check if the request has a file named 'multi_img'
    if (!$request->hasFile('multi_img')) {
    // Set the error notification for missing image
        $notification = [
            'message' => 'Image cannot be empty',
            'alert-type' => 'error'
        ];

        // Redirect back with the error notification
        return redirect()->back()->with($notification);
    }

        $new_multi = $request->imageid;
        $image = $request->file('multi_img');

    $make_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    Image::make($image)->resize(770,520)->save('upload/property/multi-image/'.$make_name);
        $uploadPath = 'upload/property/multi-image/'.$make_name;

        MultiImage::insert([
            'property_id' => $new_multi,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(), 
        ]);

    $notification = array(
            'message' => 'Property Multi Image Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }// End Method 

    public function UpdatePropertyFacilities(Request $request){

        $pid = $request->id;

        if ($request->facility_name == NULL) {
        return redirect()->back();
        }else{
            Facility::where('property_id',$pid)->delete();

        $facilities = Count($request->facility_name); 

        for ($i=0; $i < $facilities; $i++) { 
            $fcount = new Facility();
            $fcount->property_id = $pid;
            $fcount->facility_name = $request->facility_name[$i];
            $fcount->distance = $request->distance[$i];
            $fcount->save();
        } // end for 
        }

        $notification = array(
            'message' => 'Property Facility Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 

    public function DeleteProperty($id){

        $property = Property::findOrFail($id);
        unlink($property->property_thumbnail);

        Property::findOrFail($id)->delete();

        $image = MultiImage::where('property_id',$id)->get();

        foreach($image as $img){
            unlink($img->photo_name);
            MultiImage::where('property_id',$id)->delete();
        }

        $facilitiesData = Facility::where('property_id',$id)->get();
        foreach($facilitiesData as $item){
            $item->facility_name;
            Facility::where('property_id',$id)->delete();
        }


        $notification = array(
            'message' => 'Property Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method  

    public function DetailsProperty($id){

        $facilities = Facility::where('property_id',$id)->get();
        $property = Property::findOrFail($id);

        $type = $property->amenities_id;
        $property_ami = explode(',', $type);

        $multiImage = MultiImage::where('property_id',$id)->get();

        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();

        return view('backend.property.details_property',compact('property','propertytype','amenities','activeAgent','property_ami','multiImage','facilities'));

    }// End Method 

    public function InactiveProperty(Request $request){

        $pid = $request->id;
        Property::findOrFail($pid)->update([

            'status' => 0,

        ]);

    $notification = array(
            'message' => 'Property Inactive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.property')->with($notification); 


    }// End Method 


    public function ActiveProperty(Request $request){

        $pid = $request->id;
        Property::findOrFail($pid)->update([

            'status' => 1,

        ]);

    $notification = array(
            'message' => 'Property Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.property')->with($notification); 


    }// End Method 

    public function AdminPackageHistory(){
        $packagehistory = PackagePlan::latest()->get();
        return view('backend.package.package_history',compact('packagehistory'));
    }// End Method 

    public function PackageInvoice($id){
        $packagehistory = PackagePlan::where('id',$id)->first();
        $pdf = Pdf::loadView('backend.package.package_history_invoice', compact('packagehistory'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }// End Method 


}
