<html>
  <head>
	  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	  <script type="text/javascript" src="ajaxupload.3.5.js"></script>
    <title></title>
    <meta content="">
    <style>
		#files{font-size: 10px;}
    </style>
  </head>
  <body>
		<span id="pilih_gambar">Pilih gambar</span>
		<label id="status"></label>
		<div id="files"></div>
		<script type="text/javascript">
		(function($){
			var btnUpload=$('#pilih_gambar');
			var status=$('#status');
			new AjaxUpload(btnUpload, {
				action: 'http://ajaxuploader/handler.php',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
				  // extension is not allowed 
						status.text('Only JPG, PNG or GIF files are allowed');
						return false;
					}
					status.text('Uploading...');
				},
				onComplete: function(file, response){
					//On completion clear the status
					status.text('');
					//Add uploaded file to list
					if(response==="success"){
						console.log('sukses bro');
						if($("#files").html()){
							$("#files").append("<span class='fileuploaded'>, "+file+"</span>");
						}else{
							$("#files").append("<span class='fileuploaded'>"+file+"</span>");
						}
					}else{
						console.log('gagal bro');
					}
				}
			});
			$("#files").on("click",".fileuploaded",function(){
				$(this).remove();
				console.log($(this).html()+" removed");
			});
		}(jQuery))
		</script>
  </body>
</html>
