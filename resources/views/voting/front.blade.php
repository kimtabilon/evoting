@extends('layouts.app')

@section('content')
    <div class="header py-7 py-lg-8">
        <div class="container" style="text-align: center;">

            <div class="col-md-12">
                @if(Session::get('msg'))
                <div class="alert alert-{{Session::get('type')}} fade show" role="alert">
                  <strong>{{Session::get('title')}}, </strong> {{Session::get('msg')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="tim-icons icon-simple-remove"></i>
                  </button>
                </div>
                @endif
                <div class="card ">
                  <div class="card-header" >
                    <h4 class="card-title">ELECTRONIC VOTING</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('start') }}" method="post">@csrf
                    Enter ID Number
                    <div style="width: 400px; margin:20px auto;"> 
                        <input type="text" class="form-control" name="id_number" placeholder="10-20-3945" style="text-align: center;" required="true" autocomplete="off">
                    </div><br><br>
                    <input type="submit" class="btn btn-primary" name="open_voting_sheet" value="Open Voting Sheet"> 
                    </form>
                  </div>
              </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
$(document).ready(function() {
setTimeout(function() { 
      $('.alert').hide();
}, 5000);
});
</script>
@endpush