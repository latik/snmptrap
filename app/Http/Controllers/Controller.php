<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory as View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $view;
    
    public function __construct(View $view)
    {
        $this->view = $view;
    }
}
