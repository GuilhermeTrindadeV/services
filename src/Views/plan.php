<?php 
    $this->layout("_theme-header", [
        "title" => "Plano | Services",
        "items" => $items
    ])
?>

<?php 
    $this->insert('components/save-song', [
        'action' => $router->route('plans.addSong', ['services_id' => $service->cult_id]),
        'songs' => $songs
    ]); 
?>

<div card="card" id="teste">
    <div class="card-header bg-light pt-4">
        <div class="d-flex bd-highlight">
            <div class="p-2 bd-highlight">
                <div class="btn btn-sm border border-success">
                    <a href="#" class="text text-muted" id="adicionar" data-bs-toggle="modal" data-bs-target="#save-song-modal">Adicionar Música</a> 
                </div>
            </div>
        </div>
    </div>
    <div class="card-body" style="background-color: #4bff0054">
        <table class="table table-light mb-0 pb-0" id="heiress-table">
            <thead>
                <tr>
                    <th style="width: 32px;" scope="col"></th>
                    <th scope="col">DURAÇÃO</th>
                    <th scope="col">TÍTULO</th>
                </tr>
            </thead>
            <tbody list>
                <tr>
                    <td handler style="cursor: move;">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i> 
                    </td>
                    <td>0:00</td>
                    <td>Oh Que Tremenda Graça <span class="border border-success rounded-circle p-1">D</span></td>
                </tr>
                <tr>
                    <td handler style="cursor: move;">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i> 
                    </td>
                    <td>0:00</td>
                    <td>Filho do Deus Vivo <span class="border border-success rounded-circle p-1">E</span></td>
                </tr>
                <tr>
                    <td handler style="cursor: move;">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </td>
                    <td>0:00</td>
                    <td>O Grande Eu Sou <span class="border border-success rounded-circle p-1">C</span></td>
                </tr>
                <tr>
                    <td handler style="cursor: move;">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </td>
                    <td>0:00</td>
                    <td>10000 Razões <span class="border border-success rounded-circle p-1">C</span></td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th colspan="3" class="table-active">Ministração da Palavra</th>
                </tr>
            </thead>
            <tbody list>
                <tr>
                    <td handler style="cursor: move;" scope="row">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i> 
                    </td>
                    <td>0:00</td>
                    <td>Enquanto Espero <span class="border border-success rounded-circle p-1">C</span></td>
                </tr>
                <tr>
                    <td scope="row">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </td>
                    <td class="text text-secondary">Adicionar Item</td>
                    <td class="d-flex justify-content-end">
                        <span class="btn btn-sm btn-success">Feito</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer pl-2 mb-0 bg-light">
        <div class="d-flex justify-content-around">
            <span class="mt-1" style="font-size: 15px;">0:00</span>
            <div class="d-flex justify-content-start" style="font-size: 12px; height: 30px;">
                <button class="border mt-1" style="margin: 0 5px">s</button>
                <button class="border mt-1">espaço</button><p class="mt-1">: música</p>
            </div>
            <div class="d-flex justify-content-start" style="font-size: 12px; height: 30px;">
                <button class="border mt-1" style="margin: 0 5px">m</button>
                <button class="border mt-1">espaço</button><p class="mt-1">: mídia</p>
            </div>
            <div class="d-flex justify-content-start" style="font-size: 12px; height: 30px;">
                <button class="border mt-1" style="margin: 0 5px">h</button>
                <button class="border mt-1">espaço</button><p class="mt-1">: cabeçalho</p>
            </div>
            <div>
                <span class="mt-1" style="margin: 0 5px">|</span>
            </div>
            <div class="d-flex justify-content-start" style="font-size: 15px; height: 30px;">
                <span class="mt-2 mr-2" style="font-size: 15px; font-weight: bold;">"0:00" </span><p class="mt-2">: comprimento</p>
            </div>
        </div>
    </div>
</div>

<?php $this->start('scripts') ?>
<script>
    $(function () {
        const song_list = $("[list]");
        song_list.sortable({
            handle: "[handler]"
        });

        var copia = document.querySelector("#heiress-table tbody tr").outerHTML;

        $("#adicionar").on("click", function() {
            $("#heiress-table").append(copia);
        });

        const form = $("#save-song");

        $("#save-song").on("submit", function() {
            $("#save-song-modal").modal("hide");
        });
        
        form.submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if(response.success) {
                        toastr.success(response.message);
                    }
                }
            });
        });
    });
</script>
<?php $this->end(); ?>