<?php

Route::get('/', 'PagesController@index');

Route::get('home', [
	'as' => 'home',
	'uses' => 'PagesController@index'

]);

Route::get('about', [
			'as' => 'about',
			'uses' => 'PagesController@about'
]);

Route::get('service/trade-fair-exhibition', [
			'as' => 'service.trade.index',
			'uses'=> 'ServicesController@TradeIndex'
]);

Route::post('service/register', [
			'as' => 'service.register',
			'uses' => 'ServicesController@Register'
]);

Route::get('service/trade-fair-exhibition/{post}', [
			'as' => 'service.trade.show',
			'uses' => 'ServicesController@TradeShow'
]);

Route::get('service', [
		'as' 	=> 'service.index',
		'uses' 	=> 'ServicesController@ServiceIndex'
]);

Route::post('service', [
			'as' => 'service.store',
			'uses' => 'ServicesController@ServiceStore'
]);

Route::get('service/{service}', [
			'as' => 'service.service',
			'uses' => 'ServicesController@ServiceService'
]);

Route::get('service/{service}/{category}', [
		'as' => 'service.category',
		'uses' => 'ServicesController@ServiceCategory'
]);

Route::get('service/{service}/{category}/{subcategory}', [
		'as' => 'service.subcategory',
		'uses' => 'ServicesController@ServiceSubcategory'
]);

Route::get('service/{service}/{category}/{subcategory}/{post}', [
		'as' => 'service.post',
		'uses' => 'ServicesController@ServiceShow'
]);

/*Authentication*/

Route::group(['middleware' => 'auth'], function() {

	// Admin

	Route::get('admin', 'AdminController@SupportIndex');

	Route::get('admin/support', [
		'as' 	=> 'admin.support',
		'uses' 	=> 'AdminController@SupportIndex'
	]);

	Route::get('admin/support/show={id}',[
		'as' 	=> 'admin.support.show',
		'uses' 	=> 'AdminController@SupportShow'
	]);

	Route::get('admin/register', [
		'as'   => 'admin.register.index',
		'uses' => 'AdminController@RegisterIndex'
	]);

	Route::get('admin/register/show={id}', [
		'as'   => 'admin.register.show',
		'uses' => 'AdminController@RegisterShow'
	]);

	Route::get('admin/partner', [
		'as'   => 'admin.partner.index',
		'uses' => 'AdminController@PartnerIndex'
	]);

	Route::get('admin/partner/edit={id}', [
		'as'   => 'admin.partner.edit',
		'uses' => 'AdminController@PartnerEdit'
	]);

	Route::get('admin/partner/create', [
		'as'   => 'admin.partner.create',
		'uses' => 'AdminController@PartnerCreate'
	]);

	Route::post('admin/partner', [
		'as'   => 'admin.partner.store',
		'uses' => 'AdminController@PartnerStore'
	]);

	Route::post('admin/partner/destroy', [
		'as'   => 'admin.partner.destroy',
		'uses' => 'AdminController@PartnerDestroy'
	]);

	/*------------Trade Fair Exhibition------------*/

	Route::get('admin/service/tfe', [
		'as'   => 'admin.service.tfe',
		'uses' => 'AdminController@ServiceTfe'
	]);

	Route::post('admin/service/tfe', [
		'as'   => 'admin.service.tfe.store',
		'uses' => 'AdminController@ServiceTfeStore'
	]);

	Route::get('admin/service/tfe/create', [
		'as'   => 'admin.service.tfe.create',
		'uses' => 'AdminController@ServiceTfeCreate'
	]);

	Route::post('admin/service/update={id}', [
		'as'   => 'admin.service.tfe.update',
		'uses' => 'AdminController@ServiceTfeUpdate'
	]);

	Route::get('admin/service/tfe/edit={id}', [
		'as'   => 'admin.service.tfe.edit',
		'uses' => 'AdminController@ServiceTfeEdit'
	]);

	Route::post('admin/service/tfe/destroy', [
		'as'   => 'admin.service.tfe.destroy',
		'uses' => 'AdminController@ServiceTfeDestroy'
	]);

	/*-----------------------------------------------------*/

	/*---------------------Service-------------------------*/

	Route::get('admin/service/index={id}', [
		'as'   => 'admin.service.index',
		'uses' => 'AdminController@ServiceIndex'
	]);

	Route::get('admin/service/category={id}', [
		'as'   => 'admin.service.category.index',
		'uses' => 'AdminController@ServiceCategoryIndex'
	]);

	Route::get('admin/service/category/create={id}',[
		'as'   => 'admin.service.category.create',
		'uses' => 'AdminController@ServiceCategoryCreate'
	]);

	Route::get('admin/service/category/edit={id}&c={c_id}', [
		'as'   => 'admin.service.category.edit',
		'uses' => 'AdminController@ServiceCategoryEdit'
	]);

	Route::post('admin/service/category/store', [
		'as'   => 'admin.service.category.store',
		'uses' => 'AdminController@ServiceCategoryStore'
	]);

	Route::post('admin/service/category/destroy', [
		'as'   => 'admin.service.category.destroy',
		'uses' => 'AdminController@ServiceCategoryDestroy'
	]);

	Route::get('admin/service/subcategory/create={id}', [
		'as'   => 'admin.service.subcategory.create',
		'uses' => 'AdminController@ServiceSubcategoryCreate'
	]);

	Route::get('admin/service/subcategory/edit={id}&s={s_id}', [
		'as'   => 'admin.service.subcategory.edit',
		'uses' => 'AdminController@ServiceSubcategoryEdit'
	]);

	Route::post('admin/service/subcategory/store', [
		'as'   => 'admin.service.subcategory.store',
		'uses' => 'AdminController@ServiceSubcategoryStore'
	]);

	Route::get('admin/service/post={id}&view={view}', [
		'as'   => 'admin.service.post.index',
		'uses' => 'AdminController@ServicePostIndex'
	]);

	Route::get('admin/service/post/create={id}', [
		'as'   => 'admin.service.post.create',
		'uses' => 'AdminController@ServicePostCreate'
	]);

	Route::get('admin/service/post/edit={id}&service={s_id}', [
		'as'   => 'admin.service.post.edit',
		'uses' => 'AdminController@ServicePostEdit'
	]);

	Route::post('admin/service/post/store', [
		'as'   => 'admin.service.post.store',
		'uses' => 'AdminController@ServicePostStore'
	]);

	Route::post('admin/service/post/destroy', [
		'as'   => 'admin.service.post.destroy',
		'uses' => 'AdminController@ServicePostDestroy'
	]);

	/*-----------------------------------------------------*/

	// Upload
	Route::get('upload', [
		'as' 	=> 'upload.index',
		'uses'	=> 'ServiceFilemanager@Index'
	]);

	Route::post('upload/store', [
		'as'	=> 'upload.store',
		'uses'	=> 'ServiceFilemanager@Store'
	]);

	Route::post('upload/files', [
		'as'   => 'upload.files',
		'uses' => 'ServiceFilemanager@ListFile'
	]);

	Route::post('upload/destroy', [
		'as'	=> 'upload.destroy',
		'uses'	=> 'ServiceFilemanager@Destroy'
	]);

});

Route::get('admin/login', [
	'as'   => 'admin.login',
	'uses' => 'Auth\AuthController@getLogin'
]);

Route::post('admin/login', [
	'as'   => 'admin.login.post',
	'uses' => 'Auth\AuthController@postLogin'
]);

Route::get('admin/logout', [
	'as'   => 'admin.logout',
	'uses' => 'Auth\AuthController@getLogout' 
]);

