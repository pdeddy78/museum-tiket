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
        <div class="containerHeadline">
            <i class="icon-money"></i><h2>Daftar Diskon Tiket</h2>
            <div class="controlButton pull-right"><i class="icon-caret-down minimizeElement"></i></div>
        </div>
        <div class="floatingBox">
            <div class="container-fluid">
                <div align="right"><a class="btn" href="<?=base_url()?>Diskon/tambah">Tambah Diskon</a></div><br />
                <table id='example' class='stripe' cellspacing='0' width='100%'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Diskon Tiket</th>
                            <th>Nama Diskon</th>
                            <th>Keterangan</th>
                            <th>Diskon</th>
                            <?php if($this->session->userdata('role')=='admin') { ?><th></th><?php }?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no=0; foreach ($dt_diskon->result() as $row) { ?>
                        <tr>
                            <td><?=++$no?></td>
                            <td><?=$row->id_diskon?></td>
                            <td><?=$row->nama_diskon?></td>
                            <td><?=$row->keterangan?></td>
                            <td><?=$row->jumlah_diskon*100?> %</td>
                            <?php if($this->session->userdata('role')=='admin') { ?><td class="actions"><span class="label green"><a href="<?=base_url()?>Diskon/edit/<?=$row->id_diskon?>"><i class="icon-pencil edit"></i></a></span></td><?php } ?>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- ==================== END OF ROW ==================== -->
<!-- ==================== DIVIDER ROW ==================== -->
<div class="row-fluid">
    <div class="span12 contentDivider"></div>
</div>
<!-- ==================== END OF DIVIDER ROW ==================== -->
