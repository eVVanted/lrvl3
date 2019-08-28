<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Category;
use Corp\Filter;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\MenusRepository;
use Corp\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Menu;

class MenusController extends AdminController
{
    protected $m_rep;

    public function __construct(MenusRepository $m_rep, ArticlesRepository $a_rep, PortfoliosRepository $p_rep)
    {
        parent::__construct();

        $this->middleware('can:VIEW_ADMIN_MENU');

        $this->m_rep = $m_rep;
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;

        $this->template = env('THEME').'.admin.menus';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $menu = $this->getMenus();
//        dd($menu);

        $this->content = view(env('THEME').'.admin.menus_content')->with('menus',$menu)->render();

        return $this->renderOutput();
    }

    public function getMenus(){

        $menu = $this->m_rep->get();
        if($menu->isEmpty()){
            return false;
        }

        return Menu::make('forMenuPart', function($m) use ($menu){
            foreach($menu as $item){
                if($item->parent==0){
                    $m->add($item->title, $item->path)->id($item->id);
                } else {
                    if($m->find($item->parent)){
                        $m->find($item->parent)->add($item->title, $item->path)->id($item->id);
                    }
                }
            }
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->title = 'Новый пункт меню';
        $tmp = $this->getMenus()->roots();
//        dd($menus);
        $menus = $tmp->reduce(function($returnMenus, $menu){
            $returnMenus[$menu->id] = $menu->title;
            return $returnMenus;
        }, ['0'=>'Родительский пункт меню']); // посмотреть описание метода reduce

//        dd($menus);
        $categories = Category::select(['title', 'alias','parent_id','id'])->get();
//        dd($categories);
        $list = array();
        $list = array_add($list,'0','Не используется');
        $list = array_add($list,'parent','Раздел Блог');

        foreach($categories as $category){
            if($category->parent_id == 0){
                $list[$category->title] = array();
            } else {
                $list[$categories->where('id', $category->parent_id)->first()->title][$category->alias]= $category->title;
            }
        }

//        dd($list);

        $articles_tmp = $this->a_rep->get(['id','title','alias']);

        $articles = $articles_tmp->reduce(function($returnArticles, $article){
            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;
        }, []);
//        dd($articles);

        $filters = Filter::select('id','title','alias')->get()->reduce(function($returnFilters, $filter){
            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;
        }, ['parent'=>'Раздел портфолио']);
//        dd($filters);

        $portfolios= $this->p_rep->get(['id','title','alias'])->reduce(function($returnPortfolios, $portfolio){
            $returnPortfolios[$portfolio->alias] = $portfolio->title;
            return $returnPortfolios;
        }, []);

//        dd($portfolios);

        $this->content= view(env('THEME').'.admin.menus_create_content')->with(['menus'=>$menus, 'categories'=>$list, 'articles'=>$articles,'filters'=>$filters,'portfolios'=>$portfolios])->render();

        return $this->renderOutput();


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
