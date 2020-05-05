function editar(id,descricao,id_hospital){
	
			let div=document.createElement('div')
			div.className="d-flex justify-content-center"
			div.style="position:absolute;border-radius:20px;background: rgba(150,150,150,0.2);width:80%;"

			let form=document.createElement('form')
			form.action="Controllers/MaterialController.php?acao=editarativo"
			form.method="POST"
			form.className="form-group row d-flex justify-content-center"
			form.style="width:40%;"

			let inputid=document.createElement('input')
			inputid.type='hidden'
			inputid.name='id'
			inputid.value=id

			let inputid_hospital=document.createElement('input')
			inputid_hospital.type='hidden'
			inputid_hospital.name='id_hospital'
			inputid_hospital.value=id_hospital

			let labeldescricao=document.createElement('label')
			labeldescricao.className='text-dark mt-4'
			labeldescricao.innerHTML="descrição"
			labeldescricao.for="nome"
			labeldescricao.style="font-weight:bold"

			let inputdescricao=document.createElement('input')
			inputdescricao.type='text'
			inputdescricao.name='descricao'
			inputdescricao.className="form-control row "
			inputdescricao.value=descricao

					
			let button=document.createElement('button')
			button.type='submit'
			button.className='mt-4 mr-1 btn btn-success'
			button.innerHTML='Editar'
			button.style="font-weight: bold;"

			let link=document.createElement('a')
			link.href='materiaisativos.php'
			link.className='mt-4 btn btn-danger'
			link.innerHTML='Voltar'
			link.style="font-weight: bold;"

			div.appendChild(form)
			form.appendChild(labeldescricao)
			form.appendChild(inputdescricao)
			form.appendChild(inputid_hospital)
			form.appendChild(inputid)
			form.appendChild(button)
			form.appendChild(link)

			document.getElementById('cont').innerHTML=""
			let filmes=document.getElementById('cont')
	
			filmes.innerHTML=""
			filmes.insertBefore(div,filmes[0])	
	
		}
	function desativa(id,id_hospital){
		let div=document.createElement('div')
			div.className="d-flex justify-content-center"
			div.style="border-radius:20px;background: rgba(150,150,150,0.2);padding:2%"

			let h5=document.createElement('h5')
			h5.innerHTML="Deseja realmente desativar esse material?"
			h5.className="text-dark pl-2"

			let form=document.createElement('form')
			form.action="Controllers/MaterialController.php?acao=desativar"
			form.method="POST"
			form.className="form-group row d-flex justify-content-center"
			form.style="width:50%;"

			let inputid=document.createElement('input')
			inputid.type='hidden'
			inputid.name='id'
			inputid.value=id

			let inputid_hospital=document.createElement('input')
			inputid_hospital.type='hidden'
			inputid_hospital.name='id_hospital'
			inputid_hospital.value=id_hospital
			
			let button=document.createElement('button')
			button.type='submit'
			button.className='mt-2 mr-2 btn btn-success'
			button.innerHTML='Confirmar'
			button.style="font-weight: bold;"

			let link=document.createElement('a')
			link.href='materiaisativos.php'
			link.className='mt-2 mr-2 btn btn-danger'
			link.innerHTML='Voltar'
			link.style="font-weight: bold;"

			div.appendChild(form)
			form.appendChild(h5)	
			form.appendChild(inputid)
			form.appendChild(inputid_hospital)
			form.appendChild(button)
			form.appendChild(link)
			
			document.getElementById('cont').innerHTML=""
			let filmes=document.getElementById('cont')
	
			filmes.innerHTML=""
			filmes.insertBefore(div,filmes[0])
	}	

