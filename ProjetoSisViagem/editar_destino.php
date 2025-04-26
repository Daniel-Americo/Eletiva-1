    <?php
        require_once("cabecalho.php"); // Incluindo o cabeçalho
    ?>

    <h2>Editar Destino</h2>

    <form method="post">
        <div class="mb-3">
            <label for="estado" class="form-label">Nome do Estado</label>
            <input type="text" id="estado" name="estado" class="form-control" required="">
        </div>

        <div class="mb-3">
            <label for="cidade" class="form-label">Nome da Cidade</label>
            <input type="text" id="cidade" name="cidade" class="form-control" required="">
        </div>

        <div class="mb-3">
            <label for="pais" class="form-label">Nome do Pais</label>
            <input type="text" id="pais" name="pais" class="form-control" required="">
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
        <button type="button" class="btn btn-secondary" onclick="history.back();">Voltar</button>
    </form>

    <?php
        require_once("rodape.php"); // Incluindo o rodapé
    ?>
