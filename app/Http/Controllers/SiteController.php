<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    protected $p_rep; // объект класса портфолио репозиторий
    protected $s_rep; // объект класса слайдер репозиторий
    protected $a_rep;// объект класса артикл репозиторий
    protected $m_rep;// объект класса меню репозиторий и т.д.
    protected $template; // имя шаблона для отобр инф на конкр стр

    protected $vars = [];

    protected $contentRightBar = FALSE;
    protected $contentLeftBar = FALSE;

    protected $bar = FALSE;

    public function __construct(){

    }

    protected function renderOutput(){
        return view($this->template)->with($this->vars);
    }
}
