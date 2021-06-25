function modalInsertRecord() {
  var insertRecord = document.getElementById("insertRecord");
  var btn = document.getElementById("insert");
  var span = document.getElementsByClassName("close")[0];
  
  btn.onclick = function() {
    insertRecord.style.display = "block";
  }
  
  span.onclick = function() {
    insertRecord.style.display = "none";
  }
  
  window.onclick = function(event) {
    if (event.target == insertRecord) {
      insertRecord.style.display = "none";
    }
  }
}
  
function modalUpdateRecord() {
  var updateRecord = document.getElementById("updateRecord");
  var btn = document.getElementById("update");
  var span = document.getElementsByClassName("close")[1];
  
  btn.onclick = function() {
    updateRecord.style.display = "block";
  }
  
  span.onclick = function() {
    updateRecord.style.display = "none";
  }
  
  window.onclick = function(event) {
    if (event.target == updateRecord) {
      updateRecord.style.display = "none";
    }
  }
}

function modalDeleteRecord() {
  var deleteRecord = document.getElementById("deleteRecord");
  var btn = document.getElementById("delete");
  var span = document.getElementsByClassName("close")[2];
  
  btn.onclick = function() {
    deleteRecord.style.display = "block";
  }
  
  span.onclick = function() {
    deleteRecord.style.display = "none";
  }
  
  window.onclick = function(event) {
    if (event.target == deleteRecord) {
      deleteRecord.style.display = "none";
    }
  }
}

modalInsertRecord();
modalUpdateRecord();
modalDeleteRecord();