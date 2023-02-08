<?php 
    $this->layout("_theme", [
        "title" => "Início",
        "items" => $items
    ]) 
?>

<?php 
    $this->insert('components/lider-modal', [
        'action' => url('send-to-leader')
    ]); 
?>

<div class="card">
    <div id="script"></div>
    <div class="card-header bg-light pb-1">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="btn btn-success">
                        <i class="fa fa-calendar-times-o fa-lg" id="icon"></i>
                        <a href="<?= url('bloqueios/criar') ?>"  class="text-white">Data de Bloqueio</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="btn btn-success">
                        <i class="fa fa-envelope fa-lg" id="icon"></i>
                        <a href="#" class="text-white">Minhas Menssagens</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="btn btn-success" data-bs-toggle="modal" data-bs-target="#send-to-leader-modal">
                        <i class="fa fa-user fa-lg" id="icon"></i>
                        <span class="text-white">Notificar Meu Líder</span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <?php foreach($services as $service): ?>
                <a class="cardHv col-md-4 hover-overlay" href="<?= url("planos") ?>">
                    <div class="col-md-4">
                        <div class="allCard bg bg-light mb-3">
                            <div class="row">
                                <div class="col-9 pb-0">
                                    <h5 class="card-title p-3 pb-0 text-success">Set 05</h5>                   
                                </div>
                                <div class="col-1">
                                    <i class="fa fa-clock-o text-end p-3" id="clock"></i>
                                </div>
                                <p class="card-text p-4 pt-0 pb-0 text-success"><?= $service->cult_nome ?></p>
                                <div class="pt-0 pl-3 m-2">
                                    <i class="fa fa-check-circle text-success"></i>
                                    <span class="p-0"><b>Chave: </b>Levitas Músicos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
    </div>
</div>

<?php $this->start('scripts') ?>
<script>
    $(function () {
        const send_form = $("form#send-to-leader");
        const send_modal = $("#send-to-leader-modal");

        send_form.submit((event) => {
            event.preventDefault();

            $.ajax({
                url: send_form.attr('action'),
                type: send_form.attr('method'),
                data: send_form.serialize(),
                datatype: 'json',
                success: function (response) {
                    if(response.error) {
                        alert(response.error);
                    }

                    if(response.success) {
                        alert(response.success);
                        send_modal.modal('toggle');
                    }
                }
            })
        });
    });
        toastr.success('Seja Bem-Vindo(a) ao Services');
</script>
<?php $this->end() ?>