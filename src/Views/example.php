<form id="form-teste" action="rota/de/teste" method="post" enctype="multipart/form-data">
    <input type="file" class="form-control-file" name="imagem">
</form>

<script>
    $(document).ready(function () {
        $('#form-teste').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(callback) {
                    
                },
                error: function(callback) {

                }
            });
        });
    });
</script>

<!-- No método que vai receber os dados de submissão, a variável $_FILES vai receber os arquivos enviados. Portanto, estaria em $_FILES['imagem'] -->