<div class="sfa_chart_container">
	<div class="sfa_chart_heading">
		<div class="sfa_chart_title_and_value">
			<div class="sfa_chart_value">
				<?php echo($revenue_report->get_current_value()); ?>
			</div>
			<div class="sfa_chart_title">
				<?php echo($revenue_report->get_report_title()); ?>
			</div>
		</div>
		<div class="sfa_chart_delta_<?php echo($revenue_report->difference_class()) ?>">
			<?php echo($revenue_report->get_difference()); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div id="daily_revenue_chart" class="sfa_actual_chart">
	</div>
</div>
<div class="sfa_chart_container">
	<div class="sfa_chart_heading">
		<div class="sfa_chart_title_and_value">
			<div class="sfa_chart_value">
				<?php echo($average_cart_report->get_current_value()); ?>
			</div>
			<div class="sfa_chart_title">
				<?php echo($average_cart_report->get_report_title()); ?>
			</div>
		</div>
		<div class="sfa_chart_delta_<?php echo($average_cart_report->difference_class()) ?>">
			<?php echo($average_cart_report->get_difference()); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div id="daily_average_cart_total" class="sfa_actual_chart">
	</div>
</div>
<div class="sfa_chart_container">
	<div class="sfa_chart_heading">
		<div class="sfa_chart_title_and_value">
			<div class="sfa_chart_value">
				<?php echo($sales_report->get_current_value()); ?>
			</div>
			<div class="sfa_chart_title">
				<?php echo($sales_report->get_report_title()); ?>
			</div>
		</div>
		<div class="sfa_chart_delta_<?php echo($sales_report->difference_class()) ?>">
			<?php echo($sales_report->get_difference()); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div id="daily_orders_chart" class="sfa_actual_chart">
	</div>
</div>
<div class="sfa_chart_container">
	<div class="sfa_chart_heading">
		<div class="sfa_chart_title_and_value">
			<div class="sfa_chart_value">
				<?php echo($customer_report->get_current_value()); ?>
			</div>
			<div class="sfa_chart_title">
				<?php echo($customer_report->get_report_title()); ?>
			</div>
		</div>
		<div class="sfa_chart_delta_<?php echo($customer_report->difference_class()) ?>">
			<?php echo($customer_report->get_difference()); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div id="daily_customers_chart" class="sfa_actual_chart">
	</div>
</div>
<div class="sfa_chart_container">
	<div class="sfa_chart_heading">
		<div class="sfa_chart_title_and_value">
			<div class="sfa_chart_value">
				<?php echo($daily_refunds_report->get_current_value()); ?>
			</div>
			<div class="sfa_chart_title">
				<?php echo($daily_refunds_report->get_report_title()); ?>
			</div>
		</div>
		<div class="sfa_chart_delta_<?php echo($daily_refunds_report->difference_class()) ?>">
			<?php echo($daily_refunds_report->get_difference()); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div id="daily_refunds_chart" class="sfa_actual_chart">
	</div>
</div>
<div class="sfa_chart_container">
	<div class="sfa_chart_heading">
		<div class="sfa_chart_title_and_value">
			<div class="sfa_chart_value">
				<?php echo($daily_coupons_report->get_current_value()); ?>
			</div>
			<div class="sfa_chart_title">
				<?php echo($daily_coupons_report->get_report_title()); ?>
			</div>
		</div>
		<div class="sfa_chart_delta_<?php echo($daily_coupons_report->difference_class()) ?>">
			<?php echo($daily_coupons_report->get_difference()); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div id="daily_coupons_total_chart" class="sfa_actual_chart">
	</div>
</div>

<div class="clear"></div>

