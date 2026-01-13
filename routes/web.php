<?php

// Home routes
$router->get('/', 'App\\Modules\\Forum\\Controllers\\HomeController@index');
$router->get('/home', 'App\\Modules\\Forum\\Controllers\\HomeController@index');

// Auth routes
$router->get('/login', 'App\\Modules\\Auth\\Controllers\\LoginController@index');
$router->post('/login', 'App\\Modules\\Auth\\Controllers\\LoginController@store');
$router->get('/register', 'App\\Modules\\Auth\\Controllers\\RegisterController@index');
$router->post('/register', 'App\\Modules\\Auth\\Controllers\\RegisterController@store');
$router->post('/logout', 'App\\Modules\\Auth\\Controllers\\LogoutController@index');

// Forum routes
$router->get('/forum/{id}', 'App\\Modules\\Forum\\Controllers\\ForumController@show');
$router->get('/topic/{id}', 'App\\Modules\\Forum\\Controllers\\TopicController@show');
$router->post('/topic/{id}/reply', 'App\\Modules\\Forum\\Controllers\\PostController@store');
$router->get('/new-topic', 'App\\Modules\\Forum\\Controllers\\NewTopicController@index');
$router->post('/new-topic', 'App\\Modules\\Forum\\Controllers\\NewTopicController@store');

// CRUD operations
$router->get('/topic/{id}/edit', 'App\\Modules\\Forum\\Controllers\\TopicController@edit');
$router->post('/topic/{id}/update', 'App\\Modules\\Forum\\Controllers\\TopicController@update');
$router->post('/topic/{id}/delete', 'App\\Modules\\Forum\\Controllers\\TopicController@delete');
$router->get('/post/{id}/edit', 'App\\Modules\\Forum\\Controllers\\PostController@edit');
$router->post('/post/{id}/update', 'App\\Modules\\Forum\\Controllers\\PostController@update');
$router->post('/post/{id}/delete', 'App\\Modules\\Forum\\Controllers\\PostController@delete');

// Search
$router->get('/search', 'App\\Modules\\Forum\\Controllers\\SearchController@index');

// Static pages
$router->get('/about', 'App\\Modules\\Web\\Controllers\\PageController@about');
$router->get('/calendar', 'App\\Modules\\Events\\Controllers\\CalendarController@index');
$router->get('/academic-calendar', 'App\\Modules\\Events\\Controllers\\CalendarController@index');

// Feature modules
$router->get('/documents', 'App\\Modules\\Documents\\Controllers\\DocumentController@index');
$router->get('/document-library', 'App\\Modules\\Documents\\Controllers\\DocumentController@index');
$router->get('/jobs', 'App\\Modules\\Jobs\\Controllers\\JobController@index');
$router->get('/job-board', 'App\\Modules\\Jobs\\Controllers\\JobController@index');
$router->get('/research', 'App\\Modules\\Research\\Controllers\\ResearchController@index');
$router->get('/research-hub', 'App\\Modules\\Research\\Controllers\\ResearchController@index');

// User routes
$router->get('/profile', 'App\\Modules\\User\\Controllers\\ProfileController@index');
$router->post('/profile/update', 'App\\Modules\\User\\Controllers\\ProfileController@update');
$router->post('/upload-avatar', 'App\\Modules\\User\\Controllers\\ProfileController@uploadAvatar');
$router->get('/messages', 'App\\Modules\\Messaging\\Controllers\\MessageController@index');
$router->get('/notifications', 'App\\Modules\\User\\Controllers\\NotificationController@index');
$router->get('/groups', 'App\\Modules\\User\\Controllers\\GroupController@index');
$router->get('/university-groups', 'App\\Modules\\User\\Controllers\\GroupController@index');
$router->get('/settings', 'App\\Modules\\User\\Controllers\\SettingsController@index');

// Admin routes
$router->get('/admin', 'App\\Modules\\Admin\\Controllers\\DashboardController@index');
