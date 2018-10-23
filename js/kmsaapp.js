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
  parsedStrings = parseRow(rowNum);
  song = parsedStrings[0];
  artist = parsedStrings[1];
  album = parsedStrings[2];
  
  updatePlaylist(song, artist, album);  
}

function updatePlaylist(song="", artist="", album="") {
  if(window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  }
  else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200) {
      //document.getElementById('searchQueryResults').innerHTML = this.responseText;
      //Update playlist display
      document.getElementById('playlistContainer').innerHTML = document.getElementById('playlistContainer').innerHTML + this.responseText;
    }
  };
  xmlhttp.open("GET", "updatePlaylist.php?song="+song+"&artist="+artist+"&album="+album, true);
  xmlhttp.send();  
}

document.onkeydown = function (e) {
  switch(e.which || e.keyCode) {
    case 13:
      document.getElementById('searchQuerySubmit').click();
      break;
  }
}

function parseRow(row) {
  parsedList = ["", "", "","","",""];
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
      parsedList[imported] = parsedString;
      parsedString = "";
      inHTML = false;
      imported++;
    }
  }
  
  //alert(parsedList[0]);
  //alert(parsedList[1]);
  //alert(parsedList[2]);
  //alert(parsedList[3]);
  //alert(parsedList[4]);
  //alert(parsedList[5]);
  return [parsedList[1], parsedList[3], parsedList[5]];
}
