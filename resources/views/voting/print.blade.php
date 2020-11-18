<div style="text-align: center">
	<hr>
	<h3>SSC ELECTRONIC VOTING</h3>
	<em>Voting ID : </em><strong>00{{$id}}</strong>
	<hr>
	<h4>VOTED CANDIDATES</h4>
	@foreach($candidates as $candidate) 
	<em>{{$candidate->position}}</em> : <strong>{{$candidate->name}}</strong> <br>
	@endforeach
	<hr>
</div>

<script type="text/javascript">
window.print();
window.onafterprint = function(event) {
    window.location.href = '{{route("front", "success")}}'
};
</script>