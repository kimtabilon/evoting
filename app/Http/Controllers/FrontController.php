<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\Rule;

class FrontController extends Controller
{

		public function front() {
	     return view('voting/front');						
	 }

	 public function vote(Request $request) {
	     $r = $request->all();

	     $votes = Vote::where('student_id', $r['student_id'])->get();
	     $candidates = [];

	     if($votes->count()) {
	     		return redirect()->route('front')->with(['title'=>'Opps', 'msg'=>'already voted', 'type'=>'warning']);
	     } else {
	     		if(count($r)==3) {
			     		$model = new Vote;
			     		$model->student_id = $r['student_id'];
			     		$model->candidate_id = 0;
			     		$model->save();
			     } else {
			     		foreach ($r as $key => $value) {
			     			switch ($key) {
			     				case '_token':
			     				case 'student_id':
			     				case 'submit_vote':
			     					break;
			     				
			     				default:
			     					$model = new Vote;
						     		$model->student_id = $r['student_id'];
						     		$model->candidate_id = $value;
						     		$model->save();

						     		$candidates[] = Candidate::find($value);
			     					break;
			     			}
			     		}
			     }
	     }
	     return view('voting/print', [
	     		'candidates'=>$candidates,
	     		'student'=>Student::find($r['student_id']),
	     ]);
	 }

	 public function sheet(Request $request) {
	 				$req = $request->all();

	 				$student = Student::where('id_number', $req['id_number'])->get()->first();
	 				
	 				if($student) {
		 					/*CHECK VOTES*/
		 					$votes = Vote::where('student_id', $student->id)->get();
		 					if($votes->count()) {
		 							return redirect()->route('front')->with(['title'=>'Opps', 'msg'=>'already voted', 'type'=>'warning']);
		 					}

		 					$rules = Rule::where('course', $student->course)->orderBy('sort')->get();

		 					if($rules->count()) {

		 							$candidates = [];
		 							$positions = [];

		 							foreach (Candidate::all() as $_candidate) {
		 										$candidates[$_candidate->position][] = $_candidate;
		 							}

		 							foreach ($rules as $rule) {
		 									if(isset($candidates[$rule->position])) {
		 											$positions[$rule->position] = $candidates[$rule->position];
		 											$positions[$rule->position] = $candidates[$rule->position];
		 									} 
		 							}
		 							return view('voting/sheet', [
		 								'positions' => $positions,
		 								'student_id' => $student->id,

		 							]);
		 									
		 					}
		 					return redirect()->route('front')->with(['title'=>'Opps', 'msg'=>'no candidate found in '.$student->course, 'type'=>'danger']);
	 				}
	 				
	 				return redirect()->route('front')->with(['title'=>'Opps', 'msg'=>'student id not found', 'type'=>'warning']);
	 }

}