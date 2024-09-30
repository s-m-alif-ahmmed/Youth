<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\PrivacyPolicy;
use App\Models\Admin\ReturnPolicy;
use App\Models\Admin\TermsAndCondition;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function terms()
    {
        return view('website.home.terms.terms-and-conditions',[
            'terms_and_conditions' => TermsAndCondition::all(),
        ]);
    }

    public function privacy()
    {
        return view('website.home.terms.privacy-policy',[
            'privacy_policies' => PrivacyPolicy::all(),
        ]);
    }

    public function return()
    {
        return view('website.home.terms.return-policy',[
            'return_policies' => ReturnPolicy::all(),
        ]);
    }
}
