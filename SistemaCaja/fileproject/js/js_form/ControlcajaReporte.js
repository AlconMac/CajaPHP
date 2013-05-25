// JavaScript Document
function fnlFiltrarFecha(url)
{
   var year=$("#lstYear").find("span").attr("id");
   var mes=$("#lstMes").find("span").attr("id");
   var dia=$("#lstDia").val();
   if(year!="" && mes!="" & dia!=""){
	   document.location.href=url+(year+"-"+mes+"-"+dia);
   }else{
			AlertALCON({
				textBody:"Seleccione la fecha",
				botonPrincipal:{
					visible:true
				}
			});			
			return false;	   
	}
}

/////
function fnlFiltrarFechaGrafico(url){
   var year=$("#lstYear").find("span").attr("id");
   var mes=$("#lstMes").find("span").attr("id");
   if(year!="" && mes!=""){
	   document.location.href=url+(year+"-"+mes);
   }else if(year!="" && mes==""){
	   document.location.href=url+(year);
   }else{
			AlertALCON({
				textBody:"Seleccione la fecha",
				botonPrincipal:{
					visible:true
				}
			});			
			return false;	   
	}   	
}


/////
function fnlGraficoG(dataJson){
var titulo=dataJson.titulo;
var subtitulo=dataJson.subtitulo;

var categoria='['
var cartegoriag=dataJson.categorias;

var ingresos='['
var ingresosg=dataJson.ingresos;

var salidas='['
var salidasg=dataJson.salidas;


//Categorias
for(xj in cartegoriag){
	categoria+="'"+cartegoriag[xj]+"',";
}
categoria=categoria.slice(0,-1);
categoria+=']';
categoria=eval(categoria);//Categorias

//Ingresos
for(xi in ingresosg){
	ingresos+=ingresosg[xi]+",";
}
ingresos=ingresos.slice(0,-1);
ingresos+=']';
ingresos=eval(ingresos);//Ingresos

//Salidas
for(xs in salidasg){
	salidas+=salidasg[xs]+",";
}
salidas=salidas.slice(0,-1);
salidas+=']';
salidas=eval(salidas);//Salidas



        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: titulo
            },
            subtitle: {
                text: subtitulo
            },
            xAxis: {
                categories:categoria
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'S/. Soles'
                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: '#FFFFFF',
                align: 'left',
                verticalAlign: 'top',
                x: 100,
                y: 70,
                floating: true,
                shadow: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': S/.'+ this.y.toFixed(2) +'';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [ {
						name: 'Ingresos',
						data: ingresos    
		              }, {
						name: 'Salidas',
						data: salidas
					  }
			        ]
        });
}