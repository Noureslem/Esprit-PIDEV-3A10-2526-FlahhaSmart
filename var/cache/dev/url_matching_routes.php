<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/article' => [[['_route' => 'app_article_index', '_controller' => 'App\\Controller\\article\\ArticleController::index'], null, ['GET' => 0], null, true, false, null]],
        '/article/new' => [[['_route' => 'app_article_new', '_controller' => 'App\\Controller\\article\\ArticleController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/article/statistiques/prix' => [[['_route' => 'app_article_stats_price', '_controller' => 'App\\Controller\\article\\ArticleController::statsPrice'], null, ['GET' => 0], null, false, false, null]],
        '/article/statistiques/poids' => [[['_route' => 'app_article_stats_weight', '_controller' => 'App\\Controller\\article\\ArticleController::statsWeight'], null, ['GET' => 0], null, false, false, null]],
        '/consultant' => [[['_route' => 'app_consultant', '_controller' => 'App\\Controller\\article\\ConsultantController::index'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/' => [[['_route' => 'app_home', '_controller' => 'App\\Controller\\article\\HomeController::index'], null, null, null, false, false, null]],
        '/order' => [[['_route' => 'app_order_index', '_controller' => 'App\\Controller\\article\\OrderController::index'], null, ['GET' => 0], null, true, false, null]],
        '/order/new' => [[['_route' => 'app_order_new', '_controller' => 'App\\Controller\\article\\OrderController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/order/statistiques/montant' => [[['_route' => 'app_order_stats_amount', '_controller' => 'App\\Controller\\article\\OrderController::statsAmount'], null, ['GET' => 0], null, false, false, null]],
        '/order/statistiques/frais' => [[['_route' => 'app_order_stats_fees', '_controller' => 'App\\Controller\\article\\OrderController::statsFees'], null, ['GET' => 0], null, false, false, null]],
        '/estimateur-prix' => [[['_route' => 'app_price_estimator', '_controller' => 'App\\Controller\\article\\PriceEstimatorController::index'], null, null, null, false, false, null]],
        '/todo' => [[['_route' => 'app_todo_index', '_controller' => 'App\\Controller\\article\\TodoController::index'], null, ['GET' => 0], null, true, false, null]],
        '/todo/new' => [[['_route' => 'app_todo_new', '_controller' => 'App\\Controller\\article\\TodoController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/article/([^/]++)/(?'
                    .'|edit(*:67)'
                    .'|delete(*:80)'
                .')'
                .'|/order/([^/]++)/(?'
                    .'|edit(*:111)'
                    .'|delete(*:125)'
                .')'
                .'|/todo/([^/]++)/([^/]++)/(?'
                    .'|edit(*:165)'
                    .'|delete(*:179)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        67 => [[['_route' => 'app_article_edit', '_controller' => 'App\\Controller\\article\\ArticleController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        80 => [[['_route' => 'app_article_delete', '_controller' => 'App\\Controller\\article\\ArticleController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        111 => [[['_route' => 'app_order_edit', '_controller' => 'App\\Controller\\article\\OrderController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        125 => [[['_route' => 'app_order_delete', '_controller' => 'App\\Controller\\article\\OrderController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        165 => [[['_route' => 'app_todo_edit', '_controller' => 'App\\Controller\\article\\TodoController::edit'], ['nomTache', 'tache'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        179 => [
            [['_route' => 'app_todo_delete', '_controller' => 'App\\Controller\\article\\TodoController::delete'], ['nomTache', 'tache'], ['POST' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
