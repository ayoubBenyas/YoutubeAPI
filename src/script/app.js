import Http from './Http.js';

function tplawesome(e,t){var res=e;for(var n=0;n<t.length;n++){res=res.replace( /\{\{(.*?)\}\}/g, function(e,r){alert(t[n][r]);return t[n][r]})}return res}

$('#searchProgress').hide();    
$( document ).ready(()=>{
    
    $(document).keydown(function(e){
      
      if( e.which === 96 && e.ctrlKey ){
        let random = Math.random().toString(36).substring(7).toUpperCase();
        if( random == prompt("Please type in '"+random+"' to delete permanently all Data .") )
            $.get('/'+window.location.pathname.split('/')[1]+'/dbApi/deleteAll.php',(response)=>{
                alert('dataBase cleared successfully :)');
            });
      }         
    });


    $('#search-form').on('submit', e => {
        e.preventDefault();

        if(!window.navigator.onLine){
            throw new Error("Something went badly wrong!");
        }

        var publishedAfter = $('#publishedAfter').val();
        var publishedBefore = $('#publishedBefore').val();
        
        if( new Date(publishedBefore) < new Date(publishedAfter) )
            return;

        var q = $('#search-input').val().toUpperCase();;
        var maxResults = $('#maxResults').val();
        var affectDb = $("#affect-db:checked").val()!== undefined? true : false ; 
        
        $('#searchProgress').show();
        Http.get(`/search?q=${q}&maxResults=${maxResults}&publishedAfter=${publishedAfter}&publishedBefore=${publishedBefore}&affectDb=${affectDb}`,(res)=>{
            if( res.error )
                M.toast({html: `error : ${res.message}`})
            else{
                $('#myContainer').text( JSON.stringify(res) );
                $('#myContainer').html("");
                
                res.forEach(item =>{
                    $("#myContainer").append( 
                        
                        `<div class="col s12 m12">
                            <div class="card horizontal">
                                <div class="card-image" >
                                    <a href="http://www.youtube.com/embed/${item.id}?autoplay=0" class="ml-3 " >  
                                        <img src="https://i.ytimg.com/vi/${item.id}/mqdefault.jpg" style="wrap:fit;">
                                    </a>
                                </div>
                                <div class="card-stacked">
                                    <div class="card-content">
                                        <span class="card-title activator grey-text text-darken-4">${item.title}</span>
                                        <p>${item.description}</p>
                                    </div>
                                    <div class="card-action row">
                                        <div class="col s12 m6">  
                                            <i class="material-icons">create</i>${item.channelTitle}
                                        </div>
                                        <div class="col s12 m6">  
                                            <i class="material-icons">today</i>${item.publishedAt}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`

                    );
                })
            }

        });
        
    });

});