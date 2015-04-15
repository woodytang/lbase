<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CrawlerRequest;
use App\Models\Category\Category;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use Session;

class CrawlerController extends Controller {

    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client){


        $this->client = $client;
    }

    public function getGenerate_from_url(){

        
        //Redirect的参数是存session里的；
        $id = Session::get('id');


        return redirect('/admin/posts/'.$id.'/edit');

    }

    public function postGenerate_from_url(CrawlerRequest $request)
    {

        /*dd($request->all());*/
        extract($request->all());

    /*    $url = 'http://ofcss.com/2015/02/12/laravel-5-directory-structure-and-namespace.html';
        $rule1 = '.entry-header > h1.entry-title';
        $rule2 = 'div.entry-content > p';*/

        session($request->all());

        //dd(session('url'));

        $grabbed = $this->getRemote($url,$rule1,$rule2);



        $categories = Category::all();
        return view('admin.posts.generate_from_url', compact('categories', 'grabbed'));


    }


    public function getRemote($url,$rule1,$rule2){


        $response = $this->client->get($url);

        $response = $response->getBody()->read(99999);

        //dd($response);

        return $this->getDomtree($response,$rule1,$rule2);

    }

    public function getDomtree($html,$rule1,$rule2){


        $crawler = new Crawler('');
        //解决乱码的临时办法
        $crawler->addHtmlContent($html, 'UTF-8');

        $title = $crawler->filter($rule1)->text();
        $content = $crawler->filter($rule2)->html();

        //$title = '<p>'.$title.'</p>';
        $content = strip_tags($content,'<p><pre>');



        $result = ['title' => $title, 'content' => $content];


        return $result;


    }


}
