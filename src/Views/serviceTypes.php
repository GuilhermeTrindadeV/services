<?php 
    $this->layout("_theme", [
        "title" => "Tipo de Culto | Services",
        "items" => $items
    ]) 
?>

<div class="card">
<div class="header p-4 pb-0">
        <div class="row">
            <div class="col-6">
                <h6 class="ml-4">Lista dos Tipos de Cultos</h6>
            </div>
            <div class="col-6 text-end">
            <a href="<?= url("tipos-de-culto/criar") ?>" class="criar bg-success" 
                data-toggle="tooltip" data-original-title="Edit song">
                <span class="texto1">Criar Tipo de Culto</span>
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
                            Tipo de Culto
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
                    <?php foreach($serviceTypes as $serviceType): ?>
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="<?= url("themes/soft-ui/assets/img/viva.jpg") ?>" class="avatar avatar-sm me-3" alt="user1">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm"><?= $serviceType->tip_culto_nome ?></h6>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?= $serviceType->tip_culto_data_c ?></span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?= $serviceType->tip_culto_data_m ?></span>
                        </td>
                        <td class="align-middle">
                            <a href="<?= url("tipos-de-culto/{$serviceType->tip_culto_id}") ?>" class="editar bg-info ml-5" 
                                data-toggle="tooltip" data-original-title="Edit serviceType">
                                <span class="texto1">EDITAR</span>
                                <i class="fa fa-edit text-white"></i>
                            </a>
                            <a href="<?= url("tipos-de-culto/{$serviceType->tip_culto_id}/delete") ?>" class="excluir bg-danger" 
                                data-toggle="tooltip" data-original-title="Delete serviceType">
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
