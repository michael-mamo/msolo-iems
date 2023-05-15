<?php

namespace App\Http\Controllers\backend\contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactAdminMesssage;
use Auth;
use App\Models\User;
class ContactController extends Controller
{
    //function to view feedbacks
    public function FeedbackView(){

        return view('admin.contact.viewFeedback');
    }
    public function ComposeMessageView(){
        return view('admin.contact.composeMessage');
    }
    public function ContactAdmin(){
        $userId = Auth::User()->id;
        $data['messages'] = ContactAdminMesssage::where('senderid', $userId)->orWhere('recieverid', $userId)->orderBy('created_at', 'ASC')->get();
        // $updateUnSeen = ContactAdminMesssage::where('recieverid', $userId)->set('isseen', 1);
        return view('admin.contact.contactAdmin', $data);
    }
    public function ContactAdminSend(Request $request){

        $userId = Auth::User()->id;
        $senderData = User::find($userId);
        $senderRole  = $senderData->role;
        $adminId = User::where('role','Admin')
                        ->orderBy('created_at', 'DESC')
                        ->limit(1)
                        ->value('id');

        $data =  new ContactAdminMesssage();
        $data->senderid = $userId;
        $data->senderrole = $senderRole;
        $data->recieverid = $adminId;
        $data->recieverrole = 'Admin';
        $data->message = $request->message;
        $data->isseen = 0;
        $data->save();
        return redirect()->back();
    }
    public function ContactUser(){
        $userId = Auth::User()->id;
        $data['messages'] = ContactAdminMesssage::where('senderid', $userId)->orWhere('recieverid', $userId)->orderBy('created_at', 'ASC')->get();
        $data['contactCount'] = ContactAdminMesssage::where('recieverid', $userId)->groupBy('senderid')->selectRaw('senderid')->selectRaw('COUNT(CASE WHEN isseen = 1 THEN 1 END) AS seen_messsages')->selectRaw('COUNT(CASE WHEN isseen = 0 THEN 1 END) AS unseen_messsages')->orderBy('created_at', 'DESC')->get('senderid', 'seen_messsages', 'unseen_messsages');
        $data['showMessages'] = 0;
        return view('admin.contact.contactUsers', $data);
    }
    public function ShowMessages($recieverId){
        $userId = Auth::User()->id;
        $data['messages'] = ContactAdminMesssage::where('recieverid', $recieverId)->orWhere('senderid', $recieverId)->get();
        $data['contactCount'] = ContactAdminMesssage::where('recieverid', $userId)->groupBy('senderid')->selectRaw('senderid')->selectRaw('COUNT(CASE WHEN isseen = 1 THEN 1 END) AS seen_messsages')->selectRaw('COUNT(CASE WHEN isseen = 0 THEN 1 END) AS unseen_messsages')->orderBy('created_at', 'DESC')->get('senderid', 'seen_messsages', 'unseen_messsages');
        $data['showMessages'] = 1;
        ContactAdminMesssage::where('recieverid', $recieverId)->orWhere('senderid', $recieverId)->update(['isseen'=>1]);
        $data['recId'] = $recieverId;
        // dd($data['recId']);
        return view('admin.contact.contactUsers', $data);
    }
    public function ContactUserSend(Request $request, $recId){
        $userId = Auth::User()->id;
        $data =  new ContactAdminMesssage();
        $data->senderid = $userId;
        $data->senderrole = 'Admin';
        $data->recieverid = $recId;
        $data->recieverrole = 'User';
        $data->message = $request->message;
        $data->isseen = 0;
        $data->save();
        return redirect()->back();
    }
}
