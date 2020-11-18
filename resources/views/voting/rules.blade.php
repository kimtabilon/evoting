@extends('layouts.app', ['page' => __('Rules'), 'pageSlug' => 'rules'])

@section('content')
<div class="row">
  @foreach($courses as $course => $students)
  <div class="col-md-3">
    <div class="card ">
      <div class="card-header">
        <h4 class="card-title"> {{$course}} Rules</h4>
        <button 
            class="btn btn-fill btn-primary addRecordBtn" 
            data-course="{{$course}}"
            data-toggle="modal" 
            data-target="#addRecordModal">Attach</button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter " id="dataTable">
            <thead class=" text-primary">
              <tr>
                <th>
                  Positions
                </th>
                <th>
                  BTN
                </th>
              </tr>
            </thead>
            <tbody class="rules">
              @if(isset($rules[$course]))
                <?php  
                  array_multisort(array_map(function($element) {
                      return $element['sort'];
                  }, $rules[$course]), SORT_ASC, $rules[$course]);
                ?>
                @foreach($rules[$course] as $_position)
                <tr id="{{$_position['id']}}">
                  <td>{{$_position['position']}}</td>
                  <td>
                    <a href="{{ route('rules.delete', $_position['id']) }}" class="btn btn-danger btn-fab btn-icon btn-round">
                      <i class="tim-icons icon-simple-remove"></i>
                  </td>
                  <td>
                </tr>
                @endforeach
              @endif  
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @endforeach


</div>


<!-- Add Record Modal -->
<div class="modal fade modal-black" id="addRecordModal" tabindex="-1" role="dialog" aria-labelledby="addRecordModal" aria-hidden="true" style="background:rgba(255,255,255,0.6);">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('rules.new') }}" method="post">@csrf
        <input type="hidden" id="id" name="id" >
        <input type="hidden" id="course" name="course" >
      <div class="modal-body">

          <div class="form-group">
            <label for="qty" class="col-form-label">Position</label>
            <input type="text" class="form-control" list="positions" id="position" name="position" autocomplete="off" required="required">
            <datalist id="positions">
              @foreach($positions as $position => $data)
              <option value="{{$position}}">
              @endforeach  
            </datalist>
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
@endsection

@push('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function() {

  var fixHelperModified = function(e, tr) {
    var $originals = tr.children();
    var $helper = tr.clone();
    $helper.children().each(function(index) {
        $(this).width($originals.eq(index).width());
    });
    
    /*ids = {};

    trs = tr.parent('.rules').children('tr');

    trs.each( function(index) {
      ids[$(this).attr('id')]=index;
    });

    $.post("{{route('rules.sort')}}", {sorted: ids, _token: '{{csrf_token()}}'}, function(result){
      console.log(result);
    });*/

    return $helper;
  },
  updateIndex = function(e, ui) {
      $('td.index', ui.item.parent()).each(function (i) {
          $(this).html(i + 1);
      });

      ids = {};
      trs = ui.item.parent('tbody').children('tr');
      trs.each( function(index) {
        ids[$(this).attr('id')]=index;
      });
      $.post("{{route('rules.sort')}}", {sorted: ids, _token: '{{csrf_token()}}'}, function(result){
        console.log(result);
      });
  };

  $("#dataTable tbody").sortable({
      helper: fixHelperModified,
      stop: updateIndex
  }).disableSelection();


  $('#dataTable').on('click', '.modal-data', function () {
      // console.log($(this).data('items'));
      var $target = $(this);
      var id = $target.data('id');
      var course = $target.data('course');
      var position = $target.data('position');

      $('#addRecordModal #id').val(id);
      $('#addRecordModal #course').val(course);
      $('#addRecordModal #position').val(position);
      
    });

  $('.addRecordBtn').on('click', function () {
    var $target = $(this);
    var course = $target.data('course');

    $('#addRecordModal #id').val('');
    $('#addRecordModal #course').val(course);
    $('#addRecordModal #position').val('');
  });
});
</script>
@endpush
