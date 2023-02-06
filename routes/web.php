<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\Product;
use App\Http\Controllers\Slide;
use App\Http\Controllers\ShoppingCart;
use App\Http\Controllers\CodeDiscount;
use App\Http\Controllers\Checkout;
use App\Http\Controllers\Gallery;
use App\Http\Controllers\DeliveryCost;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\Blog;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class,'index']);
Route::get('/trang-chu',[HomeController::class,'index']);

Route::post('/tim-kiem-san-pham',[HomeController::class,'SeachProduct']);

Route::get('/san-pham-yeu-thich',[HomeController::class,'MyFavourite']);
Route::post('/save-favourite',[HomeController::class,'SaveFavourite']);
Route::get('/delete-favourite/{link_id_product}',[HomeController::class,'DeleteFavourite']);


Route::get('/cam-nang-cham-soc',[Blog::class,'ShowBlog']);
Route::get('/cam-nang-cham-soc/{link_slug_blog}/{link_id_blog}',[Blog::class,'DetailBlog']);


/*------------------Admin*/


Route::get('/admin-login',[AdminController::class,'AdminLogin']);
Route::get('/dashboard',[AdminController::class,'ShowDashboard']);
Route::post('/admin-dashboard',[AdminController::class,'Dashboard']);/* Sự kiện nhấn nút đăng nhập*/
Route::get('/admin-logout',[AdminController::class,'AdminLogout']);



/*Cartegory Product*/
Route::get('/list-category',[CategoryProduct::class,'ListCategory']);
Route::get('/add-category',[CategoryProduct::class,'AddCategory']);
Route::get('/edit-category/{link_id_category}',[CategoryProduct::class,'EditCategory']);

Route::get('/delete-category/{link_id_category}',[CategoryProduct::class,'DeleteCategory']);
Route::post('/save-category',[CategoryProduct::class,'SaveCategory']);
Route::post('/update-category/{link_id_category}',[CategoryProduct::class,'UpdateCategory']);

Route::get('/unactive-category/{link_id_category}',[CategoryProduct::class,'ActiveCategory']);
Route::get('/active-category/{link_id_category}',[CategoryProduct::class,'UnActiveCategory']);


/* Show category index*/
Route::get('/danh-muc-san-pham/{link_slug_category}/{link_id_category}',[CategoryProduct::class,'ShowCategoryProduct']);







/*Product*/
Route::get('/list-product',[Product::class,'ListProduct']);
Route::get('/add-product',[Product::class,'AddProduct']);
Route::get('/edit-product/{link_id_product}',[Product::class,'EditProduct']);

Route::get('/delete-product/{link_id_product}',[Product::class,'DeleteProduct']);
Route::post('/save-product',[Product::class,'SaveProduct']);
Route::post('/update-product/{link_id_product}',[Product::class,'UpdateProduct']);

Route::get('/unactive-product/{link_id_product}',[Product::class,'ActiveProduct']);
Route::get('/active-product/{link_id_product}',[Product::class,'UnActiveProduct']);



/*Gallery sản phẩm*/
Route::get('/add-gallery/{link_id_product}',[Gallery::class,'AddGallery']);
Route::post('/save-gallery/{link_id_product}',[Gallery::class,'SaveGallery']);
Route::post('/select-gallery',[Gallery::class,'SelectGallery']);

Route::post('/update-name-gallery',[Gallery::class,'UpdateNameGallery']);
Route::post('/delete-gallery',[Gallery::class,'DeleteGallery']);
Route::post('/update-image-gallery',[Gallery::class,'UpdateImageGallery']);


/*Chi tiết sản phẩm*/
Route::get('/chi-tiet-san-pham/{link_slug_product}/{link_id_product}',[Product::class,'ShowDetailProduct']);






/*Quản lý banner website*/
Route::get('/add-slide',[Slide::class,'AddSlide']);
Route::get('/list-slide',[Slide::class,'ListSlide']);
Route::get('/edit-slide/{link_id_slide}',[Slide::class,'EditSlide']);

Route::post('/save-slide',[Slide::class,'SaveSlide']);
Route::get('/delete-slide/{link_id_slide}',[Slide::class,'DeleteSlide']);
Route::post('/update-slide/{link_id_slide}',[Slide::class,'UpdateSlide']);

Route::get('/unactive-slide/{link_id_slide}',[Slide::class,'ActiveSlide']);
Route::get('/active-slide/{link_id_slide}',[Slide::class,'UnActiveSlide']);




/*Quản lý Bài biết website*/
Route::get('/add-blog',[Blog::class,'AddBlog']);
Route::get('/list-blog',[Blog::class,'ListBlog']);
Route::get('/edit-blog/{link_id_blog}',[Blog::class,'EditBlog']);


