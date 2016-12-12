<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=base_url()?>assets/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
<script src="<?=base_url()?>assets/js/jquery.autocomplete.js"></script>
<script src="<?=base_url()?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/js/dataTables.tableTools.min.js"></script>
<script src="<?=base_url()?>assets/js/vendor/bootstrap-slider.js"></script>                   <!-- bootstrap slider plugin -->
<script src="<?=base_url()?>assets/js/vendor/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>assets/js/vendor/jquery.sparkline.min.js"></script>               <!-- small charts plugin -->
<script src="<?=base_url()?>assets/js/vendor/jquery.flot.min.js"></script>                    <!-- charts plugin -->
<script src="<?=base_url()?>assets/js/vendor/jquery.flot.resize.min.js"></script>             <!-- charts plugin / resizing extension -->
<script src="<?=base_url()?>assets/js/vendor/jquery.flot.pie.min.js"></script>                <!-- charts plugin / pie chart extension -->
<script src="<?=base_url()?>assets/js/vendor/raphael.2.1.0.min.js"></script>                  <!-- vector graphic plugin / for justgage.js -->
<script src="<?=base_url()?>assets/js/vendor/justgage.js"></script>                           <!-- justgage plugin -->
<script src="<?=base_url()?>assets/js/vendor/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/thekamarel.min.js"></script>                            <!-- main project js file -->
<script type="text/javascript">
    var site = "<?=site_url();?>";
    $(function(){
       $('.autocomplete_wisatawan').autocomplete({
            // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
            serviceUrl: site+'/Welcome/search',
            });
       $('#datepickerField').datepicker({
                format: 'yyyy-mm-dd'
            });
       $('#datepickerField2').datepicker({
                format: 'yyyy-mm-dd'
            });
    });
</script>
<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
		$('#example').DataTable( {
			//"order": [[ 2, "asc" ]],
			"sDom": 'T<"clear">lfrtip',
			"tableTools": {
           		"aButtons": [
	                "copy",
	                "csv",
	                "xls"
	                //"print"
            	],
            	"sSwfPath": "assets/swf/copy_csv_xls.swf"
       		},
			"select": true,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
			},
			"scrollX": true
		});
	});
</script>

