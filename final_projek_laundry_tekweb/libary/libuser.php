<!-- script untuk menggunakan webcam 
kenapa webcam ini bisa di akses karema di libary index, ada mintak akses untuk bisa menyalakan kamera-->
<script language="JavaScript">
    Webcam.set({
        width: 470,
        height: 370,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    function ambilgambar() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>