<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('my_datatables'))
{
	function my_datatables($id='', $url='', $page=0, $display=10, $header_disable=array(), $data_params=array(), $div_class='table-responsive')
	{
		$var_tbl = str_replace('#', '', $id);
		$var_tbl = str_replace('-', '_', $var_tbl);

		$return = '';
		$return .= 'var '.$var_tbl.' = $("'.$id.'");';
		$return .= 'var '.$var_tbl.'_settings = {';
		$return .= my_datatables_config($id, $url, $page, $display, $header_disable, $data_params, $div_class);
		$return .= '};';
		$return .= $var_tbl.'.DataTable('.$var_tbl.'_settings);';
		$return .= '$(".dataTables_length select").select2({
			minimumResultsForSearch: Infinity,
			width: "auto"
		})';
		
		return $return;
	}
}

if (!function_exists('my_datatables_config'))
{
	function my_datatables_config($id='', $url='', $page=0, $display=10, $header_disable=array(), $data_params=array(), $div_class='table-responsive')
	{
		$basic_config = '
			"dom" : "<\"datatable-header\"rl><\"datatable-scroll\"t><\"datatable-footer\"ip>",
		    "paginationType": "simple_numbers",
		    "destroy": true,
		    "ordering": true,
		    "scrollCollapse": true,
		    "language": {
		        "processing": "...Loading...",
				"lengthMenu": "<span>Show:</span> _MENU_",
		        "info": "Showing <b>_START_ To _END_</b> From <b>_TOTAL_</b> records",
				"infoEmpty": "No Data Found",
				"emptyTable" : "No Data Found",
				"paginate": {
					"first": "First", 
					"previous": "Before", 
					"next": "Next", 
					"last": "Last"
				}
		    },
			"lengthMenu": [ 10, 50, 75, 100 ],
			"columnDefs": [ {
				"targets": ['.implode(',',$header_disable).'],
				"orderable": false,
				"searchable": false
			}, {
                orderSequence: ["desc", "asc"],
                aTargets: ["_all"]
            }],
			"processing" : true,
		    "displayLength": '.$display.',
			"displayStart": '.$page.',
		    "bprocessing": true,
		    "serverSide": true,
		    "ajax": {
		    	url:"'.$url.'",
		    	type:"get",
				data:'.json_encode($data_params).',
		    	error: function(jqXHR, textStatus, errorThrown) {
	              	$("'.$id.'_wrapper").html("<span class=\"text-danger\"><b>Error Retrieving Data!</b></span>");
				  	console.log(textStatus);
					console.log(errorThrown);
	            }
		    }';
		return $basic_config;
	}
}