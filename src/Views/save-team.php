<?php
    $this->layout("_theme", [
        "title" => "Salvar Equipe",
        "items" => $items
    ]);
?>

<form action="<?= $saveTeamURL ?>" method="POST">
    <div class="card">
        <div class="car-body p-4">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="equi_nome">Nome da Equipe</label>
                    <input type="text" class="form-control <?= $errors["equi_nome"] ? "is-invalid" : "" ?>" 
                        name="equi_nome" value="<?= $equi_nome ?>">
                        <div class="invalid-feedback"><?= $errors["equi_nome"] ?></div>
                </div>

                <div class="form-group col-md-6">
                    <label for="equi_lider">Líder da Equipe</label>
                    <select name="equi_lider" class="form-control <?= $errors["equi_lider"] ? "is-invalid" : "" ?>">
                        <option value="">Selecionar...</option>
                        <?php 
                            if($users) {
                                foreach($users as $usu) {
                                    $selected = $equi_lider == $usu->id ? "selected" : "";
                                    echo "<option value=\"{$usu->id}\" {$selected}>
                                        {$usu->nome}</option>";
                                }
                            }
                        ?>
                    </select>
                        <div class="invalid-feedback"><?= $errors["equi_lider"] ?></div>
                </div>
            </div>
        </div>
        <div class="card-footer d-block text-center">
            <input type="submit" class="subAndBack btn btn-success" value="Salvar">
            <a href="<?= url("equipes") ?>"><input type="button" class="btn btn-warning" value="Voltar"></a>
        </div>
    </div>
</form>