Route::post('/save-blog',[Blog::class,'SaveBlog']);
Route::post('/update-blog/{link_id_blog}',[Blog::class,'UpdateBlog']);
Route::get('/delete-blog/{link_id_blog}',[Blog::class,'DeleteBlog']);


Route::get('/unactive-blog/{link_id_blog}',[Blog::class,'ActiveBlog']);
Route::get('/active-blog/{link_id_blog}',[Blog::class,'UnActiveBlog']);



/*----------------------------TRANG CHỦ*/


/* Giỏ hàng*/


Route::post('save-shopping-cart',[ShoppingCart::class,'SaveShoppingCart']);
Route::get('/gio-hang',[ShoppingCart::class,'ShowShoppingCart']);

Route::post('/update-shopping-cart',[ShoppingCart::class,'UpdateShoppingCart']);
Route::get('/delete-shopping-cart/{rowId}',[ShoppingCart::class,'DeleteShoppingCart']);


/*Sử dụng Ajax để thêm giỏ hàng*/

Route::post('add-paynow',[ShoppingCart::class,'AddPayNow']);
Route::post('add-cartnow',[ShoppingCart::class,'AddCartNow']);



/*Mã khuyến mãi*/
Route::post('/check-code-discount',[CodeDiscount::class,'CheckCodeDiscount']);
Route::get('/list-code-discount',[CodeDiscount::class,'ListCodeDiscount']);
Route::get('/add-code-discount',[CodeDiscount::class,'AddCodeDiscount']);
Route::post('/save-code-discount',[CodeDiscount::class,'SaveCodeDiscount']);
Route::get('/delete-code-discount/{link_id_discount}',[CodeDiscount::class,'DeleteCodeDiscount']);



/*			PHÍ VẬN CHUYỂN*/

Route::get('/list-delivery-cost',[DeliveryCost::class,'ListDeliveryCost']);
Route::post('/select-delivery',[DeliveryCost::class,'SelectDelivery']);
Route::post('/save-delivery-cost',[DeliveryCost::class,'SaveDeliveryCost']);
Route::post('/load-delivery',[DeliveryCost::class,'LoadDelivery']);
Route::post('/update-delivery',[DeliveryCost::class,'UpdateDelivery']);



/*Form dang ki/dang nhap khach hang*/
Route::get('/dang-nhap',[Checkout::class,'ShowLogin']);
Route::get('/dang-ky',[Checkout::class,'ShowRegister']);


Route::post('/register',[Checkout::class,'AddUser']);
Route::post('/login',[Checkout::class,'Login']);
Route::get('/logout',[Checkout::class,'Logout']);

Route::get('/login-facebook',[Checkout::class,'LoginFacebook']);
Route::get('/dang-nhap/callback',[Checkout::class,'CallbackFacebook']);

Route::get('/login-google',[Checkout::class,'LoginGoogle']);
Route::get('/dang-nhap/google/callback',[Checkout::class,'CallbackGoogle']);


Route::get('/thong-tin-ca-nhan',[Checkout::class,'ShowInforUser']);

Route::post('//load-select',[Checkout::class,'LoadSelect']);
Route::post('/select-address-user',[Checkout::class,'SelectAddressUser']);
Route::post('/save-information-user',[Checkout::class,'SaveInforUser']);


Route::get('/don-hang-cua-toi',[Checkout::class,'ShowMyOrder']);
Route::get('/delete-my-order/{link_id_bill}',[Checkout::class,'DeleteMyBill']);




/*------------Thanh toán đơn hàng*/

/*điển thông tin đơn hàng*/
Route::get('/thanh-toan-hoa-don',[Checkout::class,'ShowCheckout'])->name('showcheckout');

Route::get('thanh-toan-truc-tuyen',[Checkout::class,'PaymentOnline']);
/*lưu thông tin đơn hàng*/
Route::post('/save-bill',[Checkout::class,'SaveBill'])->name('savebill');


Route::post('/thanh-toan-vnpay',[Checkout::class,'PaymentVnpay']);
Route::post('/testpay',[Checkout::class,'Test']);


Route::post('/thanh-toan-momo',[Checkout::class,'PaymentMomo']);

Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');



/*Trang thanh toán thành công*/
Route::get('/payment',[Checkout::class,'Payment'])->name('successpayment');

/*Quản lý đơn hàng - Admin*/
Route::get('/list-bill',[Checkout::class,'ListBill']);
Route::get('/detail-bill/{link_id_bill}',[Checkout::class,'DetailBill']);
Route::post('/update-bill/{link_id_bill}',[Checkout::class,'UpdateBill']);
Route::get('/delete-bill/{link_id_bill}',[Checkout::class,'DeleteBill']);

Route::get('/list-order',[Checkout::class,'ListOrder']);



