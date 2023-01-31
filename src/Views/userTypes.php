<?php 
    $this->layout("_theme", [
        "title" => "Tipo de Usuários | Services",
        "items" => $items
    ]) 
?>

<div class="card">
<div class="header p-4 pb-0">
        <div class="row">
            <div class="col-6">
                <h6 class="ml-4">Lista dos Tipos de Usuários</h6>
            </div>
            <div class="col-6 text-end">
            <a href="<?= url("tipo-de-usuarios/criar") ?>" class="criar bg-success" 
                data-toggle="tooltip" data-original-title="Edit song">
                <span class="texto1">Criar Tipo de Usuário</span>
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
                            Tipo de Usuário
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Função
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Data de Criação
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($userTypes as $userType): ?>
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="<?= url("themes/soft-ui/assets/img/viva.jpg") ?>" class="avatar avatar-sm me-3" alt="user1">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm"><?= $userType->tip_nome ?></h6>
                                    <p class="text-xs text-secondary mb-0"><?= $userType->tip_nome_plural ?></p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0 text-center"><?= $userType->tip_data_c ?></p>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?= $userType->tip_data_m ?></span>
                        </td>
                        <td class="align-middle">
                            <a href="<?= url("tipo-de-usuarios/{$userType->tip_usu_id}") ?>" class="editar bg-info ml-5" 
                                data-toggle="tooltip" data-original-title="Edit user">
                                <span class="texto1">EDITAR</span>
                                <i class="fa fa-edit text-white"></i>
                            </a>
                            <a href="<?= url("tipo-de-usuarios/{$userType->tip_usu_id}/delete") ?>" class="excluir bg-danger" 
                                data-toggle="tooltip" data-original-title="Delete user">
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
