<?php

namespace App\Http\Controllers\Admin;

//use Auth;
use Exception;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use App\Models\Exam;
use App\Models\Mark;
use App\Models\Role;
use App\Models\User;
use App\Models\Level;
use App\Models\Answer;
use App\Models\Profile;
use App\Models\Subject;
use App\Models\Question;
use App\Models\Semester;
use App\Models\Department;
use App\Traits\HelperTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;



class AdminController extends Controller
{
    use HelperTrait ;
    public function index(Request $request)
    {
        if (auth()->user()->hasRole('admin')) {
            $totalDepartment = Department::all()->count();
            $studentUser = User::whereHas('roles', function ($query) {
                $query->where('role_name', '=', 'student');
            })->get()->count();
            return view('admin_new.dashboard', compact(['studentUser', 'totalDepartment']));
        } elseif (auth()->user()->hasRole('student')) {
            $user=Auth::user();
            $userData=[];
            $temp=0;
            $totalMarks=Mark::where('student_id',$user->id)->get();
            $count=count($totalMarks);
            foreach($totalMarks as $totalMark)
            {
                $temp+=$totalMark->marks;
            }
            $userData['intelligencePercentage']=$temp/$count;
            $userData['totalExam']=Exam::count();
            $userData['totalAttendedExam']=$count;
            $userData['totalSubject']=Subject::count();
            $userData['intelligenceLevel']=Level::where('from','<=',$userData['intelligencePercentage'])->where('to','>=',$userData['intelligencePercentage'])->first();
            $userData['levelAplus']=0;
            $userData['levelA']=0;
            $userData['levelB']=0;
            $temp=Mark::with('exam')->where('student_id',$user->id)->get();
            foreach($temp as $val)
            {
                if($val->exam->level->level == "Level A+")
                {
                    $userData['levelAplus']++;
                }
                elseif($val->exam->level->level == "Level A")
                {
                    $userData['levelA']++;
                }
                else
                {
                    $userData['levelB']++;
                }
            }
            return view('student-dashboard')->with([
                'userData' => $userData
            ]);
        } else {
            return view('admin_new.teacher-dashboard');
        }
    }

