<!doctype html> 
<head> 

<style> 
.fadein { position:relative; height:800px; width:800px;   } 
.fadein img { position:absolute; left:0; top:0; } 
</style> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> 
<script> 
$(function(){ 
    $('.fadein img:gt(0)').hide(); 
    setInterval(function(){$('.fadein :first-child').fadeOut().next('img').fadeIn().end().appendTo('.fadein');}, 4000); 
}); 
</script> 

</head> 
<body> 
<center><div  class="fadein"> 
    <img  src="http://weblogs.upyd.es/majadahonda/wp-content/uploads/sites/47/2012/04/Dibujo.png"> 
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/37/Edificio_de_La_Gobernaci%C3%B3n_de_Nari%C3%B1o_-_Palacio_de_Gobierno.jpg/640px-Edificio_de_La_Gobernaci%C3%B3n_de_Nari%C3%B1o_-_Palacio_de_Gobierno.jpg"> 
    <img src="http://www.fenalco.com.co/sites/default/files/personajpg_3.png"> 
    <img src="http://dyg-derechoygestion.com/wp-content/uploads/2013/07/t_finanzas.jpg"> 
    <img src=" http://bm-abogados.com.mx/wp-content/uploads/2015/04/b51-1200x500.jpg"> 
   

</div></center> 
</body> 
</html> 