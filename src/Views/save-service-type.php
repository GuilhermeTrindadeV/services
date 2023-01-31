<?php
    $this->layout("_theme", [
        "title" => "Salvar Tipo de Usuário",
        "items" => $items
    ]);
?>

<form action="<?= $saveServiceTypesURL ?>" method="POST">
    <div class="card">
        <div class="car-body p-4">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="nome">Nome do Tipo de Culto</label>
                    <input type="text" class="form-control <?= $errors["tip_culto_nome"] ? "is-invalid" : "" ?>" 
                        name="tip_culto_nome" value="<?= $tip_culto_nome ?>">
                        <div class="invalid-feedback"><?= $errors["tip_culto_nome"] ?></div>
                </div>
            </div>
        </div>
            <div class="card-footer d-block text-center">
                <input type="submit" class="subAndBack btn btn-success" value="Salvar">
                <a href="<?= url("tipos-de-culto") ?>"><input type="button" class="btn btn-warning" value="Voltar"></a>
            </div>
    </div>
</form>