<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once 'dashboard/include/base_include.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>DeckBattle</title>
        <link href="/dashboard/css/styles.css" rel="stylesheet" type="text/css" />
        <!--[if IE]> <link href="/dashboard/css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->
        <link href="/dashboard/css/datatable_styles_override.css" rel="stylesheet" type="text/css" />
        <?php
            require_once 'dashboard/include/script_include.php';
 ?>
        <script type="text/javascript" src="/dashboard/js/files/datatable_global.js"></script>
        <script type="text/javascript" src="/dashboard/js/files/datatable_replacers.js"></script>
        <script type="text/javascript" src="/dashboard/js/files/datatable_toolbars.js"></script>
        <script type="text/javascript" src="/dashboard/js/files/datatable_tradelist.js"></script>
        <script type="text/javascript">
            $(function() {
                $("select, .check, .check :checkbox, input:radio, input:file").uniform();
            });
            
            function addcardstocollection(_cardid, _cardname, amount_normal, amount_foil,wn,wf,f) {
$.post("/dashboard/services/addcards_tradelist.php", {
cardid: _cardid,
userid: '<?php echo $_SESSION['user_id']; ?>',
    amountn: amount_normal,
    amountf: amount_foil,
    }, function(response){
    setTimeout("finishAjax("+_cardid+",'"+_cardname+"','Tradelist','"+escape(response)+"')", 400);
    });
    return false;
    }

    function finishAjax(id ,name,list,response) { //TODO: make json callback

        if (response != "") {
                var n=response.split("/");
                
                if (n[0] != ""){
                    $.jGrowl(decodeURI(n[0]));  
                  }
                  else {              
                    $('#normal_'+id).html(n[1]);
                    $('#foil_'+id).html(n[2]);
                }
            }
    }

        </script>
    </head>

    <body>
        <?php
        require_once 'dashboard/include/dashboard_header.php';
 ?>
        <?php
            require_once 'dashboard/include/dashboard_farleftsidebar.php';
 ?>
        <?php
            require_once 'dashboard/include/dashboard_leftsidebar_cardsdecks.php';
 ?>

        <!-- Content begins -->
        <div id="content">
            <?php
            require_once 'dashboard/include/dashboard_pageheader.php';
            createPageHeader("Collection", $mysqli);
        ?>
            <?php
                require_once 'dashboard/include/dashboard_breadcrumb.php';
                generateBreadcrumb("Dashboard", "Cards & Decks", "Card Collection");
            ?>
            <!-- Main content -->
            <div class="wrapper">
                <div class="wButton grid6">
                    <a class="buttonL bGreen" style="margin-top: 10px;" title="" href="/dashboard/collection/add_cards_tradelist.php">Add cards to Trade List</a>
                </div>
                <div class="widget">
                    <div class="whead">
                        <h6>Card to Trade</h6>
                        <div class="clear"></div>
                    </div>
                    <div class="shownpars" >
                        <table cellpadding="0" cellspacing="0" border="0" class="collection">
                            <thead>
                                <tr>
                                     <th style="width:70px;">Qty. Normal</th>
                                     <th style="width:70px;">Qty.  Foil</th>
                                    <th>Name</th>
                                    <th style="width:180px;">Type</th>
                                    <th style="width:120px;">Cost</th>
                                    <th style="width:90px;">Color</th>
                                    <th style="width:30px;">Edition</th>
                                    <th style="width:30px;">Rarity</th>
                               <!--     <th style="width:30px;">Options</th> -->
                             </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <!-- Main content ends -->
        </div>
        <!-- Content ends -->
    </body>
</html>