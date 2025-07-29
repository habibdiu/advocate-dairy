<?php

namespace App\Http\Controllers\backend;


use App\Http\Controllers\Controller;
use PDOException;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Middleware\backendAuthenticationMiddleware;

class StudentController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            backendAuthenticationMiddleware::class
        ];
    }
    public function index()
    {
        $data = [];
        $data['student_list'] = Student::orderBy('id')->limit(10)->get();

        $data['active_menu'] = 'student_list';
        $data['page_title'] = 'student List';

        return view('backend.pages.student_list', compact('data'));
    }

    public function create()
    {
        $data = [];

        $data['active_menu'] = 'student_add';
        $data['page_title'] = 'Student Add';

        return view('backend.pages.student_add', compact('data'));
    }


    public function store(Request $request)
    {
        if (!$request->isMethod('post')) {
            return back()->with('error', 'Invalid request method.');
        }

        $photo = $request->file('photo'); // Example for image upload
        $data = [];

        try {
            $newItem = Student::create([
            'batch_no' => $request->batch_no,
            'branch_id' => $request->branch_id,
            'roll_number' => $request->roll_number,
            'name' => $request->name,
            'phone' => $request->phone,
            'guardian_phone' => $request->guardian_phone,
            'guardian_phone2' => $request->guardian_phone2,
            'guardian_phone3' => $request->guardian_phone3,
            'unit_id' => $request->unit_id,
            'student_type' => $request->student_type,
            'fee_amount' => $request->fee_amount,
            'created_by' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s', strtotime($request->created_at)),
            'updated_at' => date('Y-m-d H:i:s', strtotime($request->updated_at))
            ]);

            if ($photo) {
                $photo_extension = $photo->getClientOriginalExtension();
                $photo_name = 'uploads/photos/' . $newItem->id . '.jpg';
                $image = Image::make($photo);
                $image->resize(300, 300);
                $image->save($photo_name);
                $newItem->update(['photo' => $photo_name]);
            }

            return back()->with('success', 'Added Successfully');
        } catch (PDOException $e) {
            return back()->with('error', 'Failed Please Try Again: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $data = [];
        $data['details'] = Student::find($id);

        $data['active_menu'] = 'student_list';
        $data['page_title'] = 'student Details';

        return view('student_show', compact('data'));
    }

    public function edit(Student $id)
    {
        $data = [];
        $data['details'] = Student::find($id);
        
        $data['active_menu'] = 'student_edit';
        $data['page_title'] = 'student Edit';

        return view('student_edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = [];
        $data['item'] = Student::find($id);

        if (!$data['item']) {
            return redirect()->route('Student.index')->with('error', 'Wrong Attempt!');
        }

        if ($request->isMethod('post')) {


            $old_photo = $data['item']->photo ?? null;
            $photo = $request->file('photo');

            if ($photo) {
                if (File::exists($old_photo)) {
                    File::delete($old_photo);
                }
                $photo_extension = $photo->getClientOriginalExtension();
                $photo_name = 'uploads/photos/' . $data['item']->id . '.' . $photo_extension;
                $image = Image::make($photo);
                $image->resize(300, 300);
                $image->save($photo_name);
            } else {
                $photo_name = $old_photo;
            }

            try {
                $data['item']->update([
                'batch_no' => $request->batch_no,
                'branch_id' => $request->branch_id,
                'roll_number' => $request->roll_number,
                'name' => $request->name,
                'phone' => $request->phone,
                'guardian_phone' => $request->guardian_phone,
                'guardian_phone2' => $request->guardian_phone2,
                'guardian_phone3' => $request->guardian_phone3,
                'unit_id' => $request->unit_id,
                'student_type' => $request->student_type,
                'fee_amount' => $request->fee_amount,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s', strtotime($request->created_at)),
                'updated_at' => date('Y-m-d H:i:s', strtotime($request->updated_at))
                                    ]);

                return back()->with('success', 'Updated Successfully');
            } catch (PDOException $e) {
                return back()->with('error', 'Failed Please Try Again: ' . $e->getMessage());
            }
        }
    }

    public function destroy($id)
    {
        $server_response = ['status' => 'FAILED', 'message' => 'Not Found'];
        $item = Student::find($id);

        if ($item) {
            if (!empty($item->photo) && File::exists($item->photo)) {
                File::delete($item->photo);
            }

            $item->delete();
            $server_response = ['status' => 'SUCCESS', 'message' => 'Deleted Successfully'];
        }

        echo json_encode($server_response);
    }
}
        