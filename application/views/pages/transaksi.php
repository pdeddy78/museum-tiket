<!-- ==================== ROW ==================== -->
<div class="row-fluid">
    <div class="span2">
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
                    echo form_open('Transaksi/bayar/'.$id_transaksi, $attributes);
                ?>
                    <div class="control-group">
                        <div class="controls">
                            <input type="hidden" name="id_transaksi" value="<?=$id_transaksi?>" class="span10" readonly>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Wisatawan</label>
                        <div class="controls">
                            <input type="text" name="nama_pengunjung" value="<?=$nama_pengunjung?>" readonly class="span6">&nbsp;&nbsp;
                            <input type="text" name="id_wilayah" value="<?=$id_wilayah?>" readonly class="span4">&nbsp;&nbsp;                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Tiket</label>
                        <div class="controls">
                            <input type="text" name="id_tiket" value="<?=$id_tiket?>" readonly class="span6">&nbsp;&nbsp;             
                            <input type="text" name="tot_tiket" value="<?=$tot_tiket?>" readonly class="span1">&nbsp;&nbsp;
                            <input type="text" name="harga" value="<?='@ Rp. '.$harga_tiket?>" readonly class="span3">
                        </div>
                    </div>                    
                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <input type="text" name="id_guide" value="<?=$id_guide?>" readonly placeholder="Tidak Pakai Guide" class="span3">&nbsp;&nbsp;
                            <input type="text" name="id_diskon" value="<?=$id_diskon?>" readonly placeholder="Tidak Ada Diskon" class="span3">&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Total Harga (IDR)</label>
                        <div class="controls">
                            <input type="text" name="tot_bayar" value="<?=$tot_bayar?>" readonly class="span4">
                        </div>
                    </div>
                    <div class="formFooter">
                        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
                        <button class="btn btn-cancel" onClick="history.back();"><i class="icon-refresh"></i> Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="span2">
    </div>
</div>
<!-- ==================== END OF ROW ==================== -->