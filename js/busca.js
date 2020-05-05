function buscar(){
	var material=document.getElementById('pesse').value
	var id_hospital=document.getElementById('id_hospital').value

    console.log(material.length)
    if(material.length > 3){
	let ajax=new XMLHttpRequest();
					//console.log(ajax.readyState);
	ajax.open('GET', 'teste.php?busca&material='+material+'&id_hospital='+id_hospital);
	//console.log(ajax.readyState);
	
	ajax.onreadystatechange=()=>{
	if(ajax.readyState==4 && ajax.status==200){
			console.log(ajax.responseText)
			
			//var resultado=JSON.parse(ajax.responseText)	
			//console.log(resultado.id)
			if(document.getElementById('pesse').value === 0 ||
			 document.getElementById('pesse').value ==''){
				document.getElementById('pesse').value=''
			}else{
				//document.getElementById('material-id').value=resultado.id
				//document.getElementById('pesse').value=ajax.responseText
                document.getElementById('recebe').innerHTML=ajax.responseText
			}
		}
		if(ajax.readyState==4 && ajax.status==404){
					
			document.getElementById('conteudo').innerHTML='requisicao concluida,error 404';
					//document.getElementById('loading').remove();
			}
		}
	ajax.send();
	//console.log(ajax);
    }else{
        console.log('error')
    }
	
}

function insere(id){
    console.log(id)
    document.getElementById('material-id').value=id
    document.getElementById('ul').innerHTML=''
    console.log(document.getElementById('li').innerHTML)

}
