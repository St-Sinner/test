<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin/index');
    }

    public function pages()
    {
        $pages = array_map(function ($route){
            return [
                'URI' => $route->uri(),
                'Server' => $route->getDomain() ?: 'Main',
                'Action' => $route->getActionName(),
                'Methods' => $route->methods(),
                'Name' => $route->getName()
            ];
        }, Route::getRoutes()->get());
        return view('admin/pages', ['pages' => $pages]);
    }

    public function settings()
    {
        return view('admin/settings', ['user' => Auth::user()]);
    }
}
