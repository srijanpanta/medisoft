<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\Newsletter;

class NewsletterController extends Controller
{
     public function __invoke(Newsletter $newsletter)
    {
        request()->validate([
            'email'=>'required|email'
        ]);

        try{
                $newsletter->subscribe(request('email'));
        }
        catch (\exception $e) {
                return redirect('/')
                -> with('warning','This email could not be used!');
            }
    
    
        return redirect('/')
                -> with('success','Successfully subscribed to our newsletter!');
        }
}
