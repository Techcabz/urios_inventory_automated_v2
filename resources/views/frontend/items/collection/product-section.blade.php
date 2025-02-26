<div
    class="row g-sm-4 g-3 row-cols-lg-4 row-cols-md-3 row-cols-2 mt-1 custom-gy-5 product-style-2 ratio_asos product-list-section">
    @forelse ($items as $item)
    <div>
        <div class="product-box">
            <div class="img-wrapper">
                <div class="front">
                    {{-- <a
                            href="{{ url('collection', urlencode($product->category->slug) . '/' . urlencode($product->slug)) }}">
                    @if ($item->productImages->isNotEmpty())
                    @php $firstImage = $product->productImages->first(); @endphp
                    <img src="{{ asset('storage/' . $firstImage->image) }}" class="bg-img blur-up lazyload"
                        alt="">
                    @endif
                    </a>
                    --}}
                </div>


            </div>
            <div class="product-details">
                <div class="d-flex justify-content-between">
                    <h3 class="theme-color">{{ Str::ucfirst($item->category->name) }}</h3>
                    <span class="text-primary">{{ $item->quantity }}</span>
                </div>
               
                <div class="main-price">
                    

                    <button class="btn listing-content">Reserve Now</button>
                </div>
            </div>
        </div>
    </div>
    @empty
    <h1>No availabble.</h1>
    @endforelse




</div>