
var loadFile = function(event) {
  var file = event.target.files[0];
  if (!file) return;

  var reader = new FileReader();
  reader.onload = function(){
    var output = document.getElementById('preview');
    output.style.display = 'block';
    output.src = reader.result;
  };
  reader.readAsDataURL(file);
};
