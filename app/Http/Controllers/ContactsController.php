<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactsController extends SiteController
{
    public function __construct(){
        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));
        $this->bar = 'left';
        $this->template = env('THEME').'.contacts';
    }
    //

    public function index(Request $request){

        if($request->isMethod('post')){
            $messages =[
                'required'=> 'Поле :attribute обязательно к заполнению',
                'email'=> 'Поле :attribute должно содержать правильный email',
            ];

            $this->validate( $request, [
                'name'=>'required|max:255',
                'email'=>'required|email',
                'text'=>'required',
            ]/*, $messages*/);

            $data = $request->all();

            $result = Mail::send(env("THEME").'.email', ['data'=>$data], function($m) use ($data){
                $mail_admin = env('MAIL_ADMIN');
                $m->from($data['email'],$data['name']);
                $m->to($mail_admin,'Mr. Admin')->subject('Question');
            });
//            dd($result);
            if(count(Mail::failures()) > 0){
                // Your error message or whatever you want.
            } else {
                return redirect()->route('contacts')->with('status', 'Email is Sent');
            }
//            if($result){
//
//            }

        }

        $this->title = 'Контакты';
        $content = view(env('THEME').'.contact_content')->render();
        $this->vars = array_add($this->vars, 'content', $content);

        $this->contentLeftBar = view(env('THEME').'.contact_bar')->render();

        return $this->renderOutput();
    }
}
