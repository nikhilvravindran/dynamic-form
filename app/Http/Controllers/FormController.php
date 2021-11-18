<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormFields;
use App\Models\FormDetails;

class FormController extends Controller
{
   
   public function addForm() {

     $formFields=FormFields::orderBy('created_at','desc')->get();
     return view('add-form')->with('formFields',$formFields);
   }

   public function createForm(Request $request){
        $request->validate([
            'formName' => 'required',
            'adMoreJson' => 'required',
        ]);

        $form =new Form;
        $form->name=$request->input('formName');
        $form->save();
        $lastInsertId=$form->id;

        $adMoreJson=json_decode($request->adMoreJson,true);

         foreach ($adMoreJson as $key => $value) {
            $formFields=FormFields::where('fieldname',$value['formField'])->first();
            $formDetails =new FormDetails;
            $formDetails->form_id=$lastInsertId;
            $formDetails->form_field_id=$formFields->id;
            $formDetails->fieldname=$value['formField'];
            $formDetails->fieldtype=isset($value['formType']) ? $value['formType'] : '';
            $formDetails->fieldlabel=$value['formLabel'];
            $formDetails->options=isset($value['options']) ? json_encode($value['options']) : '';
            $formDetails->save();
         }
      return redirect('/add-form')->with('success','Form Created');
   }

   public function listForm(){

        $forms= Form::orderBy('created_at','desc')->get();
        return view('list-form')->with('forms',$forms);

   }

   public function editForm($id){
       $data['formFields']=FormFields::orderBy('created_at','desc')->get();
       $data['form']=Form::find($id);
       $data['formDetails'] =FormDetails::where('form_id',$id)->get()->toArray();
       return view('edit-form')->with('data',$data);

   }



   public function updateForm(Request $request, $id){
        $request->validate([
            'formName' => 'required',
            'adMoreJson' => 'required',
        ]);


        $form=Form::find($id);
        $form->name=$request->input('formName');
        $form->save();

        $adMoreJson=json_decode($request->adMoreJson,true);

         foreach ($adMoreJson as $key => $value) {
            $formFields=FormFields::where('fieldname',$value['formField'])->first();
            if(isset($value['detailId'])){
                $formDetails=FormDetails::find($value['detailId']);
            }
            else {
               $formDetails =new FormDetails;
            }
            $formDetails->form_id=$id;
            $formDetails->form_field_id=$formFields->id;
            $formDetails->fieldname=$value['formField'];
            $formDetails->fieldtype=isset($value['formType']) ? $value['formType'] : '';
            $formDetails->fieldlabel=$value['formLabel'];
            $formDetails->options=isset($value['options']) ? json_encode($value['options']) : '';
            $formDetails->save();
         }
      return redirect('/list-form')->with('success','Form Created');
   }

    public function deleteForm($id){
        $form = Form::destroy($id); 
        $formDetails =FormDetails::where('form_id',$id)->get()->toArray();
        $ids = array_column($formDetails,'id');
        FormDetails::destroy($ids);
        return redirect('/list-form')->with('success','Form Created');
   }
}
