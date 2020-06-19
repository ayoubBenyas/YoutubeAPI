/* youtube autocomplete search  */
$(document).ready(function(){
    $("#search-input").autocomplete({
        
        source: function(request, response){
            /* Google Developer ID (optional) */
            var apiKey = 'AIzaSyAmGKKvpHj6oRJqOHw8p4fcq3eyktIJz1Y';
            /* Search keyword */
            var query = request.term;
            /* youtube sorgusu */
            
            $.ajax({
                url: "http://suggestqueries.google.com/complete/search?hl=en&ds=yt&client=youtube&hjson=t&cp=1&q="+query+"&key="+apiKey+"&format=5&alt=json&callback=?",  
                dataType: 'json',
                success: function(data, textStatus, request) {
                    response( $.map( data[1], function(item) {
                        return {
                                label: item[0],
                                value: item[0]
                            }
                        }
                    ));
                }
            });
        },
    
        /* You can use transaction is selected here to */
        select: function( event, ui ) {
            alert("ui.item.label");
            $.youtubeAPI(ui.item.label);
        }
    });

    $('button#submit').click(function(){
        var value = $('input#search-input').val();
        $.youtubeAPI(value);
    });


    $.youtubeAPI = function(kelime){
        var sonuc = $('#sonuc');
        sonuc.html('Arama gerçeklestiriliyor...');
        
        $.ajax({
            type: 'GET',
            url: 'http://gdata.youtube.com/feeds/api/videos?q=' + kelime + '&max-results=15&v=2&alt=jsonc',
            dataType: 'json',
            success: function( veri ){
                if( veri.data.items ){
                    sonuc.empty();
                    $.each( veri.data.items, function(i, data) {
                        sonuc.append('<div class="youtube">\
                            <img src="' + data.thumbnail.sqDefault + '" alt="" />\
                            <h3><a href="javascript:void(0)" onclick="$.youtubePlay(\'' + data.id + '\', \'' + data.content[5] + '\')">' + data.title + '</a></h3>\
                            <p>' + data.description + '</p>\
                        </div>\
                        <div class="youtubeOynat" id="' + data.id + '"></div>');
                    });
                }
                else {
                    sonuc.html('<div class="hata"><strong>' + kelime + '</strong> ile ilgili hiç video bulunamadi!</div>');
                }
            }
        });
    }

    $.youtubePlay = function(yid, frame){
        $('.youtubeOynat').slideUp().empty();
        $('#'+yid).slideDown().html('<iframe src="'+ frame +'&autoplay=1" style="width: 100%; box-sizing: border-box; height: 300px" />');
    }
});