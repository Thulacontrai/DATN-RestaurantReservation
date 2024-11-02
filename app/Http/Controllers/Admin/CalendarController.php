<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\TraitCRUD;

class CalendarController extends Controller
{

  use TraitCRUD;

  //protected $model = \App\Models\Calendar::class;
  protected $viewPath = 'admin.calendar';
  protected $routePath = 'admin.calendar';

  public function index(){
     return view('admin.calendar.index');
  }
}
