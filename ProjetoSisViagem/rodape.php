</main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      
      const logoutButton = document.getElementById("logoutButton");
      if (logoutButton) {
        logoutButton.addEventListener("click", function(event) {
          event.preventDefault();

          Swal.fire({
            title: 'Você tem certeza?',
            text: "Deseja sair do sistema?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, sair',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "sair.php";
            }
          });
        });
      }

    });

    function confirmarExclusao(formId) {
        Swal.fire({
            title: 'Você tem certeza?',
            text: "Esta ação não poderá ser revertida!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        })
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var table = new DataTable('#tabela', {
        language: {
          url: 'https://cdn.datatables.net/plug-ins/2.2.2/i18n/pt-BR.json',
        },
      }); 
    });
  </script>

  </body>
</html>