<!--<div class="row-fluid">
    <ul class="masterActions">
        <li class="active">
            <i class="icon-envelope redText"></i>
            <h1 class="redText">Check & send</h1>
            <p>new messages</p>
            <div class="notifyCircle red">12</div>
        </li>
        <li>
            <i class="icon-ok-sign cyanText"></i>
            <h1 class="cyanText">Check & add</h1>
            <p>new tasks</p>
            <div class="notifyCircle cyan">3</div>
        </li>
        <li>
            <i class="icon-shopping-cart greenText"></i>
            <h1 class="greenText">Check & manage</h1>
            <p>new orders</p>
            <div class="notifyCircle green">254</div>
        </li>
        <li>
            <i class="icon-bar-chart orangeText"></i>
            <h1 class="orangeText">Check</h1>
            <p>statistics</p>
        </li>
        <li>
            <i class="icon-inbox greyText"></i>
            <h1 class="greyText">Check & upload</h1>
            <p>new files</p>
            <div class="notifyCircle grey">2</div>
        </li>
    </ul>
</div>-->
<!-- ==================== END OF MASTER ACTIONS ROW ==================== -->
<!-- ==================== ROW ==================== -->
<div class="row-fluid">
    <div class="span2">
        <div class="containerHeadline">
            <i class="icon-tasks"></i><h2>Print Tiket</h2>
            <div class="controlButton pull-right"><i class="icon-caret-down minimizeElement"></i></div>
        </div>
        <div class="floatingBox">
            <div class="container-fluid">
                <ul>
                    <?php foreach($transaksi as $row) { ?>
                    <li><a href="<?=base_url()."Transaksi/CetakTiket/".$row->id_transaksi?>"><?=$row->id_transaksi?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="span8">
        <div class="containerHeadline">
            <i class="icon-keyboard"></i><h2>Transaksi <?=$id_transaksi?></h2>
            <div class="controlButton pull-right"><i class="icon-caret-down minimizeElement"></i></div>
        </div>
        <div class="floatingBox">
            <div class="container-fluid">
                <?php
                    $attributes = array('name'=>'form_transaksi','class'=>'form-horizontal contentForm','role'=>'form');
                    echo form_open('Transaksi/cek/'.$id_transaksi, $attributes);
                ?>
                    <div class="control-group">
                        <div class="controls">
                            <input type="hidden" name="id_transaksi" value="<?=$id_transaksi?>" class="span10" readonly>
                            <input type="hidden" name="id_loket" value="<?=$this->session->userdata('loket')?>" class="span10" readonly>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Wisatawan</label>
                        <div class="controls">
                            <input type="search" class="autocomplete_wisatawan nama span6" id="autocomplete1" name="nama_pengunjung" required autocomplete="off">&nbsp;&nbsp;
                            <select id="id_wilayah" name="id_wilayah" required class="span4">
                                <option value="">Asal Wisatawan...</option>
                                <?php foreach($wilayah as $row) { ?>
                                    <option value="<?php echo $row->id_wilayah?>"><?php echo $row->asal_wilayah?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Tiket</label>
                        <div class="controls">
                            <select id="id_tiket" name="id_tiket" required class="span6">
                                <option value="">Pilih Jenis Tiket...</option>
                                <?php foreach($tiket as $row) { ?>
                                    <option value="<?php echo $row->id_tiket?>"><?php echo 'Tiket '.$row->nama_tiket?></option>
                                <?php } ?>
                            </select>&nbsp;&nbsp;
                            <input type="text" name="tot_tiket" required value="<?=set_value('tot_tiket')?>" placeholder="Jumlah Tiket" class="span2">
                        </div>
                    </div>                    
                    <div class="control-group">
                        <label class="control-label">Tour Guide</label>
                        <div class="controls">
                            <select id="id_guide" name="id_guide" class="span6">
                                <option value="">Pilih Tour Guide...</option>
                                <?php foreach($guide as $row) { ?>
                                    <option value="<?php echo $row->id_staf?>"><?php echo 'Guide '.$row->nama_staf?></option>
                                <?php } ?>
                            </select>&nbsp;&nbsp;
                            <select id="id_diskon" name="id_diskon" class="span4">
                                <option value="">Pilih Diskon...</option>
                                <?php foreach($diskon as $row) { ?>
                                    <option value="<?php echo $row->id_diskon?>"><?php echo $row->nama_diskon?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="formFooter">
                        <button type="submit" class="btn btn-primary">Hitung</button>
                        <button type="reset" class="btn">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="span2">
        <div class="containerHeadline">
            <i class="icon-tasks"></i><h2>Detil Diskon Tiket</h2>
            <div class="controlButton pull-right"><i class="icon-caret-down minimizeElement"></i></div>
        </div>
        <div class="floatingBox">
            <div class="container-fluid">
                <ul>
                <?php foreach ($dt_diskon->result() as $row) { ?>
                    <li><?=$row->keterangan?><br />
                        Diskon <?=$row->jumlah_diskon*100?> %</li>
                <?php } ?>
                </ul>
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
