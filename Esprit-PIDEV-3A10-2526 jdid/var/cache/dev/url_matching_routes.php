<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/fc-load-events' => [[['_route' => 'fc_load_events', '_controller' => 'CalendarBundle\\Controller\\CalendarController::loadAction'], null, null, null, false, false, null]],
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/dashboard/admin/users' => [[['_route' => 'admin_users', '_controller' => 'App\\Controller\\AdminController::users'], null, null, null, false, false, null]],
        '/dashboard/admin/users/new' => [[['_route' => 'admin_user_new', '_controller' => 'App\\Controller\\AdminController::newUser'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\AuthController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\AuthController::logout'], null, null, null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\AuthController::register'], null, null, null, false, false, null]],
        '/admin/produits/stock' => [[['_route' => 'admin_stock_index', '_controller' => 'App\\Controller\\BackAdmin\\ProduitController::indexStock'], null, ['GET' => 0], null, false, false, null]],
        '/admin/produits/stock/nouveau' => [[['_route' => 'admin_stock_new', '_controller' => 'App\\Controller\\BackAdmin\\ProduitController::newStock'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/produits/consommation' => [[['_route' => 'admin_consommation_index', '_controller' => 'App\\Controller\\BackAdmin\\ProduitController::indexConsommation'], null, ['GET' => 0], null, false, false, null]],
        '/admin/produits/consommation/nouveau' => [[['_route' => 'admin_consommation_new', '_controller' => 'App\\Controller\\BackAdmin\\ProduitController::newConsommation'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/agriculteur/produits/stock' => [[['_route' => 'agriculteur_stock_index', '_controller' => 'App\\Controller\\BackAgriculteur\\ProduitController::indexStock'], null, ['GET' => 0], null, false, false, null]],
        '/agriculteur/produits/stock/nouveau' => [[['_route' => 'agriculteur_stock_new', '_controller' => 'App\\Controller\\BackAgriculteur\\ProduitController::newStock'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/agriculteur/produits/consommation' => [[['_route' => 'agriculteur_consommation_index', '_controller' => 'App\\Controller\\BackAgriculteur\\ProduitController::indexConsommation'], null, ['GET' => 0], null, false, false, null]],
        '/agriculteur/produits/consommation/nouveau' => [[['_route' => 'agriculteur_consommation_new', '_controller' => 'App\\Controller\\BackAgriculteur\\ProduitController::newConsommation'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/dashboard' => [[['_route' => 'app_dashboard', '_controller' => 'App\\Controller\\DashboardController::index'], null, null, null, false, false, null]],
        '/dashboard/admin' => [[['_route' => 'dashboard_admin', '_controller' => 'App\\Controller\\DashboardController::admin'], null, null, null, false, false, null]],
        '/dashboard/client' => [[['_route' => 'dashboard_client', '_controller' => 'App\\Controller\\DashboardController::client'], null, null, null, false, false, null]],
        '/dashboard/agriculteur' => [[['_route' => 'dashboard_agriculteur', '_controller' => 'App\\Controller\\DashboardController::agriculteur'], null, null, null, false, false, null]],
        '/client/produits' => [[['_route' => 'client_produit_index', '_controller' => 'App\\Controller\\Front\\ClientController::index'], null, ['GET' => 0], null, false, false, null]],
        '/profile' => [[['_route' => 'app_profile', '_controller' => 'App\\Controller\\ProfileController::index'], null, null, null, false, false, null]],
        '/article' => [[['_route' => 'app_article_index', '_controller' => 'App\\Controller\\article\\ArticleController::index'], null, ['GET' => 0], null, true, false, null]],
        '/article/new' => [[['_route' => 'app_article_new', '_controller' => 'App\\Controller\\article\\ArticleController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/article/statistiques/prix' => [[['_route' => 'app_article_stats_price', '_controller' => 'App\\Controller\\article\\ArticleController::statsPrice'], null, ['GET' => 0], null, false, false, null]],
        '/article/statistiques/poids' => [[['_route' => 'app_article_stats_weight', '_controller' => 'App\\Controller\\article\\ArticleController::statsWeight'], null, ['GET' => 0], null, false, false, null]],
        '/calendar' => [[['_route' => 'app_calendar', '_controller' => 'App\\Controller\\article\\CalendarController::index'], null, null, null, false, false, null]],
        '/calendar/events' => [[['_route' => 'app_calendar_events', '_controller' => 'App\\Controller\\article\\CalendarController::events'], null, null, null, false, false, null]],
        '/cart' => [[['_route' => 'app_cart_index', '_controller' => 'App\\Controller\\article\\CartController::index'], null, null, null, true, false, null]],
        '/cart/checkout/submit' => [[['_route' => 'app_cart_checkout_submit', '_controller' => 'App\\Controller\\article\\CartController::checkoutSubmit'], null, ['POST' => 0], null, false, false, null]],
        '/consultant' => [[['_route' => 'app_consultant', '_controller' => 'App\\Controller\\article\\ConsultantController::index'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/' => [[['_route' => 'app_home', '_controller' => 'App\\Controller\\article\\HomeController::index'], null, null, null, false, false, null]],
        '/order' => [[['_route' => 'app_order_index', '_controller' => 'App\\Controller\\article\\OrderController::index'], null, ['GET' => 0], null, true, false, null]],
        '/order/new' => [[['_route' => 'app_order_new', '_controller' => 'App\\Controller\\article\\OrderController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/order/statistiques/montant' => [[['_route' => 'app_order_stats_amount', '_controller' => 'App\\Controller\\article\\OrderController::statsAmount'], null, ['GET' => 0], null, false, false, null]],
        '/order/statistiques/frais' => [[['_route' => 'app_order_stats_fees', '_controller' => 'App\\Controller\\article\\OrderController::statsFees'], null, ['GET' => 0], null, false, false, null]],
        '/estimateur-prix' => [[['_route' => 'app_price_estimator', '_controller' => 'App\\Controller\\article\\PriceEstimatorController::index'], null, null, null, false, false, null]],
        '/shop' => [[['_route' => 'app_shop_index', '_controller' => 'App\\Controller\\article\\ShopController::index'], null, null, null, false, false, null]],
        '/todo' => [[['_route' => 'app_todo_index', '_controller' => 'App\\Controller\\article\\TodoController::index'], null, ['GET' => 0], null, true, false, null]],
        '/todo/new' => [[['_route' => 'app_todo_new', '_controller' => 'App\\Controller\\article\\TodoController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
                .'|/dashboard/admin/users/([^/]++)/(?'
                    .'|edit(*:241)'
                    .'|toggle(*:255)'
                    .'|delete(*:269)'
                .')'
                .'|/a(?'
                    .'|dmin/produits/(?'
                        .'|stock/([^/]++)(?'
                            .'|/edit(*:322)'
                            .'|(*:330)'
                        .')'
                        .'|consommation/([^/]++)(?'
                            .'|/edit(*:368)'
                            .'|(*:376)'
                        .')'
                    .')'
                    .'|griculteur/produits/(?'
                        .'|stock/([^/]++)(?'
                            .'|/edit(*:431)'
                            .'|(*:439)'
                        .')'
                        .'|consommation/([^/]++)(?'
                            .'|/edit(*:477)'
                            .'|(*:485)'
                        .')'
                    .')'
                    .'|rticle/([^/]++)(?'
                        .'|(*:513)'
                        .'|/(?'
                            .'|edit(*:529)'
                            .'|delete(*:543)'
                        .')'
                    .')'
                .')'
                .'|/c(?'
                    .'|lient/produits/([^/]++)(*:582)'
                    .'|art/(?'
                        .'|add/([^/]++)(*:609)'
                        .'|remove/([^/]++)(*:632)'
                        .'|update/([^/]++)/([^/]++)(*:664)'
                    .')'
                .')'
                .'|/order/([^/]++)/(?'
                    .'|edit(*:697)'
                    .'|delete(*:711)'
                .')'
                .'|/shop/article/([^/]++)(*:742)'
                .'|/todo/([^/]++)/([^/]++)/(?'
                    .'|edit(*:781)'
                    .'|delete(*:795)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        241 => [[['_route' => 'admin_user_edit', '_controller' => 'App\\Controller\\AdminController::editUser'], ['id'], null, null, false, false, null]],
        255 => [[['_route' => 'admin_user_toggle', '_controller' => 'App\\Controller\\AdminController::toggleUser'], ['id'], ['POST' => 0], null, false, false, null]],
        269 => [[['_route' => 'admin_user_delete', '_controller' => 'App\\Controller\\AdminController::deleteUser'], ['id'], ['POST' => 0], null, false, false, null]],
        322 => [[['_route' => 'admin_stock_edit', '_controller' => 'App\\Controller\\BackAdmin\\ProduitController::editStock'], ['idProduit'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        330 => [[['_route' => 'admin_stock_delete', '_controller' => 'App\\Controller\\BackAdmin\\ProduitController::deleteStock'], ['idProduit'], ['POST' => 0], null, false, true, null]],
        368 => [[['_route' => 'admin_consommation_edit', '_controller' => 'App\\Controller\\BackAdmin\\ProduitController::editConsommation'], ['idProduit'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        376 => [[['_route' => 'admin_consommation_delete', '_controller' => 'App\\Controller\\BackAdmin\\ProduitController::deleteConsommation'], ['idProduit'], ['POST' => 0], null, false, true, null]],
        431 => [[['_route' => 'agriculteur_stock_edit', '_controller' => 'App\\Controller\\BackAgriculteur\\ProduitController::editStock'], ['idProduit'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        439 => [[['_route' => 'agriculteur_stock_delete', '_controller' => 'App\\Controller\\BackAgriculteur\\ProduitController::deleteStock'], ['idProduit'], ['POST' => 0], null, false, true, null]],
        477 => [[['_route' => 'agriculteur_consommation_edit', '_controller' => 'App\\Controller\\BackAgriculteur\\ProduitController::editConsommation'], ['idProduit'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        485 => [[['_route' => 'agriculteur_consommation_delete', '_controller' => 'App\\Controller\\BackAgriculteur\\ProduitController::deleteConsommation'], ['idProduit'], ['POST' => 0], null, false, true, null]],
        513 => [[['_route' => 'app_article_show', '_controller' => 'App\\Controller\\article\\ArticleController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        529 => [[['_route' => 'app_article_edit', '_controller' => 'App\\Controller\\article\\ArticleController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        543 => [[['_route' => 'app_article_delete', '_controller' => 'App\\Controller\\article\\ArticleController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        582 => [[['_route' => 'client_produit_show', '_controller' => 'App\\Controller\\Front\\ClientController::show'], ['idProduit'], ['GET' => 0], null, false, true, null]],
        609 => [[['_route' => 'app_cart_add', '_controller' => 'App\\Controller\\article\\CartController::add'], ['id'], null, null, false, true, null]],
        632 => [[['_route' => 'app_cart_remove', '_controller' => 'App\\Controller\\article\\CartController::remove'], ['id'], null, null, false, true, null]],
        664 => [[['_route' => 'app_cart_update', '_controller' => 'App\\Controller\\article\\CartController::update'], ['id', 'quantity'], null, null, false, true, null]],
        697 => [[['_route' => 'app_order_edit', '_controller' => 'App\\Controller\\article\\OrderController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        711 => [[['_route' => 'app_order_delete', '_controller' => 'App\\Controller\\article\\OrderController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        742 => [[['_route' => 'app_shop_show', '_controller' => 'App\\Controller\\article\\ShopController::show'], ['id'], null, null, false, true, null]],
        781 => [[['_route' => 'app_todo_edit', '_controller' => 'App\\Controller\\article\\TodoController::edit'], ['nomTache', 'tache'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        795 => [
            [['_route' => 'app_todo_delete', '_controller' => 'App\\Controller\\article\\TodoController::delete'], ['nomTache', 'tache'], ['POST' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
