<?php 
    $this->layout("_theme-login", [ 
        "title" => "Login", 
        "items" => $items 
    ]); 
?> 

<form action="#" method="POST">
    <div class="row d-flex justify-content-around">
        <div class="col-md-6">
            <div class="login-card card">
                <div class="card-header p-0 pt-4">
                    <div class="">
                        <p class="h2 text-center">Bem-vindo!</p>
                        <p class="text-center">Faça o seu Login</p>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <div class="form-group mt-0">
                        <label for="email">E-mail</label> 
                        <input type="email" class="form-control <?= $errors["login_email"] ? "is-invalid" : "" ?>"  
                            name="login_email" value="<?= $login_email ?>"> 
                        <div class="invalid-feedback"><?= $errors["login_email"] ?></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="senha">Senha</label> 
                        <input type="password" class="form-control <?= $errors["login_senha"] ? "is-invalid" : "" ?>"  
                            name="login_senha"> 
                        <div class="invalid-feedback"><?= $errors["login_senha"] ?></div> 
                    </div>
                </div>
                <hr>
                <div class="card-footer d-flex justify-content-around p-1">
                    <input type="submit" class="btn btn-success" value="Entrar"> 
                </div>
            </div>
        </div>
    </div>
</form>