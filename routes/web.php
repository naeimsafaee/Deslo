<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//pages
Route::get('/' , 'Client\Pages\HomeController')->name('home');
Route::post('/main_form' , 'Client\Pages\HomeController@main_form')->name('main_form');

//search
Route::get('/search' , 'Client\Pages\SearchController')->name('search');



//product
Route::get('product/{slug}' , 'Client\Product\ProductController')->name('single_product');




//blogs
Route::get('/blog' , 'Client\Blogs\BlogController')->name('blogs');
Route::get('/blog/{slug}' , 'Client\Blogs\BlogController@single_blog')->name('single_blog');

//tags
Route::get('/tag' , 'Client\Tags\TagController')->name('tags');

//artist
Route::get('/artists' , 'Client\Artists\ArtistController')->name('Artist');


Route::get('/installment' , 'Client\Pages\InstallmentController')->name('installment');
Route::get('/comparison/{id}' , 'Client\Pages\ComparisonController@create')->name('add_comparison');
Route::get('/comparison' , 'Client\Pages\ComparisonController')->name('comparison');
Route::get('/delete_comparison/{id}' , 'Client\Pages\ComparisonController@delete')->name('delete_comparison');

//music
Route::get('/artist/{slug}' , 'Client\music\ArtistController')->name('artist');

Route::get('/music_archive/{category_id?}' , 'Client\music\AllMusicController')->name('music_archive');
Route::get('/music' , 'Client\music\MusicController')->name('all_music');
Route::get('/music/{id}' , 'Client\music\MusicController@category')->name('all_music_category');
Route::post('/music/submit_form' , 'Client\music\SingleMusicController@submit')->name('submit_music');

Route::get('/single-music/{slug}' , 'Client\music\SingleMusicController')->name('single_music');
Route::get('/podcast/{slug}' , 'Client\music\SinglePodcastController')->name('podcast');

Route::get('/albums' , 'Client\music\AlbumController')->name('all_album');
Route::get('/albums/{id}' , 'Client\music\AlbumController@category')->name('all_album_category');
Route::get('/album/{slug}' , 'Client\music\SingleAlbumController')->name('album');
Route::post('/album/submit_form' , 'Client\music\SingleAlbumController@submit')->name('submit_album');


Route::post('/podcast/submit_form' , 'Client\music\SinglePodcastController@submit')->name('submit_podcast');
Route::get('/podcast_archive/{category_id?}' , 'Client\music\SinglePodcastController@all')->name('all_podcast');


Route::get('/video_pay/{video_id}' , 'Client\music\PayVideoController@pay')->middleware('auth.client')->name('pay_video');
Route::get('/pay_video_callback' , 'Client\music\PayVideoController@callback')->middleware('auth.client')->name('pay_video_callback');
Route::post('/video/submit_form' , 'Client\music\SingleVideoController@submit')->name('submit_video');
Route::get('/video/{slug}' , 'Client\music\SingleVideoController')->name('video');
Route::get('/video_archive/{category_id?}' , 'Client\music\SingleVideoController@all')->name('all_video');



