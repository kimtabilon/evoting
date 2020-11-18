@extends('layouts.app')

@section('content')
    <div class="header py-7 py-lg-8">
        <div class="container" >
          <form action="{{ route('vote') }}" method="post">@csrf
            <input type="hidden" name="student_id" value="{{$student_id}}">
          <div class="row">
          @foreach($positions as $position => $candidates)
            <div class="col-md-4">
                <div class="card ">
                  <div class="card-header" >
                    <h4 class="card-title">{{$position}}</h4>
                  </div>
                  <div class="card-body">
                    
                    @foreach($candidates as $candidate)
                      <div class="form-check form-check-radio" style="width: 100%; height: 100px;" >
                          <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="{{$position}}" id="{{$position}}" value="{{$candidate->id}}" >
                              {{$candidate->name}}
                              <span class="form-check-sign"></span>
                          </label>
                          <div style="width: 100px; height: 100px; overflow: hidden; margin: 0 auto;" class="pull-right"><img src="images/{{$candidate->photo==''?'avatar2.png':$candidate->photo}}" class="img-responsive"></div> 
                          <br>
                          {{$candidate->party}}<br>
                          {{$candidate->course}}

                      </div>
                    @endforeach 
              </div>
            </div>
        </div>
        @endforeach  
        </div>  
        <div style="text-align: center; margin-top: 100px;">
          <input type="reset" class="btn btn-default" name="clear" value="CLEAR SELECTION"> 
          <input type="submit" class="btn btn-success" name="submit_vote" value="SUBMIT VOTE"> 
        </div>
        </form>
    </div>
@endsection
@push('js')

@endpush

  
