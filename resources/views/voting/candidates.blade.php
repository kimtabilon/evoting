@extends('layouts.app', ['page' => __('Candidates'), 'pageSlug' => 'candidates'])

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card ">
      <div class="card-header">
        <h4 class="card-title"> Candidate Table
          <button 
            class="btn btn-fill btn-primary pull-right addRecordBtn" 
            data-toggle="modal" 
            data-target="#addRecordModal">Filling</button>
          </h4>

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter " id="studentTable">
            <thead class=" text-primary">
              <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Party</th>
                <th>Course</th>
                <th>Photo</th>
                <th>BTNS</th>
              </tr>
            </thead>
            <tbody>
              @foreach($candidates as $candidate)
                <tr>
                  <td>{{$candidate->name}}</td>
                  <td>{{$candidate->position}}</td>
                  <td>{{$candidate->party}}</td>
                  <td>{{$candidate->course}}</td>
                  <td><div style="width: 100px; height: 100px; overflow: hidden;"><img src="images/{{$candidate->photo==''?'avatar2.png':$candidate->photo}}" class="img-responsive"></div></td>
                  <td>
                    <button 
                      data-toggle="modal" 
                      data-target="#addRecordModal" 
                      data-id="{{$candidate->id}}"
                      data-name="{{$candidate->name}}"
                      data-position="{{$candidate->position}}"
                      data-party="{{$candidate->party}}"
                      data-course="{{$candidate->course}}"
                      data-photo="{{$candidate->photo}}"
                      class="btn btn-success btn-fab btn-icon btn-round modal-data">
                        <i class="tim-icons icon-pencil"></i>
                    </button>
                    <a href="{{ route('candidates.delete', $candidate->id) }}" class="btn btn-danger btn-fab btn-icon btn-round">
                      <i class="tim-icons icon-simple-remove"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  

  <div class="col-md-4">
    <div class="card  card-plain">
      <div class="card-header">
        <h4 class="card-title"> Positions</h4>
        <p class="category"> Here is a subtitle for this table</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter " id="">
            <thead class=" text-primary">
              <tr>
                <th>
                  Name
                </th>
                <th>
                  # of Candidates
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($positions as $position => $_candidates)
              <tr>
                <td>
                  {{$position}}
                </td>
                <td>
                  <?php @$total[$position] += count($_candidates) ?>
                  {{$total[$position]}}
                </td>
                <td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- Add Record Modal -->
<div class="modal fade modal-black" id="addRecordModal" tabindex="-1" role="dialog" aria-labelledby="addRecordModal" aria-hidden="true" style="background:rgba(255,255,255,0.6);">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('candidates.new') }}" method="post" enctype="multipart/form-data">@csrf
        <input type="hidden" id="id" name="id" >
      <div class="modal-body">

          <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" autocomplete="off" required="required">
          </div>

          <div class="form-group">
            <label for="position" class="col-form-label">Position</label>
            <input type="text" class="form-control" id="position" list="positions" name="position" autocomplete="off" required="required">
            <datalist id="positions">
              @foreach($positions as $position => $data)
              <option value="{{$position}}">
              @endforeach  
            </datalist>
          </div>

          <div class="form-group">
            <label for="party" class="col-form-label">Party</label>
            <input type="text" class="form-control" id="party" name="party" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="course" class="col-form-label">Course</label>
            <input type="text" class="form-control" id="course" name="course" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="image" class="col-form-label">Upload Photo</label>
            
          </div>
          <input type="file" class="btn btn-success" id="image" name="image" autocomplete="off">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="save_student" value="Save changes"> 
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function() {

  $('#studentTable').on('click', '.modal-data', function () {
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
  });
});
</script>
@endpush
