<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

	public function boot()
	{

		view()->composer(
			'partials.head', 'App\Http\ViewComposers\NavComposer'
		);

		view()->composer(
			'partials.sidebar', 'App\Http\ViewComposers\SidebarComposer'
		);

		view()->composer(
			'partials.sidebarService', 'App\Http\ViewComposers\SidebarServiceComposer'
		);

		view()->composer(
			'admin.layouts.nav', 'App\Http\ViewComposers\NavAdminComposer'
		);

	}

	public function register()
	{

		//

	}

}