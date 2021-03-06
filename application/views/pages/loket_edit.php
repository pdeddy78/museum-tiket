<!-- ==================== ROW ==================== -->
<div class="row-fluid">
    <div class="span2">
    </div>
    <div class="span8">
        <div class="containerHeadline">
            <i class="icon-tasks"></i><h2>Edit Loket</h2>
            <div class="controlButton pull-right"><i class="icon-caret-down minimizeElement"></i></div>
        </div>
        <div class="floatingBox">
            <div class="container-fluid">
                <?php
                    $attributes = array('name'=>'form_loket','class'=>'form-horizontal contentForm','role'=>'form');
                    echo form_open('loket/edit/'.$id_loket, $attributes);
                ?>
                    <div class="control-group">
                        <label class="control-label">Kode Loket</label>
                        <div class="controls">
                            <input type="text" name="id_loket" value="<?=$id_loket?>" class="span10" readonly>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Nama Loket</label>
                        <div class="controls">
                            <input type="text" name="nama_loket" value="<?=$nama_loket?>" class="span10">
                            <?=form_error('nama_loket', '<span class="help-block greyText fade-in">', '</span>');?>
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