    //Subject Tags
    public function addSubject()
    {
        return view('admin_new.add-subject');
    }
    public function storeSubject(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'subject_image' => 'required',
        ]);
        $file=$this->uploadFile($request->subject_image, $folder = "subject_images");
        $isSubjectCreated = Subject::create([
            'name' => $request->name,
            'slug' => str::slug($request->name),
            'image' => $file['path'],
        ]);
        return redirect('subject-list')->with("status", "Subject added successfully!");
    }
    public function subjectList()
    {
        $listSubject = Subject::all();
        //return $listSubject;
        return view('admin_new.subjects', compact('listSubject'));
    }
    public function editSubject($uuid)
    {
        $subject = Subject::where('uuid',$uuid)->first();
        //return $listSubject;
        return view('admin_new.edit-subject', compact('subject'));
    }
    public function updateSubject(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $subject=Subject::where('uuid',$request->uuid)->first();
        $isSubjectUpdated = $subject->update([
            'name' => $request->name,
            'slug' => str::slug($request->name),
        ]);
        if($request->has('subject_image'))
        {
            //deleting existing file
            if(is_file(public_path($subject->image)))
            {
                unlink(public_path($subject->image)) ;
            }
            //upload image
            $file=$this->uploadFile($request->subject_image, $folder = "subject_images");
            //update table
            $subject->update([
                'image' => $file['path'],
            ]);
        }
        return redirect('subject-list')->with("status", "Subject Updated successfully!");
    }

    //Levels
    public function levels()
    {
        $levels = Level::all();
        //return $listSubject;
        return view('admin_new.levels', compact('levels'));
    }
    public function levelAdd()
    {
        return view('admin_new.add-level');
    }
    public function storeLevel(Request $request)
    {
        $request->validate([
                'from' => 'required|numeric|min:0|max:100',
                'to' => 'required|numeric|min:0|max:100|gt:from',
                'level' => 'required',
            ],
            [
                'to.gt' => "Feild To must be greater than From Feild"
            ]
        );
        $isLevelCreated = Level::create([
            'from' => $request->from,
            'to' => $request->to,
            'level' => $request->level,
        ]);
        return redirect('levels')->with("status", "Subject added successfully!");
    }
    public function editLevel($uuid)
    {
        $level = Level::where('uuid',$uuid)->first();
        //return $listSubject;
        return view('admin_new.edit-level', compact('level'));
    }
    public function updateLevel(Request $request)
    {
        $request->validate([
                'from' => 'required|numeric|min:0|max:100',
                'to' => 'required|numeric|min:0|max:100|gt:from',
                'level' => 'required',
            ],
            [
                'to.gt' => "Feild To must be greater than From Feild"
            ]
        );
        $level=Level::where('uuid',$request->uuid)->first();
        $level->update([
            'from' => $request->from,
            'to' => $request->to,
            'level' => $request->level,
        ]);
        return redirect()->route('admin.levels')->with("status", "Level Updated successfully!");
    }

    //Students
    public function studentExamList()
    {
        $examLists=Exam::all();
        // $examGiven=Exam::where()
        return view('student-exam-list')->with(['examLists'=>$examLists]);
    }
    public function studentList()
    {
        $students = User::whereHas('roles', function ($query) {
            $query->where('role_name', '=', 'student');
        })->get();
        return view('admin_new.student-list', compact('students'));
    }
    public function addStudent()
    {
        $semesters = Semester::all();
        $departments = Department::all();
        return view('admin_new.add-student', compact('departments', 'semesters'));
    }
    public function storeStudent(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:5',
                'department_id' => 'required',
                'semester_id' => 'required',
                'email' => 'required|unique:users|email',
                'phone' => 'required|numeric|min:1000000000|max:9999999999|unique:profiles',
                'password' => [
                    'required',
                    'min:8',
                    'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/'
                ],
                'address' => 'required',
                'gender' => 'required',
                'dob' => 'required|date|before:4 years ago',
                'blood_group' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'religion' => 'required',
            ]
        );
        $filename = time() . "myfile." . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('assets/img'), $filename);
        $password = bcrypt($request->password);
        $isUserCreated = User::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'email' => $request->email,
            'password' => $password,
            'email_verified_at' => now(),
        ]);
        // $isUserCreated->markEmailAsVerified();
        if ($isUserCreated) {
            $isProfileCreated = $isUserCreated->profile()->create([
                'phone' => $request->phone,
                'address' => $request->address,
                'blood_group' => $request->blood_group,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'dob' => $request->dob,
                'picture' => $filename
            ]);
        }
        $isStudentRole = Role::where('role_name', 'Student')->get();
        $isSemester = Semester::where('id', $request->semester_id)->get();
        $isUserCreated->roles()->attach($isStudentRole);
        $isUserCreated->semesters()->attach($isSemester);

        return redirect('students');
    }
    public function showGrid()
    {
        $students = User::whereHas('roles', function ($query) {
            $query->where('role_name', '=', 'student');
        })->get();
        return view('admin_new.students-grid', compact('students'));
    }
    public function updateStatus(Request $request)
    {
        dd($request->all());
        $user = User::findOrFail($request->user_id);
        $user->status = $request->status;
        $user->update();
        return response()->json([
            'status' => true,
            'message' => 'Successfully Updated !!'
        ]);
    }
    public function editStudentInfo($id)
    {
        $departments = Department::all();
        $students = User::where('uuid', $id)->get();
        return view('admin_new.edit-student', compact('students', 'departments'));
    }
    public function updateStudentInfo(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:5',
                'email' => 'required|email',
                'phone' => 'required|numeric|min:1000000000|max:9999999999',
                'address' => 'required',
                'gender' => 'required',
                'dob' => 'required|date|before:4 years ago',
                'blood_group' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
                'picture' => 'sometimes|image|mimes:jpg,png,jpeg,gif,svg',
                'religion' => 'required',
            ]
        );
        if ($request->hasFile('image')) {
            $filename = time() . "myfile." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('assets/img'), $filename);
            $student = User::where('uuid', $request->id)->first();
            $isUserUpdated = User::where('uuid', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                // 'department_id' => $request->department,
            ]);

            if ($isUserUpdated) {
                $isProfileUpdated = $student->profile()->update([
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'blood_group' => $request->blood_group,
                    'gender' => $request->gender,
                    'religion' => $request->religion,
                    'dob' => $request->dob,
                    'picture' => $filename,
                ]);
            }
        } else {
            $student = User::where('uuid', $request->id)->first();
            $isUserUpdated = User::where('uuid', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                // 'department_id' => $request->department,
            ]);

            if ($isUserUpdated) {
                $isProfileUpdated = $student->profile()->update([
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'blood_group' => $request->blood_group,
                    'gender' => $request->gender,
                    'religion' => $request->religion,
                    'dob' => $request->dob,
                ]);
            }
        }
        return redirect('students');
    }
    public function deleteStudentInfo($id)
    {
        $user = User::where('uuid', $id);
        $user->delete();
        return redirect('students')->with('message', 'Student Record Moved to Trash!!!');
    }
    public function blockStudent($id)
    {
        $user = User::where('uuid', $id)->first();
        if ($user->is_block == 0) {
            $user->is_block = 1;
        } else {
            $user->is_block = 0;
        }
        $user->update();
        return redirect('students')->with('status', 'Student data updated');
    }
    public function searchData(Request $request)
    {
        $data = $request->search;
        // $results = User::join('profiles','profiles.user_id','=','users.id','left')->where('name', 'like', "%$data%")->get();
        $results = User::whereHas('profile', function ($query) use ($data) {
            $query->where('name', 'like', "%$data%");
        })->WhereHas('roles', function ($query) {
            $query->where('role_name', 'Student');
        })->with('profile')->get();
        return $results;
    }
    public function trashedData()
    {
        $trash = User::onlyTrashed()->get();
        return view('admin_new.trashedlist', compact('trash'));
    }
    public function restoreData($uuid)
    {
        $student = User::where('uuid', $uuid)->withTrashed()->restore();
        if ($student) {
            return redirect('students')->with('data', 'Student Data restored successfully');
        } else {
            return redirect('trash-data')->with('data', 'Student Not Found');
        }
    }
    public function adminProfile($id)
    {
        return view('admin_new.profile');
    }
    public function adminUpdatePassword(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'old_password' => 'required|min:8|max:12',
            'new_password' => 'required|min:8|max:12|different:old_password|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }
        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("success", "Password changed successfully!");
    }





    public function isGeneral($id)
    {
        $teacher = User::where('uuid', $id)->first();
        $teachertype = $teacher->profile()->update([
            'isgeneral' => 0,
            'isHOD' => 1,
        ]);
        return redirect('teacher');
    }
    public function isHod($id)
    {
        $teacher = User::where('uuid', $id)->first();
        $teachertype = $teacher->profile()->update([
            'isgeneral' => 1,
            'isHOD' => 0,
        ]);
        return redirect('teacher');
    }
    public function changeStatus(Request $request)
    {
        $teacherstatus = User::findOrFail($request->teacher_id);
        $teacherstatus->status = $request->status;
        $teacherstatus->update();
        return response()->json([
            'status' => true,
            'message' => 'Teacher Status Updated !!'
        ]);
    }

    public function examList()
    {
        $examLists=Exam::all();
        return view('admin_new.exam-list')->with(['examLists'=>$examLists]);
    }
    public function examAdd()
    {
        $subjectTags=Subject::all();
        $levelTags=Level::orderBy('to','DESC')->get();
        return view('admin_new.add-exam')->with([
            'subjectTags'=>$subjectTags,
            'levelTags'=>$levelTags,
        ]);
    }
    public function storeExam(Request $request){
        $request->validate([
                'subject_tag' => 'required',
                'level_tag' => 'required',
                'name' => 'required',
                'hour' => 'required',
                'minute' => 'required',
                'second' => 'required',
            ]
        );
        $exam=Exam::create([
            'subject_tag' => $request->subject_tag,
            'level_tag' => $request->level_tag,
            'name' => $request->name,
            'exam_time' => $request->hour.':'.$request->minute.':'.$request->second,
        ]);
        return redirect()->route('admin.exam-list');
    }
    public function editExam($uuid)
    {
        $exam = Exam::where('uuid',$uuid)->first();
        $subjectTags=Subject::all();
        $levelTags=Level::orderBy('to','DESC')->get();
        $time=explode(":",$exam->exam_time);
        //return $time[0] == 0;
        return view('admin_new.edit-exam')->with([
            'exam'=>$exam,
            'subjectTags'=>$subjectTags,
            'time' => $time,
            'levelTags'=>$levelTags,

        ]);
    }
    public function updateExam(Request $request)
    {
        $request->validate([
                'subject_tag' => 'required',
                'level_tag' => 'required',
                'name' => 'required',
                'hour' => 'required',
                'minute' => 'required',
                'second' => 'required',
            ]
        );
        $exam=Exam::where('uuid',$request->uuid)->first();
        $exam->update([
            'subject_tag' => $request->subject_tag,
            'level_tag' => $request->level_tag,
            'name' => $request->name,
            'exam_time' => $request->hour.':'.$request->minute.':'.$request->second,
        ]);
        return redirect()->route('admin.exam-list');
    }

    //Question
    public function questionList($exam_uuid){
        $exam=Exam::where('uuid',$exam_uuid)->first();
        $questions=Question::where('exam_id',$exam->id)->get();
        // $options=Answer::where('question_id',)
        //return $questions[1]->options;
        return view('admin_new.question-list')->with([
            'questions' => $questions,
        ]);
    }
    public function questionAdd(){
        $exams=Exam::all();
        return view('admin_new.add-question')->with([
            'exams' => $exams,
        ]);
    }
    public function storeQuestion(Request $request){
        //return $request->all();
        $request->validate([
                'question' => 'required',
                'exam' => 'required',
                'inputs.*' => 'required',
                'answer' => 'required',
            ],
            [
                'inputs.*.option' => 'Option is required !',
            ]
        );
        $question=Question::create([
            'name' => $request->question,
            'exam_id' => $request->exam,
        ]);
        //return $question->id;
        $answerIds=[];
        foreach($request->inputs as $answer){
            $answerIds[]=Answer::create([
                'option' => $answer,
                'question_id' => $question->id
            ]);
        }
        //return $answerIds;
        $question->update([
            'answer_id'=>$answerIds[$request->answer]->id
        ]);
        return redirect('exam-list')->with('status','Question Added Successfully');
    }
    public function getExamData(Request $request,$uuid)
    {
        $getExamTime = Exam::where('uuid',$uuid)->get();
        $getQuestion = Question::with('show_answer')->where('exam_id',$getExamTime[0]->id)->inRandomOrder()->get();
        return view('admin_new.student.exam',compact('getQuestion','getExamTime'));
    }
    public function examSubmit(Request $request)
    {
        //return "actual time: ".$request->time." ".$this->toSeconds($request->time)."seconds";
        //calculate user's completion time percentage.
            $total_time=$this->toSeconds($request->exam_duration);
            $remaining_time=$this->toSeconds($request->time);
            $completion_time_percentage=($remaining_time/$total_time)*100;
        //calculate user's correct answers percentage.
            $correctAnswers=0;
            $i=1;
            foreach($request->question_id as $question)
            {
                $temp=Question::find($question);
                $var="answers_".(string)$i;
                $user_ans=$request->$var;
                if($user_ans == $temp->answer_id)
                {
                    $correctAnswers++;
                }

                $i++;
            } 
            $total_question=Question::where('exam_id',$request->exam_id)->count();
            $correctAnswersPercentage=($correctAnswers/$total_question)*100;
        //calculate Intelligence Level
            $intelligenceLevel=($completion_time_percentage+$correctAnswersPercentage)/2;
        Mark::create([
            "exam_id" => $request->exam_id,
            "student_id" => $request->user_id,
            "marks" => $intelligenceLevel,
        ]);
            
        return redirect()->route("admin.student.exam-list");
    }
    public function email()
    {
        // Mail::send('mail', ["Jayanta"], function($message) {
        //     $message->to('j.mondal1009@gmail.com', 'Tutorials Point')->subject
        //        ('Laravel HTML Testing Mail');
        //     $message->from('presckol@gmail.com','Jayanta');
        //  });
         $mailable = new Mailable();

            $mailable
                ->from('j.mondal1009@gmail.com')
                ->to('j.mondal1009@gmail.com')
                ->subject('test subject')
                ->html(view('admin_new.email.mail'));

            $result = Mail::send($mailable);
         return "HTML Email Sent. Check your inbox.";
        return view('admin_new.email.mail');
    }
}
