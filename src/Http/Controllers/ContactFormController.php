<?php

namespace Lianpark\Contactform\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Lianpark\Contactform\Models\Contact;
use Lianpark\Contactform\Mail\InquiryEmail;
use Illuminate\Support\Facades\Mail;


class ContactFormController extends Controller
{
    public function index()
    {
      return view('contactform::sample');
    }

    public function contact()
    {
      return view('contactform::contact');
    }

    public function submit(Request $request)
    {
      //return $request->all();

      // validate check
      $validated = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|max:255',
        'message' => 'required',
      ]);

      // Insert data to DB
      contact::create($validated);

      // 메일보내기 (파일명.key)
      $admin_email = config('myconfig.admin_email');
      //print_r(config()->all());
      //dd($admin_email);
      if ($admin_email === null || $admin_email === '') {
        echo 'The value of admin email not ser';
      } else {
        Mail::to($admin_email)->send(new InquiryEmail($validated));
      }

      return back()->with('success', 'Inquiry sent. Please wait a response');
    }
}
