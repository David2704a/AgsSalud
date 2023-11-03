@extends('layouts.app')
   
@section('title','Home')
@section('links')

<link rel="stylesheet" href="{{asset('/css/welcome.css')}}">
@endsection

@section('content')

<div class="content">
    <h1 class="page-title">Panel de control</h1>
    <div class="green-line"></div>
</div>

<div class="button-container">

<a href="/procedimiento">
    <div class="circle-button btn-background-circle">
        <img src="{{asset('imgs/logos/Logo-IQNet (1) A COLOR .png')}}" alt="alo">
    </div>
</a>

<a href="#">
    <div class="circle-button btn-background-circle">
        <img src="{{asset('imgs/logos/Logo-IQNet (1) A COLOR .png')}}" alt="alo">
    </div>
</a>

<a href="#">
    <div class="circle-button btn-background-circle">
        <img src="{{asset('imgs/logos/Logo-IQNet (1) A COLOR .png')}}" alt="alo">
    </div>
</a>

<a href="#">
    <div class="circle-button btn-background-circle">
        <img src="{{asset('imgs/logos/Logo-IQNet (1) A COLOR .png')}}" alt="alo">
    </div>
</a>

</div>



@endsection
