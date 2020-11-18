<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Candidate;
use App\Models\Rule;
use App\Models\Vote;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    

    public function students($municipality=null)
    {
        if($municipality != null) {
            $raw = Student::where('municipality', $municipality)->get();
        } else {
            $raw = Student::all();
        }

        $rawVotes = Vote::all();
        $votes = [];
        foreach ($rawVotes as $vote) {
            $votes[$vote->student_id]=true;
        }
        
        $students = [];
        $utilities['municipalities'] = [];
        $utilities['barangays'] = [];
        $utilities['provinces'] = [];
        $utilities['courses'] = [];

        foreach ($raw as $student) {
            $students[] = $student;
            
            @$utilities['municipalities'][$student->municipality]['total']++;
            @$utilities['barangays'][$student->barangay]['total']++;
            @$utilities['provinces'][$student->province]['total']++;
            @$utilities['courses'][$student->course]['total']++;

            if(isset($votes[$student->id])) {
                @$utilities['courses'][$student->course]['voted']++;
                @$utilities['municipalities'][$student->municipality]['voted']++;
            }
        }
        //dd($utilities['courses']);
        return view('voting/students',[
            'students'=>$students,        
            'utilities'=>$utilities,        
            'votes'=>$votes,        
        ]);
    }

    public function newStudent(Request $request)
    {
        $student = $request->all();

        $model = new Student;
        
        if($student['id']!='') {
            $model = Student::find($student['id']);
        }

        $model->id_number = $student['id_number'];
        $model->firstname = $student['firstname'];
        $model->lastname = $student['lastname'];
        $model->middlename = $student['middlename'];
        $model->course = $student['course'];
        $model->year_level = $student['year_level'];
        $model->barangay = $student['barangay'];
        $model->municipality = $student['municipality'];
        $model->province = $student['province'];
        $model->save();

        return redirect()->route('students');
    }

    public function deleteStudent($id)
    {
        $model = Student::find($id);
        $model->delete();

        return redirect()->route('students');
    }

    public function import(Request $request)
    {
        Student::truncate();

        $path = $request->file('csv_file')->getRealPath();
        $i = 0;
        $file = fopen($path,"r");
        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
            
            if($i>0 && $filedata!='') {
                //dd($filedata);
                $model = new Student;
                $model->id_number = $filedata[0];
                $model->lastname = preg_replace("/[^a-zA-Z]/", " ", $filedata[1]);
                $model->firstname = preg_replace("/[^a-zA-Z]/", " ", $filedata[2]);
                $model->middlename = preg_replace("/[^a-zA-Z]/", " ", $filedata[3]);
                $model->course = $filedata[4];
                $model->year_level = $filedata[5];
                $model->barangay = preg_replace("/[^a-zA-Z]/", " ", $filedata[6]);
                $model->municipality = preg_replace("/[^a-zA-Z]/", " ", $filedata[7]);
                $model->province = preg_replace("/[^a-zA-Z]/", " ", $filedata[8]);
                $model->save();
            }
            
            $i++;
        }

        return redirect()->route('students');
    }

    /*VOTES*/
    public function votes()
    {

        $rawVotes = Vote::all();
        $votes = [];
        foreach ($rawVotes as $vote) {
            @$votes[$vote->candidate_id]++;
        }

        $rawCandidates = Candidate::all();
        $candidates = [];
        $positions = [];

        foreach ($rawCandidates as $candidate) {
            $candidates[] = $candidate;
            $positions[$candidate->position][$candidate->id] = $candidate->toArray();

            if(isset($votes[$candidate->id])) {
                $positions[$candidate->position][$candidate->id]['votes'] = $votes[$candidate->id];
            } else {
                $positions[$candidate->position][$candidate->id]['votes'] = 0;
            }
            
        }

        return view('voting/result',[
            'candidates'=>$candidates,        
            'positions'=>$positions,            
        ]);
    }
    
    /*CANDIDATES*/
    public function candidates()
    {
        $raw = Candidate::all();
        $candidates = [];
        $positions = [];

        foreach ($raw as $candidate) {
            $candidates[] = $candidate;
            $positions[$candidate->position][] = $candidate;
        }

        return view('voting/candidates',[
            'candidates'=>$candidates,        
            'positions'=>$positions,            
        ]);
    }

    public function newCandidate(Request $request)
    {
        $candidate = $request->all();

        $model = new Candidate;
        
        if($candidate['id']!='') {
            $model = Candidate::find($candidate['id']);
        }

        if(isset($candidate['image'])&&$candidate['image']!='') {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $model->photo = $imageName;
        }

        $model->name = $candidate['name'];
        $model->position = $candidate['position'];
        $model->party = $candidate['party'];
        $model->course = $candidate['course'];
        $model->save();

        return redirect()->route('candidates');
    }

    public function deleteCandidate($id)
    {
        $model = Candidate::find($id);
        $model->delete();
        
        return redirect()->route('candidates');
    }

    /*RULES*/
    public function rules()
    {
        $rawStudents = Student::all();
        $courses = [];

        foreach ($rawStudents as $student) {
            $courses[$student->course][$student->municipality][] = $student;
        }

        $rawCandidates = Candidate::all();
        $positions = [];

        foreach ($rawCandidates as $candidate) {
            $positions[$candidate->position][] = $candidate;
        }

        $rawRules = Rule::all();
        $rules = [];

        foreach ($rawRules as $rule) {
            $rules[$rule->course][] = $rule;
        }

        return view('voting/rules',[    
            'courses'=>$courses,        
            'positions'=>$positions,        
            'rules'=>$rules,        
        ]);
    }

    public function newRule(Request $request)
    {
        $rule = $request->all();

        $model = new Rule;
        
        if($rule['id']!='') {
            $model = Rule::find($rule['id']);
        }

        $model->sort = 0;
        $model->course = $rule['course'];
        $model->position = $rule['position'];
        $model->save();

        return redirect()->route('rules');
    }

    public function sortRules(Request $request)
    {
        $rule = $request->all();
        foreach($rule['sorted'] as $id => $sort) {
            $model = Rule::find($id);
            $model->sort = $sort;
            $model->save();
        }

        return $rule['sorted'];
    }

    public function deleteRule($id)
    {
        $model = Rule::find($id);
        $model->delete();
        
        return redirect()->route('rules');
    }
}
