<?php
	namespace App;
	use Illuminate\Config\Repository;
	use Illuminate\Events\Dispatcher;
	use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
	use \JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
	use \JeroenNoten\LaravelAdminLte\Menu\Builder;
	use Illuminate\Support\Facades\Auth;

	class MenuFilter implements FilterInterface{
		public function transform($item, Builder $builder)
		{
			// TODO: Implement transform() method.
			$user = Auth::user();
			if($user->hasRole('admin')){
				return $item;
			}elseif ($user->hasRole('editor')){
				return $item;
				//dd($menu_builder);
			}
		}
	}