function ativar(id,id_hospital){
	let div=document.createElement('div')
			div.className="d-flex justify-content-center"
			div.style="border-radius:20px;background: rgba(150,150,150,0.2);padding:2%"

			let h5=document.createElement('h5')
			h5.innerHTML="Deseja realmente ativar esse material?"
			h5.className="text-dark pl-2 pr-5"

			let form=document.createElement('form')
			form.action="Controllers/MaterialController.php?acao=ativar"
			form.method="POST"
			form.className="form-group row d-flex justify-content-center"
			form.style="width:50%;"

			let inputid=document.createElement('input')
			inputid.type='hidden'
			inputid.name='id'
			inputid.value=id

			let inputid_hospital=document.createElement('input')
			inputid_hospital.type='hidden'
			inputid_hospital.name='id_hospital'
			inputid_hospital.value=id_hospital
			
			let button=document.createElement('button')
			button.type='submit'
			button.className='mt-2 mr-2 btn btn-success'
			button.innerHTML='Confirmar'
			button.style="font-weight: bold;"

			let link=document.createElement('a')
			link.href='materiaisinativos.php'
			link.className='mt-2 mr-2 btn btn-danger'
			link.innerHTML='Voltar'
			link.style="font-weight: bold;"

			div.appendChild(form)
			form.appendChild(h5)	
			form.appendChild(inputid)
			form.appendChild(inputid_hospital)
			form.appendChild(button)
			form.appendChild(link)
			
			document.getElementById('cont').innerHTML=""
			let filmes=document.getElementById('cont')
	
			filmes.innerHTML=""
			filmes.insertBefore(div,filmes[0])
}

function desativaUsuario(id,id_hospital){
			let div=document.createElement('div')
			div.className="d-flex justify-content-center"
			div.style="border-radius:20px;background: rgba(150,150,150,0.2);padding:2%"

			let h5=document.createElement('h5')
			h5.innerHTML="Deseja realmente desativar esse usuario?"
			h5.className="text-dark pl-2 pr-5"

			let form=document.createElement('form')
			form.action="Controllers/UsuarioController.php?acao=desativaUsuario"
			form.method="POST"
			form.className="form-group row d-flex justify-content-center"
			form.style="width:50%;"

			let inputid=document.createElement('input')
			inputid.type='hidden'
			inputid.name='id'
			inputid.value=id

			let inputid_hospital=document.createElement('input')
			inputid_hospital.type='hidden'
			inputid_hospital.name='id_hospital'
			inputid_hospital.value=id_hospital
			
			let button=document.createElement('button')
			button.type='submit'
			button.className='mt-2 mr-2 btn btn-success'
			button.innerHTML='Confirmar'
			button.style="font-weight: bold;"

			let link=document.createElement('a')
			link.href='usuarios.php'
			link.className='mt-2 mr-2 btn btn-danger'
			link.innerHTML='Voltar'
			link.style="font-weight: bold;"

			div.appendChild(form)
			form.appendChild(h5)	
			form.appendChild(inputid)
			form.appendChild(inputid_hospital)
			form.appendChild(button)
			form.appendChild(link)
			
			document.getElementById('cont').innerHTML=""
			let filmes=document.getElementById('cont')
	
			filmes.innerHTML=""
			filmes.insertBefore(div,filmes[0])
}

function ativaUsuario(id,id_hospital){
	let div=document.createElement('div')
			div.className="d-flex justify-content-center"
			div.style="border-radius:20px;background: rgba(150,150,150,0.2);padding:2%"

			let h5=document.createElement('h5')
			h5.innerHTML="Deseja realmente ativar esse usuario?"
			h5.className="text-dark pl-2 pr-5"

			let form=document.createElement('form')
			form.action="Controllers/UsuarioController.php?acao=ativaUsuario"
			form.method="POST"
			form.className="form-group row d-flex justify-content-center"
			form.style="width:50%;"

			let inputid=document.createElement('input')
			inputid.type='hidden'
			inputid.name='id'
			inputid.value=id

			let inputid_hospital=document.createElement('input')
			inputid_hospital.type='hidden'
			inputid_hospital.name='id_hospital'
			inputid_hospital.value=id_hospital
			
			let button=document.createElement('button')
			button.type='submit'
			button.className='mt-2 mr-2 btn btn-success'
			button.innerHTML='Confirmar'
			button.style="font-weight: bold;"

			let link=document.createElement('a')
			link.href='usuarios.php'
			link.className='mt-2 mr-2 btn btn-danger'
			link.innerHTML='Voltar'
			link.style="font-weight: bold;"

			div.appendChild(form)
			form.appendChild(h5)	
			form.appendChild(inputid)
			form.appendChild(inputid_hospital)
			form.appendChild(button)
			form.appendChild(link)
			
			document.getElementById('cont').innerHTML=""
			let filmes=document.getElementById('cont')
	
			filmes.innerHTML=""
			filmes.insertBefore(div,filmes[0])
}