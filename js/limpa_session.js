function limpar(key,id){
	let ajax=new XMLHttpRequest();
					//console.log(ajax.readyState);
	ajax.open('GET', 'teste.php?acao_interno&key='+key+'&materialid='+id);
	console.log(ajax.readyState);

	ajax.onreadystatechange=()=>{
	if(ajax.readyState==4 && ajax.status==200){
				window.location.reload()		
		}
		if(ajax.readyState==4 && ajax.status==404){
					
			document.getElementById('conteudo').innerHTML='requisicao concluida,error 404';
					//document.getElementById('loading').remove();
			}
		}
	ajax.send();
	//console.log(ajax);
}

function limparSaidaInterna(key,id){
	let ajax=new XMLHttpRequest();
	ajax.open('GET', 'teste.php?acao_saida_interno&key='+key+'&materialid='+id);
	console.log(ajax.readyState);

	ajax.onreadystatechange=()=>{
	if(ajax.readyState==4 && ajax.status==200){
				window.location.reload()		
		}
		if(ajax.readyState==4 && ajax.status==404){
					
			document.getElementById('conteudo').innerHTML='requisicao concluida,error 404';
					//document.getElementById('loading').remove();
			}
		}
	ajax.send();
	//console.log(ajax);
}

function limparSaidaExterno(key,id){
	let ajax=new XMLHttpRequest();
	ajax.open('GET', 'teste.php?acao_saida_externo&key='+key+'&materialid='+id);
	console.log(ajax.readyState);

	ajax.onreadystatechange=()=>{
	if(ajax.readyState==4 && ajax.status==200){
				window.location.reload()		
		}
		if(ajax.readyState==4 && ajax.status==404){
					
			document.getElementById('conteudo').innerHTML='requisicao concluida,error 404';
					//document.getElementById('loading').remove();
			}
		}
	ajax.send();
	//console.log(ajax);
}

function limparExterno(key){
	let ajax=new XMLHttpRequest();

	ajax.open('GET', 'teste.php?acao_externo&key='+key);

	ajax.onreadystatechange=()=>{
	if(ajax.readyState==4 && ajax.status==200){
				window.location.reload()
		}
		if(ajax.readyState==4 && ajax.status==404){
					
			document.getElementById('conteudo').innerHTML='requisicao concluida,error 404';
					//document.getElementById('loading').remove();
			}
		}
	ajax.send();
	//console.log(ajax);
}
function limparProcessados(key,nome){
	let ajax=new XMLHttpRequest();
					//console.log(ajax.readyState);
	ajax.open('GET', 'teste.php?acao_externo&key='+key+'&materialnome='+nome);

	ajax.onreadystatechange=()=>{
	if(ajax.readyState==4 && ajax.status==200){
				window.location.reload()		
		}
		if(ajax.readyState==4 && ajax.status==404){
					
			document.getElementById('conteudo').innerHTML='requisicao concluida,error 404';
					//document.getElementById('loading').remove();
			}
		}
	ajax.send();
	//console.log(ajax);
}