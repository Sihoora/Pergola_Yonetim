
$(document).ready(function () {
  $("#file-input").fileinput({
    theme: 'fa',
    allowedFileExtensions: ['jpg', 'png', 'gif'],
    overwriteInitial: false,
    maxFileSize: 2000,
    maxFilesNum: 10,
    slugCallback: function (filename) {
      return filename.replace('(', '_').replace(']', '_');
    }
  });

  // View mode handling
  if ($('form').hasClass('view-mode')) {
    $('input, select, textarea').attr('disabled', 'disabled');
  }
});


function getDynamicInputs(selectedValue, data = null) {
  var dynamicInputs = document.getElementById("dynamicInputs");
  dynamicInputs.innerHTML = "";




  if (selectedValue === "Pergola Avantgarde") {
    dynamicInputs.innerHTML = `
        <div class="form-group">
          <label for="RalKodu">Ral Kodu</label>
    <input list="RalKoduOptions" id="RalKodu" name="ral_kodu" value="${data ? data.ral_kodu : ''}" placeholder="Enter ...">
    <datalist id="RalKoduOptions">
        <option value="09418 07016">
        <option value="09418 05005">
        <option value="09418 09017">
        <option value="09418 9006">
        <option value="09418 08017">
        <option value="09418 05001">
    </datalist>
        </div>

                <div class="form-group">
          <label for="RalKodu">Kumaş Cinsi</label>
    <input list="KumasCinsiOptions" id="KumasCinsi" name="kumas_cinsi" value="${data ? data.kumas_cinsi : ''}" placeholder="Enter ...">
    <datalist id="KumasCinsiOptions">
        <option value="Düz Beyaz">
        <option value="Düz Krem">
        <option value="Düz Gri">
        <option value="3D Boya">
        <option value="3D Krem">
        <option value="Açık Gri">
    </datalist>
        </div>



         <div class="form-group">
          <label for="kumas_profil_ral">Kumaş Profil Ral</label>
    <input list="KumasProfilRalOptions" id="KumasProfilRal" name="kumas_profil_ral" value="${data ? data.kumas_profil_ral : ''}" placeholder="Enter ...">
    <datalist id="KumasProfilRalOptions">
        <option value="Krem">
        <option value="Gri">
        <option value="Beyaz">
    </datalist>
        </div>
        
                 <div class="form-group">
          <label for="led_model">Led Model</label>
    <input list="LedModelOptions" id="LedModel" name="led_model" value="${data ? data.led_model : ''}" placeholder="Enter ...">
    <datalist id="LedModelOptions">
        <option value="Gizli Led 2700K">
        <option value="Profil Üstü Led 2700K">
    </datalist>
        </div>


         <div class="form-group">
          <label for="motor_model">Motor Model</label>
    <input list="MotorModelOptions" id="MotorModel" name="motor_model" value="${data ? data.motor_model : ''}" placeholder="Enter ...">
    <datalist id="MotorModelOptions">
        <option value="Somfy 85 / 17 RTS">
        <option value="Somfy 85 / 17 10">
    </datalist>
        </div>


                 <div class="form-group">
          <label for="kumanda">Kumanda</label>
    <input list="KumandaOptions" id="Kumanda" name="kumanda" value="${data ? data.kumanda : ''}" placeholder="Enter ...">
    <datalist id="KumandaOptions">
        <option value="Telis 4 RTS">
        <option value="Telis 16 RTS">
        <option value="Stuio 5 İo">
        <option value="Stuio 16 İo">
    </datalist>
        </div>


                 <div class="form-group">
          <label for="flans">Flanş</label>
    <input list="FlansOptions" id="Flans" name="flans" value="${data ? data.flans : ''}" placeholder="Enter ...">
    <datalist id="FlansOptions">
        <option value="Boru Giderli Flanş">
        <option value="Kare Giderli Flanş">
        <option value="Paslanmaz Flanş">
    </datalist>
        </div>


                 <div class="form-group">
          <label for="arka_celik">Arka Çelik</label>
    <input list="ArkaÇelikOptions" id="ArkaÇelik" name="arka_celik" value="${data ? data.arka_celik : ''}" placeholder="Enter ...">
    <datalist id="ArkaÇelikOptions">
        <option value="50 x 150 Demir">
        <option value="100 x 100 Demir">
        <option value="120 x 120 Demir">
    </datalist>
        </div>

      `;
  } else if (selectedValue === "Pergola Elegant") {
    dynamicInputs.innerHTML = `
               <div class="form-group">
          <label for="RalKodu">Ral Kodu</label>
    <input list="RalKoduOptions" id="RalKodu" name="ral_kodu" value="${data ? data.ral_kodu : ''}" placeholder="Enter ...">
    <datalist id="RalKoduOptions">
        <option value="09418 07016">
        <option value="09418 05005">
        <option value="09418 09017">
        <option value="09418 9006">
        <option value="09418 08017">
        <option value="09418 05001">
    </datalist>
        </div>

                <div class="form-group">
          <label for="RalKodu">Kumaş Cinsi</label>
    <input list="KumasCinsiOptions" id="KumasCinsi" name="kumas_cinsi" value="${data ? data.kumas_cinsi : ''}" placeholder="Enter ...">
    <datalist id="KumasCinsiOptions">
        <option value="Düz Beyaz">
        <option value="Düz Krem">
        <option value="Düz Gri">
        <option value="3D Boya">
        <option value="3D Krem">
        <option value="Açık Gri">
    </datalist>
        </div>



         <div class="form-group">
          <label for="kumas_profil_ral">Kumaş Profil Ral</label>
    <input list="KumasProfilRalOptions" id="KumasProfilRal" name="kumas_profil_ral" value="${data ? data.kumas_profil_ral : ''}" placeholder="Enter ...">
    <datalist id="KumasProfilRalOptions">
        <option value="Krem">
        <option value="Gri">
        <option value="Beyaz">
    </datalist>
        </div>
        
                 <div class="form-group">
          <label for="led_model">Led Model</label>
    <input list="LedModelOptions" id="LedModel" name="led_model" value="${data ? data.led_model : ''}" placeholder="Enter ...">
    <datalist id="LedModelOptions">
        <option value="Gizli Led 2700K">
        <option value="Profil Üstü Led 2700K">
    </datalist>
        </div>


         <div class="form-group">
          <label for="motor_model">Motor Model</label>
    <input list="MotorModelOptions" id="MotorModel" name="motor_model" value="${data ? data.motor_model : ''}" placeholder="Enter ...">
    <datalist id="MotorModelOptions">
        <option value="Gizli Led 2700K">
        <option value="Profil Üstü Led 2700K">
    </datalist>
        </div>


                 <div class="form-group">
          <label for="kumanda">Kumanda</label>
    <input list="KumandaOptions" id="Kumanda" name="kumanda" value="${data ? data.kumanda : ''}" placeholder="Enter ...">
    <datalist id="KumandaOptions">
        <option value="Telis 4 RTS">
        <option value="Telis 16 RTS">
        <option value="Stuio 5 İo">
        <option value="Stuio 16 İo">
    </datalist>
        </div>


                 <div class="form-group">
          <label for="flans">Flanş</label>
    <input list="FlansOptions" id="Flans" name="flans" value="${data ? data.flans : ''}" placeholder="Enter ...">
    <datalist id="FlansOptions">
        <option value="Boru Giderli Flanş">
        <option value="Kare Giderli Flanş">
        <option value="Paslanmaz Flanş">
    </datalist>
        </div>


                 <div class="form-group">
          <label for="arka_celik">Arka Çelik</label>
    <input list="ArkaÇelikOptions" id="ArkaÇelik" name="arka_celik" value="${data ? data.arka_celik : ''}" placeholder="Enter ...">
    <datalist id="ArkaÇelikOptions">
        <option value="50 x 150 Demir">
        <option value="100 x 100 Demir">
        <option value="120 x 120 Demir">
    </datalist>
        </div>
    
      `;
  }

  else if (selectedValue === "0") {
    dynamicInputs.innerHTML = `

      `;
  }
  // Add more conditions for other options

}