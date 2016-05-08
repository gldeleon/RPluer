<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RPluer</title>
	
	<!--Jquery UI-->
    <!-- Bootstrap Core CSS -->
    <link href="app/views/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="app/views/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="app/views/bower_components/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="app/views/dist/css/rpluer.css" rel="stylesheet">
    <!--<link href="app/views/dist/css/datosprov.css" rel="stylesheet">-->
    <!-- Custom Fonts -->
    <!--<link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="app/views/bower_components/font-awesome/css/font-awesome.min.css">
    <!--jQuery UI Core-->
	<link rel="stylesheet" href="app/views/dist/css/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<!--jQuery time-->
	<!--<link rel="stylesheet" href="app/views/dist/css/bootstrap-timepicker.css" />-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div id="wrapper">
	<!--<div id="wrapper">-->
		<!-- header  -->
	
        <div id="header">		 
		   #HEADER#
		</div>			 
		<!-- contenido -->
			<div id="page-wrapper">
		  #CONTENIDO#		 
		</div>
		<!-- end: contenido -->		
	<!--</div>--> 
	<!--<div id="footer">
		#FOOTER#
	</div>-->
</div>
 	<!-- jQuery -->
    <script src="app/views/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="app/views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="app/views/bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="app/views/bower_components/DataTables/media/js/jquery.dataTables.js"></script>      
    <script src="app/views/bower_components/DataTables/media/js/dataTables.bootstrap.js"></script>    
    <!-- Custom Theme JavaScript -->
    <script src="app/views/dist/js/rpluer.js"></script>   
	<!--jQuery UI JS-->
	<script type="text/javascript" language="JavaScript" src="app/views/dist/js/jquery-ui/jquery-ui.min.js"></script>
	<!--JS Timepicker-->
	<script type="text/javascript" language="JavaScript" src="app/views/dist/js/bootstrap-timepicker.js"></script>  	  
  	 <script>
		  $(function() {
		    $( ".datepicker" ).datepicker({ 
		    	dateFormat: 'mm/dd/yy', 
		    	monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
    			'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'] }).val();
		  });
  	</script>	
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
        		ordering: false,
                responsive: true,
				lengthMenu: [[500,-1], [500,"Todo"]],
				columnDefs:[
					{
						targets: [2,5],
						searchable: false
					}
				],
				language: {
					lengthMenu: "Mostrando _MENU_ por pagina",
					zeroRecords: "No hay dato para mostrar",
					info: "Mostrando página _PAGE_ de _PAGES_",
					sSearch: "Buscar: ",
					sInfoFiltered:   "(Filtrado de un total de _MAX_ registros)",										
					oPaginate: {
									"sFirst":    "Primero",
									"sLast":     "Último",
									"sNext":     "Siguiente",
									"sPrevious": "Anterior"
								}
				}
        });
        
         $('#dataTables-usuarios').DataTable({
         		ordering: false,
         		language: {
					lengthMenu: "Mostrando _MENU_ por pagina",
					zeroRecords: "No hay dato para mostrar",
					info: "Mostrando página _PAGE_ de _PAGES_",
					sSearch: "Buscar: ",
					sInfoFiltered:   "(Filtrado de un total de _MAX_ registros)",
					oPaginate: {
									"sFirst":    "Primero",
									"sLast":     "Último",
									"sNext":     "Siguiente",
									"sPrevious": "Anterior"
								}
				}
			});
			
			$('#dataTables-aflujo').DataTable({
         		language: {
					lengthMenu: "Mostrando _MENU_ por pagina",
					zeroRecords: "No hay dato para mostrar",
					info: "Mostrando página _PAGE_ de _PAGES_",
					sSearch: "Buscar: ",
					sInfoFiltered:   "(Filtrado de un total de _MAX_ registros)",					
					oPaginate: {
									"sFirst":    "Primero",
									"sLast":     "Último",
									"sNext":     "Siguiente",
									"sPrevious": "Anterior"
							}
				},
				scrollY:        "400px",
        		scrollCollapse: true,
        		paging:         true
			});
                        
                        
       /*var table = $('#dataTables-example1').DataTable();
       
        $('.input-sm').on( 'keyup', function () {
    		table.search( this.value ).draw();
		} );
		
		/*Oculta segundo search
		 $('#buttom').find('label').hide();*/
		
    });
    </script>     
    <script type="text/javascript">
            $('#time').timepicker();
            
            $(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});


	$('.btn-file :file').on('fileselect', function(event, numFiles, label) {
		console.log("teste");
		var input_label = $(this).closest('.input-group').find('.file-input-label'),
			log = numFiles > 1 ? numFiles + ' files selected' : label;

		if( input_label.length ) {
			input_label.text(log);
		} else {
			if( log ) alert(log);
		}
	});
        </script>
		<!--<script>
			  
  $(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
	  width: 400,
	  height: 200,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( "#opener" ).click(function() {
      $( "#dialog" ).dialog( "open" );
    });
  });
		</script>-->
</body>
</html>