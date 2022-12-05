if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href )
}
submitForms = function(){
  document.getElementById("form1").submit();
  document.getElementById("form2").submit();
}
