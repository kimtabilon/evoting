@extends('layouts.app', ['page' => __('Students'), 'pageSlug' => 'students'])

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card ">
      <div class="card-header">
        <h4 class="card-title"> Students Table
          <button 
            class="btn btn-fill btn-primary pull-right addRecordBtn" 
            data-toggle="modal" 
            data-target="#addRecordModal">New</button>
          <button 
            class="btn btn-fill btn-warning pull-right" 
            data-toggle="modal" 
            data-target="#importModal">Import CSV</button>
          </h4>

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter " id="studentTable">
            <thead class=" text-primary">
              <tr>
                <th>ID Number</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Course</th>
                <th>Year Level</th>
                <th>Barangay</th>
                <th>Municipality</th>
                <th>Province</th>
                <th>Voted</th>
                <th>BTNS</th>
              </tr>
            </thead>
            <tbody>
              @foreach($students as $student)
                <tr>
                  @if(isset($votes[$student->id]))
                  <td><span style="color:green;">{{$student->id_number}}</span></td>
                  @else
                  <td>{{$student->id_number}}</td>
                  @endif
                  <td>{{$student->firstname}}</td>
                  <td>{{$student->middlename}}</td>
                  <td>{{$student->lastname}}</td>
                  <td>{{$student->course}}</td>
                  <td>{{$student->year_level}}</td>
                  <td>{{$student->barangay}}</td>
                  <td>{{$student->municipality}}</td>
                  <td>{{$student->province}}</td>
                  <td>{{isset($votes[$student->id])?'Yes':'No'}}</td>
                  <td>
                    <button 
                      data-toggle="modal" 
                      data-target="#addRecordModal" 
                      data-id="{{$student->id}}"
                      data-id_number="{{$student->id_number}}"
                      data-firstname="{{$student->firstname}}"
                      data-middlename="{{$student->middlename}}"
                      data-lastname="{{$student->lastname}}"
                      data-course="{{$student->course}}"
                      data-year_level="{{$student->year_level}}"
                      data-barangay="{{$student->barangay}}"
                      data-municipality="{{$student->municipality}}"
                      data-province="{{$student->province}}"
                      class="btn btn-success btn-fab btn-icon btn-round modal-data">
                        <i class="tim-icons icon-pencil"></i>
                    </button>
                    <a href="{{ route('students.delete', $student->id) }}" class="btn btn-danger btn-fab btn-icon btn-round">
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
  

  <div class="col-md-3">
    <div class="card  card-plain">
      <div class="card-header">
        <h4 class="card-title"> Courses</h4>
        <p class="category"> Here is a subtitle for this table</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter " id="">
            <thead class=" text-primary">
              <tr>
                <th>Name</th>
                <th># of Students</th>
                <th>Voted</th>
              </tr>
            </thead>
            <tbody>
              @foreach($utilities['courses'] as $_course => $_count)
              <tr>
                <td>{{$_course}}</td>
                <td>{{$_count['total']}}</td>
                <td>{{isset($_count['voted'])?$_count['voted']:0}}</td>
                <td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card  card-plain">
      <div class="card-header">
        <h4 class="card-title"> Municipalities</h4>
        <p class="category"> Here is a subtitle for this table</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter " id="">
            <thead class=" text-primary">
              <tr>
                <th>Name</th>
                <th># of Students</th>
                <th>Voted</th>
              </tr>
            </thead>
            <tbody>
              @foreach($utilities['municipalities'] as $mun => $_count)
              <tr>
                <td><a href="{{ route('students', $mun)}}" style="color: #eee;">{{$mun}}</a></td>
                <td>{{$_count['total']}}</td>
                <td>{{isset($_count['voted'])?$_count['voted']:0}}</td>
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
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <form action="{{ route('students.new') }}" method="post">@csrf
        <input type="hidden" id="id" name="id" >
      <div class="modal-body">
              

          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="firstname" class="col-form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" autocomplete="off" required="required">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="middlename" class="col-form-label">Middle Name</label>
                <input type="text" class="form-control" id="middlename" name="middlename" autocomplete="off" required="required">
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <label for="lastname" class="col-form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" autocomplete="off" required="required">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="id_number" class="col-form-label">ID Number</label>
                <input type="text" class="form-control" id="id_number" name="id_number" autocomplete="off" required="required">
              </div>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <label for="course" class="col-form-label">Course</label>
                <input type="text" class="form-control" list="courses" id="course" name="course" autocomplete="off" required="required">
                <datalist id="courses">
                  @foreach($utilities['courses'] as $course => $count)
                  <option value="{{$course}}">
                  @endforeach  
                </datalist>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="year_level" class="col-form-label">Year Level</label>
                <input type="text" class="form-control" id="year_level" name="year_level" autocomplete="off" required="required">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="barangay" class="col-form-label">Barangay</label>
                <input type="text" class="form-control" list="barangays" id="barangay" name="barangay" autocomplete="off" required="required">
                <datalist id="barangays">
                  @foreach($utilities['barangays'] as $mun => $count)
                  <option value="{{$mun}}">
                  @endforeach  
                </datalist>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="municipality" class="col-form-label">Municipality</label>
                <input type="text" class="form-control" id="municipality" list="municipalities" name="municipality" autocomplete="off" required="required">
                <datalist id="municipalities">
                  @foreach($utilities['municipalities'] as $mun => $count)
                  <option value="{{$mun}}">
                  @endforeach  
                </datalist>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="province" class="col-form-label">Province</label>
                <input type="text" class="form-control" list="provinces" id="province" name="province" autocomplete="off" required="required">
                <datalist id="provinces">
                  @foreach($utilities['provinces'] as $mun => $count)
                  <option value="{{$mun}}">
                  @endforeach  
                </datalist>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="save_student" value="Save changes"> 
      </div>
      </form>
    </div>
  </div>
