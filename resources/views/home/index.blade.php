@extends('layout')
@section('content')
@php
  $product = App\Models\Product::first();
@endphp
<section class="text-gray-600 body-font">
  <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
    <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
      <img class="object-cover object-center rounded-full" alt="hero" src="{{ $product->getFirstMediaUrl('products_image') }}">
    </div>
    <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
      <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">LABORÉ
        <br class="hidden lg:inline-block">Sensitive Skin Care
      </h1>
      <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{$product->product_name}}</h2>
      <p class="mb-8 leading-relaxed">{{$product->product_description_short}}</p>
      <div class="flex justify-center">
        <a href="{{ route('product.detail', $product->id) }}" class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">More Detail</a>
        <a href class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">Buy Now</a>
      </div>
    </div>
  </div>
</section>

<section class="text-gray-600 body-font overflow-hidden">
  @php
  $products = App\Models\Product::all();
  @endphp
  <div class="container px-5 py-24 mx-auto">
    <h2 class="text-4xl font-semibold mb-2 text-center">CATEGORY LABORÉ PRODUCT</h2>
    <div class="-my-8 divide-y-2 divide-gray-100">
      @foreach ( $products as $product )
      <div class="py-8 flex flex-wrap md:flex-nowrap">
        <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
          <img class="h-48 w-48 rounded-full" src="{{ $product->getFirstMediaUrl('products_image') }}" alt="gambar produk">
          <span class="font-semibold title-font text-gray-700">{{$product->product_name}}</span>
          <span class="mt-1 text-gray-500 text-sm">What is CLEANSER?</span>
        </div>
        <div class="md:flex-grow">
        <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{$product->product_name}}</h2>
          <p class="leading-relaxed">{{$product->product_description_short}}</p>
          <a a href="{{ route('product.detail', $product->id) }}" class="text-indigo-500 inline-flex items-center mt-4">Detail
            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="M12 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Master Cleanse Reliac Heirloom</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">LABORÉ has developed into a skin specialist providing a wide range skin health care, personalized therapy service which supported by the best formula product that have been tested by Clinical Research & Innovation team, proven to be effective and save to use.</p>
    </div>
  </div>
</section>
    
@endsection