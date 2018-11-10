<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Парк ЛПК в Нововятске</title>
  <meta name="description" content="Участвуй в конкурсе проектов благоустройства Парка ЛПК. Выйграйте денежный приз и получите проект в портфолио."/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script>
 var contentold={};   //объявляем переменную для хранения неизменного текста
 function savedata(elementidsave,contentsave) {   //функция для сохранения отредактированного текста с помощью ajax
   $.ajax({
                url: 'save.php',                           //url который обрабатывает и сохраняет наш текст
                type: 'POST',
                data: {
                          content: contentsave,     //наш пост запрос
                          id:elementidsave
                },
                success:function (data) {      //получили ответ от сервера - обрабатываем

                    if (data == contentsave)   //сервер прислал нам отредактированный текст, значит всё ok
                    {
                     $('#'+elementidsave).html(data);      //записываем присланные данные от сервера в элемент, который редактировался
                     $('<div id="status">Данные успешно сохранены:'+data+'</div>')   //выводим сообщение об успешном ответе сервера
                        .insertAfter('#'+elementidsave)
                        .addClass("success")
                        .fadeIn('fast')
                        .delay(1000)
                        .fadeOut('slow', function() {this.remove();}); //уничтожаем элемент

                    }
                    else
                    {
                        $('<div id="status">Запрос завершился ошибкой:'+data+'</div>') // выводим данные про ошибку
                        .insertAfter('#'+elementidsave)
                        .addClass("error")
                        .fadeIn('fast')
                        .delay(3000)
                        .fadeOut('slow', function() {this.remove();});  //уничтожаем элемент
                    }
                }
               });
   }
$(document).ready(function() {
     $('[contenteditable="true"]')                 //редактируемый элемент
                       .mousedown(function (e)                       //обрабатываем событие нажатие мышки
                                {
                                   e.stopPropagation();
                                   elementid=this.id;
                                   contentold[elementid]=$(this).html();        //текст до редактирования
                                   $(this).bind('keydown', function(e) {         //обработчик нажатия Escape
                                            if(e.keyCode==27){
                                               e.preventDefault();
                                               $(this).html(contentold[elementid]);	//возвращаем текст до редактирования
                                               }
                                            });
                                   $("#save").show();                              //показываем кнопку "сохранить"
                                  })
                       .blur(function (event)                   //обрабатываем событие потери фокуса
                        {
                           var elementidsave=this.id;                       //id элемента потерявшего фокус
                             var  contentsave = $(this).html();           //текст для сохранения
                             event.stopImmediatePropagation();
                             if (elementid===elementidsave)    // если id не совпадает с id элемента, потерявшего фокус,
                              {$("#save").hide(); }      // значит фокус  в редактируемом элементе, кнопку не прячем
                             if (contentsave!=contentold[elementidsave])  //если текст изменился
                                 {
                                   savedata(elementidsave,contentsave);   //отправляем на сервер
                                 }
                        });
});
</script>
  <style>
      h1 {
         font-family: sans-serif;
         text-align: center;
      }
      .img-c {
         margin: 0 auto;
         width: 200px;
         display: block;
      }
      .main {
         max-width: 1280px;
         margin: 0 auto;
      }
  </style>
</head>
<body style="100%">
<div class="main">
   <h1>Парк ЛПК</h1>
   <img class="img-c" src="logo1.jpg">
</div>
<div class="content">
   <div id="item1" contenteditable="true"></div>
   <div id="item2" contenteditable="true"></div>
   <div id="item3" contenteditable="true"></div>
</div
</body>
</html>
