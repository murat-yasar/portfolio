console.log('JS file initiated!');

document.getElementById('nav-toggle').addEventListener('click', function() {
  document.querySelector('.nav-menu').classList.toggle('active');
});
