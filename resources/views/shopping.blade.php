@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
                
            @foreach($datas as $d)
            <div class="col-md-3">                    
                
                @if($d->photourl=="") <?php continue; ?> @endif

                <img src="{{ url($d->photourl) }}" style="width: 100%">
                <br>
                <button class="btn btn-succss">Add To Cart</button>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
