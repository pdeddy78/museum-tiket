<!-- ==================== MAIN MENU ==================== -->
<div class="mainmenu">
    <div class="container-fluid">
        <ul class="nav">
            <li class="collapseMenu"><a href="#"><i class="icon-double-angle-left"></i>hide menu<i class="icon-double-angle-right deCollapse"></i></a></li>
            <li class="divider-vertical firstDivider"></li>
            <li class="left-side <?php if(isset($active_dashboard)) echo $active_dashboard;?>" id="dashboard"><a href="<?=base_url()?>Welcome"><i class="icon-dashboard"></i> DASHBOARD</a></li>
            <li class="divider-vertical"></li>
            <li class="<?php if(isset($active_staf)) echo $active_staf;?>" id="staf"><a href="<?=base_url()?>Staf"><i class="icon-group"></i> STAF</a></li>
            <li class="divider-vertical"></li>
            <li class="<?php if(isset($active_loket)) echo $active_loket;?>" id="loket"><a href="<?=base_url()?>Loket"><i class="icon-tasks"></i> LOKET</a></li>
            <li class="divider-vertical"></li>
            <li class="<?php if(isset($active_tiket)) echo $active_tiket;?>" id="tiket"><a href="<?=base_url()?>Tiket"><i class="icon-ticket"></i> TIKET</a></li>
            <li class="divider-vertical"></li>
            <li class="<?php if(isset($active_diskon)) echo $active_diskon;?>" id="diskon"><a href="<?=base_url()?>Diskon"><i class="icon-money"></i> DISKON</a></li>
            <li class="divider-vertical"></li>
            <li class="right-side <?php if(isset($active_laporan)) echo $active_laporan;?>" id="laporan"><a href="<?=base_url()?>Laporan"><i class="icon-bar-chart"></i> LAPORAN </a></li>
            <li class="divider-vertical"></li>
            <li class="right-side <?php if(isset($active_password)) echo $active_password;?>" id="password"><a href="<?=base_url()?>Staf/Password"><i class="icon-shield"></i> UBAH PASSWORD </a></li>
            <li class="divider-vertical"></li>
        </ul>
    </div>
</div>
<!-- ==================== END OF MAIN MENU ==================== -->
