<ul class="breadcrumb">
	<li><i class="icon-home"></i><a href="<?=base_url()?>Welcome"> Home</a> <span class="divider"><i class="icon-angle-right"></i></span></li>
	<?php if(isset($parent)) { ?><li> <?=$parent?><span class="divider"><i class="icon-angle-right"></i></span></li><?php } ?>
    <li class="active"><?=$judul?></li>
    <li class="moveDown pull-right">
        <span class="time"></span>
        <span class="date"></span>
    </li>    
</ul>