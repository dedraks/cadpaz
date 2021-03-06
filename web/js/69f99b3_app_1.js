
var ids = new Array();

// prepare the form when the DOM is ready
$(document).ready(function() {
    
    $body = $("body");
    $(document).on({
        // Quando uma requisição AJAX estiver sendo executada, a classe loading será adicionada
        ajaxStart: function() { $body.addClass("loading");    },
        // Remove a classe loading ao terminar a requisição AJAX
        ajaxStop: function() { $body.removeClass("loading"); }    
    });
            
    //jQuery(function($){
        $("#cpf").mask("999.999.999-99",{placeholder:"___.___.___-__"});
    //});
    
    
    
    /*
    var myTimer = setTimeout(function(){
        alert('Boom!');
    }, 10000);
    clearTimeout(myTimer);
    */
            
    var options = { 
        //target:        '#saida',   // target element(s) to be updated with server response 
        //beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse,  // post-submit callback 

        // other available options: 
        //url:       Routing.generate('pessoa_busca', {id: '11111111111'})         // override for form's 'action' attribute 
        type:      'post'      // 'get' or 'post', override for form's 'method' attribute 
        //dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 

        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 

    // bind form using 'ajaxForm' 
    $('#form1').ajaxForm(options); 
    $('#form2').ajaxForm(options); 
}); 
        
        
        $(".menuLink").on('click', function(e) {
            e.preventDefault();
            $.ajax({
                            //url: Routing.generate('relatorios_index'),
                            url: $(this).attr('href'),
                            method: 'GET',
                            //data: {'cpf': $("#cpf").val()},
                            success: function(result) {
                                $("#dataArea").html(result);
                                $("#dataArea").show();
                                $("#userDetails").slideUp();
                            }
                        });
        });
        
        /*function showRequest(formData, jqForm, options)
        {
            var text = $.param(formData); 
            
            text = text.replace(".", "");
            text = text.replace(".", "");
            text = text.replace("-", "");
            text = text.replace("cpf=", "");
            //alert(text);
        }*/
        
        /*
        function itemToTr(item)
        {
            var str = '';
            var date = new Date(item.data_nascimento);
            var m = (date.getMonth()+1);
            var d = date.getDay();
            str += '<tr id=\"tr'+item.id+'\"><td><a class=\"trlink\" href=\"' + Routing.generate('pessoa_view', {id: item.id}) + '\">' + item.nome + '</a></td><td>' + item.nome_mae + '</td><td>' + item.email + '</td><td>' + item.cpf + '</td></tr>';
            return str;
        }*/
        
        
        // post-submit callback 
        function showResponse(responseText, statusText, xhr, $form)  { 
            /*//ok(responseText);
            //alert(responseText);
            $('#userDetails').slideUp('slow');
            //$('#userDetails').slideDown('slow');
            $('#example').css('visibility','hidden');
            //$('#example').html('<thead><tr><th>Nome</th><th>Data de Nascimento</th><th>Email</th><th>CPF</th></tr></thead>');
            $('#example').slideUp(200);
            $('#example').css('visibility','visible');
            $('#example').slideDown(200);
            $('#example').html(responseText);*/
            
            $('#userDetails').html('');
            $('#userDetails').slideUp(200);
            
            //alert(responseText.search('login'));
            
            if (responseText.search('login') !== -1) {
                //alert('não logado');
                
                $('#userLoginLink')[0].click();
                
                $('#dataArea').html('<h2>Por favor efetue login para utilizar o sistema.</h2>');
                //alert('não logado');
                
                
                
                /*setTimeout(function(){
                    window.location.reload();
                }, 3000);*/
                //$('#dataArea').html('<h2>Por favor efetue login para utilizar o sistema.</h2>');
            }
            else {
                $('#dataArea').html(responseText);
            }
            //alert(responseText);
            $('#dataArea').slideDown(200);
            
            
        }
        function ok(responseText){
            // for normal html responses, the first argument to the success callback 
            // is the XMLHttpRequest object's responseText property 

            // if the ajaxForm method was passed an Options Object with the dataType 
            // property set to 'xml' then the first argument to the success callback 
            // is the XMLHttpRequest object's responseXML property 

            // if the ajaxForm method was passed an Options Object with the dataType 
            // property set to 'json' then the first argument to the success callback 
            // is the json data object returned by the server 

            //alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
            //    '\n\nThe output div should have already been updated with the responseText.'); 

            /*
            if (statusText!='success') {
                $("#saida").html('Nenhum registro encontrado');
                alert('Nenhum registro encontrado');
                return;
            }*/
        
            //$('#userDetails').css('visibility','hidden');
            $('#userDetails').slideUp('slow');
            
            
            $('#example').css('visibility','hidden');
            $('#example').html('<thead><tr><th>Nome</th><th>Data de Nascimento</th><th>Email</th><th>CPF</th></tr></thead>');
            var item = $.parseJSON(responseText);
                
            $('#example').slideUp(200);
            if ($.isArray(item)) {
                
                $('#example').css('visibility','visible');
                    
                if (item.length>0)
                    $('#example').slideDown(200);
                    
                for (i=0; i<item.length; i++) {
                    
                    ids.push(item[i].id);
                        
                    var trHTML = itemToTr(item[i]);

                    $('#example').append(trHTML);
                    //$('#example').hide();
                    //$('#example').css('visibility','visible');
                    //$('#example').show('slow');
                    //$('#example').clearQueue();
                    
                }
                
                $('#example tr').click(function() {
            
                    var href = $(this).find("a").attr("href");

                    if(href) {

                        //window.location = href;
                        //alert(href);
                        $(this).find("a").attr("href","#");
                        //$(this).click(function(){
                            $.ajax({url: href, success: function(result){
                                $("#userDetails").html('<div class=\"meio\">'+result+'</div>');
                                //$("#example").css('visibility','hidden');
                                $("#userDetails").hide();
                                $("#userDetails").css('visibility','visible');
                                //$("#example").hide('slow', function() {$("#userDetails").show('slow');});
                                //$("#example").empty();
                                $("#example").slideUp(400);
                                $("#userDetails").delay(600).slideDown(400);
                                $("#nome").val('');
                                $("#cpf").val('');
                            }});
                        //}); 
                    }
                });
            }
            else {
                    
                if (item ==null)
                {
                    $("#userDetails").html('Nenhum usuário encontrado! <a id="newlink" href=\"' + Routing.generate('pessoa_new') + '\">Cadastrar</a>');
                    $("#userDetails").hide();
                    $("#userDetails").css('visibility','visible');
                    $("#example").slideUp(400);
                    $("#userDetails").delay(600).slideDown(400);
                    
                    $("#newlink").click(function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: $(this).attr('href'),
                            method: 'POST',
                            data: {'cpf': $("#cpf").val()},
                            success: function(result) {
                                $("#userDetails").html(result);
                            }
                        });
                    });
                    
                    
                    
                    return;
                }
                        
                    
                /*var trHTML = itemToTr(item);
                    
                $('#example').append(trHTML);
                $('#example').hide();
                $('#example').css('visibility','visible');
                //$('#example').show('slow');
                $('#userDetails').slideUp('slow');
                $('#example').delay(500).slideDown(400);*/
                
                
                
                $.ajax({url: Routing.generate('pessoa_view', {id: item.id}), success: function(result){
                            $("#userDetails").html('<div class=\"meio\">'+result+'</div>');
                            //$("#example").css('visibility','hidden');
                            $("#userDetails").hide();
                            $("#userDetails").css('visibility','visible');
                            //$("#example").hide('slow', function() {$("#userDetails").show('slow');});
                            //$("#example").empty();
                            $("#example").slideUp(400);
                            $("#userDetails").delay(600).slideDown(400);
                            $("#nome").val('');
                            $("#cpf").val('');
                        }});
            }        
        }
    
        $('#form2').keyup(function(event) {

            if (event.which == 27 || event.which == 13)
            {
                event.preventDefault();
                return;
            }

            var searchText = $("#nome").val();

            if (searchText.length < 5)
                return;

                window.searchText = searchText;

            $.ajax({
                url: Routing.generate('pessoa_busca'),
                data: {'nome':searchText},
                success: showResponse,
                type: 'post'
            });
       });
       
       $("#userAreaEditLink, #userAreaChangePwdLink, #userLoginLink").click(function(e) {
           e.preventDefault();
           
           
           $.ajax({
                url: $(this).attr('href'),
                //data: {'nome':searchText},
                success: function(responseText, statusText, xhr, $form) {
                    $("#userAreaEdit").html(responseText);
                    $('#userAreaEdit').bPopup({
                        speed: 650,
                        transition: 'slideIn',
                        transitionClose: 'slideBack',
                    });
                    
                    $(".fos_user_profile_edit").ajaxForm({
                        type:'post',
                        success:function(responseText){
                            $("#userAreaEdit").html(responseText);
                        }
                    });
                },
                type: 'post'
            });
       });
    
    /*var CPF = new CPF();
    document.getElementById('cpf').mas
document.getElementById('botaoValidarCPF').onclick = function(){
    document.getElementById('saida').innerHTML = CPF.valida(document.getElementById('cpf').value);
};*/

/*
$( "#form1" ).submit(function( event ) {
    var inputtedPhoneNumber = $( "#cpf" ).val();
 
 
 
    // If the phone number doesn't match the regex
    if ( !isCPF( inputtedPhoneNumber ) ) {
 
        $("#saida").html('CPF Inválido!');
        event.preventDefault();
    } else {
 
        // Run $.ajax() here
    }
});*/
    

// Verifica, a cada 5 minutos se o usuário ainda está logado 
(function Forever(){
    
    $.ajax({
        url: '/login',
        success: function(responseText) {
            
            if (responseText.search('<a href="/login">Entrar</a>') !== -1) {
                window.location.reload();
            }
        }
    });
    
    setTimeout(Forever,300000);
})();