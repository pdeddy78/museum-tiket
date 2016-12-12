<!-- ==================== ROW ==================== -->
<div class="row-fluid">
    <div class="span2">
    </div>
    <div class="span8">
        <div class="containerHeadline">
            <i class="icon-money"></i><h2>Tambah Diskon</h2>
            <div class="controlButton pull-right"><i class="icon-caret-down minimizeElement"></i></div>
        </div>
        <div class="floatingBox">
            <div class="container-fluid">
                <?php
                    $attributes = array('name'=>'form_diskon','class'=>'form-horizontal contentForm','role'=>'form');
                    echo form_open('Diskon/edit/'.$id_diskon, $attributes);
                ?>
                    <div class="control-group">
                        <label class="control-label">Kode Diskon</label>
                        <div class="controls">
                            <input type="text" name="id_diskon" value="<?=$id_diskon?>" class="span10" readonly>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Nama Diskon</label>
                        <div class="controls">
                            <input type="text" name="nama_diskon" value="<?=$nama_diskon?>" class="span10">
                            <?=form_error('nama_diskon', '<span class="help-block greyText fade-in">', '</span>');?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Keterangan</label>
                        <div class="controls">
                            <input type="text" name="keterangan" value="<?=$keterangan?>" class="span10">
                            <?=form_error('keterangan', '<span class="help-block greyText fade-in">', '</span>');?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Diskon</label>
                        <div class="controls">
                            <input type="text" name="diskon" value="<?=$diskon?>" class="span2"> %
                            <?=form_error('diskon', '<span class="help-block greyText fade-in">', '</span>');?>
                        </div>
                    </div>
                    <div class="formFooter">
                        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">  
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