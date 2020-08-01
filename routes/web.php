<?php
Route::group(array('middleware' => 'web'), function(){
	 Route::get('my-account', ['as' => 'my_account','uses' => 'Auth\LoginController@account']);
	 Route::post('login',['as' => 'login','uses' => 'Auth\LoginController@login']);
	  Route::post('signup',['as' => 'signup','uses' => 'Auth\RegisterController@signUp']);
     Route::post('check-email-signup',['as' => 'check_email_signup','uses' => 'Auth\RegisterController@checkEmailSignup']);
     Route::post('password-email-verification-check', ['as' => 'password_email_verification_check','uses' => 'Auth\ForgotPasswordController@PasswoprdEmailVerificationCheck']);
     Route::post('forget-pass-reset-link', ['as' => 'forget_pass_reset_link',
            'uses' => 'Auth\ForgotPasswordController@ForgetPasswordGenerateLink']);
     Route::get('user-password-reset', ['as' => 'user_password_reset','uses' => 'Auth\ForgotPasswordController@ResetPass']);
    Route::post('create-reset-password', ['as' => 'create_reset_password','uses' => 'Auth\ForgotPasswordController@CreateNewpassword']);


});
Route::group(array('namespace'=>'Auth', 'middleware' => 'auth'), function(){
    Route::post('user/logout',['as' => 'user_logout','uses' => 'LoginController@logout']);
});
Route::group(array('namespace'=>'Front', 'middleware' => 'web'), function(){
    Route::get('/',array('as' => 'home','uses' => 'HomeController@index'));
    Route::post('new-arrival-product-search',['as' => 'new_arrival_product_search','uses' => 'HomeController@new_arrival_product_search']);
// start product
    Route::get('product/{product_alias}/{product_code}',['as' => 'product_details','uses' => 'ProductController@product_details']);
    Route::get('product-subcategory-search',['as' => 'product_subcategory_search','uses' => 'ProductController@product_subcategory_serach']);
    Route::get('product-brand-search',['as' => 'product_brand_search','uses' => 'ProductController@product_brand_serach']);
    Route::get('product-discount-search',['as' => 'product_discount_search','uses' => 'ProductController@product_discount_serach']);
    Route::get('product-price-search',['as' => 'product_price_search','uses' => 'ProductController@product_price_serach']);
    Route::post('product-delivered-checked',['as' => 'product_delivered_checked','uses' => 'ProductController@DeliveryStatus']);
//start contact
    Route::post('check-subscribe-email',['as' => 'check_subscribe_email','uses' => 'ContactUsController@checkSubEmail']);
    Route::post('newsletter',['as' => 'newsletter','uses' => 'ContactUsController@newsletter']);
    Route::get('contact-us',['as' => 'contact_us','uses' => 'ContactUsController@contact_us']);
    Route::post('save-contact-us',['as' => 'save_contact_us','uses' => 'ContactUsController@save_contact_us']);
//start page
    Route::get('about-us',['as' => 'about_us','uses' => 'PagesController@about_us']);
    Route::get('privacy-policy',['as' => 'privacy_policy','uses' => 'PagesController@privacy_policy']);
    Route::get('our-store',['as' => 'our_store','uses' => 'PagesController@our_store']);

// start user section
    Route::get('activation/{hash_number}',['as' => 'activation','uses' => 'UserController@activation']);
    Route::post('resend-email-verification',['as' => 'resend_email_verification','uses' => 'UserController@resendEmail']);
    Route::post('resend-email-verification-check', ['as' => 'resend_email_verification_check','uses' => 'UserController@ResendEmailVerificationCheck']);
    Route::get('my-profile',['as' => 'my_profile','uses' => 'UserController@MyProfile']);
    Route::post('profile-update',['as' => 'profile_update','uses' => 'UserController@ProfileUpdate']);
    Route::get('user-address',['as' => 'user_address','uses' => 'UserController@UserAddress']);
    Route::get('add-user-address',['as' => 'add_user_address','uses' => 'UserController@AddUserAddress']);
    Route::post('add-address',['as' => 'add_address','uses' => 'UserController@AddAddress']);
    Route::get('user-change-password',['as' => 'user_change_password','uses' => 'UserController@ChangePassword']);
    Route::post('password-update',['as' => 'password_update','uses' => 'UserController@password_update']);
    Route::post('fetch-state',['as' => 'fetch_state','uses' => 'UserController@FetchState']);
    Route::post('user-address-delete',['as' => 'user_address_delete','uses' => 'UserController@user_address_delete']);
    Route::get('edit-user-address',['as' => 'edit_user_address','uses' => 'UserController@EditUserAddress']);
    Route::post('update-user-address',['as' => 'update_user_address','uses' => 'UserController@UpdateUserAddress']);

// start wishlist
   Route::get('wishlist',['as' => 'wishlist','uses' => 'WishlistController@Wishlist']);
   Route::post('add-to-wishlist',['as' => 'add_to_wishlist','uses' => 'WishlistController@AddWishlist']);
   Route::post('wishlist-item-delete',['as' => 'wishlist_item_delete','uses' => 'WishlistController@WishlistItemDelete']);
   Route::post('quantity-update',['as' => 'quantity_update','uses' => 'WishlistController@QuantityUpdate'
    ]);
   Route::post('wishlist-to-add-to-cart',['as' => 'wishlist_to_add_to_cart','uses' => 'WishlistController@WishlistToAddCart']);

// cart start
   Route::post('add-to-cart',['as' => 'add_to_cart','uses' => 'CartController@AddCart']);
   Route::post('cart-item-delete',['as' => 'cart_item_delete','uses' => 'CartController@CartItemDelete']);
   Route::post('cart-quantity-update',['as' => 'cart_quantity_update','uses' => 'CartController@CartQuantityUpdate'
    ]);

// checkout route sectioon
  Route::get('checkout',['as' => 'checkout','uses' => 'CheckoutController@Checkout']);
  Route::get('checkout-process',['as' => 'checkout_processs','uses' => 'CheckoutController@CheckoutProcess']);
  Route::post('order-success',['as' => 'order_success','uses' => 'CheckoutController@order_success']);
  Route::get('order-cancel',['as' => 'order_cancel','uses' => 'CheckoutController@order_cancel']);
  Route::get('paypal',['as' => 'paypal','uses' => 'CheckoutController@paypal']);

    // My Order Route
    Route::get('my-order',['as' => 'myOrder','uses' => 'OrderController@myOrder']);
    //Route::get('checkout-process',['as' => 'checkout_processs','uses' => 'CheckoutController@CheckoutProcess']);
    //Route::post('order-success',['as' => 'order_success','uses' => 'CheckoutController@order_success']);
    //Route::get('order-cancel',['as' => 'order_cancel','uses' => 'CheckoutController@order_cancel']);
    //Route::get('paypal',['as' => 'paypal','uses' => 'CheckoutController@paypal']);



});

//Admin
Route::get('/admin', ['as' => 'admin_login', 'uses' => 'Admin\LoginController@index']);
Route::get('/admin-login', ['as' => 'admin_login', 'uses' => 'Admin\LoginController@index']);
Route::get('admin/login', ['as' => 'adminlogin', 'uses' => 'Admin\LoginController@Check_login']);
Route::post('admin-forgot-password', ['as' => 'admin-forgot-password', 'uses' => 'Admin\LoginController@sendResetLinkEmail']);
Route::get('admin-password/reset/{token}', 'Admin\LoginController@showResetForm');
  Route::post('admin-password/reset-pass', 'Admin\LoginController@postResetPassword');

//front only alias route
Route::group(array('namespace'=>'Front', 'middleware' => 'web'), function(){
    Route::get('{alias}',['as' => 'cat_sub_cat_product','uses' => 'ProductController@cat_sub_cat_product']);
});

