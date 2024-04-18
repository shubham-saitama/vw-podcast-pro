section_block_id();

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

function section_block_id(){
  var url_string = window.location;
  var url = new URL(url_string);
  var tab_id = url.searchParams.get("tab");
  if (tab_id == 'gutenberg_import') {

  }
}

  function ImportPremium(themeName, themeurl){
    let url = new URL(window.location.href);
    let search_params = url.searchParams;
    var page_id = search_params.get('page_id');
    if (page_id == null) {
      page_id = 0;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var resp = JSON.parse(this.responseText);
        var postid = resp.msg;
        window.location.href = themeurl +"/wp-admin/post.php?post="+postid+"&action=edit";
      }
    };
    xhttp.open("GET", themeurl+"/index.php/wp-json/vw-podcast-pro/v1/importJson?page_id="+page_id, true);
    //xhttp.send();
  }
