<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Calendario</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/colorbox.css"/>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.colorbox-min.js"></script>
	<script type="text/javascript">
		var base_url ='<?php echo base_url(); ?>';
	</script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-5">
				<div class="calendar">
					<?php echo $notes;?>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="event_detail">
					<h2 class="s_date">Eventos para <?php echo "$day $month $year";?></h2>
					<div class="detail_event">
						<?php 
							if(isset($events)){
								$i = 1;
								foreach($events as $e){
								 if($i % 2 == 0){
										echo '<div class="post-outer1">
												<div class="row">
													<div class="col-md-12">
								    					<div class="post hentry">
								        				<img src="https://4.bp.blogspot.com/-v5Q1qbEAgDQ/Ws33wIp8JPI/AAAAAAAAOck/rNSXeRQFqb4QB0qGSCY2rvujwEz4deq2QCLcBGAs/s100-c/iPad%2BMurah%2BKualitas%2BTinggi%2BDiluncurkan%2BApple.jpg" class="post-thumbnail" alt="Perú" width="800" height="800">
								        					<h2 class="post-title entry-title">
								        					<a href="https://arlinafix.blogspot.com/2015/08/fermentum-caipirinha-cherry-pink-lady.html" title="Perú">'.$e['event'].'</a></h2>
								                            <div class="post-header">
								                                <div class="post-header-line-1">
								                                    <div class="post-info">
							                                        	<div class="post-snippet"><i class="fa fa-clock-o"></i> '.$e['event_date'].'</div>
							                                        	<div class="post-snippet"><i class="fa fa-map-marker"></i> '.$e['lugar'].'</div>
								                                    </div>
								                                </div>
								        					</div>
								                        </div>
													</div>
												</div>
											</div>';
									}else{
										echo '<div class="post-outer2">
												<div class="row">
													<div class="col-md-12">
								    					<div class="post hentry">
								        				<img src="https://4.bp.blogspot.com/-v5Q1qbEAgDQ/Ws33wIp8JPI/AAAAAAAAOck/rNSXeRQFqb4QB0qGSCY2rvujwEz4deq2QCLcBGAs/s100-c/iPad%2BMurah%2BKualitas%2BTinggi%2BDiluncurkan%2BApple.jpg" class="post-thumbnail" alt="Perú" width="800" height="800">
								        					<h2 class="post-title entry-title">
								        					<a href="https://arlinafix.blogspot.com/2015/08/fermentum-caipirinha-cherry-pink-lady.html" title="Perú">'.$e['event'].'</a></h2>
								                            <div class="post-header">
								                                <div class="post-header-line-1">
								                                    <div class="post-info">
							                                        	<div class="post-snippet"><i class="fa fa-clock-o"></i> '.$e['event_date'].'</div>
							                                        	<div class="post-snippet"><i class="fa fa-map-marker"></i> '.$e['lugar'].'</div>
								                                    </div>
								                                </div>
								        					</div>
								                        </div>
													</div>
												</div>
											</div>';
									} 
									$i++;
								}
							}else{
								echo '<div class="post-outer3"><div class="row"><div class="col-md-12"><div class="post hentry"><img src="https://4.bp.blogspot.com/-v5Q1qbEAgDQ/Ws33wIp8JPI/AAAAAAAAOck/rNSXeRQFqb4QB0qGSCY2rvujwEz4deq2QCLcBGAs/s100-c/iPad%2BMurah%2BKualitas%2BTinggi%2BDiluncurkan%2BApple.jpg" class="post-thumbnail" alt="Peú" width="800" height="800"><h2 class="post-title entry-title"><br><a href="#" title="Perú">No Hay eventos </a><br></h2><div class="post-header"><div class="post-header-line-1"><div class="post-info"><div class="post-snippet"><i class="fa fa-clock-o"></i> No hay evento en esta fecha</div></div></div></div></div></div></div></div>';
							}
						?>
						<input type="button" name="add" value="Agregar Evento" val="<?php echo $day;?>" class="add_event"/>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(".detail").live('click',function(){
			$(".s_date").html("Eventos para "+$(this).attr('val')+" <?php echo "$month $year";?>");
			var day = $(this).attr('val');
			var add = '<input type="button" name="add" value="Add Event" val="'+day+'" class="add_event"/>';
			$.ajax({
				type: 'post',
				dataType: 'json',
				url: "<?php echo base_url("evencal/detail_event");?>",
				data:{<?php echo "year: $year, mon: $mon";?>, day: day},
				success: function( data ) {
					var html = '';
					if(data.status){
						var i = 1;
						$.each(data.data, function(index, value) {
						    if(i % 2 == 0){
								html = html+'<div class="post-outer1"><div class="row"><div class="col-md-12"><div class="post hentry"><img src="https://4.bp.blogspot.com/-v5Q1qbEAgDQ/Ws33wIp8JPI/AAAAAAAAOck/rNSXeRQFqb4QB0qGSCY2rvujwEz4deq2QCLcBGAs/s100-c/iPad%2BMurah%2BKualitas%2BTinggi%2BDiluncurkan%2BApple.jpg" class="post-thumbnail" alt="Perú" width="800" height="800"><h2 class="post-title entry-title"><a href="https://arlinafix.blogspot.com/2015/08/fermentum-caipirinha-cherry-pink-lady.html" title="Perú"> '+value.event+'</a></h2><div class="post-header"><div class="post-header-line-1"><div class="post-info"><div class="post-snippet"><i class="fa fa-clock-o"></i> '+value.event_date+'</div><div class="post-snippet"><i class="fa fa-map-marker"></i> '+value.lugar+'</div></div></div></div></div></div></div></div>';
							}else{
								html = html+'<div class="post-outer2"><div class="row"><div class="col-md-12"><div class="post hentry"><img src="https://4.bp.blogspot.com/-v5Q1qbEAgDQ/Ws33wIp8JPI/AAAAAAAAOck/rNSXeRQFqb4QB0qGSCY2rvujwEz4deq2QCLcBGAs/s100-c/iPad%2BMurah%2BKualitas%2BTinggi%2BDiluncurkan%2BApple.jpg" class="post-thumbnail" alt="Perú" width="800" height="800"><h2 class="post-title entry-title"><a href="https://arlinafix.blogspot.com/2015/08/fermentum-caipirinha-cherry-pink-lady.html" title="Perú"> '+value.event+'</a></h2><div class="post-header"><div class="post-header-line-1"><div class="post-info"><div class="post-snippet"><i class="fa fa-clock-o"></i> '+value.event_date+'</div><div class="post-snippet"><i class="fa fa-map-marker"></i> '+value.lugar+'</div></div></div></div></div></div></div></div>';
							} 
							i++;
						});
					}else{
						html = '<div class="post-outer3"><div class="row"><div class="col-md-12"><div class="post hentry"><img src="https://4.bp.blogspot.com/-v5Q1qbEAgDQ/Ws33wIp8JPI/AAAAAAAAOck/rNSXeRQFqb4QB0qGSCY2rvujwEz4deq2QCLcBGAs/s100-c/iPad%2BMurah%2BKualitas%2BTinggi%2BDiluncurkan%2BApple.jpg" class="post-thumbnail" alt="Peú" width="800" height="800"><h2 class="post-title entry-title"><br><a href="'+base_url+'" title="Perú">'+data.title_msg+'</a><br></h2><div class="post-header"><div class="post-header-line-1"><div class="post-info"><div class="post-snippet"><i class="fa fa-clock-o"></i> '+data.msg+'</div></div></div></div></div></div></div></div>';
					}
					html = html+add;
					$( ".detail_event" ).fadeOut("slow").fadeIn("slow").html(html);
				} 
			});
		});
		$(".delete").live("click", function() {
			if(confirm('Are you sure delete this event ?')){
				var deleted = $(this).parent().parent();
				var day =  $(this).attr('day');
				var add = '<input type="button" name="add" value="Agregar Evento" val="'+day+'" class="add_event"/>';
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: "<?php echo base_url("evencal/delete_event");?>",
					data:{<?php echo "year: $year, mon: $mon";?>, day: day,del: $(this).attr('val')},
					success: function(data) {
						if(data.status){
							if(data.row > 0){
								$('.d'+day).html(data.row);
							}else{
								$('.d'+day).html('');
								$( ".detail_event" ).fadeOut("slow").fadeIn("slow").html('<div class="message"><h4>'+data.title_msg+'</h4><p>'+data.msg+'</p></div>'+add);
							}
							deleted.remove();
						}else{
							alert('an error for deleting event');
						}
					}
				});
			}
		});
		$(".add_event").live('click', function(){
			$.colorbox({ 
					overlayClose: false,
					href: '<?php echo base_url('evencal/add_event');?>',
					data:{year:<?php echo $year;?>,mon:<?php echo $mon;?>, day: $(this).attr('val')}
			});
		});
	</script>
</body>
</html>