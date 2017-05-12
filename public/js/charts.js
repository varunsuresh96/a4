function charts(caloriesConsumed,caloriesLeft1,caloriesBurned,caloriesLeft2)
{
    //http://canvasjs.com/docs/charts/basics-of-creating-html5-chart/
		window.onload = function ()
    {
        // Pie chart containing calories consumed
    		var dataPoints=[{legendText:'Calories consumed(%)',label:'Calories consumed (%)= ',y:caloriesConsumed},{legendText:'Calories left(%)',label:'Calories left (%)= ',y:caloriesLeft1}]
		    var chart = new CanvasJS.Chart("chartContainer",
			  {
				    title:{
				        text: "Calories left to consumed"
			      },
            animationEnabled: true,
    	      theme: "theme1",

            data:
            [
    			      {
    				    type: "pie",
    				    indexLabelFontFamily: "Garamond",
    				    indexLabelFontSize: 20,
    				    indexLabel: "{label} {y}%",
    				    startAngle:-20,
    				    showInLegend: true,
    				    toolTipContent:"{legendText} {y}%",
    				    dataPoints: dataPoints
    			      }
    			  ]
    		});
		    chart.render();

    	//Pie chart containing calories burned
        var dataPoints2=[{legendText:'Calories burned (%)',label:'Calories burned (%)= ',y:caloriesBurned},{legendText:'Calories left (%)',label:'Calories left (%)= ',y:caloriesLeft2}]
		    var chart2 = new CanvasJS.Chart("chartContainer2",
		    {
		        title:
            {
				        text: "Calories to be burned"
		        },

            animationEnabled: true,
		        theme: "theme1",

            data:
            [
		            {
            		    type: "pie",
            				indexLabelFontFamily: "Garamond",
            				indexLabelFontSize: 20,
            				indexLabel: "{label} {y}%",
            				startAngle:-20,
            				showInLegend: true,
            				toolTipContent:"{legendText} {y}%",
            				dataPoints: dataPoints2
		            }
		        ]
		    });
		    chart2.render();
	  };
}
