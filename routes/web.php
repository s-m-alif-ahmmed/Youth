<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Website\WebsiteController;
use App\Http\Controllers\Website\PolicyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfilePhotoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductSubCategoryController;
use App\Http\Controllers\Admin\ProductBrandController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\Admin\LogoAddressController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\ProductReviewController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Admin\TermsAndConditionController;
use App\Http\Controllers\Admin\ReturnPolicyController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Website\SearchController;
use App\Http\Controllers\Website\FilterController;
use App\Http\Controllers\Admin\FavouriteController;
use App\Http\Controllers\Website\YouthBlogController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DeliveryTaxController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Website\CheckoutController;
use App\Http\Controllers\Website\UserDashboardController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\HeroBannerController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\EventController;


Route::get('/', [WebsiteController::class, 'index'])->name('home');
Route::get('/youth/menu/{menu_slug}', [WebsiteController::class, 'menu'])->name('home.menu');
Route::get('/youth/product/{product_category_slug}', [WebsiteController::class, 'product'])->name('home.product');
Route::get('/youth/offer/{offer_slug}', [WebsiteController::class, 'offerProduct'])->name('home.offer.product');
Route::get('/youth/event/{event_slug}', [WebsiteController::class, 'eventProduct'])->name('home.event.product');
Route::get('/youth/shop/all-products', [WebsiteController::class, 'allProduct'])->name('home.all.product');
Route::get('/youth/product/detail/{product_slug}', [WebsiteController::class, 'productDetail'])->name('home.product.detail');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('home.contact');
Route::get('/about', [WebsiteController::class, 'about'])->name('home.about');

//Search
Route::get('/search/result', [SearchController::class, 'searchResult'])->name('search.result');

//Sort By Filter
Route::get('/youth/shop/all-products/sort', [FilterController::class, 'sortProductsShop'])->name('products.sort.shop');
Route::get('/youth/{offer_slug}/offer', [FilterController::class, 'sortProductsOffer'])->name('products.sort.offer');
Route::get('/youth/{event_slug}/event', [FilterController::class, 'sortProductsEvent'])->name('products.sort.event');
Route::get('/youth/products/search', [FilterController::class, 'sortProductsSearch'])->name('products.sort.search');
Route::get('/youth/products/{product_category_slug}', [FilterController::class, 'sortProducts'])->name('products.sort');
Route::get('/youth/filter-product/{menu_slug}', [FilterController::class, 'sortMenuProducts'])->name('products.sort.menu');

//Price Range Filter
//Route::get('/youth/products/filter/price/search/result', [FilterController::class, 'filterBySearchPrice'])->name('home.product.filter.search.price');
Route::get('/youth/shop-products/filter/price', [FilterController::class, 'filterByPrice'])->name('home.product.shop.filter.price');
Route::get('/youth/offer-products/filter/price/{offer_slug}', [FilterController::class, 'filterOfferProductsByPrice'])->name('home.filter.offer.price');
Route::get('/youth/event-products/filter/price/{event_slug}', [FilterController::class, 'filterEventProductsByPrice'])->name('home.filter.event.price');
Route::get('/youth/product/filter/price/{product_category_slug}', [FilterController::class, 'filterByCategoryPrice'])->name('home.product.filter.category.price');
Route::get('/youth/product/filter/{menu_slug}', [FilterController::class, 'filterByMenuPrice'])->name('home.menu.filter.price');

//Blog
Route::get('/youth/blogs/category/{blog_category_slug}', [YouthBlogController::class, 'blogCategory'])->name('home.blog.category');
Route::get('/youth/blogs', [YouthBlogController::class, 'blog'])->name('home.blog');
Route::get('/youth/blog/details/{slug?}', [YouthBlogController::class, 'blogDetail'])->name('home.blog.detail');

//Terms, Privacy and Return Polices
Route::get('/terms',[PolicyController::class,'terms'])->name('policy.terms');
Route::get('/privacy',[PolicyController::class,'privacy'])->name('policy.privacy');
Route::get('/return',[PolicyController::class,'return'])->name('policy.return');

//Error Page
Route::get('/404',[WebsiteController::class,'error404'])->name('error.404');

