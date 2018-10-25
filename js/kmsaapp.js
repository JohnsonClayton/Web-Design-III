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

function accessDatabase(type, script, ...args) {
  var prepared = script;
  var returnMe = null;
  if (args.length > 0) prepared += "?";
  for (var arg of args) {
    prepared += arg + "&";
  }
  prepared = prepared.slice(0, prepared.length - 1);
  //alert(prepared);
  if(window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  }
  else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.open(type, prepared, false);
  xmlhttp.send();
  if(xmlhttp.status == 200) {
    return Number(xmlhttp.responseText);
  }
}

function getPlaylistSongVotes(name, artist) {
  var response = null;
  response = accessDatabase("GET", "getPlaylistSongInfo.php","name='"+name+"'", "artist='"+artist+"'")
  return response;
}

function setPlaylistSongVotes(name, artist, votes) {
  //alert("Time to set the new vote values!");
  if(window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  }
  else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange = function() {
    if(this.readyState == 4 && this.status ==200) {
    }
  };
  var cmd = "vote.php?name='"+name+"'&artist='"+artist+"'&votes="+votes;
  xmlhttp.open("GET", cmd, true);
  xmlhttp.send();
}

function addToServerVotes(name, artist, changeInVotes) {
  //alert("change in votes = " + changeInVotes);
  var currentVotes = getPlaylistSongVotes(name, artist);
  
  setPlaylistSongVotes(name, artist, currentVotes + changeInVotes);
}

function voteUp(buttonObject) {
  buttonObject.parentNode.parentNode.getElementsByTagName('td')[2].innerHTML = Number(buttonObject.parentNode.parentNode.getElementsByTagName('td')[2].innerHTML) + 1;
  if(!buttonObject.parentNode.parentNode.getElementsByTagName('td')[3].getElementsByTagName('button')[1].disabled) {
    buttonObject.disabled = true;
    buttonObject.parentNode.parentNode.getElementsByTagName('td')[3].getElementsByTagName('button')[1].disabled = false;
  }
  else {
    buttonObject.parentNode.parentNode.getElementsByTagName('td')[3].getElementsByTagName('button')[1].disabled = false;
  }
  //Add one to the server
  var name = buttonObject.parentNode.parentNode.getElementsByTagName('td')[0].innerHTML;
  var artist = buttonObject.parentNode.parentNode.getElementsByTagName('td')[1].innerHTML;
  //alert(name + " " + artist);
  addToServerVotes(name, artist, 1);
}

function voteDown(buttonObject) {

  buttonObject.parentNode.parentNode.getElementsByTagName('td')[2].innerHTML = Number(buttonObject.parentNode.parentNode.getElementsByTagName('td')[2].innerHTML) - 1;
  if(!buttonObject.parentNode.parentNode.getElementsByTagName('td')[3].getElementsByTagName('button')[0].disabled) {
    buttonObject.disabled = true;
    buttonObject.parentNode.parentNode.getElementsByTagName('td')[3].getElementsByTagName('button')[0].disabled = false;
  }
  else {
    buttonObject.parentNode.parentNode.getElementsByTagName('td')[3].getElementsByTagName('button')[0].disabled = false;
  }
  //Subtract one from server
  var name = buttonObject.parentNode.parentNode.getElementsByTagName('td')[0].innerHTML;
  var artist = buttonObject.parentNode.parentNode.getElementsByTagName('td')[1].innerHTML;
  //alert(name +" " + artist);
  addToServerVotes(name, artist, -1);
}

function announceEvent(rowNum = -1) {
  parsedStrings = parseRow(rowNum);
  song = parsedStrings[0];
  artist = parsedStrings[1];
  album = parsedStrings[2];
  
  updatePlaylist(song, artist, album);  
}

function parseTableRow(inputRow) {

  var newRow = "";
  var counter = 0;
  for(var i = 0; i < inputRow.length; i++) {
    if(inputRow[i] == '>')
      counter++;
    if(counter < 5)
      newRow+=inputRow[i];
  }
  newRow += "><td>0</td><td><button id='upButton' style='display:inline-block;' onClick='voteUp(this);'>Up</button><button id='downButton' style='display:inline-block;' onClick='voteDown(this);'>Down</button></td></tr>";

  return newRow;
}

function addSongToPlaylistAJAX(song="", artist="", album="",length="") {
  if(window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  }
  else {
    xmlhttp = new ctiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200) {
      //alert("Song added!");
    }
  };
  xmlhttp.open("GET", "updatePlaylistDB.php?song="+song+"&artist="+artist+"&album="+album+"&length="+length, true);
  xmlhttp.send(); 
}

function addSongToPlaylistDB(row) {
  parsedList = ["","","","","","","","",""];
  parsedString = "";
  inHTML = false;
  imported = 0;
  //alert(row);
  for(var i = 0; i < row.length && imported < 9; i++) {
    if(row[i] == '<') {
      inHTML = true;
    }
    else if (!inHTML) {
      parsedString += row[i];
    }
    else if(row[i] == '>') {
      parsedList[imported] = parsedString;
      parsedString = "";
      inHTML = false;
      imported++;
    } 
  } 
  //alert(parsedList[2] + parsedList[4] + parsedList[6] + parsedList[8]);
  addSongToPlaylistAJAX(parsedList[2], parsedList[4], parsedList[6], parsedList[8]);
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
      //Give this response to a PDO to add to the playlist
      addSongToPlaylistDB(this.responseText);
      var parsedTableRow = parseTableRow(this.responseText);
      document.getElementById('playlistContainer').innerHTML =  document.getElementById('playlistContainer').innerHTML + parsedTableRow;
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
  
  return [parsedList[1], parsedList[3], parsedList[5]];
}
