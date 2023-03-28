<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Option;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
class CmsController extends Controller
{
     public function index(Request $request)
     {

        if($request->ajax()){
            $faqs = Faq::orderBy('position','desc');
            return Datatables::of($faqs)
            ->addIndexColumn()
            ->make(true);
        }
         $option = Option::where('option_name','login_screen_content')->first();
         $banner =    $option->getFirstMediaUrl('logo', 'thumb');
         return view('admin.cms.index',compact('option','banner'));
     }


     public function faqUpdate(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $faq =  Faq::findOrFail($request->id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->position = $request->position;
        $faq->status = $request->status;
        if($faq->save()){
            return response(['success' => true,'message' => 'Faq has been updated successfully']);
        }else{
            return response(['success' => false,'message' => 'Faq not updated']);
        }
    }

    public function faqDelete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $faq =  Faq::findOrFail($request->id);
        if($faq->delete()){
            return response(['success' => true,'message' => 'Faq has been deleted successfully']);
        }else{
            return response(['success' => false,'message' => 'Faq not deleted']);

        }
    }


    public function faqStore(Request $request){
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'status' => 'required',
        ]);
        $faq =  new Faq;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        if($request->position == null){
            $position = 0;
        }else{
            $position = $request->position;
        }
        $faq->position = $position;
        $faq->status = $request->status;
        if($faq->save()){
            return response(['success' => true,'message' => 'Faq has been created successfully']);
        }else{
            return response(['success' => false,'message' => 'Faq not created']);
        }
    }


    public function optionUpdate(Request $request){


        $request->validate([
            'id' => 'required',
        ]);
        $option =  Option::where('id',$request->id)->first();
        $option->option_value = $request->value;
        if($option->save()){
            if($request->hasFile('logo')) {
                $option->clearMediaCollection('logo');
                $option->addMediaFromRequest('logo')->toMediaCollection('logo');
            }
            return redirect()->back()->with('success', 'Content has been updated successfully');
        }else{
            return redirect()->back()->with('error', 'Content not updated');
        }
    }


}
