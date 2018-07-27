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
                <button data-id="{{ $d->id }}" class="btn_addtocart btn btn-succss">Add To Cart</button>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.btn_addtocart').click(function(){ 
            var id = $(this).attr('data-id');
            $.ajax({
                method: "GET",
                url: "{{ url('addtocart') }}/"+id,
                dataType: "json"                
            }).done(function( data ) {
                //alert( "Data Saved: " + msg );
                if($('#hascart').val()==false){
                    $('#hascartshow').show();
                    $('#cart_count1').html(data.length);
                }
                

                alert("Successfully Added to cart");
                $('#cart_count').html(data.length);
            });
        });
    });


</script>

@endsection
