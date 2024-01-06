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
    public function EditCustomer(request $request, $id){
        $data['customer'] = PDFGenerator::find($id);
        $data['isEdit'] = 1;
        return view('admin.pdf.pdfGenerator', $data);
    }
    public function ViewPDFGenerator(){
        $data['customers'] = PDFGenerator::all();
        $data['isEdit'] = 0;
        return view('admin.pdf.pdfGenerator', $data);
    }
    public function RegsterCustomer(Request $request){
        $data = new PDFGenerator();
        $data->fullname = $request->fullname;
        $data->phone = $request->phone;
        if($request->file('portraitimage')){
            $file = $request->file('portraitimage');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/pdfimages/portraitimage/'), $fileName);
            $data['portraitimage'] = $fileName;
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
    public function UpdateCustomer(Request $request, $id){
        $data = PDFGenerator::find($id);
        $data->fullname = $request->fullname;
        $data->phone = $request->phone;
        if($request->file('portraitimage')){
            $file = $request->file('portraitimage');
            @unlink(public_path('uploads/pdfimages/portraitimage/'.$request->portraitimage));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/pdfimages/portraitimage/'), $fileName);
            $data['portraitimage'] = $fileName;
        }
        if($request->file('fullimage')){
            $file = $request->file('fullimage');
            @unlink(public_path('uploads/pdfimages/fullimage/'.$request->fullimage));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/pdfimages/fullimage/'), $fileName);
            $data['fullimage'] = $fileName;
        }
        if($request->file('passportimage')){
            $file = $request->file('passportimage');
            @unlink(public_path('uploads/pdfimages/passportimage/'.$request->passportimage));
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
            'message' => 'Customer Data is Updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.view')-> with($notification);
    }
    public function DeleteCustomer($id){
        $data = PDFGenerator::find($id);
        if($data->portraitimage){
            @unlink(public_path('uploads/pdfimages/portraitimage/'.$data->portraitimage));
        }
        if($data->fullimage){
            @unlink(public_path('uploads/pdfimages/fullimage/'.$data->fullimage));
        }
        if($data->passportimage){
            @unlink(public_path('uploads/pdfimages/passportimage/'.$data->passportimage));
        }
        $data->delete();
        $notification = array(
            'message' => 'Customer Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('customer.view')-> with($notification);
    }
}
