<!-- ==================== ROW ==================== -->
<div class="row-fluid">
    <div class="span3">
        <div class="containerHeadline">
            <i class="icon-search"></i><h2>Cari Tanggal & Loket...</h2>
            <div class="controlButton pull-right"><i class="icon-caret-down minimizeElement"></i></div>
        </div>
        <div class="floatingBox">
            <div class="container-fluid">
                <?php
                    $attributes = array('name'=>'form_laporan','class'=>'form-horizontal contentForm','role'=>'form');
                    echo form_open('Laporan/index', $attributes);
                ?>
                    <div class="control-group">
                        <div class="span2"></div>
                        <input type="text" class="span4" id="datepickerField" name="tgl_transaksi1" placeholder="YYYY-MM-DD" required> s/d  
                        <input type="text" class="span4" id="datepickerField2" name="tgl_transaksi2" placeholder="YYYY-MM-DD" required>
                    </div>
                    <div class="control-group">
                        <div class="span2"></div>
                        <select id="id_loket" class="span8" name="id_loket" required placeholder="Pilih Loket...">
                            <option value=""></option>
                            <?php
                                if(isset($list_loket)){
                                    foreach($list_loket as $row){
                            ?>
                                    <option value="<?php echo $row->id_loket?>"><?php echo $row->nama_loket?></option>
                                <?php
                                    }
                                }
                                ?>
                        </select>
                    </div>
                    <div class="formFooter">
                        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
                        <button type="reset" class="btn">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="span9">
        <div class="containerHeadline">
            <i class="icon-bar-chart"></i><h2>Laporan Penjualan</h2>
            <div class="controlButton pull-right"><i class="icon-caret-down minimizeElement"></i></div>
        </div>
        <div class="floatingBox">
            <div class="container-fluid">
                <?php if(isset($submit)) { ?>
                <div class="row-fluid">
                    <div class="hero-unit centerize">
                        <h1 class="separator bottom"><?=$pesan?></h1>
                        <p>Jalan Srigading IV No.2 RT 01/RW X Mangkubumen Surakarta Hadiningrat, Solo.</p>
                    </div>
                    <div>
                        <h5 class="text-left">Tanggal : <?=$tgl_transaksi1?> s/d <?=$tgl_transaksi2?></h5>
                        <h5 class="text-left">Loket : <?=$loket?></h5>
                        <table id='example' class='stripe' cellspacing='0' width='100%'>
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Jenis Tiket</th>
                                <th>Beli Tiket</th>
                                <th>Diskon</th>
                                <th>Tour Guide</th>
                                <th>Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($dt_laporan->result() as $row) { ?>
                            <tr>
                                <td><?=$row->id_transaksi?></td>
                                <td><?=$row->nama_tiket?></td>
                                <td><?=$row->tot_tiket?> Tiket</td>
                                <td><?=$row->nama_diskon?></td>
                                <td><?=$row->nama_staf?></td>
                                <td>Rp. <?=$row->tot_bayar?>,00</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <br/>
                    <h5 class="text-left">Statistik Wisatawan</h5>
                    <table>
                        <tbody>
                        <?php foreach($dt_wilayah->result() as $row) { ?>
                            <tr>
                                <td><?=$row->asal_wilayah?> terdapat</td>
                                <td><b><?=$row->Jumlah?></b> pengunjung</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                <?php } ?>
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
