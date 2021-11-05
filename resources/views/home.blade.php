@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/custom-style.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="header-image">
                <img src={{ asset('images/uprint-cetak-online.png') }}>
            </div>
            <div class="col-md-12 wrapper">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <a href="invoice/list/purchase">
                    <span>Purchase Invoice</span>
                </a>
                <a href="invoice/list/logistic">
                    <span>Logistic Purchase</span>
                </a>
                <a href="invoice/list/do"><span>DO</span></a>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span>
                        {{ __('Logout') }}
                    </span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                </li>
            </div>
        </div>
    </div>
@endsection
