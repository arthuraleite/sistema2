(function(){
 const body = document.body;
 const btn = document.getElementById('themeToggle');
 const saved = localStorage.getItem('theme') || 'light';
 apply(saved);
 if(btn){
   btn.addEventListener('click',()=>{
     const newTheme = body.dataset.bsTheme === 'dark' ? 'light' : 'dark';
     apply(newTheme);
     localStorage.setItem('theme', newTheme);
   });
 }
 function apply(t){
   body.dataset.bsTheme = t;
   if(btn) btn.textContent = t === 'dark' ? 'Modo Claro' : 'Modo Escuro';
 }
})();
