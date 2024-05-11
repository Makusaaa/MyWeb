<?php
    include './chapterformating.php';
    $name = $_GET['name'];
    $chapter = $_GET['chapter'];
    $html = file_get_contents("https://www.manga4life.com/read-online/$name-chapter-".$chapter);
    $chapters = substr($html,strpos($html,"vm.CHAPTERS = [")+strlen("vm.CHAPTERS = [")-1);
    $chapters = json_decode(substr($chapters,0,strpos($chapters,']')+1));
    $source = substr($html,strpos($html,"vm.CurPathName = \"")+strlen("vm.CurPathName = \""));
    $source = substr($source,0,strpos($source,"\""));
    $linkname = substr($html,strpos($html,"vm.CurChapter = {\"")+strlen("vm.CurChapter = {\""));
    $linkname = substr($linkname,0,strpos($linkname,"}"));
    $linkname = substr($linkname,strpos($linkname,"Directory\":\"")+strlen("Directory\":\""));
    $linkname = substr($linkname,0,strpos($linkname,"\""));
    if(strlen($linkname)!=0){
        $linkname = $name.'/'.$linkname;
    }else{
        $linkname = $name;
    }
    // https://scans.lastation.us/mangalife/Golden-Boy/Part1/0000-001.png
    $chapindex = 0;
    foreach($chapters as $ch){
        if(showformat($ch->Chapter) == $chapter){
            $pages = (int)$ch->Page;
            break;
        }
        $chapindex += 1;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makusa</title>
</head>
<style>
    body{
        margin: 0;
    }
    #container{
        display: flex;
        flex-direction: column;
    }
    #container img{
        width: 100%;
    }
    .error{
        display: none;
    }
    #fullpage{
        display: flex;
        flex-direction: column;
    }
    .tab{
        display: flex;
        justify-content: space-between;
        background: black;
        height: 50px;
    }
    .button{
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-decoration: none;
        color: white;
    }

    .title{
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    #chapter{
        color: white;
        font-family: 'Courier New', Courier, monospace;
        margin: 0px auto;
    }
    
    #chapter input{
        width: 30px;
        text-align: center;
        padding: none;
        background-color: black;
        color: white;
        font-family: 'Courier New', Courier, monospace;
        border: none;
        font-size: 15px;
        outline: none;
    }

    #chapter input[type=text]:focus {
        border: none;
    }

    .prev{
        margin-left: 10px;
        font-family: 'Courier New', Courier, monospace;
    }
    .next{
        margin-right: 10px;
        font-family: 'Courier New', Courier, monospace;
    }

</style>
<body>
    <div id="testsrccontainer">
    </div>
    <div id="fullpage">
        <div class="tab">
            <a class="prev button" href="<?php if($chapindex != 0){ echo "/mangalife/?name=$name&chapter=".showformat($chapters[$chapindex-1]->Chapter); }?>">
                <span><?php if($chapindex != 0){ echo 'PREV'; }?></span>
            </a>
            <div class="title" action="javascript:gotopage()">
                <span id="chapter">Chapter <?=$chapter?></span>
            </div>
            <a class="next button" href="<?php if($chapindex != count($chapters)-1){ echo "/mangalife/?name=$name&chapter=".showformat($chapters[$chapindex+1]->Chapter); }?>">
                <span><?php if($chapindex != count($chapters)-1){ echo 'NEXT'; }?></span>
            </a>
        </div>
        <div id="container">
            <?php for($i=1;$i<=$chapters[$chapindex]->Page;$i++){ ?>
                <img class="page" id="" src="<?="https://$source/manga/$linkname/".imgformat($chapter)."-".sprintf('%03d',$i).".png"?>" alt="">
            <?php } ?>
        </div>
        <div class="tab">
            <a class="prev button" href="<?php if($chapindex != 0){ echo "/mangalife/?name=$name&chapter=".showformat($chapters[$chapindex-1]->Chapter); }?>">
                <span><?php if($chapindex != 0){ echo 'PREV'; }?></span>
            </a>
            <a class="next button" href="<?php if($chapindex != count($chapters)-1){ echo "/mangalife/?name=$name&chapter=".showformat($chapters[$chapindex+1]->Chapter); }?>">
                <span><?php if($chapindex != count($chapters)-1){ echo 'NEXT'; }?></span>
            </a>
        </div>
    </div>
</body>
</html>