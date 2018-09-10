<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebviewController extends Controller
{	

	public function healthPlus() {
	    $data = "<html><h1>SGKS - Health plus</h1></html>";
        return $data;
    }

    public function privacyPolicy() {
	    $data = "<html><h1>SGKS - Privacy Policy</h1></html>";
        return $data;
    }

    public function help() {
	    $data = "<html><h1>SGKS - Help</h1></html>";
        return $data;
    }

    public function qa() {
	    $data = "<html><h1>SGKS - Q and A</h1></html>";
        return $data;
    }

    public function contactUs() {
	    $data = "<html><h1>SGKS - Contact Us</h1></html>";
        return $data;
    }
}
