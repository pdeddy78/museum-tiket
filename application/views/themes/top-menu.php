<!-- ==================== TOP MENU ==================== -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
        <a class="brand" href="<?=base_url()?>Welcome"><strong class="brandBold">MUSEUM </strong>SURAKARTA</a>
            <div class="nav pull-right">
                <form class="navbar-form">
                    <div class="input-append">                        
                        <div class="collapsibleContent">
                            <span class="add-on add-on-mini add-on-dark" id="profile"><i class="icon-user"></i><span class="username"><?=$this->session->userdata('nama')?></span></span>
                        </div>
                        <div class="collapsibleContent">
                            <a href="<?=base_url()?>Auth/logout" class="sidebar"><span class="add-on add-on-mini add-on-dark" id="profile"><i class="icon-off"></i><span class="logout">Keluar</span></span></a>
                        </div>
                   </div>
                </form>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- ==================== END OF TOP MENU ==================== -->