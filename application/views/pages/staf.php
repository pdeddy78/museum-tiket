<!-- pesan flash message start -->
<?php $flash_pesan = $this->session->flashdata('pesan')?>
<?php if (! empty($flash_pesan)) : ?>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $flash_pesan; ?>
    </div>
<?php endif ?>
<!-- pesan flash message end -->
<!-- ==================== ROW ==================== -->
<div class="row-fluid">
    <div class="span12">
    <!-- ==================== SPAN12 HEADLINE ==================== -->
        <div class="containerHeadline">
            <i class="icon-group"></i><h2>Daftar Staf</h2>
            <div class="controlButton pull-right"><i class="icon-caret-down minimizeElement"></i></div>
        </div>
    <!-- ==================== END OF SPAN12 HEADLINE ==================== -->
    <!-- ==================== SPAN12 FLOATING BOX ==================== -->
        <div class="floatingBox">
            <div class="container-fluid">
                <div align="right"><a class="btn" href="<?=base_url()?>Staf/tambah">Tambah Staf</a></div><br />
                <table id='example' class='stripe' cellspacing='0' width='100%'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat Rumah</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            <?php if($this->session->userdata('role')=='admin') { ?><th></th><?php }?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no=0; foreach($dt_staf->result() as $row) { ?>
                        <tr>
                            <td><?=++$no?></td>
                            <td><?=$row->nama_staf?></td>
                            <td><?=$row->alamat_staf?> <?=$row->kota?></td>
                            <td><?=$row->username?></td>
                            <td><?=$row->role?></td>
                            <td><?php if ($row->status == 1) { echo "<span class='label active'>active</span>"; }
                                    elseif ($row->status == 0) { echo "<span class='label label inactive'>inactive</span>"; }
                                    else { echo "<span class='label label banned'>busy</span>"; }
                                ?>
                            </td>
                            <?php if($this->session->userdata('role')=='admin') { ?><td class="actions"><span class="label green"><a href="<?=base_url()?>Staf/edit/<?=$row->id_staf?>"><i class="icon-pencil edit"></i></a></span></td><?php } ?>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <!-- ==================== END OF SPAN12 FLOATING BOX ==================== --> 
    </div>
</div>
<!-- ==================== END OF ROW ==================== -->
<!-- ==================== DIVIDER ROW ==================== -->
<div class="row-fluid">
    <div class="span12 contentDivider"></div>
</div>
<!-- ==================== END OF DIVIDER ROW ==================== -->
