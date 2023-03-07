<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\Settings\SettingRepositoryContract;

use App\Datatables\SettingTables;
use App\Models\Setting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    protected $settings;

    protected $settingRepository;


    public function __construct(SettingRepositoryContract $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function show(){
        return core()->view("dashboard.pages.settings.show");
    }

    public function create(Request $request){
        return view("dashboard.pages.settings.create");
    }

    public function store(Request $request){
        $input = $request->except(["_token", "_method"]);

        $rules = array(
            'site_title'  => 'required|string'
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->errors()->first(), 400);
        }


        foreach ($input as $key => $value){
            $this->settingRepository->updateOrCreate([
                'key' => $key
            ],[
                'value' => $value
            ]);
        }

        Cache::forget("settings");

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = Setting::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.settings.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.settings.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.settings.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = Setting::find($id);

        $input = $request->except('_token');

        $rules = array(
            'title'  => 'required|string'
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->errors()->first(), 400);
        }
        $item->slug = null;
        $item->title = $input['title'];

        $item->save();

        return redirect()->back()->with('success', 'Item Updated');
    }

    public function delete($id){
        if(request()->has('ids')){
            $ids = request()->get('ids');
            try {
                Settings::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
