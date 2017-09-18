<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rest Call API by AJAX</title>
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/lib/bootstrap/css/bootstrap.min.css">
    </head>
    <body>

        <div class="jumbotron">
        	<div class="container">
        		<h1>Restful Call API with AJAX</h1>
        		<a class="btn btn-primary btn-lg" id="load_province">Load Provinces</a>
        	</div>
        </div>

        <div class="container showdata"></div>

        <script src="<?php echo base_url() ?>assets/backend/lib/jquery/jquery-2.2.4.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/lib/bootstrap/js/bootstrap.min.js"></script>

        <script type="text/javascript">
        	$(function(){
        		$('#load_province').click(function(){
        			//console.log('ok click load provine button');
        			$.ajax({ 
				url: 'https://itgenius.co.th/restfulapi/api/v1/provinces',
				//url:'http://localhost/restfulapi/api/v1/provinces',
				async: true,
				type:'GET',
				//dataType: 'json',
				dataType: 'jsonp', // Cross Domain
				contentType: 'application/json',
				beforeSend: function(xhr) {
					//xhr.setRequestHeader("Authorization", "Basic "+btoa('samit'+':'+'smk377040'));
					xhr.setRequestHeader("Authorization", "Basic <?php echo $glob_basic_auth_hash; ?>");
				},
				success: function(data){
				 	//console.log(data);
				 	var i = 0;
					var table = '<table class="table table-striped table-bordered table-hover"><thead><tr class="bg-primary"><th>ID</th><th>Code</th><th>Name</th><th>Name_Eng</th><th>GEO</th></tr></thead><tbody>';
					
					$.each(data, function(key, value){                            
					        table += ('<tr>');
					        table += ('<td>' + value.province_id + '</td>');
					        table += ('<td>' + value.province_code + '</td>');
					        table += ('<td>' + value.province_name + '</td>');
					        table += ('<td>' + value.province_name_eng + '</td>');
					        table += ('<td>' + value.geo_id + '</td>');
					        table += ('</tr>');
					});
					table += '</tbody></table>';
					$(".showdata").html(table);
				},
				error: function(err) {
					console.log(err);
				}
			});
        		});
        	});
        </script>

    </body>
</html>