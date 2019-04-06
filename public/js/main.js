var url = "socialapp.com";
window.addEventListener('load',function(){
    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');    

    //boton de like
    function like(){
        $(".btn-like").unbind('click').click(function(){
            console.log("like cliked");
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', '/img/like-red.png');
            $.ajax({
                url: '/like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if (response.like) {
                        console.log('Haz dado like'); 
                    }else{
                        console.log("error al dar like");  
                    }
                }
            });
            dislike();
        });
    }

    function dislike(){
        //boton de dislike
        $(".btn-dislike").unbind('click').click(function(){
            console.log("dislike cliked");
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', '/img/like-gray.png');
            $.ajax({
                url: '/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if (response.like) {
                        console.log('Haz dado dislike');
                        
                    }else{
                        console.log("error al dar dislike");  
                    }
                }
            });

            like();
        });
    }

    dislike();   
    like();


    //buscador de personas
    $("#buscador").submit(function(e){
        $(this).attr('action','/people/'+$("#buscador #search").val());
    });
});