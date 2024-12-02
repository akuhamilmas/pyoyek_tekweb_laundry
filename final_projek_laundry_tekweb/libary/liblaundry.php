<!--sistem nya ajax di tambah.php, ada onchange yang mempasin jenis, maka ketika jenis di piling maka fungsi dari jenis akan di tambahkan
fungsi jenis berada di bawa ini akan mengambil varibel id, variabel id ini berisi data id jenis(kd_jenis)
kemudian setelah menangkap kode jenis akan mengirim ke autofill.php -->
<script>
  // menghitung total bayar
  function sum(){
    var jmlKilo = document.getElementById('jml_kilo').value;
    var tarif = document.getElementById('tarif').value;

    // jml kilo * tarif
    var total = parseInt(jmlKilo)*tarif;

    // memeriksa apakan parameter numerik
    if(!isNaN(total)){
      document.getElementById('totalbayar').value = total;
    }else{
      document.getElementById('totalbayar').value = '';
    }
  }

  function jenis(){
    // mengambil data dari id=id_jenis
    var id = $("#id_jenis").val();

    $.ajax({
      // mengirim data idjenis ke file autofill.php
      url: "page/laundry/autofill.php",
      data: 'idjenis='+id,
      success: function (data){
        var json = data,
        obj = JSON.parse(json);
        // jika sukses mengirim balik
        if (obj.sukses) {
          // auto mengisi data pada id = tarif
          $('#tarif').val(obj.sukses.tarif);
          // auto mengisi data pada id = tgl_selesai
          $('#tgl_selesai').val(obj.sukses.tgl_selesai);
          $('#jml_kilo').val('');
          $('#totalbayar').val('');
        }else if(obj.gagal){
          $('#tarif').val('');
          $('#tgl_selesai').val('');
          $('#jml_kilo').val('');
          $('#totalbayar').val('');
        }
      }
    })
  }
        
</script>