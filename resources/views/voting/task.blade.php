@extends('layouts.app', ['page' => __('Task'), 'pageSlug' => 'task'])

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card ">
      <div class="card-header">
        <h4 class="card-title"> Pending Printout
          <a href="{{route('printout')}}" 
            class="btn btn-fill btn-primary pull-right" >Print All Pending</a>
          </h4>

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter " id="studentTable">
            <thead class=" text-primary">
              <tr>
                <th>Student Name</th>
                <th>ID</th>
                <th>DATE</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tasks['print'] as $task)
                <tr>
                  <?php  $raw = json_decode($task->raw, true); ?>
                  <td>{{$raw['student']['name']}}</td>
                  <td>{{$raw['student']['id_number']}}</td>
                  <td>{{$raw['date']}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>  
@endsection

@push('js')
<script>
$(document).ready(function() {

  /*$('#studentTable').on('click', '.modal-data', function () {
      // console.log($(this).data('items'));
      var $target = $(this);
      var id = $target.data('id');
      var name = $target.data('name');
      var position = $target.data('position');
      var party = $target.data('party');
      var course = $target.data('course');
      var photo = $target.data('photo');

      $('#addRecordModal #id').val(id);
      $('#addRecordModal #name').val(name);
      $('#addRecordModal #position').val(position);
      $('#addRecordModal #party').val(party);
      $('#addRecordModal #course').val(course);
      $('#addRecordModal #photo').val(photo);
      
    });

  $('.addRecordBtn').on('click', function () {
    $('#addRecordModal #id').val('');
    $('#addRecordModal #name').val('');
    $('#addRecordModal #position').val('');
    $('#addRecordModal #party').val('');
    $('#addRecordModal #course').val('');
    $('#addRecordModal #photo').val('');
  });*/
});
</script>
@endpush
