//Usage
//https://codecanyon.net/item/spin2win-wheel-spin-it-2-win-it/16337656?ref=chrisgannon
//http://preview.codecanyon.net/item/spin2win-wheel-spin-it-2-win-it/full_screen_preview/16337656?_ga=1.225779801.210001494.1491571662

//load your JSON (you could jQuery if you prefer)
function loadJSON(callback) {

  var xobj = new XMLHttpRequest();
  //xobj.overrideMimeType("application/json");
  //xobj.open('GET', './osmel.php', true); 
  xobj.open('GET', './juego_json', true); 
  xobj.onreadystatechange = function() {
    if (xobj.readyState == 4 && xobj.status == "200") {
      //Call the anonymous function (callback) passing in the response
      callback(xobj.responseText);
    }
  };
  xobj.send(null);
}

//your own function to capture the spin results
function myResult(e) {
  //e is the result object

    //console.log(e);
    //console.log('Spin Count: ' + e.spinCount + ' - ' + 'Win: ' + e.win + ' - ' + 'Message: ' +  e.msg);

    // if you have defined a userData object...
    if(e.userData){
      
      //console.log('User defined score: ' + e.userData.score)

    }


 // puede probar que giran 
 
  if(e.spinCount == 1){
    // mostrar el progreso del juego cuando el spinCount es 3 
    //console.log(e.target.getGameProgress());
    //reiniciarlo si te gusta 
    //e.target.restart();
  }  

}

//su propia función para capturar cualquier errores
function myError(e) {
  //e is un objeto error
  //console.log('Cantidad de giros: ' + e.spinCount + ' - ' + 'Message: ' +  e.msg);

}

function myGameEnd(e) {
          //si es la primera vez entonces
       

   valor=e.results[0].userData.score;
   //alert("si");
                        jQuery.ajax({ //guardar en la cookie el conteo
                                url : '/respuesta_tarjeta',
                                data : { 
                                       //figura: $(this).parent().attr('carta'),
                                       valor: valor, //$(this).parent().attr('valor'),
                                },
                                type : 'POST',
                                dataType : 'json',
                                success : function(data) {  
                                        localStorage.setItem('virada',  parseInt(localStorage.getItem('virada'))+1 );
                                        if ( parseInt(localStorage.getItem('virada')) >=1) {
                                            
                                            localStorage.setItem('virada',  0 );
                                            var url = "/proc_modal_felicidades";  
                                            
                                            jQuery('#modalMessage3').modal({
                                                backdrop: 'static',
                                                keyboard: false, 
                                                show:'true',
                                                remote:url,
                                            });
                                        }
                                      return false;
                                }
                        }); 




}




function init() {



    loadJSON(function(response) {

    if (!(localStorage.getItem('virada'))) {
            localStorage.setItem('virada',  0 );
        }


          if ( parseInt(localStorage.getItem('virada')) >=1) {
               // alert('aa');
                //localStorage.setItem('virada',  0 );
                //alert('aa');
                var url = "/proc_modal_felicidades";  
                
                jQuery('#modalMessage3').modal({
                    backdrop: 'static',
                    keyboard: false, 
                    show:'true',
                    remote:url,
                });

            } 


      // Parse JSON string to an object
      var jsonData = JSON.parse(response);
      //if you want to spin it using your own button, then create a reference and pass it in as spinTrigger
      var mySpinBtn = document.querySelector('.spinBtn');
      //create a new instance of Spin2Win Wheel and pass in the vars object
      var myWheel = new Spin2WinWheel();
      
  

      //WITH your own button
      myWheel.init({data:jsonData, onResult:myResult, onGameEnd:myGameEnd, onError:myError, spinTrigger:mySpinBtn});
      
      //WITHOUT your own button
      //myWheel.init({data:jsonData, onResult:myResult, onGameEnd:myGameEnd, onError:myError});


    });

}


//And finally call it
init();
