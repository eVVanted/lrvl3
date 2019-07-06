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
    protected $c_rep;// объект класса меню репозиторий и т.д.
    protected $template; // имя шаблона для отобр инф на конкр стр

    protected $keywords;
    protected $meta_desc;
    protected $title;

    protected $vars = [];

    protected $contentRightBar = FALSE;
    protected $contentLeftBar = FALSE;

    protected $bar = 'no';

    public function __construct(MenusRepository $m_rep){

        $this->m_rep = $m_rep;
    }

    protected function renderOutput(){

        $menu = $this->getMenu();
//        dd($menu);
        $navigation = view(env('THEME').'.navigation')->with('menu',$menu)->render();
//        dd($navigation);
        $this->vars = array_add($this->vars,'navigation',$navigation);
//        dd($this->vars);

        if($this->contentRightBar){
            $rightBar = view(env('THEME').'.rightBar')->with('content_rightBar',$this->contentRightBar)->render();
            $this->vars = array_add($this->vars,'rightBar',$rightBar);
        }

        $this->vars = array_add($this->vars,'bar',$this->bar);

        $this->vars = array_add($this->vars,'keywords',$this->keywords);
        $this->vars = array_add($this->vars,'meta_desc',$this->meta_desc);
        $this->vars = array_add($this->vars,'title',$this->title);


        $footer = view(env('THEME').'.footer')->render();
        $this->vars = array_add($this->vars,'footer',$footer);


        return view($this->template)->with($this->vars);
    }

    protected function getMenu(){
        $menu =$this->m_rep->get();
        $mBuilder = \Menu::make('MyNav', function($m) use($menu){
            foreach($menu as $item){
                if($item->parent == 0){
                    $m->add($item->title,$item->path)->id($item->id);
                }else{
                    if($m->find($item->parent)){
                        $m->find($item->parent)->add($item->title,$item->path)->id($item->id);
                    }
                }
            }
        });

//        dd($mBuilder);

        return $mBuilder;
    }
}
