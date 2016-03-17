<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pengiriman Email</title>
	  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	  <script type="text/javascript" src="ajaxupload.3.5.js"></script>
	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/form-basic.css">
</head>
	<header>
		<h1>Send Mail</h1>
    </header>
    <div class="main-content">
        <form class="form-basic" method="post" action="#">
            <div class="form-title-row">
                <h1>Pengiriman Email</h1>
            </div>
            <div class="form-row">
                <label>
                    <span>Judul Email</span>
                    <input type="text" name="subject" id="mailsubject">
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Email Tujuan</span>
                    <input type="email" name="email" id="mailto">
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Isi Email</span>
                    <textarea name="content" id="mailcontent"></textarea>
                </label>
            </div>
            <div class="form-row">
                <label id="pilih_gambar">Attachment</label>
				<label id="status"></label>
				<div id="files"></div>
                <button  id="sendmail">Kirim Email</button>
            </div>
        </form>
    </div>
		<script type="text/javascript">
		(function($){
			$("#sendmail").click(function(){
				$.ajax({
					url:"http://ajaxuploader/mailsender.php",
					data:{mailto:$("#mailto").val(),mailsubject:$("#mailsubject").val(),mailcontent:$("#mailcontent").val(),filename:$("#fileuploaded").html()},
					type:"post"
				})
				.done(function(res){
					console.log("Sukses",res);
				})
				.fail(function(err){
					console.log("Error",err);
				});
			});
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
							$("#files").append("<span class='fileuploaded' id='fileuploaded'>, "+file+"</span>");
						}else{
							$("#files").append("<span class='fileuploaded' id='fileuploaded'>"+file+"</span>");
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
