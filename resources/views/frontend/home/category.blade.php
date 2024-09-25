@php
$ptype = App\Models\PropertyType::latest()->limit(5)->get();
@endphp

<section class="category-section centred">
    <div class="container d-flex justify-content-center"> <!-- Flexbox container for horizontal centering -->
        <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms" style="width: 100%;"> <!-- Ensure it takes full width -->
            
            <ul class="category-list list-unstyled d-flex justify-content-center flex-wrap"> <!-- Prevent squishing with flex-wrap -->
                
                @foreach($ptype as $item)

                @php
                    $property = App\Models\Property::where('propertyType_id',$item->id)->get();
                @endphp

                <li class="m-3" style="min-width: 200px;">
                    <div class="category-block-one text-center">
                        <div class="inner-box">
                            <div class="icon-box"><i class="{{ $item->type_icon }}"></i></div>
                            <h5><a href="property-details.html">{{ $item->type_name }}</a></h5>
                            <span>{{ count($property) }}</span>
                        </div>
                    </div>
                </li>

                @endforeach
                
            </ul>
            
            <div class="more-btn d-flex justify-content-center mt-4"> <!-- Center the button -->
                <a href="categories.html" class="theme-btn btn-one">All Categories</a>
            </div>
        </div>
    </div>
</section>
