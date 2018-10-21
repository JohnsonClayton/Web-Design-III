function updateSearchTable() {
  var query = document.getElementById('searchQuery').value;

  if(window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  }
  else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200) {
      document.getElementById('searchQueryResults').innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "getSearchQuery.php?q="+query, true);
  xmlhttp.send();  
}

document.onkeydown = function (e) {
  switch(e.which || e.keyCode) {
    case 13:
      document.getElementById('searchQuerySubmit').click();
      break;
  }
}

function announceEvent(rowNum = -1) {
  alert(parseRow(rowNum));
}

function parseRow(row) {
  parsedString = "";
  inHTML = false;
  imported = 0;
  for(var i=0; i < row.length && imported < 6; i++) {
    if(row[i] == '<') {
      inHTML = true;
    }
    else if(!inHTML) {
      parsedString += row[i];
    }
    else if(row[i] == '>') {
      parsedString += ' ';
      inHTML = false;
      imported++;
    }
  }
  

  return parsedString;
}
