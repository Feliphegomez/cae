		<script src="/js/jquery.min.js"></script>
		<script src="/lib/jQueryUI/jquery-ui-1.8.18.custom.min.js"></script>
		<script src="/js/s_scripts.js"></script>
		<script src="/js/jquery.ui.extend.js"></script>
		<script src="/lib/qtip2/jquery.qtip.min.js"></script>
		<script src="/lib/jQplot/jquery.jqplot.min.js"></script>
		<script src="/lib/jQplot/jqplot.plugins.js"></script>
		<script src="/lib/fullcalendar/fullcalendar.min.js"></script>
		<script src="/js/jquery.list.min.js"></script>
		<script src="/js/pertho.js"></script>
		<script>
			$(document).ready(function() {
				//* common functions
				prth_common.init();
                
                //* nested accordion
                prth_nested_accordion.init();
				//* full calendar
				prth_calendar.init();
				//* filterable list
				prth_flist.init();
				//* smart gallery
				prth_gallery.init();
				//* home page charts resize
				prth_charts.charts_resize();
				//* home page charts
				prth_charts.ds_plot1();
				prth_charts.ds_plot2();
				if(!jQuery.browser.mobile) {
					// create image from visible chart
					prth_charts.makeImage();
				}
				//* horizontal scrollable (charts)
				prth_h_scrollable.init();
			});
		</script>
