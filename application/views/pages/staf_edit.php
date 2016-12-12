<!-- ==================== ROW ==================== -->
<div class="row-fluid">
    <div class="span2">
    </div>
    <div class="span8">
        <div class="containerHeadline">
            <i class="icon-user"></i><h2>Edit Staf</h2>
            <div class="controlButton pull-right"><i class="icon-caret-down minimizeElement"></i></div>
        </div>
        <div class="floatingBox">
            <div class="container-fluid">
                <?php
                    $attributes = array('name'=>'form_staf','class'=>'form-horizontal contentForm','role'=>'form');
                    echo form_open('Staf/edit/'.$id_staf, $attributes);
                ?>
                    <div class="control-group">
                        <label class="control-label">ID Staf</label>
                        <div class="controls">
                            <input type="text" name="id_staf" value="<?=$id_staf?>" class="span10" readonly>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Username</label>
                        <div class="controls">
                            <input type="text" name="username" value="<?=$username?>" class="span10" readonly>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Nama Staf</label>
                        <div class="controls">
                            <input type="text" name="nama_staf" value="<?=$nama_staf?>" class="span10">
                            <?=form_error('nama_staf', '<span class="help-block greyText fade-in">', '</span>');?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">No Handphone</label>
                        <div class="controls">
                            <input type="text" name="no_handphone" value="<?=$no_handphone?>" class="span10">
                            <?=form_error('no_handphone', '<span class="help-block greyText fade-in">', '</span>');?>
                        </div>
                    </div>
                    <div class="control-group last">
                        <label class="control-label">Alamat</label>
                        <div class="controls">
                            <textarea name="alamat_staf" value="<?=$alamat_staf?>" class="span10"></textarea>
                            <?=form_error('alamat_staf', '<span class="help-block greyText fade-in">', '</span>');?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Kota/Kab</label>
                        <div class="controls">
                            <input type="text" name="kota" value="<?=$kota?>" class="span10">
                            <?=form_error('kota', '<span class="help-block greyText fade-in">', '</span>');?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Role</label>
                        <div class="controls">
                            <select id="uniqueSelect" name="role" value="<?=$role?>">
                                <option id="opt1" value="loket">Petugas Loket</option>
                                <option id="opt2" value="guide">Tour Guide</option>
                                <option id="opt3" value="admin">Administrator</option>
                            </select>
                            <?=form_error('role', '<span class="help-block greyText fade-in">', '</span>');?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Status</label>
                        <div class="controls">
                            <input type="text" name="status" value="<?=$status?>" class="span10">
                            <span class="help-block greyText fade-in">1 = Aktif; 0 = Tidak Aktif.</span>
                            <?=form_error('status', '<span class="help-block greyText fade-in">', '</span>');?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Masukkan Password Anda</label>
                        <div class="controls">
                            <input type="password" name="password" class="span10">
                            <?=form_error('password', '<span class="help-block greyText fade-in">', '</span>');?>
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