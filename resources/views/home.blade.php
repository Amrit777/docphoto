@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in!') }}
                        <menu>
                            <li class="menu-box"><a href="/invoice/list/purchase">Purchase Invoice </a></li>
                            <li><a href="/invoice/list/logistic">Logistic Purchase</a></li>
                            <li><a href="/invoice/list/do">DO</a></li>
                            <li><a class="" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </menu>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
