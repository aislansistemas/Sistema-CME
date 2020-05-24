function limpar_recebido_geral(){
	let ajax=new XMLHttpRequest();
	ajax.open('GET', 'teste.php?acao_interno_geral');
	ajax.onreadystatechange=()=>{
	if(ajax.readyState==4 && ajax.status==200){
		return
		}
		if(ajax.readyState==4 && ajax.status==404){
			document.getElementById('conteudo').innerHTML='requisicao concluida,error 404';
			}
		}
	ajax.send();
}

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

function limpar_pre_processar(key,id){
	let ajax=new XMLHttpRequest();
	ajax.open('GET', 'teste.php?acao_pre_processar&key='+key+'&materialid='+id);
	ajax.onreadystatechange=()=>{
	if(ajax.readyState==4 && ajax.status==200){
				window.location.reload()		
		}
		if(ajax.readyState==4 && ajax.status==404){
					
			document.getElementById('conteudo').innerHTML='requisicao concluida,error 404';
			}
		}
	ajax.send();
}

function limpar_pre_processar_geral(){
	let ajax=new XMLHttpRequest();
	ajax.open('GET', 'teste.php?acao_pre_prcessar_geral');
	ajax.onreadystatechange=()=>{
	if(ajax.readyState==4 && ajax.status==200){
		return
		}
		if(ajax.readyState==4 && ajax.status==404){
			document.getElementById('conteudo').innerHTML='requisicao concluida,error 404';
			}
		}
	ajax.send();
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
function limpar_recebido_externo_geral(){
	let ajax=new XMLHttpRequest();
	ajax.open('GET', 'teste.php?acao_externo_geral');
	ajax.onreadystatechange=()=>{
	if(ajax.readyState==4 && ajax.status==200){
			return
		}
		if(ajax.readyState==4 && ajax.status==404){
			document.getElementById('conteudo').innerHTML='requisicao concluida,error 404';
			}
		}
	ajax.send();
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

function limpar_pre_processar_externo(key,nome){
	let ajax=new XMLHttpRequest();
					//console.log(ajax.readyState);
	ajax.open('GET', 'teste.php?acao_pre_processar_externo&key='+key+'&materialnome='+nome);

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