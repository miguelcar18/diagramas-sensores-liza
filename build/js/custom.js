$(function() {

	/**** Variables iniciales ****/
	var arrayXY = [];
	var arrayYZ = [];
	var arrayXZ = [];
	var arrayFX = [];
	var arrayFY = [];
	var arrayFZ = [];

	/**** Variables para guardar en base de datos ****/
	var arrayX = [];
	var arrayY = [];
	var arrayZ = [];
	var arrayV = [];
	var arrayN = [];
	var arrayF = [];

	/**** Agregar primer elemento en matriz según ejemplo ****/
	arrayXY.push(['X', 'Y']);
	arrayYZ.push(['X', 'Y']);
	arrayXZ.push(['X', 'Y']);
	arrayFX.push(['X', 'Y']);
	arrayFY.push(['X', 'Y']);
	arrayFZ.push(['X', 'Y']);

	function drawChart() {
		var options_Scatter = {
			width:550,
			height:300,
			legend: 'none',
			chartArea: {width: '80%' , height: '80%'} ,
			hAxis: { minValue: -7, maxValue: 7 },
			//vAxis: { minValue: -6, maxValue: 6 },
			pointSize: 3,
			series: {
				0: { pointShape: 'circle' },

			}
		};
			
		var options_Line = {
			width:550,
			height:300,
			legend: 'none',
		  	//hAxis:{viewWindowMode: "explicit", viewWindow:{ min: 0 }},
			vAxis:{viewWindowMode: "explicit", viewWindow:{ min: 0 } },
	        //hAxis: { minValue: 10, maxValue: 1200 },
			//vAxis: { minValue: -6, maxValue: 6 },
			pointSize: 3,
			series: {
				0: { pointShape: 'circle' },

			}
		};
		
		var dataXY = google.visualization.arrayToDataTable(arrayXY);
		var chartXY = new google.visualization.ScatterChart(document.getElementById('chart_XY'));
		chartXY.draw(dataXY, options_Scatter);

		var dataYZ = google.visualization.arrayToDataTable(arrayYZ);
		var chartYZ = new google.visualization.ScatterChart(document.getElementById('chart_YZ'));
		chartYZ.draw(dataYZ, options_Scatter);

		var dataXZ = google.visualization.arrayToDataTable(arrayXZ);
		var chartXZ = new google.visualization.ScatterChart(document.getElementById('chart_XZ'));
		chartXZ.draw(dataXZ, options_Scatter);

		var dataFX = google.visualization.arrayToDataTable(arrayFX);
		var chartFX = new google.visualization.LineChart(document.getElementById('chart_FX'));
		chartFX.draw(dataFX, options_Line);

		var dataFY = google.visualization.arrayToDataTable(arrayFY);
		var chartFY = new google.visualization.LineChart(document.getElementById('chart_FY'));
		chartFY.draw(dataFY, options_Line);

		var dataFZ = google.visualization.arrayToDataTable(arrayFZ);
		var chartFZ = new google.visualization.LineChart(document.getElementById('chart_FZ'));
		chartFZ.draw(dataFZ, options_Line);
	}

	function findReadFile(idCarpeta, contador) {
		/**** Buscar y leer archivo ****/
		fetch('/production/files/data.txt').then(res => res.text()).then(content => {
			let lines = content.split(/\n/);
		    lines.forEach(function(currentValue, index, line) {
		        /**** 
		            Si no es la primera fila que contiene el encabezado 
		            y si no es una linea vacía (como la linea final de data.txt por ejemplo)
		        ****/
		        if(index > 0 && currentValue != ""){
			        /**** 
			            Se crea una variable para poder separar cada elemento 
			            de la fila por coma ","
			            parseFloat es para que tome ese valor como un número decimal
			        ****/
		            var separarValores  = (currentValue).split(",");
		            var X_AXIS          = parseFloat(separarValores[0]);
		            var Y_AXIS          = parseFloat(separarValores[1]);
		            var Z_AXIS          = parseFloat(separarValores[2]);
		            var BATTERY_VOLTS   = parseFloat(separarValores[3]);
		            var ENE             = (parseInt(index) - 1);
		            var F               = ((ENE * (50 / 512)*60));

		            /**** 
				    	Comprobar carpeta y	guardar variables en base de datos 
					****/
					if(contador === 0){
						$.ajax({
							url: "conecction/agregar.php",
							type: "POST", 
							dataType: 'json', 
							data: {X_AXIS: X_AXIS, Y_AXIS: Y_AXIS, Z_AXIS: Z_AXIS, BATTERY_VOLTS: BATTERY_VOLTS, ENE: ENE, F: F, IDCARPETA: idCarpeta},
							success: function(result){
								console.log(result);
							}
						});
					}

		            /**** Agregar elemento a arreglos ****/
		            arrayX.push(X_AXIS);
		            arrayY.push(Y_AXIS);
		            arrayZ.push(Z_AXIS);
		            arrayV.push(BATTERY_VOLTS);
		            arrayN.push(ENE);
		            arrayF.push(F);

					arrayXY.push([X_AXIS, Y_AXIS]);
		            arrayYZ.push([Y_AXIS, Z_AXIS]);
		            arrayXZ.push([X_AXIS, Z_AXIS]);
					if(F < 3000){
						arrayFX.push([F , X_AXIS]);
						arrayFY.push([F , Y_AXIS]);
						arrayFZ.push([F , Z_AXIS]);
					}
		        }
			});
		});

		// Load Charts and the corechart and barchart packages.
		google.charts.load('43', {'packages':['corechart']});

		// Draw the pie chart and bar chart when Charts is loaded.
		google.charts.setOnLoadCallback(drawChart);
	}

	/**** Reemplazar data actual ****/
	$.ajax({
		url: "conecction/reemplazarArchivo.php",
		type: "GET", 
		dataType: 'json', 
		data: {},
		success: function(result){
			findReadFile(result.idCarpeta, result.contador);
			$("#labelH3").html("Gráficas de la carpeta "+result.carpeta);
		}
	});
//setTimeout('document.location.reload()', 10000);
});