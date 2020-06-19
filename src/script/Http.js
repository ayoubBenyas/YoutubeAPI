export default class Http {
    

    static post = (url, data, callback)=>{
        
        $.ajax({
                type: 'POST',
                url : url,
                data: data,
                dataType:'text',
                success: function( response ){
                        callback( response);
                        return true; 
                    },
                error: function(xhr, statut, error){
                    console.log(JSON.stringify(xhr));
                }
            });
    }

    static get = ( url, callback)=>{ 
        $.ajax({
            type    :   'GET',
            url     :    url,
            dataType : 'json',
            success: function( response){
                callback( response);
            },
            error: function(xhr, statut, error){
                alert("error"+ JSON.stringify(xhr)); 
                //connecting('Connecting Database failed #youtubedbapi','Connecting failures are usually caused by network difficulties, or maintenance activity.',200) ;
            },
            complete:function(){
                $('#searchProgress').hide();
            }
        });
    }
}
