(function(){
  var b=document.getElementById('menuBtn'),m=document.getElementById('mobileNav');
  if(b&&m){b.addEventListener('click',function(){var o=m.classList.toggle('hidden');b.setAttribute('aria-expanded',String(!o))})}
  var y=document.getElementById('yr');if(y)y.textContent=new Date().getFullYear();
  var q=new URLSearchParams(location.search),f=document.getElementById('contactForm');
  if(f){
    if(q.get('sent')==='1'){f.reset();var t=document.getElementById('thanks');if(t){t.classList.remove('hidden');t.scrollIntoView({block:'center'})}}
    if(q.get('error')){var e=document.getElementById('sendError');if(e){e.classList.remove('hidden');e.scrollIntoView({block:'center'})}}
  }
})();
