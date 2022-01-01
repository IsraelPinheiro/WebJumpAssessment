$(function(){
	//Inicialização DataTables
	dataTable = $('.datatable').DataTable({
		//"dom": "<'row mb-2'<'col-12 text-right'B>>" + "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
		"dom":"<'row'<'col-sm-4'l><'col-sm-4'f><'col-sm-4'B>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdfHtml5'
		],
		"lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Todos"]],
		"pageLength": 15,
		"language": {
			"sEmptyTable": "Nenhum registro encontrado",
			"sInfo": "Exibindo de _START_ à _END_ de _TOTAL_ registros",
			"sInfoEmpty": "Exibindo 0 até 0 de 0 registros",
			"sInfoFiltered": "(Filtrados de _MAX_ registros)",
			"sInfoPostFix": "",
			"sInfoThousands": ".",
			"sLengthMenu": "_MENU_  ",//"_MENU_ itens por página",
			"sLoadingRecords": "Carregando...",
			"sProcessing": "Processando...",
			"sZeroRecords": "Nenhum registro encontrado",
			"sSearch": "Pesquisar",
			"oPaginate": {
				"sNext": "Próximo",
				"sPrevious": "Anterior",
				"sFirst": "Primeiro",
				"sLast": "Último"
			},
			"oAria": {
				"sSortAscending": ": Ordenar colunas de forma ascendente",
				"sSortDescending": ": Ordenar colunas de forma descendente"
			}
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