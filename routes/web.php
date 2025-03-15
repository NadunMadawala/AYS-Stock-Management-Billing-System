<?php

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

use App\Http\Controllers\AllMembersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\CS_MainDashboardController;
use App\Http\Controllers\CS_ClothsController;
use App\Http\Controllers\CS_ItemSellingController;
use App\Http\Controllers\CS_StockReportsController;
use App\Http\Controllers\CS_LowStockAlertReportsController;
use App\Http\Controllers\CS_LowStockInAndOutReportsController;
use App\Http\Controllers\CS_SalesReportController;
use App\Http\Controllers\CS_DiscountReportController;




Route::group(['middleware' => 'prevent-back-history'], function () {

    Route::group(['middleware' => 'login' ], function () {
        Route::get('/', function () {
            return view('auth.login');
        });
    });



    Route::group(['middleware' => ['get.menu']], function () {
        // Route::get('/', function () {           return view('dashboard.homepage'); });

        // Route::get('/', function () {
        //     return view('auth.login');
        // });


        Route::group(['middleware' => ['role:cashier|manager|admin']], function () {


            Route::get('/dashboard', function () {
                return view('dashboard.homepage');
            });



            Route::get('/dashboard', [CS_MainDashboardController::class, 'viewMainDashboard'])->name('main-dashboard');
            Route::get('/user-register', [CS_MainDashboardController::class, 'viewRegisterPage'])->name('user-register');


            Route::resource('add-cloths',        'CS_ClothsController');
            Route::POST('/clothes-insert', [CS_ClothsController::class, 'store'])->name('clothes.store');
            Route::get('/clothes/{cloth}/pricing', [CS_ClothsController::class, 'createPricing'])->name('clothes.pricing.create');
            Route::post('/clothes/{cloth}/pricing', [CS_ClothsController::class, 'storePricing'])->name('clothes.pricing.store');
            Route::get('/cloths-list', [CS_ClothsController::class, 'listAllClothsDetails'])->name('clothes.list');
            Route::get('/clothes/{id}/details', [CS_ClothsController::class, 'showClothDetails'])->name('clothes.details');

            Route::get('/clothes/{id}/edit', [CS_ClothsController::class, 'clothsEdit'])->name('clothes.edit');
            Route::put('/clothes/{id}', [CS_ClothsController::class, 'clothsUpdate'])->name('clothes.update');



            Route::resource('item-selling',        'CS_ItemSellingController');
            Route::get('/search-items', [CS_ItemSellingController::class, 'searchItems'])->name('search.items');

            Route::post('/sales/complete', [CS_ItemSellingController::class, 'completeSale']);


            Route::get('/current-stock-report', [CS_StockReportsController::class, 'currentStockReport'])->name('clothes.stock');
            Route::get('/current-stock-report/filter', [CS_StockReportsController::class, 'filterStockReport'])->name('clothes.filter');
            Route::get('/current-stock-report/export', [CS_StockReportsController::class, 'exportStockReport'])->name('clothes.export');

            Route::get('/low-stock-alert-report', [CS_LowStockAlertReportsController::class, 'lowStockReport'])->name('clothes.stock');

            Route::get('/stock-in-and-out-report', [CS_LowStockInAndOutReportsController::class, 'inAndOutStockReport'])->name('stock-in-and-out-report');
            Route::get('/stock-in-and-out-report/filter', [CS_LowStockInAndOutReportsController::class, 'filterInAndOutStockReport'])->name('stock-in-and-out.filter');
            Route::get('/stock-in-and-out-report/export', [CS_LowStockInAndOutReportsController::class, 'exportInAndOutStockReport'])->name('stock-in-and-out.export');


            Route::get('/daily-sales-report', [CS_SalesReportController::class, 'DailySalesReport'])->name('daily-sales-report');
            Route::get('/daily-sales-report/filter', [CS_SalesReportController::class, 'filterSalesReport'])->name('daily-sales-report.filter');
            Route::get('/daily-sales-report/export', [CS_SalesReportController::class, 'exportSalesReport'])->name('daily-sales-report.export');

            Route::get('/discount-report', [CS_DiscountReportController::class, 'DiscountReport'])->name('discount-report');
            Route::get('/discount-report/filter', [CS_DiscountReportController::class, 'filterDiscountReport'])->name('discount-report.filter');
            Route::get('/discount-report/export', [CS_DiscountReportController::class, 'exportDiscountReport'])->name('discount-report.export');


            Route::get('/colors', function () {
                return view('dashboard.colors');
            });
            Route::get('/typography', function () {
                return view('dashboard.typography');
            });
            Route::get('/charts', function () {
                return view('dashboard.charts');
            });
            Route::get('/widgets', function () {
                return view('dashboard.widgets');
            });
            Route::get('/404', function () {
                return view('dashboard.404');
            });
            Route::get('/500', function () {
                return view('dashboard.500');
            });
            Route::prefix('base')->group(function () {
                Route::get('/breadcrumb', function () {
                    return view('dashboard.base.breadcrumb');
                });
                Route::get('/cards', function () {
                    return view('dashboard.base.cards');
                });
                Route::get('/carousel', function () {
                    return view('dashboard.base.carousel');
                });
                Route::get('/collapse', function () {
                    return view('dashboard.base.collapse');
                });

                Route::get('/forms', function () {
                    return view('dashboard.base.forms');
                });
                Route::get('/jumbotron', function () {
                    return view('dashboard.base.jumbotron');
                });
                Route::get('/list-group', function () {
                    return view('dashboard.base.list-group');
                });
                Route::get('/navs', function () {
                    return view('dashboard.base.navs');
                });

                Route::get('/pagination', function () {
                    return view('dashboard.base.pagination');
                });
                Route::get('/popovers', function () {
                    return view('dashboard.base.popovers');
                });
                Route::get('/progress', function () {
                    return view('dashboard.base.progress');
                });
                Route::get('/scrollspy', function () {
                    return view('dashboard.base.scrollspy');
                });

                Route::get('/switches', function () {
                    return view('dashboard.base.switches');
                });
                Route::get('/tables', function () {
                    return view('dashboard.base.tables');
                });
                Route::get('/tabs', function () {
                    return view('dashboard.base.tabs');
                });
                Route::get('/tooltips', function () {
                    return view('dashboard.base.tooltips');
                });
            });
            Route::prefix('buttons')->group(function () {
                Route::get('/buttons', function () {
                    return view('dashboard.buttons.buttons');
                });
                Route::get('/button-group', function () {
                    return view('dashboard.buttons.button-group');
                });
                Route::get('/dropdowns', function () {
                    return view('dashboard.buttons.dropdowns');
                });
                Route::get('/brand-buttons', function () {
                    return view('dashboard.buttons.brand-buttons');
                });
            });
            Route::prefix('icon')->group(function () {  // word: "icons" - not working as part of adress
                Route::get('/coreui-icons', function () {
                    return view('dashboard.icons.coreui-icons');
                });
                Route::get('/flags', function () {
                    return view('dashboard.icons.flags');
                });
                Route::get('/brands', function () {
                    return view('dashboard.icons.brands');
                });
            });
            Route::prefix('notifications')->group(function () {
                Route::get('/alerts', function () {
                    return view('dashboard.notifications.alerts');
                });
                Route::get('/badge', function () {
                    return view('dashboard.notifications.badge');
                });
                Route::get('/modals', function () {
                    return view('dashboard.notifications.modals');
                });
            });
            Route::resource('notes', 'NotesController');
        });
        Auth::routes();

        Route::resource('resource/{table}/resource', 'ResourceController')->names([
            'index'     => 'resource.index',
            'create'    => 'resource.create',
            'store'     => 'resource.store',
            'show'      => 'resource.show',
            'edit'      => 'resource.edit',
            'update'    => 'resource.update',
            'destroy'   => 'resource.destroy'
        ]);

        Route::group(['middleware' => ['role:admin']], function () {
            Route::resource('bread',  'BreadController');   //create BREAD (resource)
            Route::resource('users',        'UsersController')->except(['create', 'store']);
            Route::resource('roles',        'RolesController');
            Route::resource('mail',        'MailController');
            Route::get('prepareSend/{id}',        'MailController@prepareSend')->name('prepareSend');
            Route::post('mailSend/{id}',        'MailController@send')->name('mailSend');
            Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
            Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');
            Route::prefix('menu/element')->group(function () {
                Route::get('/',             'MenuElementController@index')->name('menu.index');
                Route::get('/move-up',      'MenuElementController@moveUp')->name('menu.up');
                Route::get('/move-down',    'MenuElementController@moveDown')->name('menu.down');
                Route::get('/create',       'MenuElementController@create')->name('menu.create');
                Route::post('/store',       'MenuElementController@store')->name('menu.store');
                Route::get('/get-parents',  'MenuElementController@getParents');
                Route::get('/edit',         'MenuElementController@edit')->name('menu.edit');
                Route::post('/update',      'MenuElementController@update')->name('menu.update');
                Route::get('/show',         'MenuElementController@show')->name('menu.show');
                Route::get('/delete',       'MenuElementController@delete')->name('menu.delete');
            });
            Route::prefix('menu/menu')->group(function () {
                Route::get('/',         'MenuController@index')->name('menu.menu.index');
                Route::get('/create',   'MenuController@create')->name('menu.menu.create');
                Route::post('/store',   'MenuController@store')->name('menu.menu.store');
                Route::get('/edit',     'MenuController@edit')->name('menu.menu.edit');
                Route::post('/update',  'MenuController@update')->name('menu.menu.update');
                Route::get('/delete',   'MenuController@delete')->name('menu.menu.delete');
            });
            Route::prefix('media')->group(function () {
                Route::get('/',                 'MediaController@index')->name('media.folder.index');
                Route::get('/folder/store',     'MediaController@folderAdd')->name('media.folder.add');
                Route::post('/folder/update',   'MediaController@folderUpdate')->name('media.folder.update');
                Route::get('/folder',           'MediaController@folder')->name('media.folder');
                Route::post('/folder/move',     'MediaController@folderMove')->name('media.folder.move');
                Route::post('/folder/delete',   'MediaController@folderDelete')->name('media.folder.delete');;

                Route::post('/file/store',      'MediaController@fileAdd')->name('media.file.add');
                Route::get('/file',             'MediaController@file');
                Route::post('/file/delete',     'MediaController@fileDelete')->name('media.file.delete');
                Route::post('/file/update',     'MediaController@fileUpdate')->name('media.file.update');
                Route::post('/file/move',       'MediaController@fileMove')->name('media.file.move');
                Route::post('/file/cropp',      'MediaController@cropp');
                Route::get('/file/copy',        'MediaController@fileCopy')->name('media.file.copy');
            });
        });
    });
});
