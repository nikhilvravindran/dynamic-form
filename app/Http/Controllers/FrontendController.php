<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormFields;
use App\Models\FormDetails;
use DB;
class FrontendController extends Controller
{
   public function index(){

    return view('dashboard');
   }


   public function contact(){
       $form=Form::where('name','Test Form2')->first();
       $formDetails =FormDetails::where('form_id',$form->id)->get()->toArray();
       $contactForm=response()->view('form',compact('formDetails'))->content();
       return view('contact')->with('contactForm',$contactForm);
   }
}
