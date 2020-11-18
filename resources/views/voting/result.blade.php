@extends('layouts.app', ['page' => __('Votes'), 'pageSlug' => 'votes'])

@section('content')
<div class="row" id="containment-wrapper">
  @foreach($positions as $position => $candidates)
    <div class="col-md-3 {{preg_replace('/[^a-zA-Z]/', '', $position)}} ui-widget-content draggable" id="draggable"> 
        <div class="card ">
          <div class="card-header" >
            <h4 class="card-title">{{$position}}</h4>
          </div>
          <div class="card-body">
            
            @foreach($candidates as $candidate)
              <div class="form-check form-check-radio" style="width: 100%; height: 100px;" >
                  {{$candidate['name']}}
                  <div style="width: 100px; height: 100px; overflow: hidden; margin: 0 auto;" class="pull-right"><img src="images/{{$candidate['photo']==''?'avatar2.png':$candidate['photo']}}" class="img-responsive"></div> 
                  <br>
                  {{$candidate['party']}}<br>
                  {{$candidate['course']}}<br>
                  <span class="badge badge-pill badge-primary" style="font-size: 15pt; padding: 5px 20px;"> Votes : {{$candidate['votes']}}</span>

              </div>
            @endforeach 
      </div>
    </div>
</div>
@endforeach  
</div>  
@endsection

@push('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
var positions = JSON.parse(localStorage.positions || "{}");
$(function () {

    var d = $("[id=draggable]").attr("id", function (i) {
        return "draggable_" + i
    })
    $.each(positions, function (id, pos) {
        $("#" + id).css(pos)
    })

    d.draggable({
        containment: "#containment-wrapper",
        scroll: false,
        stop: function (event, ui) {
            positions[this.id] = ui.position
            localStorage.positions = JSON.stringify(positions)
        }
    });
});
</script>
@endpush
