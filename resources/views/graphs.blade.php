@extends('layouts.app')

@section('content')
	<div class="container">
        <div class="col-sm-offset-1 col-sm-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Purchase trends from shops
                </div>

                <div class="panel-body">
                	<div id="myDiv" style="width: 480px; height: 380px; margin:0 auto;">
                		<!-- Plotly chart will be drawn inside this DIV -->
                	</div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::to('src/js/jquery.js') }}"></script>
    <!-- Plotly.js -->
	<script src="{{ URL::to('src/js/plotly-latest.min.js') }}"></script>
	<!-- Numeric JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/numeric/1.2.6/numeric.min.js"></script>
	<script>
	$(document).ready(function(){
	    $.ajax({ 
	    	url: 'graphsdata', 
	    })
	    .done(function(data) { 
	    	var plotdata = [data];

			var layout = {
			  height: 380,
			  width: 480
			};

			Plotly.newPlot('myDiv', plotdata, layout);
	    });
	    return false; 
	});
	</script>
@endsection        

