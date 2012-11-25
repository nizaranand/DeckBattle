<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once 'dashboard/include/db_connect.php';

$deckid = $_GET['deckid'];
//echo $deckid;
$datasetCreatures = 0;
$datasetArtifactCreatures = 0;
$datasetArtifacts =  0;
$datasetAura =  0;
$datasetCurse =  0;
$datasetEnchantment =  0;
$datasetSorcery =  0;
$datasetInstant =  0;
$datasetScheme =  0;
$datasetPlaneswalker =  0;
 $datasetLand =  0;
 $datasetBasicLand =  0;

$omething =  $mysqli->query('SET CHARACTER SET utf8');
  $q = "SELECT Ntype,(amount_normal+amount_foil) as total FROM user_decks_cards JOIN Ncards on Ncardid = cardid WHERE deckid = ? AND location = 'Deck'";
        if ($stmt = $mysqli -> prepare($q)) {
        $stmt -> bind_param('s', $deckid);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($type,$amount);
        
        while ($stmt -> fetch()) {
            $temp = explode("—", $type);
            $temp[0] = str_replace("—","", $temp[0]);
                        
            if (strpos($temp[0],"Artifact Creature") !== false) {

               $datasetArtifactCreatures += $amount ;
                
            }
            else if (strpos($temp[0],"Creature")  !== false) {
            
               $datasetCreatures += $amount ;
                
            }
            else if (strpos($temp[0],"Artifact") !== false) {
            
               $datasetArtifacts+= $amount;
                
            }
            else if (strpos($temp[0],"Aura") !== false) {
            
               $datasetAura += $amount;
                
            }
            else if (strpos($temp[0],"Curse") !== false) {
            
               $datasetCurse += $amount ;
                
            }
            else if (strpos($temp[0],"Enchantment") !== false) {
            
               $datasetEnchantment += $amount ;
                
            }
            else if (strpos($temp[0],"Sorcery") !== false) {
            
               $datasetSorcery += $amount ;
                
            }
            else if (strpos($temp[0],"Instant") !== false) {
            
               $datasetInstant += $amount ;
                
            }
            else if (strpos($temp[0],"Scheme") !== false) {
            
               $datasetScheme += $amount ;
                
            }
            else if (strpos($temp[0],"Planeswalker") !== false) {
            
               $datasetPlaneswalker +=  $amount ;
                
            }
            else if (strpos($temp[0],"Basic Land") !== false) {
               $datasetBasicLand += $amount ;
            }
            else if (strpos($temp[0],"Land") !== false) {
               $datasetLand += $amount ;
            }
        }
      }
   
   $dataset1 = array();
   
   if ($datasetArtifactCreatures > 0)
   $dataset1[] = array(label=>"Artifact Creatures",data=> $datasetArtifactCreatures);
   
   if ($datasetCreatures > 0)
   $dataset1[] = array(label=>"Creatures",data=> $datasetCreatures);
   
   if ($datasetArtifacts > 0)
   $dataset1[] = array(label=>"Artifacts",data=> $datasetArtifacts);
   
   if ($datasetAura > 0)
   $dataset1[] = array(label=>"Aura",data=> $datasetAura);
   
   if ($datasetBasicLand > 0)
   $dataset1[] = array(label=>"Basic Land",data=> $datasetBasicLand);
   
   if ($datasetCurse > 0)
   $dataset1[] = array(label=>"Curse",data=> $datasetCurse);
   
   if ($datasetEnchantment > 0)
   $dataset1[] = array(label=>"Enchantment",data=> $datasetEnchantment);
   
   if ($datasetInstant > 0)
   $dataset1[] = array(label=>"Instant",data=> $datasetInstant);
   
   if ($datasetLand > 0)
   $dataset1[] = array(label=>"Land",data=> $datasetLand);
   
   if ($datasetPlaneswalker > 0)
   $dataset1[] = array(label=>"Planeswalker",data=> $datasetPlaneswalker);
   
   if ($datasetScheme > 0)
   $dataset1[] = array(label=>"Scheme",data=> $datasetScheme);
   
   if ($datasetSorcery > 0)
   $dataset1[] = array(label=>"Sorcery",data=> $datasetSorcery);
 

echo json_encode($dataset1);


?>