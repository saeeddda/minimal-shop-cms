<?php

//Laravel uses
use App\Http\Controllers\Site\Account\AccountTicketController;
use App\Http\Controllers\Site\Account\CompareController;
use App\Http\Controllers\Site\PageController;
use Illuminate\Support\Facades\Route;

//Admin uses
use App\Http\Controllers\Admin\Notification\NotificationController;

//Site uses
use App\Http\Controllers\Site\Account\OrderController as SiteOrderController;
use App\Http\Controllers\Site\Account\FavoriteController as SiteFavoriteController;
use App\Http\Controllers\Site\Account\ProfileController as SiteProfileController;
use App\Http\Controllers\Site\Account\AddressController as SiteAddressController;
use App\Http\Controllers\Site\Auth\LoginRegisterController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\Market\ProductController;
use App\Http\Controllers\Site\SaleProcess\CartController;
use App\Http\Controllers\Site\SaleProcess\ShippingController;
use App\Http\Controllers\Site\SaleProcess\PaymentController as SitePaymentController;

/*
|-------------------------------------------------------------------
| Admin routes
|-------------------------------------------------------------------
*/

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/', 'AdminDashboardController@index')->name('admin.home');

    //market routes
    Route::prefix('market')->namespace('Market')->group(function () {
        //Category routes
        Route::prefix('category')->group(function () {
            Route::get('/', 'CategoryController@index')->name('admin.market.category.index');
            Route::get('/create', 'CategoryController@create')->name('admin.market.category.create');
            Route::post('/store', 'CategoryController@store')->name('admin.market.category.store');
            Route::get('/edit/{productCategory}', 'CategoryController@edit')->name('admin.market.category.edit');
            Route::put('/update/{productCategory}', 'CategoryController@update')->name('admin.market.category.update');
            Route::delete('/destroy/{productCategory}', 'CategoryController@destroy')->name('admin.market.category.destroy');
            Route::get('/show-change/{productCategory}', 'CategoryController@showChange')->name('admin.market.category.show-change');
            Route::get('/status/{productCategory}', 'CategoryController@status')->name('admin.market.category.status');
        });

        //brand routes
        Route::prefix('brand')->group(function () {
            Route::get('/', 'BrandController@index')->name('admin.market.brand.index');
            Route::get('/create', 'BrandController@create')->name('admin.market.brand.create');
            Route::post('/store', 'BrandController@store')->name('admin.market.brand.store');
            Route::get('/edit/{brand}', 'BrandController@edit')->name('admin.market.brand.edit');
            Route::put('/update/{brand}', 'BrandController@update')->name('admin.market.brand.update');
            Route::delete('/destroy/{brand}', 'BrandController@destroy')->name('admin.market.brand.destroy');
            Route::get('/status/{brand}', 'BrandController@status')->name('admin.market.brand.status');
        });

        //comment routes
        Route::prefix('comment')->group(function () {
            Route::get('/', 'ProductCommentController@index')->name('admin.market.comment.index');
            Route::post('/store', 'ProductCommentController@store')->name('admin.market.comment.store');
            Route::get('/show/{comment}', 'ProductCommentController@show')->name('admin.market.comment.show');
            Route::get('/approved/{comment}', 'ProductCommentController@approved')->name('admin.market.comment.approved');
            Route::get('/status/{comment}', 'ProductCommentController@status')->name('admin.market.comment.status');
            Route::post('/answer/{comment}', 'ProductCommentController@answer')->name('admin.market.comment.answer');
        });

        //delivery routes
        Route::prefix('delivery')->group(function () {
            Route::get('/', 'DeliveryController@index')->name('admin.market.delivery.index');
            Route::get('/create', 'DeliveryController@create')->name('admin.market.delivery.create');
            Route::post('/store', 'DeliveryController@store')->name('admin.market.delivery.store');
            Route::get('/edit/{delivery}', 'DeliveryController@edit')->name('admin.market.delivery.edit');
            Route::put('/update/{delivery}', 'DeliveryController@update')->name('admin.market.delivery.update');
            Route::delete('/destroy/{delivery}', 'DeliveryController@destroy')->name('admin.market.delivery.destroy');
            Route::get('/status/{delivery}', 'DeliveryController@status')->name('admin.market.delivery.status');

        });

        //coupon routes
        Route::prefix('coupon')->group(function () {
            //discount
            Route::prefix('discount')->group(function() {
                Route::get('/', 'CopounController@discount')->name('admin.market.coupon.discount.index');
                Route::get('/create', 'CopounController@discountCreate')->name('admin.market.coupon.discount.create');
                Route::post('/store', 'CopounController@discountStore')->name('admin.market.coupon.discount.store');
                Route::get('/edit/{coupon}', 'CopounController@discountEdit')->name('admin.market.coupon.discount.edit');
                Route::put('/update/{coupon}', 'CopounController@discountUpdate')->name('admin.market.coupon.discount.update');
                Route::delete('/destroy/{coupon}', 'CopounController@discountDestroy')->name('admin.market.coupon.discount.destroy');
                Route::get('/status/{coupon}', 'CopounController@discountStatus')->name('admin.market.coupon.discount.status');
            });

            //general
            Route::prefix('general-discount')->group(function() {
                Route::get('/', 'CopounController@generalDiscount')->name('admin.market.coupon.general.index');
                Route::get('/create', 'CopounController@generalDiscountCreate')->name('admin.market.coupon.general.create');
                Route::post('/store', 'CopounController@generalDiscountStore')->name('admin.market.coupon.general.store');
                Route::get('/edit/{generalCoupon}', 'CopounController@generalDiscountEdit')->name('admin.market.coupon.general.edit');
                Route::put('/update/{generalCoupon}', 'CopounController@generalDiscountUpdate')->name('admin.market.coupon.general.update');
                Route::delete('/destroy/{generalCoupon}', 'CopounController@generalDiscountDestroy')->name('admin.market.coupon.general.destroy');
                Route::get('/status/{generalCoupon}', 'CopounController@generalDiscountStatus')->name('admin.market.coupon.general.status');
            });

            //amazing
            Route::prefix('amazing-discount')->group(function() {
                Route::get('/', 'CopounController@amazingDiscount')->name('admin.market.coupon.amazing.index');
                Route::get('/create', 'CopounController@amazingDiscountCreate')->name('admin.market.coupon.amazing.create');
                Route::post('/store', 'CopounController@amazingDiscountStore')->name('admin.market.coupon.amazing.store');
                Route::get('/edit/{amazingCoupon}', 'CopounController@amazingDiscountEdit')->name('admin.market.coupon.amazing.edit');
                Route::put('/update/{amazingCoupon}', 'CopounController@amazingDiscountUpdate')->name('admin.market.coupon.amazing.update');
                Route::delete('/destroy/{amazingCoupon}', 'CopounController@amazingDiscountDestroy')->name('admin.market.coupon.amazing.destroy');
                Route::get('/status/{amazingCoupon}', 'CopounController@amazingDiscountStatus')->name('admin.market.coupon.amazing.status');
            });
        });

        //order routes
        Route::prefix('orders')->group(function () {
            Route::get('/', 'OrderController@index')->name('admin.market.order.all');
            Route::get('/new-orders', 'OrderController@newOrders')->name('admin.market.order.new');
            Route::get('/processing', 'OrderController@processing')->name('admin.market.order.processing');
            Route::get('/unpaid', 'OrderController@unpaid')->name('admin.market.order.unpaid');
            Route::get('/canceled', 'OrderController@canceled')->name('admin.market.order.canceled');
            Route::get('/returned', 'OrderController@returned')->name('admin.market.order.returned');

            Route::get('/show/{order}', 'OrderController@show')->name('admin.market.order.show');
            Route::get('/print/{order}', 'OrderController@print')->name('admin.market.order.print');
            Route::get('/change-send-status/{order}', 'OrderController@changeSendStatus')->name('admin.market.order.changeSendStatus');
            Route::get('/change-order-status/{order}', 'OrderController@changeOrderStatus')->name('admin.market.order.changeOrderStatus');
        });

        //payment routes
        Route::prefix('payment')->group(function () {
            Route::get('/', 'PaymentController@index')->name('admin.market.payment.index');
            Route::get('/online', 'PaymentController@online')->name('admin.market.payment.online');
            Route::get('/offline', 'PaymentController@offline')->name('admin.market.payment.offline');
            Route::get('/cash', 'PaymentController@cash')->name('admin.market.payment.cash');

            Route::get('/show/{payment}', 'PaymentController@show')->name('admin.market.payment.show');
            Route::get('/cancel/{payment}', 'PaymentController@cancel')->name('admin.market.payment.cancel');
            Route::get('/returned/{payment}', 'PaymentController@returned')->name('admin.market.payment.returned');
        });

        //product routes
        Route::prefix('product')->group(function () {
            Route::get('/', 'ProductController@index')->name('admin.market.product.index');
            Route::get('/create', 'ProductController@create')->name('admin.market.product.create');
            Route::post('/store', 'ProductController@store')->name('admin.market.product.store');
            Route::get('/edit/{product}', 'ProductController@edit')->name('admin.market.product.edit');
            Route::put('/update/{product}', 'ProductController@update')->name('admin.market.product.update');
            Route::delete('/destroy/{product}', 'ProductController@destroy')->name('admin.market.product.destroy');
            Route::get('/status/{product}', 'ProductController@status')->name('admin.market.product.status');
            Route::get('/marketable/{product}', 'ProductController@marketable')->name('admin.market.product.marketable');

            //gallery route
            Route::get('/gallery/{product}', 'ProductGalleryController@index')->name('admin.market.product.gallery.index');
            Route::get('/gallery/{product}/create', 'ProductGalleryController@create')->name('admin.market.product.gallery.create');
            Route::post('/gallery/{product}/store', 'ProductGalleryController@store')->name('admin.market.product.gallery.store');
            Route::delete('/gallery/destroy/{product}/{productGallery}', 'ProductGalleryController@destroy')->name('admin.market.product.gallery.destroy');


            Route::get('/color/{product}', 'ProductColorController@index')->name('admin.market.product.color.index');
            Route::get('/color/{product}/create', 'ProductColorController@create')->name('admin.market.product.color.create');
            Route::post('/color/{product}/store', 'ProductColorController@store')->name('admin.market.product.color.store');
            Route::delete('/color/destroy/{product}/{productColor}', 'ProductColorController@destroy')->name('admin.market.product.color.destroy');

            //gallery route
            Route::get('/guarantee/{product}', 'ProductGuaranteeController@index')->name('admin.market.product.guarantee.index');
            Route::get('/guarantee/{product}/create', 'ProductGuaranteeController@create')->name('admin.market.product.guarantee.create');
            Route::post('/guarantee/{product}/store', 'ProductGuaranteeController@store')->name('admin.market.product.guarantee.store');
            Route::delete('/guarantee/destroy/{product}/{guarantee}', 'ProductGuaranteeController@destroy')->name('admin.market.product.guarantee.destroy');
        });

        //property routes
        Route::prefix('property')->group(function () {
            Route::get('/', 'PropertyController@index')->name('admin.market.property.index');
            Route::get('/create', 'PropertyController@create')->name('admin.market.property.create');
            Route::post('/store', 'PropertyController@store')->name('admin.market.property.store');
            Route::get('/edit/{categoryAttribute}', 'PropertyController@edit')->name('admin.market.property.edit');
            Route::put('/update/{categoryAttribute}', 'PropertyController@update')->name('admin.market.property.update');
            Route::delete('/destroy/{categoryAttribute}', 'PropertyController@destroy')->name('admin.market.property.destroy');

            Route::get('/value/{categoryAttribute}', 'PropertyValueController@index')->name('admin.market.property.value.index');
            Route::get('/value/{categoryAttribute}/create', 'PropertyValueController@create')->name('admin.market.property.value.create');
            Route::post('/value/{categoryAttribute}/store', 'PropertyValueController@store')->name('admin.market.property.value.store');
            Route::get('/value/{categoryAttribute}/edit/{categoryValue}', 'PropertyValueController@edit')->name('admin.market.property.value.edit');
            Route::put('/value/{categoryAttribute}/update/{categoryValue}', 'PropertyValueController@update')->name('admin.market.property.value.update');
            Route::delete('/value/destroy/{categoryAttribute}/{categoryValue}', 'PropertyValueController@destroy')->name('admin.market.property.value.destroy');
        });

        //storage routes
        Route::prefix('storage')->group(function () {
            Route::get('/', 'StorageController@index')->name('admin.market.storage.index');
            Route::get('/add-to-storage/{product}', 'StorageController@addToStorage')->name('admin.market.storage.addToStorage');
            Route::post('/store/{product}', 'StorageController@store')->name('admin.market.storage.store');
            Route::get('/edit/{product}', 'StorageController@edit')->name('admin.market.storage.edit');
            Route::put('/update/{product}', 'StorageController@update')->name('admin.market.storage.update');
        });
    });

    Route::prefix('content')->namespace('Content')->group(function () {
        //Category routes
        Route::prefix('category')->middleware('role:editor,category-list')->group(function () {
            Route::get('/', 'CategoryController@index')->name('admin.content.category.index');
            Route::get('/create', 'CategoryController@create')->name('admin.content.category.create');
            Route::post('/store', 'CategoryController@store')->name('admin.content.category.store');
            Route::get('/edit/{postCategory}', 'CategoryController@edit')->name('admin.content.category.edit');
            Route::put('/update/{postCategory}', 'CategoryController@update')->name('admin.content.category.update');
            Route::delete('/destroy/{postCategory}', 'CategoryController@destroy')->name('admin.content.category.destroy');
            //for ajax
            Route::get('/status/{postCategory}', 'CategoryController@status')->name('admin.content.category.status');
        });

        //comment routes
        Route::prefix('comment')->group(function () {
            Route::get('/', 'CommentController@index')->name('admin.content.comment.index');
            Route::post('/store', 'CommentController@store')->name('admin.content.comment.store');
            Route::get('/show/{comment}', 'CommentController@show')->name('admin.content.comment.show');
            Route::get('/approved/{comment}', 'CommentController@approved')->name('admin.content.comment.approved');
            Route::get('/status/{comment}', 'CommentController@status')->name('admin.content.comment.status');
            Route::post('/answer/{comment}', 'CommentController@answer')->name('admin.content.comment.answer');
        });

        //faq routes
        Route::prefix('faq')->group(function () {
            Route::get('/', 'FAQController@index')->name('admin.content.faq.index');
            Route::get('/create', 'FAQController@create')->name('admin.content.faq.create');
            Route::post('/store', 'FAQController@store')->name('admin.content.faq.store');
            Route::get('/show/{faq}', 'FAQController@show')->name('admin.content.faq.show');
            Route::get('/edit/{faq}', 'FAQController@edit')->name('admin.content.faq.edit');
            Route::put('/update/{faq}', 'FAQController@update')->name('admin.content.faq.update');
            Route::delete('/destroy/{faq}', 'FAQController@destroy')->name('admin.content.faq.destroy');
            //for ajax
            Route::get('/status/{faq}', 'FAQController@status')->name('admin.content.faq.status');
        });

        //menu routes
        Route::prefix('menu')->group(function () {
            Route::get('/', 'MenuController@index')->name('admin.content.menu.index');
            Route::get('/create', 'MenuController@create')->name('admin.content.menu.create');
            Route::post('/store', 'MenuController@store')->name('admin.content.menu.store');
            Route::get('/show/{menu}', 'MenuController@show')->name('admin.content.menu.show');
            Route::get('/edit/{menu}', 'MenuController@edit')->name('admin.content.menu.edit');
            Route::put('/update/{menu}', 'MenuController@update')->name('admin.content.menu.update');
            Route::delete('/destroy/{menu}', 'MenuController@destroy')->name('admin.content.menu.destroy');
            //for ajax
            Route::get('/status/{menu}', 'MenuController@status')->name('admin.content.menu.status');
        });

        //page builder routes
        Route::prefix('page-builder')->group(function () {
            Route::get('/', 'PageBuilderController@index')->name('admin.content.page-builder.index');
            Route::get('/create', 'PageBuilderController@create')->name('admin.content.page-builder.create');
            Route::post('/store', 'PageBuilderController@store')->name('admin.content.page-builder.store');
            Route::get('/show/{page}', 'PageBuilderController@show')->name('admin.content.page-builder.show');
            Route::get('/edit/{page}', 'PageBuilderController@edit')->name('admin.content.page-builder.edit');
            Route::put('/update/{page}', 'PageBuilderController@update')->name('admin.content.page-builder.update');
            Route::delete('/destroy/{page}', 'PageBuilderController@destroy')->name('admin.content.page-builder.destroy');
            //for ajax
            Route::get('/status/{page}', 'PageBuilderController@status')->name('admin.content.page-builder.status');
        });

        //page builder routes
        Route::prefix('banner')->group(function () {
            Route::get('/', 'BannerController@index')->name('admin.content.banner.index');
            Route::get('/create', 'BannerController@create')->name('admin.content.banner.create');
            Route::post('/store', 'BannerController@store')->name('admin.content.banner.store');
            Route::get('/show/{banner}', 'BannerController@show')->name('admin.content.banner.show');
            Route::get('/edit/{banner}', 'BannerController@edit')->name('admin.content.banner.edit');
            Route::put('/update/{banner}', 'BannerController@update')->name('admin.content.banner.update');
            Route::delete('/destroy/{banner}', 'BannerController@destroy')->name('admin.content.banner.destroy');
            //for ajax
            Route::get('/status/{banner}', 'BannerController@status')->name('admin.content.banner.status');
        });

        //post routes
        Route::prefix('post')->group(function () {
            Route::get('/', 'PostController@index')->name('admin.content.post.index');
            Route::get('/create', 'PostController@create')->name('admin.content.post.create');
            Route::post('/store', 'PostController@store')->name('admin.content.post.store');
            Route::get('/show/{post}', 'PostController@show')->name('admin.content.post.show');
            Route::get('/edit/{post}', 'PostController@edit')->name('admin.content.post.edit');
            Route::put('/update/{post}', 'PostController@update')->name('admin.content.post.update');
            Route::delete('/destroy/{post}', 'PostController@destroy')->name('admin.content.post.destroy');
            //for ajax
            Route::get('/status/{post}', 'PostController@status')->name('admin.content.post.status');
            Route::get('/commentable/{post}', 'PostController@commentable')->name('admin.content.post.commentable');
        });
    });

    //user routes
    Route::prefix('user')->namespace('User')->group(function () {
        //admin user routes
        Route::prefix('admin')->group(function () {
            Route::get('/', 'AdminUserController@index')->name('admin.user.admin.index');
            Route::get('/create', 'AdminUserController@create')->name('admin.user.admin.create');
            Route::post('/store', 'AdminUserController@store')->name('admin.user.admin.store');
            Route::get('/show/{user}', 'AdminUserController@show')->name('admin.user.admin.show');
            Route::get('/edit/{user}', 'AdminUserController@edit')->name('admin.user.admin.edit');
            Route::put('/update/{user}', 'AdminUserController@update')->name('admin.user.admin.update');
            Route::delete('/destroy/{user}', 'AdminUserController@destroy')->name('admin.user.admin.destroy');
            Route::get('/status/{user}', 'AdminUserController@status')->name('admin.user.admin.status');
            Route::get('/activation/{user}', 'AdminUserController@activation')->name('admin.user.admin.activation');
            Route::get('/role/{user}', 'AdminUserController@role')->name('admin.user.admin.role');
            Route::post('/role/{user}/store', 'AdminUserController@roleStore')->name('admin.user.admin.role-store');
            Route::get('/permission/{user}', 'AdminUserController@permission')->name('admin.user.admin.permission');
            Route::post('/permission/{user}/store', 'AdminUserController@permissionStore')->name('admin.user.admin.permission-store');
        });

        //customer user routes
        Route::prefix('customer')->group(function () {
            Route::get('/', 'CustomerUserController@index')->name('admin.user.customer.index');
            Route::get('/create', 'CustomerUserController@create')->name('admin.user.customer.create');
            Route::post('/store', 'CustomerUserController@store')->name('admin.user.customer.store');
            Route::get('/show/{user}', 'CustomerUserController@show')->name('admin.user.customer.show');
            Route::get('/edit/{user}', 'CustomerUserController@edit')->name('admin.user.customer.edit');
            Route::put('/update/{user}', 'CustomerUserController@update')->name('admin.user.customer.update');
            Route::delete('/destroy/{user}', 'CustomerUserController@destroy')->name('admin.user.customer.destroy');
            Route::get('/status/{user}', 'CustomerUserController@status')->name('admin.user.customer.status');
            Route::get('/activation/{user}', 'CustomerUserController@activation')->name('admin.user.customer.activation');
        });

        //user role routes
        Route::prefix('role')->group(function () {
            Route::get('/', 'UserRoleController@index')->name('admin.user.role.index');
            Route::get('/create', 'UserRoleController@create')->name('admin.user.role.create');
            Route::post('/store', 'UserRoleController@store')->name('admin.user.role.store');
            Route::get('/show/{role}', 'UserRoleController@show')->name('admin.user.role.show');
            Route::get('/edit/{role}', 'UserRoleController@edit')->name('admin.user.role.edit');
            Route::put('/update/{role}', 'UserRoleController@update')->name('admin.user.role.update');
            Route::delete('/destroy/{role}', 'UserRoleController@destroy')->name('admin.user.role.destroy');
            Route::get('/permission-edit/{role}', 'UserRoleController@permissionEdit')->name('admin.user.role.permission-edit');
            Route::put('/permission-update/{role}', 'UserRoleController@permissionUpdate')->name('admin.user.role.permission-update');
        });

        //role permission routes
        Route::prefix('permission')->group(function () {
            Route::get('/', 'RolePermissionController@index')->name('admin.user.permission.index');
            Route::get('/create', 'RolePermissionController@create')->name('admin.user.permission.create');
            Route::post('/store', 'RolePermissionController@store')->name('admin.user.permission.store');
            Route::get('/show/{permission}', 'RolePermissionController@show')->name('admin.user.permission.show');
            Route::get('/edit/{permission}', 'RolePermissionController@edit')->name('admin.user.permission.edit');
            Route::put('/update/{permission}', 'RolePermissionController@update')->name('admin.user.permission.update');
            Route::delete('/destroy/{permission}', 'RolePermissionController@destroy')->name('admin.user.permission.destroy');
        });
    });

    Route::prefix('notify')->namespace('Notify')->group(function () {
        //email notification routes
        Route::prefix('email')->group(function () {
            Route::get('/', 'EmailController@index')->name('admin.notify.email.index');
            Route::get('/create', 'EmailController@create')->name('admin.notify.email.create');
            Route::post('/store', 'EmailController@store')->name('admin.notify.email.store');
            Route::get('/edit/{email}', 'EmailController@edit')->name('admin.notify.email.edit');
            Route::put('/update/{email}', 'EmailController@update')->name('admin.notify.email.update');
            Route::delete('/destroy/{email}', 'EmailController@destroy')->name('admin.notify.email.destroy');
            Route::get('/status/{email}', 'EmailController@status')->name('admin.notify.email.status');
            Route::get('/send-mail/{email}', 'EmailController@sendMail')->name('admin.notify.email.send-mail');
        });

        Route::prefix('email-file')->group(function () {
            Route::get('/{email}', 'EmailFileController@index')->name('admin.notify.email-file.index');
            Route::get('/{email}/create', 'EmailFileController@create')->name('admin.notify.email-file.create');
            Route::post('/{email}/store', 'EmailFileController@store')->name('admin.notify.email-file.store');
            Route::get('/edit/{emailFile}', 'EmailFileController@edit')->name('admin.notify.email-file.edit');
            Route::put('/update/{emailFile}', 'EmailFileController@update')->name('admin.notify.email-file.update');
            Route::delete('/destroy/{emailFile}', 'EmailFileController@destroy')->name('admin.notify.email-file.destroy');
            Route::get('/status/{emailFile}', 'EmailFileController@status')->name('admin.notify.email-file.status');
        });

        //sms notification routes
        Route::prefix('sms')->group(function () {
            Route::get('/', 'SMSController@index')->name('admin.notify.sms.index');
            Route::get('/create', 'SMSController@create')->name('admin.notify.sms.create');
            Route::post('/store', 'SMSController@store')->name('admin.notify.sms.store');
            Route::get('/edit/{sms}', 'SMSController@edit')->name('admin.notify.sms.edit');
            Route::put('/update/{sms}', 'SMSController@update')->name('admin.notify.sms.update');
            Route::delete('/destroy/{sms}', 'SMSController@destroy')->name('admin.notify.sms.destroy');
            Route::get('/status/{sms}', 'SMSController@status')->name('admin.notify.sms.status');
            Route::get('/send-sms/{sms}', 'SMSController@sendSMS')->name('admin.notify.sms.send-sms');
        });
    });

    //ticket route
    Route::prefix('ticket')->namespace('Ticket')->group(function () {

        Route::get('/', 'TicketController@index')->name('admin.ticket.index');
        Route::get('/new-tickets', 'TicketController@newTickets')->name('admin.ticket.newTickets');
        Route::get('/open-tickets', 'TicketController@openTickets')->name('admin.ticket.openTickets');
        Route::get('/closed-tickets', 'TicketController@closedTickets')->name('admin.ticket.closedTickets');
        Route::get('/show/{ticket}', 'TicketController@show')->name('admin.ticket.show');
        Route::post('/answer/{ticket}', 'TicketController@answer')->name('admin.ticket.answer');
        Route::post('/change/{ticket}', 'TicketController@change')->name('admin.ticket.change');

        //Category routes
        Route::prefix('category')->group(function () {
            Route::get('/', 'TicketCategoryController@index')->name('admin.ticket.category.index');
            Route::get('/create', 'TicketCategoryController@create')->name('admin.ticket.category.create');
            Route::post('/store', 'TicketCategoryController@store')->name('admin.ticket.category.store');
            Route::get('/edit/{ticketCategory}', 'TicketCategoryController@edit')->name('admin.ticket.category.edit');
            Route::put('/update/{ticketCategory}', 'TicketCategoryController@update')->name('admin.ticket.category.update');
            Route::delete('/destroy/{ticketCategory}', 'TicketCategoryController@destroy')->name('admin.ticket.category.destroy');
            //for ajax
            Route::get('/status/{ticketCategory}', 'TicketCategoryController@status')->name('admin.ticket.category.status');
        });

        //Category routes
        Route::prefix('priority')->group(function () {
            Route::get('/', 'TicketPriorityController@index')->name('admin.ticket.priority.index');
            Route::get('/create', 'TicketPriorityController@create')->name('admin.ticket.priority.create');
            Route::post('/store', 'TicketPriorityController@store')->name('admin.ticket.priority.store');
            Route::get('/edit/{ticketPriority}', 'TicketPriorityController@edit')->name('admin.ticket.priority.edit');
            Route::put('/update/{ticketPriority}', 'TicketPriorityController@update')->name('admin.ticket.priority.update');
            Route::delete('/destroy/{ticketPriority}', 'TicketPriorityController@destroy')->name('admin.ticket.priority.destroy');
            //for ajax
            Route::get('/status/{ticketPriority}', 'TicketPriorityController@status')->name('admin.ticket.priority.status');
        });

        //Category routes
        Route::prefix('admin')->group(function () {
            Route::get('/', 'TicketAdminController@index')->name('admin.ticket.admin.index');
            Route::get('/set/{admin}', 'TicketAdminController@set')->name('admin.ticket.admin.set');
        });
    });

    Route::prefix('setting')->namespace('Setting')->group(function () {
        Route::get('/', 'SettingController@index')->name('admin.setting.index');
        Route::get('/edit/{setting}', 'SettingController@edit')->name('admin.setting.edit');
        Route::put('/update/{setting}', 'SettingController@update')->name('admin.setting.update');
    });

    Route::post('notification/read-all', [NotificationController::class, 'readAll'])->name('admin.notification.readAll');
});

