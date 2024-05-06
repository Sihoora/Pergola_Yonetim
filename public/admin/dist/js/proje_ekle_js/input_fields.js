function getDynamicInputs(selectedValue) {
    var dynamicInputs = document.getElementById("dynamicInputs");
    dynamicInputs.innerHTML = "";

    if (selectedValue === "Pergola Avantgarde") {
      dynamicInputs.innerHTML = `
        <div class="form-group">
          <label>Avantgarde Input 1</label>
          <input type="text" name="avantgarde_input_1" class="form-control" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Avantgarde Input 2</label>
          <input type="text" name="avantgarde_input_2" class="form-control" placeholder="Enter ...">
        </div>
      `;
    } else if (selectedValue === "Pergola Elegant") {
      dynamicInputs.innerHTML = `
        <div class="form-group">
          <label>Elegant Input 1</label>
          <input type="text" name="elegant_input_1" class="form-control" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Elegant Input 2</label>
          <input type="text" name="elegant_input_2" class="form-control" placeholder="Enter ...">
        </div>
      `;
    } else if (selectedValue === "Pergola Classic") {
      dynamicInputs.innerHTML = `
        <div class="form-group">
          <label>Classic Input 1</label>
          <input type="text" name="classic_input_1" class="form-control" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Classic Input 2</label>
          <input type="text" name="classic_input_2" class="form-control" placeholder="Enter ...">
        </div>
      `;
    }
    // Add more conditions for other options

  }