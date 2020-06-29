(function($){
    //fonction bouton like/unlike(requete ajax)
    $('.affichage-question').on('click','.btn-like', function(e){
        e.preventDefault()
        var link = this
        var parent = $(link).parent(".footer-question")
        var httpRequest = new XMLHttpRequest()
        httpRequest.onreadystatechange = function(){
            if(httpRequest.readyState === 4){
                if(httpRequest.status === 200){
                     $(parent).replaceWith(httpRequest.responseText)
                }else{
                    alert('impossible de contacter le serveur')
                }
            }
        }
        httpRequest.open('GET',this.getAttribute('href'), true)
        httpRequest.send()
    });

    //fonction recherche question (bar de recherche menu déroulant)(requete ajax jquery)
    $("#search").autocomplete({
        source: function( request, response ) {
         // requete ajax
         $.ajax({
          url: "traitement/traitement_recherche_question/search-question-fonction.php",
          type: 'post',
          dataType: "json",
          data: {
           search: request.term
          },
          success: function( data ) {
           response( data );
           // effet menu deroulant
           $(".ui-autocomplete").effect("slide",{direction:'up'});
          }
         });
        },
        select: function (event, ui) {
         $('#search').val(ui.item.label); 
         return false;
        }
    });

    //fonction affichage recherche (requete ajax)
    $('.affichage-question').on('submit','#search-form', function(e){
        e.preventDefault()
        var form = this
        var data = new FormData(form)
        var httpRequest = new XMLHttpRequest()
        httpRequest.onreadystatechange = function(){
            if(httpRequest.readyState === 4){
                if(httpRequest.status === 200){
                    switch(httpRequest.responseText){
                        case '1':
                            $('.error-search').replaceWith('<span class="erreur error-search">Vous devez écrire une question</span>')
                            break;
                        case '2':
                            $('.error-search').replaceWith('<span class="erreur error-search">La question n\'existe pas</span>')
                            break;
                        case '3':
                            break;
                        default:
                            $('.error-search').empty();
                            $('.search-answer-container').empty().hide().append(httpRequest.responseText).fadeIn("slow");
                            break;
                    }
                }else{
                    alert('impossible de contacter le serveur')
                }
            }
        }
        httpRequest.open('POST',form.getAttribute('action'), true)
        httpRequest.setRequestHeader('X-Requested-With', 'XMLHttpRequest')
        httpRequest.send(data)
    });
})(jQuery);