Route::middleware(['userBan'])->group(function () {

    Route::middleware(['auth', 'verified'])->group(function () {

        Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

        //    User Middleware

        Route::middleware(['user'])->group(function () {

//            Dashboard Order
            Route::get('/youth/order',[UserDashboardController::class,'order'])->name('order.detail');
            Route::get('/youth/order/details/{tracking_id}',[UserDashboardController::class,'orderDetails'])->name('order.detail.products');
            Route::get('/youth/wishlist',[UserDashboardController::class,'wishlist'])->name('user.wishlist');

//          Cart
            Route::get('/youth/cart/show',[CartController::class,'index'])->name('home.product.cart');
            Route::post('/youth/product/cart/store',[CartController::class,'store'])->name('cart.store');
            Route::post('/youth/product/cart/update/{id}',  [CartController::class,'updateQuantity'])->name('cart.update.quantity');
            Route::get('/youth/product/cart/delete/{id}',[CartController::class,'destroy'])->name('cart.delete');

            //  buy now
            Route::post('/cart/buy-now', [CartController::class, 'buyNow'])->name('cart.buy.now');

//          Checkout
            Route::get('/youth/order/information',[CheckoutController::class,'productCheckout'])->name('home.product.checkout');
            Route::post('/youth/order/new',[CheckoutController::class,'newOrder'])->name('order.new');
            Route::get('/youth/order/confirm',[CheckoutController::class,'orderConfirm'])->name('order.confirm');

//            Coupon Check
            Route::get('/couponCheck',[CheckoutController::class,'couponCheck'])->name('couponCheck');
            Route::post('/apply-discount', [CheckoutController::class,'applyDiscount'])->name('front.applyDiscount');

//          Subscribe Email
            Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscription.email.store');

//          Favourite Product
            Route::resource('/youth/favourite', FavouriteController::class);

//          Product Review
            Route::resource('/product-review',ProductReviewController::class);
            Route::get('/product-review/view',[ProductReviewController::class, 'view'])->name('product.review.view');

//          Blog Comment
            Route::resource('/comment',CommentController::class);
            Route::get('/comment/view',[CommentController::class, 'view'])->name('comment.view');

        });

        //    Admin Middleware
        Route::middleware(['admin'])->group(function () {

            //        User
            Route::get('/users',[UserController::class,'users'])->name('users');
            Route::get('/users-detail/{id}',[UserController::class,'usersDetail'])->name('users-detail');
            Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser'])->name('delete-user');
            Route::get('/change-role/{id}',[UserController::class,'changeRole'])->name('change-role');
            Route::get('/change-ban-status/{id}',[UserController::class,'changeBanStatus'])->name('change-ban-status');

//            Product Category
            Route::resource('/admin/menus',MenuController::class);
            Route::get('/admin/change-menu-status/{id}',[MenuController::class,'changeMenuStatus'])->name('change.menu.status');

//            Product Category
            Route::resource('/admin/product-category',ProductCategoryController::class);
            Route::get('/admin/change-product-category-status/{id}',[ProductCategoryController::class,'changeCategoryStatus'])->name('change.product-category.status');
            Route::get('/admin/change-product-category-filter-status/{id}',[ProductCategoryController::class,'changeCategoryFilterStatus'])->name('change.product-category.filter.status');

//            Product Brand
            Route::resource('/admin/product-brand',ProductBrandController::class);
            Route::get('/admin/change-product-brand-filter-status/{id}',[ProductBrandController::class,'changeBrandFilterStatus'])->name('change.product-brand.filter.status');
            Route::get('/admin/change-product-brand-status/{id}',[ProductBrandController::class,'changeBrandStatus'])->name('change.product-brand.status');

//            Product Size
            Route::resource('/admin/product-size',ProductSizeController::class);
            Route::get('/admin/change-product-size-status/{id}',[ProductSizeController::class,'changeSizeStatus'])->name('change.product-size.status');

//            Product
            Route::resource('/admin/product',ProductController::class);
            Route::get('/admin/change-product-status/{id}',[ProductController::class,'changeProductStatus'])->name('change.product.status');
            Route::get('/admin/change-product-tranding-status/{id}',[ProductController::class,'changePopularProductStatus'])->name('change.popular.product.status');
//            Route::get('/admin/change-product-related-status/{id}',[ProductController::class,'changeRelatedProductStatus'])->name('change.related.product.status');

//           Product Category & Sub Category Dropdown
            Route::get('/getCategoriesByMenu', [ProductController::class, 'getCategoriesIdByMenu'])->name('get.categories');

            //    Product review
            Route::get('/change/product-review/{id}',[ProductReviewController::class,'changeProductReviewStatus'])->name('change.status.product.review');

//          Order
            Route::get('/admin/orders/pending',[AdminOrderController::class,'adminOrdersPending'])->name('admin.orders.pending');
            Route::get('/admin/orders/complete',[AdminOrderController::class,'adminOrdersComplete'])->name('admin.orders.completed');
            Route::get('/admin/orders/return',[AdminOrderController::class,'adminOrdersReturn'])->name('admin.orders.return');
            Route::get('/admin/orders/canceled',[AdminOrderController::class,'adminOrdersCanceled'])->name('admin.orders.canceled');
            Route::get('/admin/orders/detail/{tracking_id}',[AdminOrderController::class,'adminOrderDetail'])->name('admin.order.detail');
            Route::post('/admin/order/{id}', [AdminOrderController::class, 'changeOrderStatus'])->name('change.status.order');
            Route::get('/admin/order/invoice/{id}',[AdminOrderController::class,'invoice'])->name('admin.invoice.order');

//            Blog Categories
            Route::resource('/admin/blog-category', BlogCategoryController::class);
            Route::get('/blog/category/status/{id}',[BlogCategoryController::class,'changeBlogCategoryStatus'])->name('change.status.blog.category');

//             Blogs
            Route::resource('/admin/blog', BlogController::class);
            Route::get('/blog/status/{id}',[BlogController::class,'changeBlogStatus'])->name('change.status.blog');

            //   Blog Comment
            Route::get('/blog/comment/manage',[CommentController::class,'blogCommentManage'])->name('admin.blog.comment.manage');
            Route::get('/blog/comment/detail/{id}',[CommentController::class,'blogCommentDetail'])->name('admin.blog.comment.view');
            Route::get('/blog/comment/status/{id}',[CommentController::class,'changeBlogCommentStatus'])->name('change.status.blog.comment');

//             Coupon
            Route::resource('/admin/coupon', PromoCodeController::class);
            Route::get('/coupon/status/{id}',[PromoCodeController::class,'changeCouponStatus'])->name('change.status.coupon.code');

//             Logo Address Favicon
            Route::resource('/admin/logo-address', LogoAddressController::class);

//             Social Media
            Route::resource('/admin/social-media', SocialMediaController::class);
            Route::get('/social-media/status/{id}',[SocialMediaController::class,'changeSocialMediaStatus'])->name('change.status.social.media');

//            Subscribe Email
            Route::get('/admin/subscription', [SubscriptionController::class, 'index'])->name('subscription.email.index');
            Route::post('/admin/subscription/{id}', [SubscriptionController::class, 'destroy'])->name('subscription.email.destroy');

//            Terms & Conditions
            Route::resource('/admin/terms-and-conditions', TermsAndConditionController::class);

//            Privacy Policy
            Route::resource('/admin/privacy-policy', PrivacyPolicyController::class);

//            Return Policy
            Route::resource('/admin/return-policy', ReturnPolicyController::class);

//            Delivery Vat
            Route::resource('/admin/delivery-vat', DeliveryTaxController::class);

//          Contact Us
            Route::resource('/contact-us', ContactMessageController::class);
            Route::get('/contact/status/{id}',[ContactMessageController::class,'changeStatusContact'])->name('status.contact');

//          Home Page Banner
            Route::resource('/admin/hero-banner', HeroBannerController::class);
            Route::get('/admin/hero-banner/active/status/{id}',[HeroBannerController::class,'changeStatusHeroBannerActive'])->name('change.status.hero.banner.active');
            Route::get('/admin/hero-banner/status/{id}',[HeroBannerController::class,'changeStatusHeroBanner'])->name('change.status.hero.banner');

//          Product Offer
            Route::resource('/admin/offer', OfferController::class);
            Route::get('/admin/offer/active/status/{id}',[OfferController::class,'changeStatusOfferActive'])->name('change.status.offer.active');
            Route::get('/admin/offer/status/{id}',[OfferController::class,'changeStatusOffer'])->name('change.status.offer');

//          Product Event
            Route::resource('/admin/event', EventController::class);
            Route::get('/admin/event/active/status/{id}',[EventController::class,'changeStatusEventActive'])->name('change.status.event.active');
            Route::get('/admin/event/status/{id}',[EventController::class,'changeStatusEvent'])->name('change.status.event');

//          About Page
            Route::resource('/admin/about-page',AboutPageController::class);

        });

    });


    Route::middleware('auth')->group(function () {

//            profile show
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        //    Profile Photo manage
        Route::resource('/photo', ProfilePhotoController::class);
        Route::get('/photo/{id}', [ProfilePhotoController::class, 'show'])->name('profile.show');

    });

});

require __DIR__.'/auth.php';
