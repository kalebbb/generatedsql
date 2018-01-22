<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<script src="{{asset('js/app.js')}}"></script>
        <!-- Styles -->
      <!-- Compiled and minified CSS -->
   <link type="text/css" rel="stylesheet" href="{{asset('materialize/css/materialize.min.css')}}"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    </head>
    <body>
        <div class="row">
        <div class="col s12 m3 center-align valign-wrapper">
          <div class="card blue-grey darken-1 card-panel hoverable ">
            <div class="card-content white-text">
              <span class="card-title">Import Excel</span> 
         <form id="myForm" action="/fileUp" method="post" enctype="multipart/form-data">
         {{ csrf_field() }}
                 <div class="file-field input-field">
                  <div class="btn">
                    <span>File</span>
                    <input type="file" name="excel_file">
                  </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>
            
         </form>
            </div>

          </div>
        </div>
        <a class="waves-effect waves-light btn" id="gerar_sql"><i class="material-icons left">description</i>Gerar Sql</a>
      </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
        <script src="http://malsup.github.com/jquery.form.js"></script>     
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="{{asset('materialize/js/materialize.min.js')}}"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
        <script src="http://malsup.github.com/jquery.form.js"></script> 

 <script>
 var EXCEL_FILE = "";
 </script>
    <script> 
        // wait for the DOM to be loaded 
        $(document).ready(function() { 
            $('#gerar_sql').click(function(){
              if(EXCEL_FILE != ""){
 $.ajax({
                  type: "POST",
                  url: '{{route('generateSql')}}',
                   headers: {
                      'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                  data: { file_path: EXCEL_FILE},
                  success:function(resposta){
                  window.open ( '{{route("downloadSql")}}/?storage_file='+ resposta.sql_download);
                  },
                  error:function(){
                  }
                });
              }else{
                alert('tem q importar para gerar o sql');
              }
             

     
            });
            $('input[type="file"]').change(function(){
                $('#myForm').ajaxForm({
                     success: function(resposta)
                        {
                            EXCEL_FILE = resposta.file_path;
                            console.log(resposta);
                        },
                        // Método que será chamado quando houver algum erro na requisição
                        // Seja algum erro no servidor ou então estourar o TIMEOUT
                        error: function()
                        {
                            console.log('Oops, ocorreu um errro.');
                        }
                }).submit(); 
            });
        }); 
    </script> 
    </body>
</html>
