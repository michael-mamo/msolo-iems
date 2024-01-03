<?php

namespace App\Http\Controllers\backend\pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PDFGenerator;

class PDFGeneratorController extends Controller
{
    //
    public function ViewCustomers(){
        $data['allData'] = PDFGenerator::all();
        return view('admin.pdf.viewCustomers', $data);
    }
    public function ViewPDFController(){
        $data['customers'] = PDFGenerator::all();
        return view('admin.pdf.pdfGenerator', $data);
    }
    public function RegsterCustomer(Request $request){
        $data = new PDFGenerator();
        $data->fullname = $request->fullname;
        $data->phone = $request->phone;
        if($request->file('protraitimage')){
            $file = $request->file('protraitimage');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/pdfimages/protraitimage/'), $fileName);
            $data['protraitimage'] = $fileName;
        }
        if($request->file('fullimage')){
            $file = $request->file('fullimage');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/pdfimages/fullimage/'), $fileName);
            $data['fullimage'] = $fileName;
        }
        if($request->file('passportimage')){
            $file = $request->file('passportimage');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/pdfimages/passportimage/'), $fileName);
            $data['passportimage'] = $fileName;
        }
        $data->relegion = $request->relegion;
        $data->dateofbirth = $request->dateofbirth;
        $data->placeofbirth = $request->placeofbirth;
        $data->town = $request->town;
        $data->maritalstatus = $request->maritalstatus;
        $data->children = $request->children;
        $data->weight = $request->weight;
        $data->height = $request->height;
        $data->complexion = $request->complexion;
        $data->education = $request->education;
        if($request->has('arabics')){
            $data->arabics = 1;
        }
        if($request->has('arabicw')){
            $data->arabicw = 1;
        }
        if($request->has('arabicr')){
            $data->arabicr = 1;
        }
        if($request->has('englishs')){
            $data->englishs = 1;
        }
        if($request->has('englishw')){
            $data->englishw = 1;
        }
        if($request->has('englishr')){
            $data->englishr = 1;
        }
        $data->empcountry = $request->empcountry;
        $data->empperiod = $request->empperiod;
        $data->delala = $request->delala;
        if($request->has('driving')){
            $data->driving = 1;
        }
        if($request->has('cooking')){
            $data->cooking = 1;
        }
        if($request->has('washing')){
            $data->washing = 1;
        }
        if($request->has('cleaning')){
            $data->cleaning = 1;
        }
        if($request->has('babyseat')){
            $data->babyseat = 1;
        }
        if($request->has('sewing')){
            $data->sewing = 1;
        }
        $data->appliedfor = $request->appliedfor;
        $data->salary = $request->salary;
        $data->contactperiod = $request->contactperiod;
        $data->passportnumber = $request->passportnumber;
        $data->pdate = $request->pdate;
        $data->pplace = $request->pplace;
        $data->pexpiry = $request->pexpiry;
        
        $data->save();
         $notification = array(
            'message' => 'Customer Data is Registered successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.view')-> with($notification);
    }
}
