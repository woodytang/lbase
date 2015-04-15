<?php namespace App\Providers;

use App\Models\Menu\Menuset;
use Illuminate\Support\ServiceProvider;
use Settings;
use View;

class ViewComposerServiceProvider extends ServiceProvider {


    /**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->getMainMenu();


	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

    private function getMainMenu()
    {
        view()->composer('*',function(){

            //非常重要！！使用Eloquent来处理数据关系后，baum的默认排序会被覆盖，要用orderBy('lft','asc')重新排序
            $menus = Menuset::findOrFail(14)->menus()->where('parent_id',null)->orderBy('lft','asc')->get();



            $mega1 = Menuset::findOrFail(15)->menus()->get();
            $mega2 = Menuset::findOrFail(16)->menus()->get();
            $mega3 = Menuset::findOrFail(17)->menus()->get();
            $mega4 = Menuset::findOrFail(18)->menus()->get();

            $options = Settings::get('options');

            View::share(['menus'=> $menus,'mega1'=>$mega1,'mega2'=>$mega2,'mega3'=>$mega3,'mega4'=>$mega4,'options'=> $options]);

        });

    }

}
