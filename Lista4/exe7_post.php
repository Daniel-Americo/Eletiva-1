<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 4 </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <form method="post" action ="exe7_resposta.php">
        <label for="data1" class="form-label">Digite a primeira data (dd/mm/YYYY):</label>
        <input type="text" id="data1" name="data1" class="form-control" required>

        <label for="data2" class="form-label mt-2">Digite a segunda data (dd/mm/YYYY):</label>
        <input type="text" id="data2" name="data2" class="form-control" required>

        <button type="submit" class="btn btn-primary mt-3">Calcular Diferença</button>
    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  </body>
</html>