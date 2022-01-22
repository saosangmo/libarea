<?php

namespace Modules\Search;

use Hleb\Scheme\App\Controllers\MainController;
use Hleb\Constructor\Handlers\Request;
use Modules\Search\Helper;
use UserData, Tpl, Translate, Config;

use Wamania\Snowball\StemmerFactory; 
 
class SearchController extends MainController
{

    protected $limit = 100;
    
    private $user;
    
    public function __construct()
    {
        $this->user  = UserData::get();
    }

    public function index()
    {  
        $page   = Request::getInt('page');
        $page   = $page == 0 ? 1 : $page;
        $query  = Request::getPost('q');
        $type   = Config::get('general.search') == false ? 'mysql' : 'server';
 
        if (Request::getPost()) {
            if ($query == '') {
                addMsg(Translate::get('empty request'), 'error');
                redirect(getUrlByName('search'));
            } 
 
            $stem   = self::stemmer($query);

            $result = self::search($page, $this->limit, $stem, $type);
    
            $count  = SearchModel::getSearchCount($stem);
        }
        
        $result     = $result ?? null;
        $quantity   = $count ?? null;
        
        return view(
            '/view/default/search',
            [
                'meta'  => meta($m = [], Translate::get('search')),
                'user'  => $this->user,
                'data'  => [
                    'result'        => $result ? Helper::handler($result) : null,
                    'type'          => 'admin',
                    'sheet'         => 'admin',
                    'query'         => $query ?? null,
                    'count'         => $quantity,
                    'pagesCount'    => ceil($quantity / $this->limit),
                    'pNum'          => $page,
                    'tags'          => SearchModel::getSearchTags($query, $type, 10),
                ]
            ]
        );
    }
 
    public static function stemmer($query)
    {
            require_once __DIR__ . '/vendor/autoload.php';
            
            if (Config::get('general.lang') == 'ru') {
                $stemmer    = StemmerFactory::create('ru');
                $stemmer    = StemmerFactory::create ('russian');
            } else {
                $stemmer    = StemmerFactory::create('en');
                $stemmer    = StemmerFactory::create ('english'); 
            }

            return $stemmer->stem($query);
        
    }
 
    public static function search($page, $limit, $stem, $type)
    {
        if ($type == 'mysql') {
            return SearchModel::getSearch($page, $limit, $stem);
        }

        return SearchModel::getSearchPostServer($stem, 50);
    }
    
    public function api()
    {

        $type   = Config::get('general.search') == false ? 'mysql' : 'server';
        $topics = SearchModel::getSearchTags(Request::getPost('q'), $type, 5);

        if ($type == 'mysql') {
            $posts = SearchModel::getSearch(1, 5, Request::getPost('q'));
            $result = array_merge($topics, $posts);

            return json_encode($result, JSON_PRETTY_PRINT);
        }

        $posts = SearchModel::getSearchPostServer(Request::getPost('q'), 5);
        $result = array_merge($topics, $posts);

        return json_encode($result, JSON_PRETTY_PRINT);
    }
}