Route::group(['middleware' => 'auth.client'], function () {

    Route::get('/buy_podcast/{id}' , 'Client\music\SinglePodcastController@buy_podcast')->name('buy_podcast');
    Route::get('/call_back_podcast' , 'Client\music\SinglePodcastController@callback')->name('call_back_buy_podcast');

    Route::get('/buy_album/{id}' , 'Client\music\SingleAlbumController@buy_album')->name('buy_album');
    Route::get('/call_back_album' , 'Client\music\SingleAlbumController@callback')->name('call_back_buy_album');


    Route::get('/buy_music/{id}' , 'Client\music\SingleMusicController@buy_music')->name('buy_music');
    Route::get('/call_back_music' , 'Client\music\SingleMusicController@callback')->name('call_back_buy_music');

    Route::get('/buy_album_with_member_ship/{id}' , 'Client\music\SingleAlbumController@buy_album_with_member_ship')->name('buy_album_with_member_ship');
    Route::get('/buy_podcast_with_member_ship/{id}' , 'Client\music\SingleAlbumController@buy_podcast_with_member_ship')->name('buy_podcast_with_member_ship');

    Route::get('/buy_member_ship/{id}' , 'Client\Profile\MembershipController@buy_member_ship')->name('buy_member_ship');
    Route::get('/callback/membership' , 'Client\Profile\MembershipController@callback')->name('callback_membership');

    Route::get('/callback/product' , 'Client\Cart\CartController@callback')->name('callback_product');

    Route::get('/member_ship_is_gone' , function(){
        return "member_ship_is_gone";
    })->name('member_ship_is_gone');

    Route::get('product/comment/{id}' , 'Client\Product\CommentRelplyController')->name('comment_reply');
    Route::post('product/comment/submit' , 'Client\Product\CommentRelplyController@submit')->name('comment_submit');
    Route::post('product/question/submit' , 'Client\Product\QuestionController')->name('question_submit');
    Route::post('product/question/reply/{q_id}' , 'Client\Product\QuestionController@reply')->name('question_reply');
    Route::get('product/question/like/{q_id}' , 'Client\Product\QuestionController@like')->name('like_submit');
    Route::get('product/question/dis_like/{q_id}' , 'Client\Product\QuestionController@dis_like')->name('dis_like_submit');

    //profile
    Route::get('/profile' , 'Auth\ProfileController')->name('profile');
    Route::get('/profile/address' , 'Client\Profile\AddressController')->name('profile_address');
    Route::get('/profile/address/{address}/delete' , 'Client\Profile\AddressController@delete')->name('delete_profile_address');
    Route::get('/profile/address/{address}/edit' , 'Client\Profile\AddressController@edit')->name('edit_profile_address');
    Route::post('/profile/address/edit/submit' , 'Client\Profile\AddressController@edit_submit')->name('submit_profile_address');
    Route::get('/profile/albums' , 'Client\Profile\AlbumsController')->name('profile_album');
    Route::get('/profile/comment' , 'Client\Profile\CommentsController')->name('profile_comment');
    Route::get('/profile/edit' , 'Client\Profile\EditController')->name('profile_edit');
    Route::post('/profile/edit' , 'Client\Profile\EditController@edit')->name('profile_edit_submit');
    Route::get('/profile/files' , 'Client\Profile\FilesController')->name('profile_file');
    Route::get('/profile/installments' , 'Client\Profile\IntallmentsController')->name('profile_installments');
    Route::get('/profile/membership' , 'Client\Profile\MembershipController')->name('profile_membership');
    Route::get('/profile/pickup' , 'Client\Profile\PickupsController')->name('profile_pickup');
    Route::get('/profile/pickup/new' , 'Client\Profile\PickupsController@new')->name('new_pickup');
    Route::post('/profile/pickup/new/submit' , 'Client\Profile\PickupsController@new_submit')->name('new_pickup_submit');
    Route::get('/profile/regulate' , 'Client\Profile\RegulateController')->name('profile_regulate');
    Route::get('/profile/regulate/new' , 'Client\Profile\RegulateController@new')->name('new_regulate');
    Route::post('/profile/regulate/new/submit' , 'Client\Profile\RegulateController@new_submit')->name('new_regulate_submit');
    Route::get('/profile/orders' , 'Client\Profile\OrdersController')->name('profile_orders');
    Route::get('/profile/favorite' , 'Client\Profile\FavoriteController')->name('profile_favorite');
    Route::get('/profile/register' , 'Auth\ProfileController@showRegister')->name('profile.register');
    Route::post('/profile/register' , 'Auth\ProfileController@register')->name('profile.register');

    Route::get('/toggle_bookmark/{id}', 'Client\Product\ProductController@toggle_bookmark')->name('toggle_bookmark');



    //cart
    Route::get('cart/{discount_id?}', 'Client\Cart\CartController@cart')->name('cart');

    Route::get('card/result', 'Client\Cart\CartController@result');
    Route::get('add_to_cart/{id}', 'Client\Cart\CartController@add')->name('add_to_cart');
    Route::get('increase_cart_item/{product_id}', 'Client\Cart\CartController@increase_cart_item')->name('increase_cart_item');
    Route::get('remove_cart_item/{product_id}', 'Client\Cart\CartController@remove_cart_item')->name('remove_cart_item');
    Route::get('delete_cart_item/{product_id}', 'Client\Cart\CartController@delete_cart_item')->name('delete_cart_item');

    Route::get('add_discount_code', 'Client\Cart\CartController@add_discount_code')->name('add_discount_code');
    Route::get('cart_address', 'Client\Cart\CartController@cart_address')->name('cart_address');
    Route::get('cart_installment', 'Client\Cart\CartController@cart_installment')->name('cart_installment');
    Route::post('cart_address', 'Client\Cart\CartController@add_cart_address')->name('cart_address');
    Route::get('cart_pay', 'Client\Cart\CartController@cart_pay')->name('cart_pay');
    Route::post('cart_pay', 'Client\Cart\CartController@add_cart_pay')->name('cart_pay');
    Route::post('cart_pay_installment', 'Client\Cart\CartController@add_cart_pay_installment')->name('cart_pay_installment');
    Route::post('discount_cart_pay', 'Client\Cart\CartController@add_discount_cart_pay')->name('discount_cart_pay');

    Route::get('pay_installment/{id}', 'Client\Profile\IntallmentsController@pay')->name('pay_installment');
    Route::get('callback_installment', 'Client\Profile\IntallmentsController@callback')->name('callback_installment');

});
//auth
Route::get('/login', 'Auth\LoginController')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('do_login');
Route::get('/verify', 'Auth\VerifyController')->name('verify');
Route::post('/verify', 'Auth\VerifyController@verify')->name('do_verify');
Route::get('/logout', 'Auth\ProfileController@logout')->name('logout');
Route::get('/pages/{slug}' , 'Client\Pages\PageController')->name('pages');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
