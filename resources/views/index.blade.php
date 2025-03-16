@extends('layouts.app')
@section('content')

<div class="carousel">
<div class="slider">
    <div class="slides">
      <div class="slide"><img src="{{ asset('images/いろいろ定食.png') }}" alt="Slide 1"></div>
      <div class="slide"><img src="{{ asset('images/いろいろ定食2.png') }}" alt="Slide 1"></div>
      <div class="slide"><img src="{{ asset('images/いろいろ定食3.png') }}" alt="Slide 1"></div>
    </div>
 
    <div class="controls">
      <button class="prev">&#10094;</button>
      <button class="next">&#10095;</button>

    </div>
  </div>
</div>
<x-news :news="$news" />
@endsection