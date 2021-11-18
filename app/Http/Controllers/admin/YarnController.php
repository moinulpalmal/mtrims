<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Yarn;
use App\YarnType;
use App\YarnCount;
use Illuminate\Http\Request;

class YarnController extends Controller
{
    public function index(){
        $types = YarnType::orderBy('name')->where('status', '!=', 'D')->get();
        $yarns = Yarn::orderBy('color')->where('status', '!=', 'D')->get();
        $counts = YarnCount::orderBy('name')->where('status', '!=', 'D')->get();
        return view('admin.yarn.index', compact('types', 'yarns', 'counts'));
    }

    public function saveYarn(Request $request){

        $id = $request->get('id');
        if(!empty($id))
        {
            $supplier = Yarn::find($request->id);
            if($supplier != null){
                $supplier->yarn_count_id = $request->yarn_count;
                $supplier->color = $request->color;
                $supplier->remarks = $request->remarks;
                if($supplier->save())
                {
                    return 'Saved';
                }

            }
            return 'Updated';
        }
        else
        {
            $supplier = new Yarn();
            $supplier->yarn_count_id = $request->yarn_count;
            $supplier->unit_id = 2;
            $supplier->color = $request->color;
            $supplier->remarks = $request->remarks;
            $supplier->status = 'A';
            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateYarn(Request $req)
    {
        $supplier =  Yarn::find($req->id);

        if($supplier == null)
            return null;

        $yarnData = array(
            'id' => $supplier->id,
            'color' => $supplier->color,
            'yarn_count' => $supplier->yarn_count_id,
            'remarks' => $supplier->remarks,
        );
        return $yarnData;
    }

    public function fullDelete(Request $request)
    {
        $supplier = Yarn::find($request->id);
        $supplier->status = 'D';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function activate(Request $request)
    {
        $supplier = Yarn::find($request->id);
        $supplier->status = 'A';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function inActivate(Request $request)
    {
        $yarn = Yarn::find($request->id);
        $yarn->status = 'IN';
        if($yarn->save()){
            return true;
        }
        return 'Error';

    }


}
