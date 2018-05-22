<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use PDF;
use DB;

class DistributionDetailController extends Controller
{
    public function index()
    {
      return view('admin.distribution.details') ;
    }

    public function pdf_download()
    {
      $pdf = PDF::loadView('admin.distribution.pdf');
      return $pdf->download('tcds_distributed_course_details.pdf');
    }
}
