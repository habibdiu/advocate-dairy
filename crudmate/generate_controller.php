<?php 

function generate_controller($modelName, $controllerName, $fields) {
	// Controller content
        $controller = "<?php

        namespace App\Http\Controllers;

        use App\Models\\$modelName;

        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\File;
        use Illuminate\Support\Facades\Auth;
        use Intervention\Image\Facades\Image;

        class $controllerName extends Controller
        {
            public function index()
            {
                \$data = [];
                \$data['data_list'] = $modelName::all();

                \$data['active_menu'] = '".strtolower($modelName) ."_list';
                \$data['page_title'] = '".strtolower($modelName) ." List';

                return view('".strtolower($modelName) ."_list', compact('data'));
            }

            public function create()
            {
                \$data = [];

                \$data['active_menu'] = '".strtolower($modelName) ."_create';
                \$data['page_title'] = '".strtolower($modelName) ." Create';

                return view('".strtolower($modelName) ."_create', compact('data'));
            }


            public function store(Request \$request)
            {
                if (!\$request->isMethod('post')) {
                    return back()->with('error', 'Invalid request method.');
                }

                \$photo = \$request->file('photo'); // Example for image upload
                \$data = [];

                try {
                    \$newItem = $modelName::create([
                            " . implode(",\n", array_map(function($f) {
                                $name = $f['name'];
                                $input_type = $f['input_type'];
                                if ($name === 'created_by') {
                                    return "                '$name' => Auth::user()->id";
                                } elseif ($name === 'photo') {
                                    return "                'photo' => \$photo_name";
                                } elseif ($input_type === 'datetime') {
                                    return "                '$name' => date('Y-m-d H:i:s', strtotime(\$request->$name))";
                                }  elseif ($input_type === 'date') {
                                    return "                '$name' => date('Y-m-d', strtotime(\$request->$name))";
                                } else {
                                    return "                '$name' => \$request->$name";
                                }
                            }, array_filter($fields, fn($f) => $f['name']))) . "
                                    ]);

                    if (\$photo) {
                        \$photo_extension = \$photo->getClientOriginalExtension();
                        \$photo_name = 'uploads/photos/' . \$newItem->id . '.jpg';
                        \$image = Image::make(\$photo);
                        \$image->resize(300, 300);
                        \$image->save(\$photo_name);
                        \$newItem->update(['photo' => \$photo_name]);
                    }

                    return back()->with('success', 'Added Successfully');
                } catch (PDOException \$e) {
                    return back()->with('error', 'Failed Please Try Again: ' . \$e->getMessage());
                }
            }

            public function show(\$id)
            {
                \$data = [];
                \$data['details'] = $modelName::find(\$id);

                \$data['active_menu'] = '".strtolower($modelName) ."_list';
                \$data['page_title'] = '".strtolower($modelName) ." Details';

                return view('".strtolower($modelName) ."_show', compact('data'));
            }

             public function edit($modelName \$id)
            {
                \$data = [];
                \$data['details'] = $modelName::find(\$id);
                
                \$data['active_menu'] = '".strtolower($modelName) ."_edit';
                \$data['page_title'] = '".strtolower($modelName) ." Edit';

                return view('".strtolower($modelName) ."_edit', compact('data'));
            }

            public function update(Request \$request, \$id)
            {
                \$data = [];
                \$data['item'] = $modelName::find(\$id);

                if (!\$data['item']) {
                    return redirect()->route('{$modelName}.index')->with('error', 'Wrong Attempt!');
                }

                if (\$request->isMethod('post')) {


                    \$old_photo = \$data['item']->photo ?? null;
                    \$photo = \$request->file('photo');

                    if (\$photo) {
                        if (File::exists(\$old_photo)) {
                            File::delete(\$old_photo);
                        }
                        \$photo_extension = \$photo->getClientOriginalExtension();
                        \$photo_name = 'uploads/photos/' . \$data['item']->id . '.' . \$photo_extension;
                        \$image = Image::make(\$photo);
                        \$image->resize(300, 300);
                        \$image->save(\$photo_name);
                    } else {
                        \$photo_name = \$old_photo;
                    }

                    try {
                        \$data['item']->update([
                                " . implode(",\n", array_map(function($f) {
                                    $name = $f['name'];
                                    $input_type = $f['input_type'];
                                    if ($name === 'created_by') {
                                        return "                '$name' => Auth::user()->id";
                                    } elseif ($name === 'photo') {
                                        return "                'photo' => \$photo_name";
                                    } elseif ($input_type === 'datetime') {
                                        return "                '$name' => date('Y-m-d H:i:s', strtotime(\$request->$name))";
                                    }  elseif ($input_type === 'date') {
                                        return "                '$name' => date('Y-m-d', strtotime(\$request->$name))";
                                    } else {
                                        return "                '$name' => \$request->$name";
                                    }
                                }, array_filter($fields, fn($f) => $f['name']))) . "
                                            ]);

                        return back()->with('success', 'Updated Successfully');
                    } catch (PDOException \$e) {
                        return back()->with('error', 'Failed Please Try Again: ' . \$e->getMessage());
                    }
                }
            }

            public function destroy(\$id)
            {
                \$server_response = ['status' => 'FAILED', 'message' => 'Not Found'];
                \$item = $modelName::find(\$id);

                if (\$item) {
                    if (!empty(\$item->photo) && File::exists(\$item->photo)) {
                        File::delete(\$item->photo);
                    }

                    \$item->delete();
                    \$server_response = ['status' => 'SUCCESS', 'message' => 'Deleted Successfully'];
                }

                echo json_encode(\$server_response);
            }
        }
        ";
        file_put_contents("output/{$controllerName}.php", $controller);
}