</div>

<!-- IMPORT MODAL -->
<div class="modal fade modal-black" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModal" aria-hidden="true" style="background:rgba(255,255,255,0.6);">
  <div class="modal-dialog modal-lg" role="document" >
    <form class="form-horizontal" method="POST" action="{{ route('import') }}" enctype="multipart/form-data">{{ csrf_field() }}
    <div class="modal-content">
      <div class="modal-body">
          IMPORT STUDENT CSV<br>
          <input id="csv_file" type="file" class="form-control" name="csv_file" required>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="import_student" value="Run"> 
      </div>
    </div>
    </form>
  </div>
</div>
@endsection

@push('js')
<script src="{{ asset('black') }}/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
  $('#studentTable').DataTable();

  $('#studentTable').on('click', '.modal-data', function () {
      // console.log($(this).data('items'));
      var $target = $(this);
      var id = $target.data('id');
      var id_number = $target.data('id_number');
      var firstname = $target.data('firstname');
      var middlename = $target.data('middlename');
      var lastname = $target.data('lastname');
      var course = $target.data('course');
      var year_level = $target.data('year_level');
      var barangay = $target.data('barangay');
      var municipality = $target.data('municipality');
      var province = $target.data('province');

      $('#addRecordModal #id').val(id);
      $('#addRecordModal #id_number').val(id_number);
      $('#addRecordModal #firstname').val(firstname);
      $('#addRecordModal #middlename').val(middlename);
      $('#addRecordModal #lastname').val(lastname);
      $('#addRecordModal #course').val(course);
      $('#addRecordModal #year_level').val(year_level);
      $('#addRecordModal #barangay').val(barangay);
      $('#addRecordModal #municipality').val(municipality);
      $('#addRecordModal #province').val(province);
      
    });

  $('.addRecordBtn').on('click', function () {
    $('#addRecordModal #id').val('');
    $('#addRecordModal #id_number').val('');
      $('#addRecordModal #firstname').val('');
      $('#addRecordModal #middlename').val('');
      $('#addRecordModal #lastname').val('');
      $('#addRecordModal #course').val('');
      $('#addRecordModal #year_level').val('');
      $('#addRecordModal #barangay').val('');
      $('#addRecordModal #municipality').val('');
      $('#addRecordModal #province').val('');
  });
});
</script>
@endpush
