
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
        <label for="RalKodu">En</label>
        <input list="RalKoduOptions" id="en" name="en" value="${data ? data.en : ''}" class="form-control" placeholder=" En...">
        <datalist id="RalKoduOptions">
        </datalist>
        </div>

         <div class="form-group" style="">
        <label for="RalKodu">Boy</label>
        <input list="RalKoduOptions" id="boy" name="boy" value="${data ? data.boy : ''}" class="form-control" placeholder=" Boy...">
        <datalist id="RalKoduOptions">
        </datalist>
        </div>

      <div class="form-group">
        <label for="RalKodu">Ral Kodu</label>
        <input list="RalKoduOptions" id="RalKodu" name="ral_kodu" value="${data ? data.ral_kodu : ''}" class="form-control" placeholder=" Ral Kodu...">
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
        <label for="KumasCinsi">Kumaş Cinsi</label>
        <input list="KumasCinsiOptions" id="KumasCinsi" name="kumas_cinsi" value="${data ? data.kumas_cinsi : ''}" class="form-control" placeholder=" Kumaş Cinsi...">
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
        <label for="KumasProfilRal">Kumaş Profil Ral</label>
        <input list="KumasProfilRalOptions" id="KumasProfilRal" name="kumas_profil_ral" value="${data ? data.kumas_profil_ral : ''}" class="form-control" placeholder=" Kumaş Profil Ral...">
        <datalist id="KumasProfilRalOptions">
          <option value="Krem">
          <option value="Gri">
          <option value="Beyaz">
        </datalist>
      </div>

      <div class="form-group">
        <label for="LedModel">Led Model</label>
        <input list="LedModelOptions" id="LedModel" name="led_model" value="${data ? data.led_model : ''}" class="form-control" placeholder=" Led Model...">
        <datalist id="LedModelOptions">
          <option value="Gizli Led 2700K">
          <option value="Profil Üstü Led 2700K">
        </datalist>
      </div>

      <div class="form-group">
        <label for="MotorModel">Motor Model</label>
        <input list="MotorModelOptions" id="MotorModel" name="motor_model" value="${data ? data.motor_model : ''}" class="form-control" placeholder=" Motor Model...">
        <datalist id="MotorModelOptions">
          <option value="Somfy 85 / 17 RTS">
          <option value="Somfy 85 / 17 10">
        </datalist>
      </div>

      <div class="form-group">
        <label for="Kumanda">Kumanda</label>
        <input list="KumandaOptions" id="Kumanda" name="kumanda" value="${data ? data.kumanda : ''}" class="form-control" placeholder=" Kumanda...">
        <datalist id="KumandaOptions">
          <option value="Telis 4 RTS">
          <option value="Telis 16 RTS">
          <option value="Stuio 5 İo">
          <option value="Stuio 16 İo">
        </datalist>
      </div>

      <div class="form-group">
        <label for="Flans">Flanş</label>
        <input list="FlansOptions" id="Flans" name="flans" value="${data ? data.flans : ''}" class="form-control" placeholder=" Flanş...">
        <datalist id="FlansOptions">
          <option value="Boru Giderli Flanş">
          <option value="Kare Giderli Flanş">
          <option value="Paslanmaz Flanş">
        </datalist>
      </div>

      <div class="form-group">
        <label for="ArkaÇelik">Arka Çelik</label>
        <input list="ArkaÇelikOptions" id="ArkaÇelik" name="arka_celik" value="${data ? data.arka_celik : ''}" class="form-control" placeholder=" Arka Çelik...">
        <datalist id="ArkaÇelikOptions">
          <option value="50 x 150 Demir">
          <option value="100 x 100 Demir">
          <option value="120 x 120 Demir">
        </datalist>
      </div>
    `;


  } else if (selectedValue === "Pergola Elegant") {
    dynamicInputs.innerHTML = `
     <div class="form-row">
        <div class="form-group col-md-6">
          <label for="en">En</label>
          <input type="text" class="form-control" id="en" name="en" value="${data ? data.en : ''}" placeholder=" En...">
        </div>
        <div class="form-group col-md-6">
          <label for="boy">Boy</label>
          <input type="text" class="form-control" id="boy" name="boy" value="${data ? data.boy : ''}" placeholder=" Boy...">
        </div>
      </div>

      <div class="form-group">
        <label for="RalKodu">Ral Kodu</label>
        <input list="RalKoduOptions" id="RalKodu" name="ral_kodu" value="${data ? data.ral_kodu : ''}" class="form-control" placeholder=" Ral Kodu...">
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
        <label for="KumasCinsi">Kumaş Cinsi</label>
        <input list="KumasCinsiOptions" id="KumasCinsi" name="kumas_cinsi" value="${data ? data.kumas_cinsi : ''}" class="form-control" placeholder=" Kumaş Cinsi...">
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
        <label for="KumasProfilRal">Kumaş Profil Ral</label>
        <input list="KumasProfilRalOptions" id="KumasProfilRal" name="kumas_profil_ral" value="${data ? data.kumas_profil_ral : ''}" class="form-control" placeholder=" Kumaş Profil Ral...">
        <datalist id="KumasProfilRalOptions">
          <option value="Krem">
          <option value="Gri">
          <option value="Beyaz">
        </datalist>
      </div>

      <div class="form-group">
        <label for="LedModel">Led Model</label>
        <input list="LedModelOptions" id="LedModel" name="led_model" value="${data ? data.led_model : ''}" class="form-control" placeholder=" Led Model...">
        <datalist id="LedModelOptions">
          <option value="Gizli Led 2700K">
          <option value="Profil Üstü Led 2700K">
        </datalist>
      </div>

      <div class="form-group">
        <label for="MotorModel">Motor Model</label>
        <input list="MotorModelOptions" id="MotorModel" name="motor_model" value="${data ? data.motor_model : ''}" class="form-control" placeholder=" Motor Model...">
        <datalist id="MotorModelOptions">
          <option value="Somfy 85 / 17 RTS">
          <option value="Somfy 85 / 17 10">
        </datalist>
      </div>

      <div class="form-group">
        <label for="Kumanda">Kumanda</label>
        <input list="KumandaOptions" id="Kumanda" name="kumanda" value="${data ? data.kumanda : ''}" class="form-control" placeholder=" Kumanda...">
        <datalist id="KumandaOptions">
          <option value="Telis 4 RTS">
          <option value="Telis 16 RTS">
          <option value="Stuio 5 İo">
          <option value="Stuio 16 İo">
        </datalist>
      </div>

      <div class="form-group">
        <label for="Flans">Flanş</label>
        <input list="FlansOptions" id="Flans" name="flans" value="${data ? data.flans : ''}" class="form-control" placeholder=" Flanş...">
        <datalist id="FlansOptions">
          <option value="Boru Giderli Flanş">
          <option value="Kare Giderli Flanş">
          <option value="Paslanmaz Flanş">
        </datalist>
      </div>

      <div class="form-group">
        <label for="ArkaÇelik">Arka Çelik</label>
        <input list="ArkaÇelikOptions" id="ArkaÇelik" name="arka_celik" value="${data ? data.arka_celik : ''}" class="form-control" placeholder=" Arka Çelik...">
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