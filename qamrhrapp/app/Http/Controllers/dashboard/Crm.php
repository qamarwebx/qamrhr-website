<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Crm extends Controller
{
  public function index()
  {
    return view('content.dashboard.dashboards-crm');
  }

  function test_function() {
    return view('test.index',['test_data'=>'hi this is a test data']);
  }
}
