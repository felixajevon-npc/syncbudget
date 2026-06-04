<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::where('email', 'manager@syncbudget.com')->first();
$request = \Illuminate\Http\Request::create('/api/management/logs', 'GET');
$request->setUserResolver(function() use ($user) { return $user; });

$controller = new \App\Http\Controllers\Api\ActivityLogController();
$response = $controller->index($request);
echo json_encode($response->getData(true), JSON_PRETTY_PRINT);
