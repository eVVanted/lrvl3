<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\MenusRepository;
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

    public function __construct(MenusRepository $m_rep){

        $this->m_rep = $m_rep;
    }

    protected function renderOutput(){

        $menu = $this->getMenu();

        $navigation = view(env('THEME').'.navigation')->render();
        $this->vars = array_add($this->vars,'navigation',$navigation);
        return view($this->template)->with($this->vars);
    }

    protected function getMenu(){
        $menu =$this->m_rep->get();

        return $menu;
    }
}
