<div id="registr-block">
  <?php
  $href = Yii::app()->user->isGuest ? '/signup' : '/private/subscribe';
  echo CHtml::link('Subscribe now!', $href, array(
    'id' => 'registr-link',
    'class' => 'bold',
    'style' => 'font-size:14pt;text-decoration:none',
  ));
  ?>
</div>
<div id="registr-dialog">
  <div></div>
</div>
<script type="text/javascript">
  var regform = $('#registr-dialog');
  var regfcon = $('#registr-dialog > div');

  function updateRegForm(data) {
    switch (data.result) {
      case 'form':
        regfcon.html(data.form);
        break;
      case 'close':
        regform.hide();
        window.location = window.document.URL;
        break;
      case 'redirect':
        window.location = data.url;
    }
  }

  $('#registr-link').click(function (event) {
    if($(this).attr('href')!='/signup')
      return;
    event.preventDefault();
    regform.show();
    if (regfcon.html().length == 0) {
      $.getJSON('/signup', function (data) {
        updateRegForm(data);
      });
    }
  });

  regform.click(function () {
    $(this).hide();
  });

  regfcon.on('click', '#reg-submit', function (event) {
    event.preventDefault();
    $.ajax({
      'type': 'POST',
      'url': '/signup',
      'cache': false,
      'data': $(this).parents('form').serialize(),
      'dataType': 'json',
      'success': function (data) {
        updateRegForm(data);
      }
    });
    return false;
  });
  
  regfcon.on('click', '#reg-close', function (){
    regform.hide();
  });

  regfcon.click(function (event) {
    event.stopPropagation();
  });
</script>