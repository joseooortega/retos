/*
Por hacer:

  - No script message.
  - Diferentes tipos de input.
  - Pillar mensajes traducidos desde php.

*/


var forms = [];
var forms_html = [];

$(document).ready(function(){

  get_forms();
  submit_form();
  focus_out_input();
  keyup_input();

});


function get_forms(){
  $('form').each(function(){
    var elem = $(this).clone();
    var form = [];
    form['id'] = elem.attr('id');
    form['validation'] = elem.attr('class').indexOf('validation') == -1 ? false : true;
    form['action'] = elem.attr('action');
    elem.attr('action', '');
    forms.push(form);
    forms_html.push(elem);
  });
}
function validate_input(elem, this_form = false){

  var val = elem.val();
  var name = elem.attr('name');
  var required = elem.hasAttr('class') == true ? (elem.attr('class').indexOf('required') == -1 ? false : true) : false;
  var max_lenght = elem.hasAttr('maxlength') == true ? elem.attr('maxlength') : false;
  var min_lenght = elem.hasAttr('minlength') == true ? elem.attr('minlength') : false;
  var clear = true;


  if (this_form !== false){
    var max_lenght = this_form.find('input[name="'+name+'"]').hasAttr('maxlength') == true ? this_form.find('input[name="'+name+'"]').attr('maxlength') : false;
    var min_lenght = this_form.find('input[name="'+name+'"]').hasAttr('minlength') == true ? this_form.find('input[name="'+name+'"]').attr('minlength') : false;
  }

  if (required && val.length == 0){
    message_form(elem, 'Este campo es obligatorio', false);
    return false;
  }

  var regex = [];
  var message = [];

  if (max_lenght !== false)
    check_max_lenght(regex, message, max_lenght);
  if (min_lenght !== false)
    check_min_lenght(regex, message, min_lenght);


  switch (elem.attr('type')) {
    case 'text':
      regex.push(new RegExp('^[A-Za-z0-9]{'+val.length+'}$'));
      message.push('Caracteres no válidos!!');
      break;
    case 'email':
      regex.push(new RegExp('^.+@.+[.].+'));
      message.push('Email no válido, tiene que ser del tipo "algo@algo.algo"');
      break;
    case 'password':
      var rx = [
        new RegExp('(?=.*[A-Z]+)'),
        new RegExp('(?=.*[a-z]+)'),
        new RegExp('(?=.*[0-9]+)'),
        new RegExp('(?=.*[!@#$&()=%*]+)'),
        new RegExp('^.{0,12}$'),
      ];
      var msg = [
        'Tiene que tener al menos una letra <b>mayúscula</b>',
        'Tiene que tener al menos una letra <b>minúscula</b>',
        'Tiene que tener al menos un <b>número</b>',
        'Tiene que tener al menos un caracter <b>especial</b>',
        'Como máximo puede tener 12 caracteres',
      ];
      regex = regex.concat(rx);
      message = message.concat(msg);
      break;
    default:
      e.preventDefault();
  }

  for (var i=0;i<regex.length; i++) {
    if (!regex[i].test(val)){
      clear = false;
      message_form(elem, message[i], clear);
    }
  }

  if (clear) message_form(elem, '', clear);

  return clear;

}
function validation_form(id, e) {

  $('#'+id).find('input:not([type="submit"])').each(function(){

    var name = $(this).attr('name');
    var this_form = get_form(id);


    if (this_form === false || this_form.find('input[name="'+name+'"]').length == 0){
      e.preventDefault();
      message_form($(this), 'Ha ocurrido un error, actualiza y vuelve a intentarlo por favor', false);
      return false;
    }

    var check = validate_input($(this), this_form);
    if (check === false){
      $(this).addClass('invalid');
      e.preventDefault()
    }else{
      $(this).addClass('valid');
    }
  });
}

function check_min_lenght(regex, message, min_lenght){
  var parte1 = '^[A-Za-z0-9]{';
  var parte2 = ',}$';
  regex.push(new RegExp(parte1+min_lenght+parte2));
  message.push('Como mínimo debe haber '+min_lenght+' caracter(es)');
}
function check_max_lenght(regex, message, max_lenght){
  var parte1 = '^[A-Za-z0-9]{0,';
  var parte2 = '}$';
  regex.push(new RegExp(parte1+max_lenght+parte2));
  message.push('Como máximo puede haber '+max_lenght+' caracter(es)');
}
function keyup_input(){
  $('form input').not('[type="submit"]').keyup(function(e){

    if (e.keyCode == 9)
      return false;


    $(this).removeClass('valid invalid');

    if ($(this).next().hasAttr('class') == true && $(this).next().attr('class').indexOf('message_input_form') != -1){
      $(this).next().empty();
    }
    var this_form = get_form($(this).closest('form').attr('id'));
    var check = validate_input($(this), this_form);

    if (check == true){
      $(this).addClass('valid');
    }else{
      $(this).addClass('invalid');
    }
  });
}
function focus_out_input(){
  $('form input').not('[type="submit"]').focusout(function(e){

    if ($(this).next().hasAttr('class') == true && $(this).next().attr('class').indexOf('message_input_form') != -1){
      $(this).next().empty();
    }
    var this_form = get_form($(this).closest('form').attr('id'));
    var check = validate_input($(this), this_form);

    if (check == true){
      $(this).addClass('valid');
    }else{
      $(this).addClass('invalid');
    }
  });
}
function submit_form(){
  $('form input[type="submit"]').click(function(e){

    $(this).closest('form').find('.message_input_form').empty();
    var prevent = true;
    var id = $(this).closest('form').attr('id');

    for (var i=0;i<forms.length;i++) {
      if (id == forms[i]['id'] && $('#'+forms[i]['id']).length){
        prevent = false;
        if (forms[i]['validation']){
          validation_form(forms[i]['id'], e);
        }
      }
    }

    if (prevent) e.preventDefault();
  });
}

function get_form(id){

  for (var i=0;i<forms_html.length;i++) {
    if (forms_html[i].attr('id') == id){
      return forms_html[i];
    }
  }
  return false;
}

function message_form(element, message, clear){

  message = '<p>'+message+'</p>';
  var index =element.next().hasAttr('class') == true ? element.next().attr('class').indexOf('message_input_form') : -1;

  if (index == -1){
    if (!clear)
    element.after('<div class="message_input_form">'+message+'</div>');
  }else{
    if (clear){
      element.next().empty();
    }else{
      element.next().html(element.next().html() + message);
    }
  }
}












/**/
