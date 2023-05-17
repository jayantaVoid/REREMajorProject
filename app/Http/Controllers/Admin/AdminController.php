<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Answer;
use App\Models\Profile;
use App\Models\Subject;
use App\Models\Question;
use App\Models\Semester;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;


class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->hasRole('admin')) {
            $totalDepartment = Department::all()->count();
            $studentUser = User::whereHas('roles', function ($query) {
                $query->where('role_name', '=', 'student');
            })->get()->count();
            return view('admin_new.dashboard', compact(['studentUser', 'totalDepartment']));
        } elseif (auth()->user()->hasRole('student')) {
            return view('student-dashboard');
        } else {
            return view('admin_new.teacher-dashboard');
        }
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

        return back()->with("status", "Password changed successfully!");
    }


    //Department call
    public function addDepartment()
    {
        return view('admin_new.add-department');
    }
    public function listDepartment()
    {
        $departments = Department::all();
        $semesters = Semester::all();
        return view('admin_new.department-list', compact('departments', 'semesters'));
    }
    public function storeDepartment(Request $request)
    {
        $request->validate([
            'dept_no' => 'required|numeric',
            'dept_name' => 'required',
        ]);
        $department = Department::create([
            'dept_no' => $request->dept_no,
            'name' => $request->dept_name,
            'slug' => str::slug($request->dept_name),
        ]);
        if ($department) {
            return redirect('department-list')->with("status", "Department added successfully!");
        } else {
            return redirect()->back()->with("status", "Department Not Added!");
        }
    }
    public function addTeacher()
    {
        $departments = Department::all();
        return view('admin_new.teacher.add-teacher', compact('departments'));
    }
    public function storeTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'department_id' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|min:1000000000|max:9999999999',
            'address' => 'required',
            'gender' => 'required|in:Male,Female,Others',
            'dob' => 'required|date|before:4 years ago',
            'joining_date' => 'required',
            'qualification' => 'required',
            'experience' => 'required',
            'blood_group' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg,gif,svg',
            'password' => 'required|min:8|max:12|confirmed',
            'religion' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'country' => 'required',
        ]);
        $filename = time() . "myfile." . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('assets/img'), $filename);
        $password = bcrypt($request->password);
        $isUserCreated = User::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'email' => $request->email,
            'password' => $password,
        ]);
        if ($isUserCreated) {
            $isProfileCreated = $isUserCreated->profile()->create([
                'phone' => $request->phone,
                'address' => $request->address,
                'blood_group' => $request->blood_group,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'dob' => $request->dob,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
                'isGeneral' => '1',
                'isHod' => '0',
                'qualification' => $request->qualification,
                'joining_date' => $request->joining_date,
                'experience' => $request->experience,
                'picture' => $filename
            ]);
        }
        $isTeacherRole = Role::where('role_name', 'teacher')->get();
        $isUserCreated = $isUserCreated->roles()->attach($isTeacherRole);
        return redirect('teacher');
    }
    public function teachersList()
    {
        $teachers = User::whereHas('roles', function ($query) {
            $query->where('role_name', '=', 'teacher');
        })->get();
        return view('admin_new.teacher.teachers-list', compact('teachers'));
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
    public function showTeachersProfile($id)
    {
        $teachersData = User::where('uuid', $id)->get();
        return view('admin_new.teacher.teacher-profile', compact('teachersData'));
    }
    public function editTeachersData($uuid)
    {
        $departments = Department::all();
        $teachers = User::where('uuid', $uuid)->get();
        // dd($teachers);
        return view('admin_new.teacher.edit-teachers-data', compact('teachers', 'departments'));
    }
    public function addSubject()
    {
        $departmentList = Department::all();
        $semesterlist = Semester::all();
        return view('admin_new.add-subject', compact('departmentList', 'semesterlist'));
    }
    public function storeSubject(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'department' => 'required',
            'semester' => 'required',
        ]);
        // dd($request->all());
        $isSubjectCreated = Subject::create([
            'name' => $request->name,
            'slug' => str::slug($request->name),
        ]);
        $isDepartment = Department::where('id', $request->department)->get();
        $isSemester = Semester::where('id', $request->semester)->get();
        $isSubjectCreated->department()->attach($isDepartment);
        $isSubjectCreated->semester()->attach($isSemester);
        return redirect('subject-list')->with("status", "Subject added successfully!");
    }
    public function subjectList()
    {
        $listSubject = Subject::all();
        return view('admin_new.subjects', compact('listSubject'));
    }
    public function attachSemester(Request $request)
    {
        $department = Department::find($request->dept_id);
        $semesters = Semester::whereIn('id', $request->semesters)->get();
        $isSemesterAttached = $department->semester()->attach($semesters);
        return response()->json([
            'status' => true,
            'message' => 'Semester added successfully',
        ]);
    }
    public function addSemester()
    {
        return view('admin_new.add-semester');
    }
    public function listSemester()
    {
        $semesters = Semester::all();
        return view('admin_new.semester-list', compact('semesters'));
    }
    public function storeSemester(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $semester = Semester::create([
            'name' => $request->name,
        ]);
        if ($semester) {
            return redirect('semester-list')->with('status', 'semester Added Successfully');
        } else {
            return redirect()->back();
        }
    }
    public function examList()
    {
        return view('admin_new.exam-list');
    }
    public function examAdd()
    {
        return view('admin_new.add-exam');
    }
    public function storeQuestion(Request $request){
        //return $request->all();
        $request->validate([
                'question' => 'required',
                'inputs.*' => 'required',
                'answer' => 'required',
            ],
            [
                'inputs.*.option' => 'Option is required !',
            ]
        );
        $question=Question::create([
            'name' => $request->question
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
        return redirect('add-question')->with('status','Question Added Successfully');
    }
}