<script type="text/javascript">

	jQuery.plot(jQuery("#daily_revenue_chart"), 
	[ 
		{	
			data: <?php echo($revenue_report->generate_report_data()); ?>,
			color: 'rgba(37,90,140,1)'
			
		}
	],
	 	{ 
			yaxis: 
			{ 
				show: true,
				color: 'rgba(66,162,206,0.3)',
				font:
				{
					color: 'rgba(35,40,45,1)'
				}
			},
			xaxis:
			{
				show: 'true',
				color: 'rgba(66,162,206,0.3)',
				font:
				{
					color: 'rgba(35,40,45,1)'
				}
			},
			series:
			{
				lines:
				{
					show: true,
					fill: true,
					fillColor: 'rgba(164,100,151,0.6)',
					lineWidth: 3
				},
				points:
				{
					show: true
				}
			},
			grid:
			{
				show: false,
				hoverable: true,
				color: 'transparent'
			}
		});
		
	jQuery("<div id='tooltip'></div>").css({
		position: "absolute",
		display: "none",
		border: "1px solid rgba(37,90,140,1)",
		padding: "10px",
		"background-color": "rgba(113,176,47,0.8)"
	}).appendTo("body");
		
	jQuery("#daily_revenue_chart").bind("plothover", function (event, pos, item) {
		if (item) {
			var x = item.datapoint[0].toFixed(2),
				y = item.datapoint[1].toFixed(2);

			jQuery("#tooltip").html(parseInt(Math.abs(x - 31)) + " days ago you had $" + y + " in revenue.")
				.css({top: item.pageY+5, left: item.pageX+5})
				.fadeIn(50);
		} else {
			jQuery("#tooltip").hide();
		}
	});

	jQuery.plot(jQuery("#daily_orders_chart"), 
	[ 
		{	
			data: <?php echo($sales_report->generate_report_data()); ?>,
			color: 'rgba(37,90,140,50)'
			
		}
	],
	 	{ 
			yaxis: 
			{ 
				show: true,
				color: 'rgba(66,162,206,0.3)',
				font:
				{
					color: 'rgba(35,40,45,1)'
				}
			},
			xaxis:
			{
				show: 'true',
				color: 'rgba(66,162,206,0.3)',
				font:
				{
					color: 'rgba(35,40,45,1)'
				}
			},
			series:
			{
				lines:
				{
					show: true,
					fill: true,
					fillColor: 'rgba(164,100,151,0.6)',
					lineWidth: 3
				},
				points:
				{
					show: true
				}
			},
			grid:
			{
				show: false,
				hoverable: true,
				color: 'transparent'
			}
		});
		
	jQuery("#daily_orders_chart").bind("plothover", function (event, pos, item) {
		if (item) {
			var x = item.datapoint[0].toFixed(2),
				y = item.datapoint[1].toFixed(2);

			jQuery("#tooltip").html(parseInt(Math.abs(x - 31)) + " days ago you had " + parseInt(y) + " total sales.")
				.css({top: item.pageY+5, left: item.pageX+5})
				.fadeIn(50);
		} else {
			jQuery("#tooltip").hide();
		}
	});
	
	jQuery.plot(jQuery("#daily_customers_chart"), 
	[ 
		{	
			data: <?php echo($customer_report->generate_report_data()); ?>,
			color: 'rgba(37,90,140,50)'
			
		}
	],
	 	{ 
			yaxis: 
			{ 
				show: true,
				color: 'rgba(66,162,206,0.3)',
				font:
				{
					color: 'rgba(35,40,45,1)'
				}
			},
			xaxis:
			{
				show: 'true',
				color: 'rgba(66,162,206,0.3)',
				font:
				{
					color: 'rgba(35,40,45,1)'
				}
			},
			series:
			{
				lines:
				{
					show: true,
					fill: true,
					fillColor: 'rgba(164,100,151,0.6)',
					lineWidth: 3
				},
				points:
				{
					show: true
				}
			},
			grid:
			{
				show: false,
				hoverable: true,
				color: 'transparent'
			}
		});
		
	jQuery("#daily_customers_chart").bind("plothover", function (event, pos, item) {
		if (item) {
			var x = item.datapoint[0].toFixed(2),
				y = item.datapoint[1].toFixed(2);

			jQuery("#tooltip").html(parseInt(Math.abs(x - 31)) + " days ago you had " + parseInt(y) + " customers.")
				.css({top: item.pageY+5, left: item.pageX+5})
				.fadeIn(50);
		} else {
			jQuery("#tooltip").hide();
		}
	});
	
	jQuery.plot(jQuery("#daily_refunds_chart"), 
	[ 
		{	
			data: <?php echo($daily_refunds_report->generate_report_data()); ?>,
			color: 'rgba(37,90,140,50)'
			
		}
	],
	 	{ 
			yaxis: 
			{ 
				show: true,
				color: 'rgba(66,162,206,0.3)',
				font:
				{
					color: 'rgba(35,40,45,1)'
				}
			},
			xaxis:
			{
				show: 'true',
				color: 'rgba(66,162,206,0.3)',
				font:
				{
					color: 'rgba(35,40,45,1)'
				}
			},
			series:
			{
				lines:
				{
					show: true,
					fill: true,
					fillColor: 'rgba(164,100,151,0.6)',
					lineWidth: 3
				},
				points:
				{
					show: true
				}
			},
			grid:
			{
				show: false,
				hoverable: true,
				color: 'transparent'
			}
		});
		
	jQuery("#daily_refunds_chart").bind("plothover", function (event, pos, item) {
		if (item) {
			var x = item.datapoint[0].toFixed(2),
				y = item.datapoint[1].toFixed(2);

			jQuery("#tooltip").html(parseInt(Math.abs(x - 31)) + " days ago you had $" + y + " in refunds.")
				.css({top: item.pageY+5, left: item.pageX+5})
				.fadeIn(50);
		} else {
			jQuery("#tooltip").hide();
		}
	});
	
	jQuery.plot(jQuery("#daily_average_cart_total"), 
	[ 
		{	
			data: <?php echo($average_cart_report->generate_report_data()); ?>,
			color: 'rgba(37,90,140,50)'
			
		}
	],
	 	{ 
			yaxis: 
			{ 
				show: true,
				color: 'rgba(66,162,206,0.3)',
				font:
				{
					color: 'rgba(35,40,45,1)'
				}
			},
			xaxis:
			{
				show: 'true',
				color: 'rgba(66,162,206,0.3)',
				font:
				{
					color: 'rgba(35,40,45,1)'
				}
			},
			series:
			{
				lines:
				{
					show: true,
					fill: true,
					fillColor: 'rgba(164,100,151,0.6)',
					lineWidth: 3
				},
				points:
				{
					show: true
				}
			},
			grid:
			{
				show: false,
				hoverable: true,
				color: 'transparent'
			}
		});
		
	jQuery("#daily_average_cart_total").bind("plothover", function (event, pos, item) {
		if (item) {
			var x = item.datapoint[0].toFixed(2),
				y = item.datapoint[1].toFixed(2);

			jQuery("#tooltip").html(parseInt(Math.abs(x - 31)) + " days ago you had $" + y + " as an average cart total.")
				.css({top: item.pageY+5, left: item.pageX+5})
				.fadeIn(50);
		} else {
			jQuery("#tooltip").hide();
		}
	});
	
	jQuery.plot(jQuery("#daily_coupons_total_chart"), 
	[ 
		{	
			data: <?php echo($daily_coupons_report->generate_report_data()); ?>,
			color: 'rgba(37,90,140,50)'
			
		}
	],
	 	{ 
			yaxis: 
			{ 
				show: true,
				color: 'rgba(66,162,206,0.3)',
				font:
				{
					color: 'rgba(35,40,45,1)'
				}
			},
			xaxis:
			{
				show: 'true',
				color: 'rgba(66,162,206,0.3)',
				font:
				{
					color: 'rgba(35,40,45,1)'
				}
			},
			series:
			{
				lines:
				{
					show: true,
					fill: true,
					fillColor: 'rgba(164,100,151,0.6)',
					lineWidth: 3
				},
				points:
				{
					show: true
				}
			},
			grid:
			{
				show: false,
				hoverable: true,
				color: 'transparent'
			}
		});
		
	jQuery("#daily_coupons_total_chart").bind("plothover", function (event, pos, item) {
		if (item) {
			var x = item.datapoint[0].toFixed(2),
				y = item.datapoint[1].toFixed(2);

			jQuery("#tooltip").html(parseInt(Math.abs(x - 31)) + " days ago gave away $" + y + " in coupons.")
				.css({top: item.pageY+5, left: item.pageX+5})
				.fadeIn(50);
		} else {
			jQuery("#tooltip").hide();
		}
	});
			
</script>