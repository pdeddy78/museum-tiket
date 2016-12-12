<!-- ==================== ROW ==================== -->
<div class="row-fluid">
    <div class="span2">
    </div>
    <div class="span8">
        <div class="containerHeadline">
            <i class="icon-ticket"></i><h2>Tambah Jenis Tiket</h2>
            <div class="controlButton pull-right"><i class="icon-caret-down minimizeElement"></i></div>
        </div>
        <div class="floatingBox">
            <div class="container-fluid">
                <?php
                    $attributes = array('name'=>'form_tiket','class'=>'form-horizontal contentForm','role'=>'form');
                    echo form_open('tiket/tambah', $attributes);
                ?>
                    <div class="control-group">
                        <label class="control-label">Kode Jenis Tiket</label>
                        <div class="controls">
                            <input type="text" name="id_tiket" value="<?=$id_tiket?>" class="span10" readonly>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Nama Jenis Tiket</label>
                        <div class="controls">
                            <input type="text" name="nama_tiket" value="<?=set_value('nama_tiket')?>" class="span10">
                            <?=form_error('nama_tiket', '<span class="help-block greyText fade-in">', '</span>');?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Harga Tiket</label>
                        <div class="controls">
                            <input type="text" name="harga" value="<?=set_value('harga')?>" class="span10">
                            <?=form_error('harga', '<span class="help-block greyText fade-in">', '</span>');?>
                        </div>
                    </div>
                    <div class="formFooter">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="span2">
    </div>
</div>
<!-- ==================== END OF ROW ==================== -->