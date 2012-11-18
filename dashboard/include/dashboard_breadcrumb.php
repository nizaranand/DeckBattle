<?php
function generateBreadcrumb($firstpage="", $secondpage="",$thirdpage="")
{
	?>
<div class="breadLine">
  <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
<?php
	if ($firstpage != "" && $secondpage != "" && $thirdpage != "")
	{
	?>
      <li><a href="#"><?php echo $firstpage; ?></a></li>
       <li><a href="#"><?php echo $secondpage; ?></a></li>
      <li class="current"><a href="#"><?php echo $thirdpage; ?></a></li>
    
<?php
}
else if ($firstpage != "" && $secondpage != "")
{
	?>	
	
     <li><a href="#"><?php echo $firstpage; ?></a></li>
     <li class="current"><a href="#"><?php echo $secondpage; ?></a></li>
    
    	
	<?php
	}
	else if ($firstpage != "")
	{
?>
	    <li class="current"><a href="#"><?php echo $firstpage; ?></a></li>
 <?php
}
	?>
    
        </ul>
  </div>
	<!--
	 <div class="breadLinks">
    <ul>
      <li><a href="#" title=""><i class="icos-list"></i><span></span>Ranking<strong>(+58)</strong></a></li>
      <li><a href="#" title=""><i class="icos-check"></i><span>Recently added</span> <strong>(+12)</strong></a></li>
      <li class="has"> <a title=""> <i class="icos-money3"></i> <span>---</span> <span><img src="images/elements/control/hasddArrow.png" alt="" /></span> </a>
        <ul>
          <li><a href="#" title=""><span class="icos-add"></span>New invoice</a></li>
          <li><a href="#" title=""><span class="icos-archive"></span>History</a></li>
          <li><a href="#" title=""><span class="icos-printer"></span>Print invoices</a></li>
        </ul>
      </li>
    </ul>
    <div class="clear"></div>
  </div> 
-->
</div>
	
<?php
}
	?>