function send(id){
    document.getElementById('loading').style.display = 'block';
    document.getElementById('send').remove();
    document.getElementById('destroy' + id).submit();
}    


