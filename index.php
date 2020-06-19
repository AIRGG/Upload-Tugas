<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Tugas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="margin-top:10px;">
    <div class="row">
                <div class="col-xs-12">
                <h1>Upload Tugas ENGLISH</h1>
                <div id="valform">
                    <form method="POST">
                        <div class="form-group">
                            <label for="InputFile">Nama Kamu..</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="InputFile">Filenya..</label>
                            <input type="file" id="InputFile" name="file" required>
                        </div>
                        <div class="form-group">
                            <input id="btnSubmit" type="submit" class="btn btn-primary" value="Upload">
                        </div>                 
                    </form>
                </div>
                </div>
                <div class="col-xs-12">
                    <!-- <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                    </div> -->
                    <div class="progress">
                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Complete</span>
                        </div>
                    </div>
                    <div id="msgok" class="alert alert-success" role="alert" style="display:none;">
                        Berhasil Add, <b>Cek Nama Kamu,</b> kalo sudah ada berarti sudah <b>Berhasil</b> ..<br/>
                        Kamu akan dialihkan dalam <b id="waktuout"></b>
                    </div>
                    <div id="msgerr" class="alert alert-danger" role="alert" style="display:none;">
                        Lahh Kok Error !
                    </div>
                    <div id="trashmsg">
                        
                    </div>
                </div>
    </div>
            <!-- <div class="row">
                <div class="col-xs-6">                
                </div>
            </div> -->
    </div>
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>  

    <script>
    $('form').submit(function(e){
        $("#msgerr").hide()
        e.preventDefault(e);
        $("#btnSubmit").attr("disabled", "disabled")
        if($("input[name='nama']").val() == ""){
                alert("isi Semua!!")
                $("input[name='nama']").focus()
                return
            };
                var formData = new FormData($('form')[0]);
               
                $.ajax({
                    xhr : function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e){
                            var percent = Math.round((e.loaded / e.total) * 100);
                            $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                        });
                        return xhr;
                    },
                    
                    type : 'POST',
                    url : 'upload.php',
                    data : formData,
                    processData : false,
                    contentType : false,
                    success : function(response){
                        $('form')[0].reset();
                        $("#valform").html("")
                        $("#msgok").show()
                        $("#trashmsg").html(response)
                        var no = 7
                        setInterval(function(){
                            $("#waktuout").html(no)
                            if(no == 0){
                                window.location = "../";
                            }
                            no--
                        }, 1000)
                    },
                    error : function(xhr, msg, txt){
                        $("#btnSubmit").removeAttr("disabled")
                        //console.log(response);
                        //$('#InputFile, input[name="nama"]').reset();
                        $('#progressBar').attr('aria-valuenow', 0).css('width', 0 + '%').text(0 + '%');
                        $("#msgerr").show()
                        if(xhr.status == 502){
                            $("#msgerr").text("Isi Dulu itu Form jangan lupa Upload !!")
                        }
                        if(xhr.status == 501){
                            $("#msgerr").text("Ganti nama yang lain, atau kasih angka123 !")
                        }
                        if(xhr.status == 500){
                            $("#msgerr").text("Lahh kok Gagal ?, Coba Upload ulang ! Pastiin Internetmu Kenceng Bruhh..")
                            console.log(xhr)
                            console.log(msg)
                            console.log(txt)
                        }
                    }
                });
    })
    </script>
</body>
</html>