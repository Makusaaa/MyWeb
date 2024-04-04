<?php
    if(isset($_POST['manga'])){
        $html = file_get_contents('https://manga4life.com/manga/'.$_POST['manga']);
        $json = substr($html,strpos($html,"vm.Chapters = [")+strlen("vm.Chapters = [")-1);
        $json = json_decode(substr($json,0,strpos($json,']')+1));
        $chap1 = $json[count($json)-1]->Chapter;
        header('Location: '.'./manga?name='.$_POST['manga'].'&chapter='.showformat($chap1));
    }
    $json = file_get_contents('https://manga4life.com/_search.php');
    $obj = json_decode($json);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <title>Makusa</title>
  </head>
  <body>
    ayam ayam apa yang ayam?<br>
    ayam so cool...<br>
    -Makusa<br><br>
    Mau baca manga? nih tinggal pilih:<br>
    <form action="./index.php" method="post">
        <select name="manga" class="selectpicker" data-live-search="true">
            <option value="">cari manga</option>
            <?php
                    foreach($obj as $m){ ?>
                        <option value="<?=$m->i?>"><?=$m->s?></option>                        
            <?php   } ?>
        </select>
        <button type="submit" class="btn btn-light">Baca!</button>
    </form>


    <!-- Optional JavaScript -->
    <script>
        $('select').selectpicker();
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  </body>
</html>