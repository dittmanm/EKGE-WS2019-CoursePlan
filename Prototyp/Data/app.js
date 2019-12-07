function clearAll (e) {
  e.preventDefault();
  closeAllDivs();
  deleteActiv();
  console.log('clearAll');
}
function closeAllDivs () {
  $('.section .math-group').hide();
  $('.section .german-group').hide();
  $('.section .english-group').hide();
  $('.section .other-group').hide();
  console.log('closeAllDivs');
}
function deleteActiv () {
  $('.section .activ').removeClass('activ');
  console.log('deleteActiv');
}

$(document).ready(function(){
  $('.section a.math').bind('click', function(e) {
    clearAll(e);
    console.log('a.math');
    $('.section .math-group').show();
    $('.section a.math').addClass('activ');
  });
  $('.section a.german').bind('click', function(e) {
    clearAll(e);
    console.log('a.german');    
    $('.section .german-group').show();
    $('.section a.german').addClass('activ');
  });
  $('.section a.english').bind('click', function(e) {
    clearAll(e);
    console.log('a.english');
    $('.section .english-group').show();
    $('.section a.english').addClass('activ');
  });
  $('.section a.other').bind('click', function(e) {
    clearAll(e);
    console.log('a.other');
    $('.section .other-group').show();
    $('.section a.other').addClass('activ');
  });
});
