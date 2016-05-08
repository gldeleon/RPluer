<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
		/* styles unrelated to zoom */
		* { border:0; margin:0; padding:0; }
		p { position:absolute; top:3px; right:28px; color:#555; font:bold 13px/1 sans-serif;}

		/* these styles are for the demo, but are not required for the plugin */
		.zoom {
			display:inline-block;
			position: relative;
                        padding: 10px;
		}
		
		/* magnifying glass icon */
		.zoom:after {
			content:'';
			display:block; 
			width:33px; 
			height:33px; 
			position:absolute; 
			top:0;
			right:0;
			background:url(icon.png);
		}

		.zoom img {
			display: block;
		}

		.zoom img::selection { background-color: transparent; }

		#ex2 img:hover { cursor: url(grab.cur), default; }
		#ex2 img:active { cursor: url(grabbed.cur), default; }
	</style>
    </head>
    <body>
        <?php
            //$directory="./image/2016/04/18/26994";
            $directory = $ruta;
            /*con la funcion dir, leemos el contenido de la carpeta que le indiquemos (ruta)*/
            $dirint = dir($directory);
            $i = 1;
            while (($archivo = $dirint->read()) !== false)
                    {
                        /*eregi para que solo procese los archivos del tipo gif, jpg y png
                            Despues concateno $directory para que imprima la ruta completa del archivo  */
                        if (eregi("gif", $archivo) || eregi("jpg", $archivo) || eregi("png", $archivo)){
                            //echo $directory."/".$archivo;.
                             echo '<span class="zoom ex1">';
                             echo '<img width="600" height="400" src="'.$directory."/".$archivo.'" >'."\n";
                             echo '</span>';
                        }
                        $i++;
                    }
            $dirint->close();
        ?>
        
    </body>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <script src='http://localhost/rpluer/app/zoom/jquery.zoom.js'></script>
<script type="text/javascript">
	$('.ex1').zoom();
</script>
</html>
