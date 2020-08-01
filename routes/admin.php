<?php
Route::group(['as'=>'admin::','prefix'=>'admin','middleware' => ['web','AdminMiddleware']], function () {
    Route::get('admin-logout', ['as' => 'logout', 'uses' => 'Admin\LoginController@logout']);
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'Admin\Dashboard\DashboardController@dashboard']);
    Route::get('/profile/{id}', ['as' => 'profile', 'uses' => 'Admin\Profile\ProfileController@index']);
    Route::post('profile-update',['as' => 'profile_update','uses' => 'Admin\Profile\ProfileController@profile_update']);
    Route::get('changePassForm', ['as' => 'changePassForm', 'uses' => 'Admin\PasswordChangeController@changePassForm']);
    Route::post('ChangePass', ['as' => 'ChangePass', 'uses' => 'Admin\PasswordChangeController@ChangePass']);

    /* administartor route */
    Route::get('manage-admin', ['as' => 'manage_admin','uses' => 'Admin\AdministratorController@index']);
    Route::get('add-admin', ['as' => 'add_admin','uses' => 'Admin\AdministratorController@add']);
    Route::post('save-admin', ['as' => 'save_admin','uses' => 'Admin\AdministratorController@save']);
    Route::post('admin-status', ['as' => 'admin_status','uses' => 'Admin\AdministratorController@status']);
    Route::get('/delete-admin/{id}', ['as' => 'delete_admin','uses' => 'Admin\AdministratorController@delete']);

    /* user route */
    Route::get('manage-user', ['as' => 'manage_user','uses' => 'Admin\User\UserController@index']);
    Route::post('user-status', ['as' => 'user_status','uses' => 'Admin\User\UserController@status']);
    Route::get('/delete-user/{id}', ['as' => 'delete_user','uses' => 'Admin\User\UserController@delete']);

    /* Banner route */
    Route::get('manage-banner', ['as' => 'manage_banner','uses' => 'Admin\Banner\BannerController@index']);
    Route::get('add-banner', ['as' => 'add_banner','uses' => 'Admin\Banner\BannerController@add']);
    Route::post('save-banner', ['as' => 'save_banner','uses' => 'Admin\Banner\BannerController@save']);
    Route::get('/edit-banner/{id}', ['as' => 'edit_banner', 'uses' => 'Admin\Banner\BannerController@edit']);
    Route::post('/update-banner/{id}', ['as' => 'update_banner','uses' => 'Admin\Banner\BannerController@update']);
    Route::post('banner-status', ['as' => 'banner_status','uses' => 'Admin\Banner\BannerController@status']);
    Route::get('/delete-banner/{id}', ['as' => 'delete_banner','uses' => 'Admin\Banner\BannerController@delete']);

    /* categories route */
    Route::get('manage-category', ['as' => 'manage_category','uses' => 'Admin\Category\CategoryController@index']);
    Route::get('add-category', ['as' => 'add_category','uses' => 'Admin\Category\CategoryController@add']);
    Route::post('save-category', ['as' => 'save_category','uses' => 'Admin\Category\CategoryController@save']);
    Route::get('/edit-category/{id}', ['as' => 'edit_category', 'uses' => 'Admin\Category\CategoryController@edit']);
    Route::post('/update-category/{id}', ['as' => 'update_category','uses' => 'Admin\Category\CategoryController@update']);
    Route::post('banner-category', ['as' => 'category_status','uses' => 'Admin\Category\CategoryController@status']);
    Route::get('/delete-category/{id}', ['as' => 'delete_category','uses' => 'Admin\Category\CategoryController@delete']);

     /* Sub categories route */
    Route::get('manage-sub-category', ['as' => 'manage_subcategory','uses' => 'Admin\Subcategory\SubCategoryController@index']);
    Route::get('add-sub-category', ['as' => 'add_subcategory','uses' => 'Admin\Subcategory\SubCategoryController@add']);
    Route::post('save-sub-category', ['as' => 'save_subcategory','uses' => 'Admin\Subcategory\SubCategoryController@save']);
    Route::get('/edit-sub-category/{id}', ['as' => 'edit_subcategory', 'uses' => 'Admin\Subcategory\SubCategoryController@edit']);
    Route::post('/update-sub-category/{id}', ['as' => 'update_subcategory','uses' => 'Admin\Subcategory\SubCategoryController@update']);
    Route::post('banner-sub-category', ['as' => 'subcategory_status','uses' => 'Admin\Subcategory\SubCategoryController@status']);
    Route::get('/delete-sub-category/{id}', ['as' => 'delete_subcategory','uses' => 'Admin\Subcategory\SubCategoryController@delete']);

    /* Brand route */
    Route::get('manage-brand', ['as' => 'manage_brand','uses' => 'Admin\Brand\BrandController@index']);
    Route::get('add-brand', ['as' => 'add_brand','uses' => 'Admin\Brand\BrandController@add']);
    Route::post('save-brand', ['as' => 'save_brand','uses' => 'Admin\Brand\BrandController@save']);
    Route::get('/edit-brand/{id}', ['as' => 'edit_brand', 'uses' => 'Admin\Brand\BrandController@edit']);
    Route::post('/update-brand/{id}', ['as' => 'update_brand','uses' => 'Admin\Brand\BrandController@update']);
    Route::post('brand-status', ['as' => 'brand_status','uses' => 'Admin\Brand\BrandController@status']);
    Route::get('/delete-brand/{id}', ['as' => 'delete_brand','uses' => 'Admin\Brand\BrandController@delete']);

    /* Page route */
    Route::get('manage-page', ['as' => 'manage_page','uses' => 'Admin\Page\PageController@index']);
    Route::get('add-page', ['as' => 'add_page','uses' => 'Admin\Page\PageController@add']);
    Route::post('save-page', ['as' => 'save_page','uses' => 'Admin\Page\PageController@save']);
    Route::get('/edit-page/{id}', ['as' => 'edit_page', 'uses' => 'Admin\Page\PageController@edit']);
    Route::get('/view-page/{id}', ['as' => 'view_page', 'uses' => 'Admin\Page\PageController@view']);
    Route::post('/update-page/{id}', ['as' => 'update_page','uses' => 'Admin\Page\PageController@update']);
    Route::get('/delete-page/{id}', ['as' => 'delete_page','uses' => 'Admin\Page\PageController@delete']);

    /* Size Route */
    Route::get('manage-size', ['as' => 'manage_size','uses' => 'Admin\Size\SizeController@index']);
    Route::get('add-size', ['as' => 'add_size','uses' => 'Admin\Size\SizeController@add']);
    Route::post('save-size', ['as' => 'save_size','uses' => 'Admin\Size\SizeController@save']);
    Route::get('/edit-size/{id}', ['as' => 'edit_size', 'uses' => 'Admin\Size\SizeController@edit']);
    Route::post('/update-size/{id}', ['as' => 'update_size','uses' => 'Admin\Size\SizeController@update']);
     Route::post('size-status', ['as' => 'size_status','uses' => 'Admin\Size\SizeController@status']);
    Route::get('/delete-size/{id}', ['as' => 'delete_size','uses' => 'Admin\Size\SizeController@delete']);

    /* Site Setting */
    Route::get('manage-setting', ['as' => 'manage_setting','uses' => 'Admin\Setting\SettingController@index']);
    Route::get('/edit-setting/{id}', ['as' => 'edit_setting', 'uses' => 'Admin\Setting\SettingController@edit']);
    Route::post('/update-setting/{id}', ['as' => 'update_setting','uses' => 'Admin\Setting\SettingController@update']);

    /* Product Route */
    Route::get('manage-product', ['as' => 'manage_product','uses' => 'Admin\Product\ProductController@index']);
    Route::get('add-product', ['as' => 'add_product','uses' => 'Admin\Product\ProductController@add']);
    Route::post('save-product', ['as' => 'save_product','uses' => 'Admin\Product\ProductController@save']);
    Route::get('/edit-product/{id}', ['as' => 'edit_product', 'uses' => 'Admin\Product\ProductController@edit']);
    Route::post('/update-product/{id}', ['as' => 'update_product','uses' => 'Admin\Product\ProductController@update']);
    Route::post('product-status', ['as' => 'product_status','uses' => 'Admin\Product\ProductController@status']);
    Route::get('/delete-product/{id}', ['as' => 'delete_product','uses' => 'Admin\Product\ProductController@delete']);
    Route::post('fetch-category-subcategory', ['as' => 'fetch_category_subcategory','uses' => 'Admin\Product\ProductController@fetch']);
    Route::post('product-image-default', ['as' => 'product_image_default','uses' => 'Admin\Product\ProductController@image_default']);
    Route::post('product-image-delete', ['as' => 'product_image_delete','uses' => 'Admin\Product\ProductController@ProductImageDelete']);

    // testimonial
    Route::get('manage-order', ['as' => 'manage_order','uses' => 'Admin\Product\OrderController@index']);
    Route::get('/edit-order/{id}', ['as' => 'edit_order', 'uses' => 'Admin\Product\OrderController@edit']);
    Route::get('/print-order/{id?}', ['as' => 'print_order', 'uses' => 'Admin\Product\OrderController@print_order']);
    Route::post('/update-order/{id}', ['as' => 'update_order','uses' => 'Admin\Product\OrderController@update']);


    // testimonial
     Route::get('manage-testimonial', ['as' => 'manage_testimonial','uses' => 'Admin\Testimonial\TestimonialController@index']);
    Route::get('add-testimonial', ['as' => 'add_testimonial','uses' => 'Admin\Testimonial\TestimonialController@add']);
    Route::post('save-testimonial', ['as' => 'save_testimonial','uses' => 'Admin\Testimonial\TestimonialController@save']);
    Route::get('/edit-testimonial/{id}', ['as' => 'edit_testimonial', 'uses' => 'Admin\Testimonial\TestimonialController@edit']);
    Route::post('/update-testimonial/{id}', ['as' => 'update_testimonial','uses' => 'Admin\Testimonial\TestimonialController@update']);
    Route::post('testimonial-status', ['as' => 'testimonial_status','uses' => 'Admin\Testimonial\TestimonialController@status']);
    Route::get('/delete-testimonial/{id}', ['as' => 'delete_testimonial','uses' => 'Admin\Testimonial\TestimonialController@delete']);

    /* Delivery Charge */
    Route::get('manage-delivery-charge', ['as' => 'manageDeliveryCharge','uses' => 'Admin\Delivery\DeliveryController@index']);
    Route::get('/edit-delivery-charge/{id}', ['as' => 'editDeliveryCharge', 'uses' => 'Admin\Delivery\DeliveryController@edit']);
    Route::post('/update-delivery-charge/{id}', ['as' => 'updateDeliveryCharge','uses' => 'Admin\Delivery\DeliveryController@update']);


    /* Opening Time */
    Route::get('manage-opening-time', ['as' => 'OpeningTime','uses' => 'Admin\OpeningTime\OpeningTimeController@index']);
    Route::post('opening-time-save', ['as' => 'openingTimeSave','uses' => 'Admin\OpeningTime\OpeningTimeController@openingTimeSave']);

    /* Contact us route */
    Route::get('manage-contact', ['as' => 'manageContact','uses' => 'Admin\Contact\ContactController@index']);
    Route::get('/edit-contact/{id}', ['as' => 'edit_contact', 'uses' => 'Admin\Contact\ContactController@edit']);
    Route::get('/delete-contact/{id}', ['as' => 'delete_contact','uses' => 'Admin\Contact\ContactController@delete']);



});
