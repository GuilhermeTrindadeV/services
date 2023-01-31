<?php
    $this->layout("_theme", [
        "title" => "Salvar Usuário",
        "items" => $items
    ]);
?>

<form action="<?= $saveServiceURL ?>" method="POST">
    <div class="card">
        <div class="car-body p-4">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome do Culto</label>
                    <input type="text" class="form-control <?= $errors["cult_nome"] ? "is-invalid" : "" ?>" 
                        name="cult_nome" value="<?= $cult_nome ?>">
                        <div class="invalid-feedback"><?= $errors["cult_nome"] ?></div>
                </div>
    
                <div class="form-group col-md-6">
                    <label for="tipo">Tipo de Culto</label>
                    <select name="cult_tipo" class="form-control  <?= $errors["cult_tipo"] ? "is-invalid" : "" ?>">
                        <option value="">Selecionar...</option>
                        <?php 
                            if($serviceTypes) {
                                foreach($serviceTypes as $serviceType) {
                                    $selected = $cult_tipo == $serviceType->tip_culto_id ? "selected" : "";
                                    echo "<option value=\"{$serviceType->tip_culto_id}\" {$selected}>
                                        {$serviceType->tip_culto_nome}</option>";
                                }
                            }
                        ?>
                    </select>
                        <div class="invalid-feedback"><?= $errors["cult_tipo"] ?></div>
                </div>
            </div>
        </div>
        <div class="card-footer d-block text-center">
            <input type="submit" class="subAndBack btn btn-success" value="Salvar">
            <a href="<?= url("cultos") ?>"><input type="button" class="btn btn-warning" value="Voltar"></a>
        </div>
    </div>
</form>