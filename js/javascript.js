
function smazatAkci(id)
 {
   if(confirm("Opravdu chcete smazat tuto akci?")) {
         jQuery.ajax({
	   url: "administrace/slevy/",
	   data: "smazat="+id,
	   cache: false,
	   success: function(status)
           {
             $("#radek_"+id).css("background","#f67f90");
             $("#radek_"+id).css("color","white");
             $("#radek_"+id).hide(1000);
	   },
	   error: function(XMLHttpRequest, textStatus, errorThrown) {
	               alert("Chyba - " + textStatus + " " + errorThrown);
	         }
	   });
        }  
        return false;
 }
function smazatClanek(id) {
   if(confirm("Opravdu chcete odstranit tento článek?")) {
         jQuery.ajax({
	   url: "administrace/clanky/",
	   data: "smazClanek="+id,
	   cache: false,
	   success: function(status)
           {
             $("#radek_"+id).css("background","#f67f90");
             $("#radek_"+id).css("color","white");
             $("#radek_"+id).hide(1000);       
	   },
	   error: function(XMLHttpRequest, textStatus, errorThrown) {
	               alert("Chyba - "+ XMLHttpRequest.abort + " " + textStatus + " " + errorThrown);
	         }
	   });
        }      

        return false;   
}
function smazAnketu(id) {
   if(confirm("Opravdu chcete odstranit tuto anketu?")) {
         jQuery.ajax({
	   url: "administrace/anketa/",
	   data: "smazAnketu="+id,
	   cache: false,
	   success: function(status)
           {
             $("#radek_"+id).css("background","#f67f90");
             $("#radek_"+id).css("color","white");
             $("#radek_"+id).hide(1000);       
	   },
	   error: function(XMLHttpRequest, textStatus, errorThrown) {
	               alert("Chyba - "+ XMLHttpRequest.abort + " " + textStatus + " " + errorThrown);
	         }
	   });
        }      

        return false;      
    
}
function zmenaStavuPlatby(id,email,zpusobPlatby)
 {
   if(confirm("Opravdu chcete odstranit tuto položku za zaplacenou?")) {
         jQuery.ajax({
	   url: "administrace/objednavky/",
	   data: "stavPlatby="+id+"&email="+email+"&platba="+zpusobPlatby,
	   cache: false,
	   success: function(status)
           {
             $("#radek_"+id).css("background","#f67f90");
             $("#radek_"+id).css("color","white");
             $("#radek_"+id).hide(1000);       
	   },
	   error: function(XMLHttpRequest, textStatus, errorThrown) {
	               alert("Chyba - " + textStatus + " " + errorThrown);
	         }
	   });
        }      

        return false;
 }
 function zmenitZobrazeno(id,hodnota)
 {
  if(confirm("Opravdu chcete změnit zobrazení?")) {
         jQuery.ajax({
	   url: "administrace/slevy/",
	   data: "IdZobrazeno="+id+"&hodnota="+hodnota,
	   cache: false,
	   success: function(status)
           {
            alert("Akce proběhla");  
	   },
	   error: function(XMLHttpRequest, textStatus, errorThrown) {
	               alert("Chyba - " + textStatus + " " + errorThrown);
	         }
	   });
        }      

        return false;     
     
 }
 function zmenaVycerpano(idObje,idSlevy,value)
 {
     var vycerpanoHodnota = value.options[value.selectedIndex].value;
   jQuery.ajax({
	   url: "administrace/objednavky/",
	   data: "idObje="+idObje+"&idSlevy="+idSlevy+"&hodnota="+vycerpanoHodnota,
	   cache: false,
	   success: function(status)
           {
            alert("Uloženo.");  
	   },
	   error: function(XMLHttpRequest, textStatus, errorThrown) {
	               alert("Chyba - " + textStatus + " " + errorThrown);
	         }
	   });
   return false;
 }
 

