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
                  <span class="badge badge-pill badge-warning" style="font-size: 15pt; padding: 5px 20px;"> Votes : {{$candidate['votes']}}</span>

              </div>
            @endforeach 
      </div>
    </div>
</div>
@endforeach  
</div>  

<div class="print-wrap" style="display: none;">
<h2>SSC EVOTING RESULTS</h2>
<em>Printed: {{date('F j, Y, g:i a')}}</em>
@foreach($positions as $position => $candidates)
<h4>{{$position}}</h4>
<table class="table" style="width: 100%; border: 1px solid #333; margin-top: -10px">
  <thead>
  <th>Candidate</th>
  <th>Party</th>
  <th>Votes</th>
  </thead>
  <tbody>
    @foreach($candidates as $candidate)
    <tr>
      <td>{{$candidate['name']}}</td>
      <td style="text-align: center;">{{$candidate['party']}}</td>
      <td style="text-align: center;">{{$candidate['votes']}}</td>
    </tr>
    @endforeach 
  </tbody>
</table>
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
