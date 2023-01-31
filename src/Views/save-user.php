<?php
    $this->layout("_theme", [
        "title" => "Salvar Usuário",
        "items" => $items
    ]);
?>

<form action="<?= $saveURL ?>" method="POST">
    <div class="card">
        <div class="car-body p-4">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome do Usuário</label>
                    <input type="text" class="form-control <?= $errors["nome"] ? "is-invalid" : "" ?>" 
                        name="nome" value="<?= $nome ?>">
                        <div class="invalid-feedback"><?= $errors["nome"] ?></div>
                </div>

                <div class="form-group col-md-6">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control <?= $errors["email"] ? "is-invalid" : "" ?>" 
                        name="email" value="<?= $email ?>">
                        <div class="invalid-feedback"><?= $errors["email"] ?></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control <?= $errors["senha"] ? "is-invalid" : "" ?>" 
                        name="senha">
                        <div class="invalid-feedback"><?= $errors["senha"] ?></div>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="confirmar_senha">Confirmar Senha</label>
                    <input type="password" class="form-control <?= $errors["confirmar_senha"] ? "is-invalid" : "" ?>" 
                        name="confirmar_senha">
                        <div class="invalid-feedback"><?= $errors["confirmar_senha"] ?></div>
                </div>
            </div>
    
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="apelido">Apelido</label>
                    <input type="text" class="form-control <?= $errors["apelido"] ? "is-invalid" : "" ?>" 
                        name="apelido" value="<?= $apelido ?>">
                        <div class="invalid-feedback"><?= $errors["apelido"] ?></div>
                </div>
    
                <div class="form-group col-md-6">
                    <label for="tipo">Tipo de Usuário</label>
                    <select name="tip_usu_id" class="form-control  <?= $errors["tip_usu_id"] ? "is-invalid" : "" ?>">
                        <option value="">Selecionar...</option>
                        <?php 
                            if($userTypes) {
                                foreach($userTypes as $userType) {
                                    $selected = $tip_usu_id == $userType->tip_usu_id ? "selected" : "";
                                    echo "<option value=\"{$userType->tip_usu_id}\" {$selected}>
                                        {$userType->tip_nome}</option>";
                                }
                            }
                        ?>
                    </select>
                        <div class="invalid-feedback"><?= $errors["tip_usu_id"] ?></div>
                </div>
            </div>
        </div>
        <div class="card-footer d-block text-center">
            <input type="submit" class="subAndBack btn btn-success" value="Salvar">
            <a href="<?= url("usuarios") ?>"><input type="button" class="btn btn-warning" value="Voltar"></a>
        </div>
    </div>
</form>