if(document.all){
var tags=document.all.tags("a")
for (var i=0;i<tags.length;i++)
tags(i).outerHTML=tags(i).outerHTML.replace(">"," hidefocus=true>")}