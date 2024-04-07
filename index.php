<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>


<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Gestion</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
     aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#barre">Barre de recherche</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#balance">Tri par balance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#tous">Tous les clients</a>
        </li>
        <li class="nav-item">
        <button type="button" id ="seco" class="btn btn-primary">Se connecter</button>
        </li>

      </ul>
    </div>
  </div>
</nav>




<div id="barre">

<h2>Barre de recherche par nom</h2>

<div class="container">

  <div class="row">

    <div class="col-sm-0 col-md-2 col-lg-3"></div>

    <div class="col-sm-12 col-md-8 col-lg-6">



      <div class="form-group">

        <input class="form-control" type="text" id="search-client" value="" placeholder="Rechercher un ou plusieurs clients par leur nom"/>

      </div>

      <div style="margin-top: 20px">

        <div id="result-search"></div> 

      </div>

    </div>

  </div>

</div>

</div>




<div id="balance">

<h2>Clients selon leur balance</h2>

    <label>
        <input type="radio" name="balance" value="positive" checked> Balance positive
    </label>
    <label>
        <input type="radio" name="balance" value="negative" > Balance négative
    </label>
    <div id="resultats"></div>

    </div>




<div id="tous">

<h2>Tous les clients</h2>


<div id="resultatous">



</div>

</div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <script src="js/bootstrap.min.js"></script>

<!-- /////////////////////////////SCRIPT AJAX BOUTON SE CO -->

<script>

        document.getElementById('seco').addEventListener('click', function() {

            var xhr = new XMLHttpRequest();
            

            xhr.open('GET', 'connexion.php', true);
            

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {

                    window.location.href = 'connexion.php';
                }
            };
            

            xhr.send();
        });
    </script>



<!-- /////////////////////////////SCRIPT AJAX BARRE DE RECHERCHE -->
<script>
// Le code s'exécute si le document est complètement chargé
	  $(document).ready(function(){
// Gestionnaire d'évènements : déclenche la fonction dès qu'une touche dans le champs search-client est relachée
	    $('#search-client').keyup(function(){
// Vide le contenu de la div result-search
	      $('#result-search').html('');
// Stocke dans la variable utilisateur la valeur de search-client
	      var utilisateur = $(this).val();
// Si la valeur n'est pas nulle
	      if(utilisateur != ""){

	        $.ajax({
            // Méthode HTTP
	          type: 'GET',
            // URL de page de traiement
	          url: 'recherche.php',
            // On envoie le paramètre client avec la valeur utilisateur encodée pour les caractères spéciaux
	          data: 'client=' + encodeURIComponent(utilisateur),

            // Si la requète AJAX réussie
	          success: function(data){
	            if(data != ""){
                // On ajoute les données dans la div result-search
	              $('#result-search').append(data);
	            }
              // Sinon, on écrit Aucun Utilisateur
              else{
	              document.getElementById('result-search').innerHTML = "<div style='font-size: 20px; text-align: center; margin-top: 10px'>Aucun utilisateur</div>"
	            }
	          }
	        });
	      }
	    });
	  });
	</script>

<!-- ////////////////////////////////AFFICHER LES CLIENTS SELON RADIO -->

<script>

        function radioClients(balance) {

            $.ajax({
                url: 'radio_clients.php', 
                method: 'GET',
                data: { balance: balance },
                success: function(data) {

                    $('#resultats').html(data);
                },

                error: function() {
                    alert('Erreur');
                }
            });
        }


        $('input[name="balance"]').change(function() {
            var balanceSelectionnee = $(this).val();
            radioClients(balanceSelectionnee);
        });


        radioClients('positive'); 
        
    </script>



<!-- TOUS LES CLIENTS -->
<script>
        $(document).ready(function() {

            $.ajax({

                url: 'recuperer_clients.php', 
                method: 'GET',
                dataType: 'json',

                success: function(data) {
                    if (data && data.length > 0) {
                        var resultatHtml = '<ul>';
                        data.forEach(function(client) {
                            resultatHtml += '<li>' + '<p>' + client.name + ' - ' + client.statut + " " + ":" + client.balance + '</p>' + '</li>';
                        });

                        resultatHtml += '</ul>';
                        $('#resultatous').html(resultatHtml);
                    } else {
                        $('#resultatous').html('Aucun client trouvé.');
                    }
                },

                error: function() {
                    $('#resultatous').html('Erreur lors de la récupération des données.');
                }
            });
        });
    </script>

</html>