<?php

 namespace App\Http\Controllers;
 use Illuminate\Http\Request;
 use \Illuminate\Http\Response;
 use App\Message;
 use App\User;
 use Illuminate\Support\Facades\Validator;
 use Illuminate\Support\Facades\DB;


 class MessageController extends Controller
 {

     public function message() {
         $id = auth()->id();
         // retrieve the messages of the connected user
         $message = User::find($id)->messages;

         return view('message', compact('message'));
      }

     public function add_message(Request $request){

         $messages = [
             'title.max' => 'le titre  ne peut pas avoir plus de 5 caractères',
             'title.min' => 'le titre ne peut pas avoir moins de :min caractères.',
             'message.required' => 'Vous devez saisir votre message.'


         ];

         $rules = [
             'title' => 'required|string|min:5|max:55',
             'message' => 'required|string|min:3|max:255'
         ];



         $validator = Validator::make($request->all(),$rules,$messages);
         if ($validator->fails()) {
             return redirect('message')
                 ->withInput()
                 ->withErrors($validator);
         }
         else{
             $data = $request->input();

             $title = trim($data['title']);
             $title = strip_tags($title);
             $messages = trim($data['message']);
             $messages = stripslashes(strip_tags($messages));
             $user_id = auth()->id();
             try{
                 $message = new Message();
                 $message->title = $title;
                 $message->message = $messages;
                 $message->user_id = $user_id;
                 $message->save();
                 return redirect('message')->with('status',"les informations sont enregistrées");
             }
             catch(Exception $e){
                 return redirect('message')->with('failed',"echec");
             }
         }
     }



 }

