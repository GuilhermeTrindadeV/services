<?php 
    $this->layout("_theme", [
        "title" => "Culto | Services",
        "items" => $items
    ]) 
?>

<div class="card">
<div class="header p-4 pb-0">
        <div class="row">
            <div class="col-6">
                <h6 class="ml-4">Lista dos Cultos</h6>
            </div>
            <div class="col-6 text-end">
            <a href="<?= url("cultos/criar") ?>" class="criar bg-success" 
                data-toggle="tooltip" data-original-title="Edit song">
                <span class="texto1">Criar Culto</span>
                <i class="fa-solid fa-circle-plus text-white"></i>
            </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Nome de Culto
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Culto de 
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Data de Criação
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Data de Modificação
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($services as $service): ?>
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="<?= url("themes/soft-ui/assets/img/viva.jpg") ?>" class="avatar avatar-sm me-3" alt="user1">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm"><?= $service->cult_nome ?></h6>
                                    <p class="text-xs text-secondary mb-0"><?= $service->mus_nome ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?= $service->service_type_name ?></span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?= $service->cult_data_c ?></span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?= $service->cult_data_m ?></span>
                        </td>
                        <td class="align-middle">
                            <a href="<?= url("cultos/{$service->cult_id}") ?>" class="editar bg-info ml-5" 
                                data-toggle="tooltip" data-original-title="Edit service">
                                <span class="texto1">EDITAR</span>
                                <i class="fa fa-edit text-white"></i>
                            </a>
                            <a href="<?= url("cultos/{$service->cult_id}/delete") ?>" class="excluir bg-danger" 
                                data-toggle="tooltip" data-original-title="Delete service">
                                <span class="texto2">EXCLUIR</span>  
                                <i class="icone fa fa-trash text-white"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
