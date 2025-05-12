// var loadFile = function(event) {
//     var reader = new FileReader();
//     reader.onload = function(){
//       var output = document.getElementById('preview');
//       output.src = reader.result;
//     };
//     reader.readAsDataURL(event.target.files[0]);
//   };
var loadFile = function(event) {
  var file = event.target.files[0];
  if (!file) return; // Se o usuário cancelou, não faz nada.

  var reader = new FileReader();
  reader.onload = function(){
    var output = document.getElementById('preview');
    output.src = reader.result;
  };
  reader.readAsDataURL(file);
};
