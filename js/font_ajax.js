function SetFonts(fonts) { 
    for (var i = 0; i < fonts.items.length; i++) {      
     $('#styleFont')
         .append($("<option></option>")
         .attr("value", fonts.items[i].family)
         .text(fonts.items[i].family));
    }    
}

$.getJSON("https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAYJsif1PxS6-JErAwruv7woKoyMLK7HJA", function(fonts){
    for (var i = 0; i < fonts.items.length; i++) {      
     $('#styleFont')
         .append($("<option></option>")
         .attr("value", fonts.items[i].family)
         .text(fonts.items[i].family));
    }    
});
var script = document.createElement('script');
script.src = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAYJsif1PxS6-JErAwruv7woKoyMLK7HJA&callback=SetFonts';
document.body.appendChild(script);


 WebFontConfig = {
   google: { families: ['ABeeZee', 'Abel', 'Abril Fatface', 'Aclonica', 'Acme', 'Actor', 'Adamina', 'Advent Pro', 'Aguafina Script', 'Annie Use Your Telescope', 'Average', 'Average Sans', 'Averia Gruesa Libre', 'Averia Libre', 'Averia Sans Libre', 'Averia Serif Libre', 'Berkshire Swash', 'Bevan', 'Bigelow Rules', 'Bigshot One', 'Bilbo', 'Bilbo Swash Caps', 'Bitter', 'Black Ops One', 'Bokor', 'Bonbon', 'Caesar Dressing', 'Cagliostro', 'Calligraffitti', 'Cambo', 'Carter One', 'Caudex','Cedarville Cursive', 'Ceviche One', 'Changa One', 'Chango', 'Chau Philomene One', 'Chela One', 'Chelsea Market', 'Chenla', 'Cherry Cream Soda', 'Cherry Swash', 'Chewy', 'Chicle', 'Chivo', 'Cinzel', 'Cinzel Decorative', 'Clicker Script', 'Coda', 'Coda Caption', 'Codystar', 'Combo', 'Comfortaa', 'Coming Soon','Concert One', 'Condiment', 'Content', 'Contrail One', 'Convergence', 'Cookie', 'Copse', 'Corben', 'Courgette', 'Cousine', 'Coustard', 'Covered By Your Grace', 'Crafty Girls', 'Creepster', 'Crete Round', 'Crimson Text', 'Croissant One', 'Crushed', 'Cuprum', 'Cutive', 'Cutive Mono']}
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })();

