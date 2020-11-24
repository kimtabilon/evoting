@foreach($tasks['print'] as $task)
	
	<?php  $raw = json_decode($task->raw, true); ?>

	<div style="text-align: center">
		<h3>SSC ELECTRONIC VOTING</h3>
		<em>Voting ID : </em><strong>{{$raw['student']['voting_id']}}</strong><br>
		{{$raw['student']['id_number']}} &bull; {{$raw['student']['name']}} <br>
		{{date('F j, Y, g:i a')}}
		<h4>VOTED CANDIDATES</h4>
		@foreach($raw['candidates'] as $candidate) 
		<em>{{$candidate['position']}}</em> : <strong>{{$candidate['name']}}</strong> <br>
		@endforeach
		<hr>
	</div>
@endforeach
<script type="text/javascript">
window.print();
window.onafterprint = function(event) {
    window.location.href = '{{route("task")}}'
};
</script>