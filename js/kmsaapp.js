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
