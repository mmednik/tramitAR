<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>tramitAR | &lt;PROGRAM.ar/&gt;</title>
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="css/typeahead.js-bootstrap.css" rel="stylesheet"> 
    <link href="css/bootstrap-glyphicons.css" rel="stylesheet"> 
    <link href="css/styles.css" rel="stylesheet">
    
  </head>
<?php include('lib/class.MySQL.php'); ?>
<?php 
  $oMySQL = new MySQL('tramites','***','***');
?>
  <body>
    <div id="wrap">
      <div class="navbar navbar-fixed-top">
        <div class="container">
          <a class="navbar-brand">
            <span class="glyphicon glyphicon-list-alt"></span><br />
            <strong>tramit</strong>AR
          </a>
        </div>
      </div>
      <div class="container">

        <form>
          <div class="form-group">
            <input type="text" class="form-control typeahead" id="search" name="search" placeholder="Busc&aacute; cualquier reclamo, denuncia y otros tr&aacute;mites ..." autofocus />
            <div id="no-results" class="alert fade in">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>No hay resultados.</strong> Pod&eacute;s elegir un tipo de tr&aacute;mite para una b&uacute;squeda r&aacute;pida.
            </div>
          </div>
        </form>

        <?php
          // titulos tramites
          $titulos = $oMySQL->ExecuteSQL('SELECT idtramites, titulo, organismo FROM tramites');
          // tags
          $tags = $oMySQL->ExecuteSQL('SELECT DISTINCT label FROM tags');
        ?>

        <div id="nav-filter">
          <div class="msg">
            <span>Tambi&eacute;n pod&eacute;s consultarlos todos por <strong>tipo de tr&aacute;mite</strong>: </span>
          </div>
          <div class="tags">
            <ul id="nav-tags">
            <?php foreach($tags as $tag): ?>
            <li><a type="button" class="btn btn-default <?php echo $tag['label'] ?>" data-tag="<?php echo $tag['label'] ?>"><?php echo $tag['label'] ?></a></li>
            <?php endforeach; ?>
            </ul>
          </div>
        </div>

        <div id="tramites">
          <div class="row">
          <?php $i=0 ?>
          <?php foreach($titulos as $titulo): ?>
            <?php $i++ ?>
            <?php $tituloTags = $oMySQL->ExecuteSQL('SELECT DISTINCT label FROM tags WHERE idtramites=' . $titulo['idtramites']) ?>
            <div data-toggle="modal" data-tramite="<?php echo $titulo['idtramites'] ?>" href="#modalTramite" class="col-lg-4<?php foreach($tituloTags as $tituloTag) { echo ' '; if(isset($tituloTag['label'])): print_r($tituloTag['label']); else: print_r($tituloTag); endif; } ?>">
              <p class="lead"><?php echo utf8_encode($titulo['titulo']) ?></p>
              <p><?php echo utf8_encode($titulo['organismo']) ?></p>
              <ul class="mini-tags">
              <?php foreach($tituloTags as $tituloTag) {
                  echo '<li><a class="btn btn-default btn-mini" disabled="disabled">';
                  if(isset($tituloTag['label'])): 
                    print_r($tituloTag['label']);
                  else:
                    print_r($tituloTag);
                  endif;
                  echo '</a></li>';
              } ?>
              </ul>
            </div>
            <?php /*if($i%3==0): ?></div><div class="row"><?php endif */?>
          <?php endforeach; ?>
          </div>
        </div>

      </div>
    </div>
    <div id="footer">
      <div class="container">
        <p class="text-muted credit"><a href="https://twitter.com/NatiusD">@NatiusD</a>, <a href="https://twitter.com/smessina_">@smessina_</a> y <a href="https://twitter.com/mmednik">@mmednik</a> para <a href="http://datospublicos.gob.ar/hackatonprogramar/">&lt;PROGRAM.ar/&gt;</a>.</p>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalTramite">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script src="js/jquery-1.10.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/typeahead.js"></script>
    <script src="js/scripts.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
      $('#search').typeahead({
          name: 'accounts',
          local: [
          <?php 
            foreach($titulos as $titulo) {
              echo "'" . htmlentities($titulo['titulo']) . "',";
            }
          ?>
          ],
          limit: 10
      });

      jQuery('#search').on('typeahead:selected', function (e, datum) {
        $.ajax({
           type: "POST",
           url: "resultado.php",
           data: "datum=" + datum.value,
           success: function(html){
              $('#tramites .col-lg-4[data-tramite="' + html.trim() + '"]').click();
           }
        });
      });

      $('#modalTramite').on('show.bs.modal', function () {
        $.ajax({
           type: "POST",
           url: "tramite.php",
           data: "id=" + IDtramite,
           success: function(html){
                $('#modalTramite').html(html);
           }
        });
      });
    });
    </script>
  </body>
</html>
