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
    <div class="span2">
    </div>
    <div class="span8">
        <div class="containerHeadline">
            <i class="icon-shield"></i><h2><?=$judul?></h2>
            <div class="controlButton pull-right"><i class="icon-caret-down minimizeElement"></i></div>
        </div>
        <div class="floatingBox">
            <div class="container-fluid">
                <?php
                    $attributes = array('name'=>'form_password','class'=>'form-horizontal contentForm','role'=>'form');
                    echo form_open('Staf/password', $attributes);
                ?>
                    <div class="control-group">
                        <label class="control-label">Password Lama</label>
                        <div class="controls">
                            <input type="password" name="password" value="" class="span10">
                            <?=form_error('password', '<span class="help-block greyText fade-in">', '</span>');?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Password Baru</label>
                        <div class="controls">
                            <input type="password" name="new_password" value="" class="span10">
                            <?=form_error('new_password', '<span class="help-block greyText fade-in">', '</span>');?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Konfirmasi Password Baru</label>
                        <div class="controls">
                            <input type="password" name="new_password_conf" value="" class="span10">
                            <?=form_error('new_password_conf', '<span class="help-block greyText fade-in">', '</span>');?>
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