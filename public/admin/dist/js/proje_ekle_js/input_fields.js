function getDynamicInputs(selectedValue, data = null) {
  var dynamicInputs = document.getElementById("dynamicInputs");
  dynamicInputs.innerHTML = "";

    if (selectedValue === "Pergola Avantgarde") {
      dynamicInputs.innerHTML = `
        <div class="form-group">
          <label>Ral Kodu</label>
          <input type="text" name="ral_kodu" class="form-control" value="${data ? data.ral_kodu : ''}" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Kumaş Cinsi</label>
          <input type="text" name="kumas_cinsi" class="form-control" value="${data ? data.kumas_cinsi : ''}" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Kumaş Profil Ral</label>
          <input type="text" name="kumas_profil_ral" class="form-control" value="${data ? data.kumas_profil_ral : ''}" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Led Model</label>
          <input type="text" name="led_model" class="form-control" value="${data ? data.led_model : ''}" placeholder="Enter ...">
        </div>
      `;
    } else if (selectedValue === "Pergola Elegant") {
      dynamicInputs.innerHTML = `
      <div class="form-group">
          <label>Ral Kodu</label>
          <input type="text" name="ral_kodu" class="form-control" value="${data ? data.ral_kodu : ''}" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Kumaş Cinsi</label>
          <input type="text" name="kumas_cinsi" class="form-control" value="${data ? data.kumas_cinsi : ''}" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Kumaş Profil Ral</label>
          <input type="text" name="kumas_profil_ral" class="form-control" value="${data ? data.kumas_profil_ral : ''}" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Led Model</label>
          <input type="text" name="led_model" class="form-control" value="${data ? data.led_model : ''}" placeholder="Enter ...">
        </div>
      `;
    } else if (selectedValue === "Pergola Classic") {
      dynamicInputs.innerHTML = `
      <div class="form-group">
      <label>Ral Kodu</label>
      <input type="text" name="ral_kodu" class="form-control" value="${data ? data.ral_kodu : ''}" placeholder="Enter ...">
    </div>
    <div class="form-group">
      <label>Kumaş Cinsi</label>
      <input type="text" name="kumas_cinsi" class="form-control" value="${data ? data.kumas_cinsi : ''}" placeholder="Enter ...">
    </div>
    <div class="form-group">
      <label>Kumaş Profil Ral</label>
      <input type="text" name="kumas_profil_ral" class="form-control" value="${data ? data.kumas_profil_ral : ''}" placeholder="Enter ...">
    </div>
    <div class="form-group">
      <label>Led Model</label>
      <input type="text" name="led_model" class="form-control" value="${data ? data.led_model : ''}" placeholder="Enter ...">
    </div>
      `;
    }

    else if (selectedValue === "0") {
      dynamicInputs.innerHTML = `

      `;
    }
    // Add more conditions for other options

  }