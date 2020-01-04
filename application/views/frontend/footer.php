<!--//////////		Scripts    ////////////////--> 
  <script type="text/javascript">
    var base_url ='<?php echo base_url(); ?>';
  </script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js'></script>
<?php if ($this->uri->segment(1) == 'home'): ?>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/scripts/jquery.mobile.customized.min.js'></script> 
<?php endif?>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/scripts/jquery.easing.1.3.js'></script> 
<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/scripts/fluid_dg.min.js'></script> 
<script>jQuery(document).ready(function(){
		jQuery(function(){			
			jQuery('#fluid_dg_wrap_4').fluid_dg({height: 'auto', loader: 'bar', pagination: false, thumbnails: true, hover: false, opacityOnGrid: false, imagePath: ''});
		}); })
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/mapscript.js'></script>
</body>
</html>