$(document).ready(function(){   
$("#anketaDialog").hide();
$("#pridatAnketu").click(function(){
   $("#anketaDialog").dialog({
       
        autoOpen: true,
                maxHeight:0.95 * $(window).height(),//1
                width: 800,
                modal: true,
                position: 'center',
                resizable: false,
                autoResize: true,
      buttons: {
        "Uložit": function() {
               var odpoved = document.formular.odpovedi;
               var otazka = document.formular.otazka.value;       
               var odpovediPole = "";
               for (var i = 0; i < odpoved.length; ++i) {
                 odpovediPole +="&odpoved[]="+odpoved[i].value;
      
               }
        if(otazka === "" || odpoved === "")  
        {
         alert("Musíte vyplnit všechny údaje!\n");
         return 0;
        }   
        if(otazka.lenght > 199)
        {
         alert("Otázka musí být maximálně 50 znaků dlouhý.\n");
         return 0;
        }
          jQuery.ajax({  
           method:"post",
	   url: "administrace/anketa/",
           data: "otazka="+otazka+odpovediPole,
        //   data: "otazka="+otazka+{odpoved:odpovediPole},
	   cache: false,
	   success: function()
           {
            alert("Anketa byla vytvořena");
	   },
	   error: function(XMLHttpRequest, textStatus, errorThrown) {
	               alert("Chyba - " + textStatus + " " + errorThrown);
	         }
	   });
        },
        "Zavřít": function() {
          $( this ).dialog( "close" );
          location.href = "administrace/anketa";
        }
      }
           
});          


});


$( ".tlacitko" ).button();
 $("#zaskrtavac").click(function(){
    var zaskrtnuto_hodnota;
    if(this.checked)
    {
     zaskrtnuto_hodnota = 1;
    }
    else
    {
     zaskrtnuto_hodnota = 0;
    }
   jQuery.ajax({
	   url: "nastaveni/jine/",
	   data: "zaskrtnuto="+zaskrtnuto_hodnota,
	   cache: false,
	   success: function(status)
           {
            if(zaskrtnuto_hodnota == 1)
            {
             $("#status_check").text("ANO");
             alert(" Nyní se budou posílat na váš email informace o akcích.");
            }
            if(zaskrtnuto_hodnota == 0)
            {
             $("#status_check").text("NE");  
             alert(" Nyní se nebudou posílat na váš email informace o akcích.");
            }
	   },
	   error: function(XMLHttpRequest, textStatus, errorThrown) {
	               alert("Chyba - " + textStatus + " " + errorThrown);
	         }
	   });
         });  
    
    
   $( "#dialogUpravy" ).dialog({
       
        autoOpen: true,
                maxHeight:0.95 * $(window).height(),//1
                width: 800,
                modal: true,
                position: 'center',
                resizable: false,
                autoResize: true,
      buttons: {
        "Uložit": function() {
     
        var nazev = document.uFormular.uNazev.value;
        var id  = document.uFormular.uID.value;
        var obsah = CKEDITOR.instances.editor2.getData();
        var druh = document.uFormular.uDruh.value;
        alert(obsah.lenght);
        if(nazev === "" || obsah === "" || druh === "")  
        {
         alert("Musíte vyplnit všechny údaje!\n"+nazev+"\n"+obsah+"\n"+druh);
         return 0;
        }   
        if(nazev.lenght > 49)
        {
         alert("Název musí být maximálně 50 znaků dlouhý.\n");
         return 0;
        }
       
          jQuery.ajax({  
	   url: "administrace/clanky/",
           contentType: "application/x-www-form-urlencoded",
	   data: "eNazev="+nazev+
                 "&eObsah="+encodeURIComponent(obsah)+
                 "&eDruh="+druh+
                 "&eID="+id,
          
	   cache: false,
	   success: function()
           {
            alert("Článek byl upraven.");
	   },
	   error: function(XMLHttpRequest, textStatus, errorThrown) {
	               alert("Chyba - " + textStatus + " " + errorThrown);
	         }
	   }); 
        },
        "Zavřít": function() {
          $( this ).dialog( "close" );
          location.href = "administrace/clanky";
        }
      }
           
});          
             
 
    $( "#dialog" ).hide();     
$("#pridatClanek").click(function(){
               CKEDITOR.replace( 'editor1', {
    language: 'cs'
});
   $( "#dialog" ).dialog({
        autoOpen: true,
                maxHeight:0.95 * $(window).height(),//1
                width: 800,
                modal: true,
                position: 'center',
      buttons: {
        "Vytvořit článek": function() {
         
        var nazev = document.formular.nazev.value;
        var obsah = CKEDITOR.instances.editor1.getData();
        var druh = document.formular.druh.value;
        if(nazev === "" || obsah === "" || druh === "")  
        {
         alert("Musíte vyplnit všechny údaje!\n"+nazev+"\n"+obsah+"\n"+druh);
         return 0;
        }   
        if(nazev.lenght > 49)
        {
         alert("Název musí být maximálně 50 znaků dlouhý.\n");
         return 0;
        }  
        jQuery.ajax({
            type: "POST",
            contentType: "application/x-www-form-urlencoded",
	   url: "administrace/clanky/",
	   data: "pNazev="+nazev+
                 "&pObsah="+encodeURIComponent(obsah)+
                 "&pDruh="+druh,
	   cache: false,
	   success: function()
           {
            alert("Článek byl vytvořen.");
            document.formular.reset();
	   },
	   error: function(XMLHttpRequest, textStatus, errorThrown) {
	               alert("Chyba - " + textStatus + " " + errorThrown);
	         }
	   }); 
        },
        "Zavřít": function() {
          $( this ).dialog( "close" );
          location.reload();
        }
      }
           
});
   
});
    


$("#pridatSlevu").click(function(){
   $( "#dialog" ).dialog({
         maxHeight:0.95 * $(window).height(),//1
         width: 800,
         modal: true,
         position: 'center',
      buttons: {
        "Vytvořit slevu": function() {
        var nazev = document.formular.nazev.value;
        var popis = document.formular.popis.value;
        var puvodniCena = document.formular.puvodniCena.value;
        var cenaPoSleve = document.formular.cena.value;   
       // var obrazek = document.formular.obrazek.value;  
       var obrazek = document.formular.obrazek.files[0];  
        if(nazev === "" || popis === "" || puvodniCena === "" || cenaPoSleve === "")  
        {
         alert("Musíte vyplnit všechny údaje!\n");
         return 0;
        }   
        if(nazev.lenght > 49)
        {
         alert("Název musí být maximálně 50 znaků dlouhý.\n");
         return 0;
        }
        if(isNaN(parseInt(puvodniCena)) || isNaN(parseInt(cenaPoSleve)))
        {
         alert("Původní cena nebo cena po slevě nesmí obsahovat text.\n");
         return 0;
        }
       
       if(obrazek.type !== "image/jpeg" && obrazek.type !== "image/png") {
          alert("Formát obrázku musí být JPG nebo PNG! "+obrazek.type);
          return 0;
       }

        
       var form = new FormData;
       form.append('obrazek', obrazek);
       form.append('nazev', nazev);
       form.append('popis', popis);
       form.append('puvodniCena', puvodniCena);
       form.append('cenaPoSleve', cenaPoSleve);

             jQuery.ajax({
           method: "POST",
	   url: "administrace/slevy/",
	   data: form,
           processData: false,  // tell jQuery not to process the data
           contentType: false,   // tell jQuery not to set contentType
	   cache: false,
	   success: function()
           {
            alert("Slevový kupón byl vytvořen.");
            document.formular.reset();
	   },
	   error: function(XMLHttpRequest, textStatus, errorThrown) {
	               alert("Chyba - " + textStatus + " " + errorThrown);
	         }
	   }); 
           
           
           
           
           
           
           
        },
        "Zavřít": function() {
          $( this ).dialog( "close" );
          location.reload();
        }
      }
           
});
});

$( "#dialog" ).hide();  
   $( "#upravaSlevy" ).dialog({
         maxHeight:0.95 * $(window).height(),//1
         width: 800,
         modal: true,
         position: 'center',
      buttons: {
        "Uložit": function() {
        var id = document.formular2.kupon.value;
        var nazev = document.formular2.uNazev.value;
        var popis = document.formular2.uPopis.value;
        var puvodniCena = document.formular2.uPuvodniCena.value;
        var cenaPoSleve = document.formular2.uCena.value;  
        var obrazek = document.formular2.eObrazek.files[0];  
        if(nazev === "" || popis === "" || puvodniCena === "" || cenaPoSleve === "")  
        {
         alert("Musíte vyplnit všechny údaje!\n");
         return 0;
        }   
        if(nazev.lenght > 49)
        {
         alert("Název musí být maximálně 50 znaků dlouhý.\n");
         return 0;
        }
        if(isNaN(parseInt(puvodniCena)) || isNaN(parseInt(cenaPoSleve)))
        {
         alert("Původní cena nebo cena po slevě nesmí obsahovat text.\n");
         return 0;
        }
         if(obrazek.type !== "image/jpeg" && obrazek.type !== "image/png") {
          alert("Formát obrázku musí být JPG nebo PNG! "+obrazek.type);
          return 0;
       }
 
       var form = new FormData;
       form.append('eObrazek', obrazek);
       form.append('eNazev', nazev);
       form.append('ePopis', popis);
       form.append('ePuvodniCena', puvodniCena);
       form.append('eCenaPoSleve', cenaPoSleve);
       form.append('eID', id);
        jQuery.ajax({
              method: "POST",
	   url: "administrace/slevy/"+id,
	   data: form,
           processData: false,  // tell jQuery not to process the data
           contentType: false,   // tell jQuery not to set contentType
	   cache: false,
	   success: function()
           {
            alert("Slevový kupón byl upraven.");
	   },
	   error: function(XMLHttpRequest, textStatus, errorThrown) {
	               alert("Chyba - " + textStatus + " " + errorThrown);
	         }
	   }); 
        },
        "Zavřít": function() {
          $( this ).dialog( "close" );
          location.href = "administrace/slevy";
        }
      }
});






 
/*konec-document-ready*/    
});