Route::namespace('Site')->group(function(){
    //auth routes
    Route::get('/login-register', [LoginRegisterController::class, 'loginRegister'])->name('site.auth.login-register');
    Route::post('/login-register', [LoginRegisterController::class, 'loginRegisterStore'])->name('site.auth.login-register.store')->middleware('throttle:site-login-register');
    Route::get('/code-confirm/{token}', [LoginRegisterController::class, 'codeConfirm'])->name('site.auth.code-confirm');
    Route::post('/code-confirm/{token}', [LoginRegisterController::class, 'codeConfirmStore'])->name('site.auth.code-confirm.store')->middleware('throttle:site-confirm-code');
    Route::get('/resend-code/{token}', [LoginRegisterController::class, 'resendCode'])->name('site.auth.resend')->middleware('throttle:site-resend-code');
    Route::get('/logout', [LoginRegisterController::class, 'logout'])->name('site.auth.logout');

    //home routes
    Route::get('/', [HomeController::class, 'index'])->name('site.home');

    //product routes
    Route::get('/product/{product:slug}', [ProductController::class, 'index'])->name('site.product.single');
    Route::post('/add-comment/{product}', [ProductController::class, 'commentStore'])->name('site.product.add-comment');
    Route::post('/add-favorite/{product}', [ProductController::class, 'addToFavorite'])->name('site.product.add-to-favorite');
    Route::get('/rate-product/{product:slug}', [ProductController::class, 'rateProduct'])->name('site.product.rate');
    Route::post('/add-compare/{product}', [ProductController::class, 'addToCompare'])->name('site.product.add-to-compare');

    Route::get('/products/{category?}', [ProductController::class, 'products'])->name('site.products');

    //sale process routes
    Route::namespace('SaleProcess')->group(function (){
        //Cart routes
        Route::get('/cart',[CartController::class, 'cart'])->name('site.sale.cart');
        Route::post('/cart',[CartController::class, 'updateCart'])->name('site.sale.cart-update');
        Route::post('/add-to-cart/{product}',[CartController::class, 'addToCart'])->name('site.sale.add-to-cart');
        Route::get('/remove-from-cart/{cartItem}',[CartController::class, 'removeFromCart'])->name('site.sale.remove-from-cart');

        //Shipping routes
        Route::prefix('shipping')->group(function (){
            Route::get('/', [ShippingController::class, 'shipping'])->name('site.sale.shipping.index');
            Route::post('/add-address', [ShippingController::class, 'addAddress'])->name('site.sale.shipping.add-address');
            Route::post('/set-address-and-delivery', [ShippingController::class, 'setAddressAndDelivery'])->name('site.sale.shipping.set-address-and-delivery');
        });

        //Payment routes
        Route::prefix('payment')->group(function (){
            Route::get('/', [SitePaymentController::class, 'payment'])->name('site.sale.payment.index');
            Route::post('/apply-coupon', [SitePaymentController::class, 'applyCoupon'])->name('site.sale.payment.apply-coupon');
            Route::post('/submit', [SitePaymentController::class, 'paymentSubmit'])->name('site.sale.payment.submit');
            Route::any('/callback/{order}/{onlinePayment}', [SitePaymentController::class, 'paymentCallback'])->name('site.sale.payment.callback');
        });
    });

    //User account routes
    Route::namespace('Account')->prefix('account')->group(function (){
        Route::prefix('profile')->group(function (){
            Route::get('/', [SiteProfileController::class, 'index'])->name('site.account.profile.index');
        });

        Route::prefix('address')->group(function (){
            Route::get('/', [SiteAddressController::class, 'index'])->name('site.account.address.index');
        });

        Route::prefix('orders')->group(function (){
            Route::get('/', [SiteOrderController::class, 'index'])->name('site.account.orders.index');
        });

        Route::prefix('favorite')->group(function (){
            Route::get('/', [SiteFavoriteController::class, 'index'])->name('site.account.favorite.index');
            Route::get('/remove/{product}', [SiteFavoriteController::class, 'removeFavorite'])->name('site.account.favorite.remove');
        });

        Route::prefix('compare')->group(function (){
            Route::get('/', [CompareController::class, 'index'])->name('site.account.compare.index');
            Route::get('/remove/{product}', [CompareController::class, 'removeCompare'])->name('site.account.compare.remove');
        });

        Route::prefix('tickets')->group(function (){
           Route::get('/', [AccountTicketController::class, 'index'])->name('site.account.tickets.index');
           Route::get('/create', [AccountTicketController::class, 'create'])->name('site.account.tickets.create');
           Route::post('/store', [AccountTicketController::class, 'store'])->name('site.account.tickets.store');
           Route::get('/show/{ticket}', [AccountTicketController::class, 'show'])->name('site.account.tickets.show');
           Route::get('/answer/{ticket}', [AccountTicketController::class, 'answer'])->name('site.account.tickets.answer');
           Route::get('/change/{ticket}', [AccountTicketController::class, 'change'])->name('site.account.tickets.change');
        });
    });

    Route::get('/page/{page:slug}', [PageController::class, 'index'])->name('site.page');
});
