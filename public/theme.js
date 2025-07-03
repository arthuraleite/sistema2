(function(){
 const root = document.documentElement;
 const btn = document.getElementById('themeToggle');
 const saved = localStorage.getItem('theme') || 'light';
 apply(saved);
 if(btn){
   btn.addEventListener('click',()=>{
     const newTheme = root.dataset.bsTheme === 'dark' ? 'light' : 'dark';
     apply(newTheme);
     localStorage.setItem('theme', newTheme);
   });
 }
 function apply(t){
   root.dataset.bsTheme = t;
   if(btn) btn.textContent = t === 'dark' ? 'Modo Claro' : 'Modo Escuro';
 }
})();
