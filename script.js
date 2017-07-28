
(function(){
  // declarations
  var first = document.getElementsByTagName("li")[0];
  var icon = '<i class="fa fa-bars"></i> '
  var current = document.getElementById("open");
  var nav = document.querySelector(".navbar");
  first.className += " active";
  function showNav() {
    // add class
    nav.className += " isOpen";
  }
  function hideNav() {
    // remove class
    var classes = nav.className;
    // check if navbar has class "isOpen"
    if (classes === "navbar isOpen"){
      nav.className = classes.substring(0, classes.length-7);
    }
  }
  function newActive(element) {
    var active = document.querySelector(".active");
    var classes = active.className;
    // remove active class
    active.className = classes.substring(0, classes.length-7);
    // add active class to new element
    element.className += " active";
  }
  function createDiv (title, img, dir) {
    var imgTag;
    //if (img === "ERROR") {
    //  imgTag = '<img class="cover" src="placeholder.jpg" alt="Cover">';
    //} else {
      imgTag = '<img class="cover" src="' + dir + '/' + img + '" alt="Cover"><br>'
    //}

    var div = '<a class="preview" href="' + dir + '/'
    + title + '" target="_blank">'
    + imgTag + title + '</a>';
    return div;
  }
  function reqData(folder, content) {
    $.getJSON("cover_generator.php", "folder="+folder, function(data) {
      console.log(data);
      // paste out filenames
      var titles = data.pdf;
      var pics = data.jpg;
      //compose HTML to show in content
      var preview = "";
       //console.log(pics + " + " + titles)
      titles.forEach(function(title, index) {
        preview += createDiv(title, pics[index], folder);
      });
      content.html(preview);
    });
  }

  current.addEventListener("click", showNav);


  document.querySelectorAll("ul li").forEach(function(li) {
    li.addEventListener('click', function(){
      newActive(this);
      // close navbar
      hideNav();
      var folder = this.innerHTML;
      document.querySelector("#openText").innerHTML = icon + this.innerHTML;
      var content = $(".content");
      // request json with filenames from server
      content.html('<div class="loader"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><br>'
      +'<span>Creating images...</span></div>');
      reqData(folder, content);
    })
  })
reqData("AbookApart", $(".content"));
}());
