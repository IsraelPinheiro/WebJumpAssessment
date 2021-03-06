$(function(){
	//Inicialização DataTables
	dataTable = $('.datatable').DataTable({
		"dom":"<'row'<'col-sm-4'l><'col-sm-4'f><'col-sm-4'B>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
			{
				extend: 'copyHtml5',
				className: 'fas fa-copy btn-primary',
				text: '',
				titleAttr: 'Copy data to clipboard',
				exportOptions: {
                    columns: ':visible(:not(.noexport))'
                }
			},
			{
				extend: 'csvHtml5',
				className: 'fas fa-file-csv btn-primary',
				text: '',
        		titleAttr: 'Export to CSV',
				exportOptions: {
                    columns: ':visible(:not(.noexport))'
                }
			}
		],
		"lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
		"pageLength": 15,
		"language": {
			"sLengthMenu": "_MENU_",//"_MENU_ itens per page"
		},
		responsive: true,
		pageResize: true,
		columnDefs: [
			{
				targets: "noorder",
				orderable: false
			},
			{
				targets: "noshow",
				visible: false
			}
		],
		"initComplete": function(settings, json){
			$('.dataTables_filter').remove();
			$('.dt-buttons').find('button').removeClass('btn-secondary');
			$('.dt-buttons').find('button').addClass('btn-primary')
			$('.dt-buttons').addClass('float-right pb-2');
			$('.dataTables_length').find('select').removeClass('custom-select-sm');
			//$('.dataTables_length').remove();
		}
	});
	$('.datatable').DataTable();
	$('#Search').keyup(function(){
		dataTable.search($(this).val()).draw();
	});
});