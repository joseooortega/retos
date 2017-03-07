/*
Por hacer:

  - No script message.
  - Diferentes tipos de input.
  - Pillar mensajes traducidos desde php.
  -

*/

var forms = [];
var forms_html = [];

$(document).ready(function(){

  //get_forms();
  //submit_form();

  var form_prueba = $('#new_user')[0];
  $('footer .container').click(function(){
    form_prueba = $('<div/>').html(form_prueba).contents();
    console.log(form_prueba);
  });

});


function get_forms(){
  $('form').each(function(){
    var form = [];
    form['id'] = $(this).attr('id');
    form['validation'] = $(this).attr('class').indexOf('validation') == -1 ? false : true;
    form['action'] = $(this).attr('action');
    $(this).attr('action', '');
    forms.push(form);
    forms_html.push($(this));
  });
}

function validation_form(id, e) {
  //e.preventDefault();
  $('#'+id).find('input:not([type="submit"])').each(function(){

    var name = $(this).attr('name');

    if (name == 'nombre') {
      var this_form = get_form(id);


      if (this_form.find('input[name="'+name+'"]').length == 0){
        e.preventDefault();
        return false;
      }

      var val = $(this).val();
      var required = $(this).hasAttr('class') == true ? ($(this).attr('class').indexOf('required') == -1 ? false : true) : false;
      var max_lenght = this_form.find('input[name="'+name+'"]').hasAttr('maxlength') == true ? this_form.find('input[name="'+name+'"]').attr('maxlength') : false;
      var min_lenght = this_form.find('input[name="'+name+'"]').hasAttr('minlength') == true ? this_form.find('input[name="'+name+'"]').attr('minlength') : -1;
      var clear = true;

      var regex = /^/;

      switch ($(this).attr('type')) {
        case 'text':

          regex = [new RegExp('^[A-Za-z0-9]{'+val.length+'}$')];
          message = ['Carácteres no válidos!!'];
          console.log(regex);
          if (max_lenght !== false) {
            var parte1 = '^[A-Za-z0-9]{0,';
            var parte2 = '}$';
            console.log(max_lenght);
            regex.push(new RegExp(parte1+max_lenght+parte2));
            message.push('Como máximo tienen que haber '+max_lenght+' carácteres');
          }

          if (min_lenght !== false) {
            var parte1 = '^[A-Za-z0-9]{';
            var parte2 = ',}$';
            regex.push(new RegExp(parte1+min_lenght+parte2));
            message.push('Como mínimo pueden haber '+min_lenght+' carácteres');
          }

          if (required && val.length < min_lenght){
            /*clear = false;
            e.preventDefault();
            var chars = min_lenght - val.length;
            message_form($(this), '¡¡Faltan '+chars+' carácteres para llegar al mínimo!!', clear);*/
          }

          for (var i=0;i<regex.length; i++) {
            if (!regex[i].test(val)){
              clear = false;
              e.preventDefault();
              message_form($(this), message[i], clear);
              return false;
            }
          }
          break;
        default:
          e.preventDefault();
      }

      if (clear) message_form($(this), '', clear);
    }

  });
  e.preventDefault();
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
