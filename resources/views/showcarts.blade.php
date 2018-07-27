@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('carts'))
                <table class="table table-hover">
                    <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Options</th>
                    </tr>
                    @foreach(Session::get('carts') as $key => $d)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $d['productarr']['photoname'] }}</pre></td>
                            <td>{{ $d['qty'] }}</td>
                            <td><a href="{{ url('removeprd/'.$key) }}"><button>Remove</button></a></td>
                        </tr>
                    @endforeach
                </table>

                <h2><a href="{{ url('clearcart') }}">Clear Cart</a></h2>
            @else
                <h1>You have no products in the cart.
            @endif
        </div>
    </div>
</div>

@endsection
