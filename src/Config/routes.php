<?php

$router = new \CoffeeCode\Router\Router(ROOT);
$router->namespace("Src\App");

$router->group(null);
$router->get("/", "Web:home");
$router->get("/inicio", "Web:home");

$router->get("/login", "Web:login", "web.login");
$router->post("/login", "Web:login", "web.login");
$router->get("/logout", "Web:logout", "web.logout");
$router->post("/send-to-leader", "Web:sendToLeader", "web.sendToLeader", \Src\App\Middlewares\MUser::class);

$router->group('planos', \Src\App\Middlewares\MUser::class);
$router->get("/", "Plans:plans", 'plans.plans');
$router->get("/{services_id}", "Plans:get", 'plans.create');
$router->post("/", "Plans:plans", 'plans.plans');

$router->group('usuarios', \Src\App\Middlewares\MUser::class);
$router->get("/", "Users:users", 'users.users');
$router->post("/", "Users:save", "users.store");
$router->get("/{user_id}", "Users:get", 'users.edit');
$router->post("/{user_id}", "Users:save", "users.update");
$router->get("/{user_id}/delete", "Users:delete", "users.delete");
$router->get("/criar", "Users:get", 'users.create');

$router->group('tipo-de-usuarios', \Src\App\Middlewares\MUser::class);
$router->get("/", "AUserTypes:userTypes", 'usertypesCRUD.usertypes');
$router->post("/", "AUserTypes:save", "userTypesCRUD.store");
$router->get("/{user_types_id}", "AUserTypes:get", "usertypesCRUD.edit");
$router->post("/{user_types_id}", "AUserTypes:save", "userTypesCRUD.update");
$router->get("/{user_types_id}/delete", "AUserTypes:delete", "userTypesCRUD.delete");
$router->get("/criar", "AUserTypes:get", 'userTypesCRUD.create');

$router->group('equipes', \Src\App\Middlewares\MTeams::class);
$router->get("/", "Teams:team", 'teams.teams');
$router->post("/", "Teams:save", "teams.store");
$router->get("/{team_id}", "Teams:get", 'teams.edit');
$router->post("/{team_id}", "Teams:save", "teams.update");
$router->get("/{team_id}/delete", "Teams:delete", "teams.delete");
$router->get("/criar", "Teams:get", 'teams.create');

$router->group('musicas', \Src\App\Middlewares\MSongs::class);
$router->get("/", "Songs:songs");
$router->post("/", "Songs:save", "songs.store");
$router->get("/{songs_id}", "Songs:get", "songs.edit");
$router->post("/{songs_id}", "Songs:save", "songs.update");
$router->get("/{songs_id}/delete", "Songs:delete", "songs.delete");
$router->get("/criar", "Songs:get", 'songs.create');

$router->group('cultos', \Src\App\Middlewares\MServices::class);
$router->get("/", "Services:service", 'services.service');
$router->post("/", "Services:save", "services.store");
$router->get("/{services_id}", "Services:get", 'services.edit');
$router->post("/{services_id}", "Services:save", "services.update");
$router->get("/{services_id}/delete", "Services:delete", "services.delete");
$router->get("/criar", "Services:get", 'services.create');

$router->group('tipos-de-culto', \Src\App\Middlewares\MServiceTypes::class);
$router->get("/", "ServiceTypesCRUD:serviceTypes", 'serviceTypesCRUD.serviceTypes');
$router->post("/", "ServiceTypesCRUD:save", "serviceTypesCRUD.store");
$router->get("/{services_types_id}", "ServiceTypesCRUD:get", 'serviceTypesCRUD.edit');
$router->post("/{services_types_id}", "ServiceTypesCRUD:save", "serviceTypesCRUD.update");
$router->get("/{services_types_id}/delete", "ServiceTypesCRUD:delete", "serviceTypesCRUD.delete");
$router->get("/criar", "ServiceTypesCRUD:get", 'serviceTypesCRUD.create');

$router->group('bloqueios', \Src\App\Middlewares\MUser::class);
$router->get("/", "Blocks:block", 'blocks.blocks');
$router->post("/", "Blocks:save", "blocks.store");
$router->get("/{block_id}", "Blocks:get", 'blocks.edit');
$router->post("/{block_id}", "Blocks:save", "blocks.update");
$router->get("/{block_id}/delete", "Blocks:delete", "blocks.delete");
$router->get("/criar", "Blocks:get", 'blocks.create');

$router->group('erro');
$router->get("/{error_code}", "Error:main");

$router->dispatch();

if($router->error()) {
    $router->redirect("/erro/{$router->error()}");
}